<?php

namespace App\Http\Livewire;

use Illuminate\Support\Arr;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ImagesSearch extends Component
{

    public $search;
    public $images = array();
    public  function mount($search = null)
    {
        $this->search = Str::slug(trim($search), ',');
        // $this->search=$search;
    }
    public function render()
    {
        $this->images = DB::table('images')
            ->select('images.*', 'albums.album_name')
            ->leftJoin('albums', 'albums.id', 'images.id_album')
            ->where('images.image_key_slug', 'like', '%' . $this->search . '%')
            ->get();
        return view('livewire.images-search');
    }
}
