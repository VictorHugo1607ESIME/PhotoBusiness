<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Illuminate\Support\Str;


class Collections extends Component
{
    use WithPagination;
    public $search;
    public $ids = array();
    protected $paginationTheme = 'bootstrap';

    public function mount($search = null)
    {
        $datos = Str::slug($search, ',');
        $this->search = $datos;
    }
    //
    public function getImageAlbum()
    {
    }
    public function render()
    {
        if ($this->search != null) {
            $aux = DB::table('images')
                ->leftJoin('albums', 'albums.id', 'images.id_album')
                ->select('id_album')->where('images.image_key_slug', 'LIKE', '%' . $this->search . '%')
                ->where('albums.album_status', 'A')
                ->groupBy('id_album')
                ->get();
            foreach ($aux as $key => $value) {
                array_push($this->ids, $value->id_album);
            }
        }
        $images = DB::table('main_images')
            ->leftJoin('images', 'images.id', 'main_images.image_id')
            ->leftJoin('albums', 'albums.id', 'main_images.album_id')
            ->orderByDesc('albums.date')
            ->where('albums.album_status', 'A')
            ->when(count($this->ids) > 0, function ($q) {
                $q->whereIn('albums.id', $this->ids);
            })
            ->paginate(50);
        return view('livewire.collections', [
            'images' => $images
        ]);
    }
}
