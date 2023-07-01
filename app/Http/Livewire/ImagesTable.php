<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

use Livewire\Component;
use PHPUnit\Framework\Constraint\Count;

class ImagesTable extends Component
{
    use WithPagination;
    public $albums;
    public $album_id;

    public $imagesCheck = [];
    public $btndelete;

    function mount()
    {
        $this->btndelete = false;
        $this->album_id = 0;
        $this->imagesCheck = array();
    }

    public function render()
    {
        if (count($this->imagesCheck)) {
            $this->btndelete = true;
        } else {
            $this->btndelete = false;
        }
        $this->albums = DB::table('albums')->where('album_status', 'A')->get();
        if ($this->album_id > 0) {
            $images = DB::table('images')
                ->select('images.*')
                ->leftJoin('albums', 'albums.id', '=', 'images.id_album')
                ->where('images.id_album', $this->album_id)
                ->where('images.image_status', 'A')
                ->orderBy('images.id', 'DESC')
                ->paginate(50);
        } else {
            $images = DB::table('images')
                ->select('images.*')
                ->leftJoin('albums', 'albums.id', '=', 'images.id_album')
                ->orderBy('images.id', 'DESC')
                ->where('images.image_status', 'A')
                ->paginate(24);
        }

        return view('livewire.images-table')->with('images', $images);
    }

    public function deleteImages()
    {
        if (count($this->imagesCheck) > 0) {
            foreach ($this->imagesCheck as $key => $value) {
                DB::table('images')->where('id', $value)->update([
                    'image_status' => 'E'
                ]);
            }
            $this->emit('success','');
        }
    }
}
