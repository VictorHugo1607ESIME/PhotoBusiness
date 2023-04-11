<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Albums;
use App\Models\Images;
use Illuminate\Support\Facades\DB;


class AlbumsController extends Controller
{
    public $albums = null;
    public $images = null;
    public function __construct()
    {
        $this->albums = new Albums();
        $this->images = new Images();
    }
    public function index(Request $request)
    {
        $result['breadcrumb'] = array();
        array_push($result['breadcrumb'], ['title' => 'Albums', 'url' => url('admin/albums')]);
        $result['albums'] = DB::table('albums')
            ->select('albums.*', 'companies.company_name', DB::raw("count('images.id') as images_count"))
            ->Join('companies', 'companies.id', '=', 'albums.company_id', 'left outer')
            ->Join('images', 'images.id_album', '=', 'albums.id', 'left outer')
            ->where('albums.album_status', 'A')
            ->groupBy('albums.id')
            ->get();
        return view('admin.albums.index')->with('result', $result);
    }
    public function add(Request $request)
    {
        $result['breadcrumb'] = array();
        array_push($result['breadcrumb'], ['title' => 'Albums', 'url' => url('admin/albums')]);
        array_push($result['breadcrumb'], ['title' => 'Agregar album', 'url' => url('admin/albums/add')]);
        return view('admin.albums.add')->with('result', $result);
    }

    public function edit($id)
    {
        $result = array();
        $result['breadcrumb'] = array();
        array_push($result['breadcrumb'], ['title' => 'Albums', 'url' => url('admin/albums')]);
        array_push($result['breadcrumb'], ['title' => 'Agregar album', 'url' => url('admin/albums/add')]);
        array_push($result['breadcrumb'], ['title' => 'Editar album', 'url' => url('admin/albums/edit', $id)]);
        $id = base64_decode($id);
        if (is_numeric($id)) {
            $result['album'] = DB::table('albums')
                // ->select('albums')
                // ->leftJoin('companies', 'companies.id', 'albums.company_id')
                ->where('albums.id', $id)
                ->first();
        }
        $result['html_images'] = $this->getImages_album($id);
        return view('admin.albums.edit')->with('result', $result);
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'id' => 'required'
            ]);
            $id = $this->albums->edit($request->id, $request->name, $request->date);
            return redirect()->back()->with('success', true);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function insert(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $id = $this->albums->add($request->name, isset($request->date) ? $request->date : null);
            return redirect(url('admin/albums/edit', base64_encode($id)));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', true);
        }
    }

    public function insert_photos(Request $request)
    {
    }

    public function status($id)
    {
        $id = base64_decode($id);
        if (is_numeric($id)) {
            $status = $this->albums->set_status($id);
            if ($status) {
                return redirect()->back()->with('success', true);
            }
        }
        return redirect()->back()->with('success', true);
    }

    public function upImage(Request $request)
    {
        try {
            $album = DB::table('albums')->where('album_slug', trim($request->slug))->first();
            if ($album && $request->hasFile("file")) {
                $imagen = $request->file("file");
                $ruta = public_path("img/" . trim($request->slug)) . '/';
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                $dataImagen = getimagesize($imagen->getRealPath());
                $nameImagen = $imagen->getClientOriginalName();
                $ruta_asset = "/img/" . trim($request->slug) . '/' . $nameImagen;

                if (!empty($dataImagen)) {
                    try {
                        $data = exif_read_data($imagen->getRealPath());
                        $data =  (object)$data;
                    } catch (\Throwable $th) {
                        $data = null;
                    }
                    // add($id_album, $images_path, $images_url, $with, $height, $type = 'photo', $info = null)
                    $set = $this->images->add($nameImagen, $album->id, $ruta_asset, asset($ruta_asset), $dataImagen[0], $dataImagen[1], 'photo', $data);
                    copy($imagen->getRealPath(), $ruta . $nameImagen);
                }
                return response(['success' => true], 200);
            }
            return response(['success' => false], 404);
        } catch (\Throwable $th) {
            //throw $th;
            return response(['success' => false], 404);
        }
    }
    public function getImages_album($id_album)
    {
        // dd($id_album);
        try {
            $images = DB::table('images')->where('id_album', $id_album)->get();

            return view('admin.albums.get_images')->with('images', $images)->render();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
