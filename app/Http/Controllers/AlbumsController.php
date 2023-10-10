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
            ->select('albums.*', 'companies.company_name', "number_photos as images_count")
            ->Join('companies', 'companies.id', '=', 'albums.company_id', 'left outer')
            // ->Join('images', 'images.id_album', '=', 'albums.id', 'left outer')
            ->where('albums.album_status', 'A')
            ->groupBy('albums.id')
            ->orderBy('albums.id', 'DESC')
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
        $result['id'] = $id;
        if (is_numeric($id)) {
            $result['album'] = DB::table('albums')
                // ->select('albums')
                // ->leftJoin('companies', 'companies.id', 'albums.company_id')
                ->where('albums.id', $id)
                ->first();
        }
        // $result['html_images'] = $this->getImages_album($id);
        return view('admin.albums.edit')->with('result', $result);
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'id' => 'required'
            ]);

            $id = $this->albums->edit($request->id, $request->name, $request->date, $request->album_keywords);
            if (isset($request->exclusive)) {
                $this->albums->album_exclusiva($id, $request->exclusive);
            }
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
            if (isset($request->exclusive) && $request->exclusive == "true") {
                $this->albums->album_exclusiva($id, $request->exclusive);
            }
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
            $dataImagen = array();
            $album = DB::table('albums')->where('id', (int)$request->album_id)->first();
            if ($album && $request->file("file")) {
                $imagen = $request->file("file");
                $ruta = public_path("img/" . trim($album->album_slug)) . '/';
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                chmod($ruta, 0777);
                $dataImagen[0] = 0;
                $dataImagen[1] = 0;
                // $dataImagen = getimagesize(realpath($request->file("file")));
                // dd($dataImagen);
                $nameImagen = $imagen->getClientOriginalName();
                $ruta_asset = "/img/" . trim($album->album_slug) . '/' . $nameImagen;
                // copy(realpath($request->file("file")), $ruta . $nameImagen);
                $request->file('file')->move($ruta, $nameImagen);
                if (!empty($dataImagen)) {
                    chmod(public_path($ruta_asset), 0777);
                    try {
                        $data = exif_read_data(realpath($request->file("file")));
                        $data =  (object)$data;
                    } catch (\Throwable $th) {
                        $data = null;
                    }
                    // add($id_album, $images_path, $images_url, $with, $height, $type = 'photo', $info = null)
                    $set = $this->images->add($nameImagen, $album->id, $ruta_asset, asset($ruta_asset), $dataImagen[0], $dataImagen[1], 'photo', $data);
                    if ($set > 0) {
                        // $this->images->optimice($set);
                        // $this->getInfo($set);
                    }
                    $this->countImages($album->id);
                }
                return response(['success' => true], 200);
            }
            return response(['success' => false], 404);
        } catch (\Throwable $th) {
            //throw $th;
            return response(['success' => false], 404);
        }
    }
    public function getInfo($id)
    {
        try {
            $modelo = new Images();
            $imagen = DB::table('images')->where('id', $id)->first();
            $modelo->get_titule(public_path($imagen->image_path));
            if ($imagen->image_info == null || $imagen->image_with == 0 || $imagen->image_height == 0) {
                $data = getimagesize(public_path($imagen->image_path), $i);
                if ($data) {
                    DB::table('images')->where('id', $id)->update([
                        'image_with' => $data[0],
                        'image_height' => $data[1],
                    ]);
                }
                $info = exif_read_data(public_path($imagen->image_path), 0, true);
                if ($info) {
                    DB::table('images')->where('id', $id)->update([
                        'image_info' => json_encode($info),
                    ]);
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function countImages($album_id)
    {
        try {
            $images = DB::table('images')->where('id_album', $album_id)->where('image_status', 'A')->count();
            DB::table('albums')->where('id', $album_id)->update([
                'number_photos' => $images,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }



    public function getImages_album($id_album)
    {
        // dd($id_album);
        try {
            $images = DB::table('images')
                ->where('image_status', 'A')
                ->where('id_album', $id_album)
                ->get();

            return view('admin.albums.get_images')->with('images', $images)->render();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function top_html($id)
    {
        try {
            $album = DB::table('albums')->where('id', $id)->first();
            return view('admin.albums.form_top')->with('album', $album)->render();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function top_edit(Request $request)
    {
        try {
            $top_albums = DB::table('albums')
                ->where('albums_top', $request->album_top)->update([
                    'albums_top' => null
                ]);
            $new_top = DB::table('albums')
                ->where('id', $request->id)->update([
                    'albums_top' => $request->album_top
                ]);
            return redirect()->back()->with('success', true);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', true);
        }
    }
    public function syncFTP($ruta = null, $id_album = 0)
    {
        try {
            if ($ruta == null) {
                $ruta = public_path('upImg');
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                    chmod($ruta, 0777);
                }
            }
            echo $ruta . '<br>';
            if (is_dir($ruta)) {
                $gestor = opendir($ruta);
                while (($archivo = readdir($gestor)) !== false) {
                    $ruta_completa = $ruta . "/" . $archivo;
                    if ($archivo != "." && $archivo != "..") {
                        // Si es un directorio se recorre recursivamente
                        echo $archivo . '<br>';
                        if (is_dir($ruta_completa)) {
                            ///si es carpeta
                            $id_album = $this->albums->add($archivo);
                            $this->syncFTP($ruta_completa, $id_album);
                        } else {
                            // si es arcvhivo
                            $this->images->moveImg($ruta_completa, $id_album);
                        }
                    }
                }
                closedir($gestor);
                echo '<br>Archivos vacios';
            }
            sleep(5);
            $ruta = public_path('upImg');
            rmdir($ruta, true);
            if (!file_exists($ruta)) {
                mkdir($ruta, 0777, true);
                chmod($ruta, 0777);
            }
        } catch (\Throwable $th) {
            echo '<br> Error al realizar el proceso.';
            //throw $th;
        }
        echo '<br> Proceso terminado';
    }
    public function delete_album($id)
    {
        try {
            $exist = DB::table('albums')->where('id', $id)->get();
            if ($exist) {
                DB::table('albums')->where('id', $id)->delete();
                DB::table('images')->where('id_album', $id)->update(['image_status', 'A']);
                return redirect()->back()->with('success', true);
            }
            return redirect()->back()->with('error', true);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', true);
        }
    }
    public function index_exclusives()
    {
        $result['breadcrumb'] = array();
        array_push($result['breadcrumb'], ['title' => 'Albums', 'url' => url('admin/albums')]);
        array_push($result['breadcrumb'], ['title' => 'Exlusivas', 'url' => url('admin/albums/exclusives')]);
        $result['albums'] = DB::table('albums')
            ->select('albums.*', 'companies.company_name')
            ->Join('companies', 'companies.id', '=', 'albums.company_id', 'left outer')
            // ->Join('images', 'images.id_album', '=', 'albums.id', 'left outer')
            ->where('albums.exclusive', 1)
            ->where('albums.album_status', 'A')
            ->groupBy('albums.id')
            ->orderBy('albums.id', 'DESC')
            ->get();
        return view('admin.albums.exclusives')->with('result', $result);
    }
    public function configure_exclusives($id)
    {
        $result['breadcrumb'] = array();
        array_push($result['breadcrumb'], ['title' => 'Albums', 'url' => url('admin/albums')]);
        array_push($result['breadcrumb'], ['title' => 'Exlusivas', 'url' => url('admin/albums/exclusives')]);
        array_push($result['breadcrumb'], ['title' => 'Exlusivas configuración', 'url' => url('admin/albums/exclusives', $id)]);
        $result['album'] = DB::table('albums')
            ->select('albums.*', 'companies.company_name')
            ->Join('companies', 'companies.id', '=', 'albums.company_id', 'left outer')
            // ->Join('images', 'images.id_album', '=', 'albums.id', 'left outer')
            ->where('albums.id', $id)
            ->first();
        $result['users'] = DB::table('users')->where('status', 'A')->get();

        $result['users_exclusive'] = DB::table('albums_exclusive')
            ->select('users.user_name', 'users.email', 'albums_exclusive.*')
            ->leftJoin('users', 'users.id', 'albums_exclusive.user_id')
            ->where('albums_exclusive.album_id', $id)
            ->where('users.status', 'A')
            ->get();
        return view('admin.albums.configure_exclusive')->with('result', $result);
    }

    public function update_exclusive(Request $request)
    {
        try {
            if (isset($request->ids)) {
                foreach ($request->ids as  $value) {
                    $exist = DB::table('albums_exclusive')->where('album_id', $request->id_album)->where('user_id', $value)->first();
                    if (!$exist) {
                        DB::table('albums_exclusive')->insertGetId([
                            'album_id' => $request->id_album,
                            'user_id' => $value
                        ]);
                    }
                }
                return redirect()->back()->with('success', true);
            }
            return redirect()->back()->with('error', true);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', true);
        }
    }
    public function delete_exclusive($id = 0)
    {
        try {
            if ($id != 0) {
                DB::table('albums_exclusive')->where('id', $id)->delete();
                return response(['success' => true], 200);
            }
            return response(['success' => false], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response(['success' => false], 200);
        }
    }
    public  function add_view_images($id)
    {
        $result['album'] = DB::table('albums')
            ->where('albums.id', $id)
            ->first();
        $this->countImages($id);
        return view('admin.albums.add_images')->with('result', $result)->with('id', $id);
    }
}
