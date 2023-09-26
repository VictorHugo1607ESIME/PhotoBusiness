<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class IconCard extends Component
{
    public $contador;

    public function mount()
    {
        $this->contador = 0;
    }
    public function render()
    {
        $contador = DB::table('downloads')
            ->select(
                'downloads.downloads_id',
                'downloads.id_image',
                'downloads.id_album',
                'downloads.status',
                'images.id',
                'images.id_album',
                'images.image_path',
                'images.image_with',
                'images.image_height',
                'images.optimice_path',
                'images.created_at',
                'images.updated_at',
                'albums.album_name',
            )
            ->join('images', 'images.id', 'downloads.id_image')
            ->join('albums', 'albums.id', 'images.id_album')
            ->where('downloads.id_user', session('id_user'))
            ->where('downloads.status', 0)
            ->count();
        if ($contador > 0) {
            $this->contador = $contador;
        }
        return view('livewire.icon-card');
    }

    public function update_cart()
    {
        $this->dispatchBrowserEvent('update-cart', ['newName' => true]);
        $this->emit('render');
    }
}
