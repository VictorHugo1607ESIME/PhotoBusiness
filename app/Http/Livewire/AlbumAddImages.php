<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AlbumAddImages extends Component
{
    public $album_id;
    public function mount($album_id = 0)
    {
        $this->album_id = $album_id;
    }
    public function render()
    {
        return view('livewire.album-add-images');
    }
}
