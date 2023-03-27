<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Albums;
use Illuminate\Support\Facades\DB;


class AlbumsController extends Controller
{
    public $albums = null;
    public function __construct()
    {
        $this->albums = new Albums();
    }
    public function index(Request $request)
    {
        $result['albums'] = DB::table('albums')
            ->leftJoin('companies', 'companies.id', 'albums.company_id')
            ->where('albums.album_status', 'A')
            ->get();
        return view('admin.albums.index')->with('result', $result);
    }
    public function add(Request $request)
    {
        return view('admin.albums.add');
    }

    public function edit($id)
    {
        $result = array();
        $id = base64_decode($id);
        if (is_numeric($id)) {
            $result['album'] = DB::table('albums')
                ->leftJoin('companies', 'companies.id', 'albums.company_id')
                ->where('albums.id', $id)
                ->first();
        }
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
}
