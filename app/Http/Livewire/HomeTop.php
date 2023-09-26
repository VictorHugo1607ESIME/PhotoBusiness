<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;

use Livewire\Component;

class HomeTop extends Component
{

    public $dataArray = array();
    public function mount()
    {
        $dataArray = array();
        $data = DB::table('albums')->whereIn('albums_top', [1])->get();
        if ($data) {
            foreach ($data as $key => $value) {
                $image = DB::table('main_images')
                    ->leftJoin('images', 'images.id', 'main_images.image_id')
                    ->leftJoin('albums', 'albums.id', 'main_images.album_id')
                    ->where('main_images.album_id', $value->id)
                    ->first();
                if (!$image) {
                    $image = DB::table('images')
                        ->leftJoin('albums', 'albums.id', 'images.album_id')
                        ->where('album_id', $value->id)
                        ->orderBy('images.id')
                        ->first();
                }
                if ($image) {
                    array_push($dataArray, [
                        'album_id' => $value->id,
                        'url' => asset($image->image_path),
                        'album' => $image->album_name,
                        'title' => $image->image_title,
                        'height' => $image->image_height,
                        'with' => $image->image_with,
                        'ruta' => URL('/album/' . $image->id_album . '/' . $image->album_name)
                    ]);
                }
            }
        }
        $this->dataArray = $dataArray;
    }


    public function render()
    {


        return view('livewire.home-top');
    }
}
