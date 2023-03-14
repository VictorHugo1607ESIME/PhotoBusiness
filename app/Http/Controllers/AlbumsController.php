<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Albums;


class AlbumsController extends Controller
{
    public function __construct()
    {
        $this->albums = new Albums();
    }
    public function index(Request $request)
    {
    }
    public function add(Request $request)
    {

        return view();
    }

    public function edit($id)
    {
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
            $id = $this->albums->add($request->name);
            return redirect()->back()->with('success', true);
        } catch (\Throwable $th) {
            //throw $th;
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
