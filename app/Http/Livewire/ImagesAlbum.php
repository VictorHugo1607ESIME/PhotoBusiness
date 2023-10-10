<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class ImagesAlbum extends Component
{


    use WithPagination;
    public $search;
    protected $paginationTheme = 'bootstrap';

    public $idAlbum;

    public function mount($idAlbum = 0)
    {
        $this->idAlbum = $idAlbum;
    }
    public function render()
    {
        $album = DB::table('albums')->where('album_status', 'A')->where('id', $this->idAlbum)->first();
        $images = DB::table('images')
            ->select('images.*', 'albums.album_name')
            ->leftJoin('albums', 'albums.id', 'images.id_album')
            ->where('images.id_album', $this->idAlbum)
            ->paginate(50);
        return view('livewire.images-album', [
            'images' => $images,
            'album' => $album,
        ]);
    }
}
