<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class TableAlbums extends Component
{
    public $albums;
    public $id_delete;

    public function mount()
    {
        $this->id_delete = 0;
    }
    public function render()
    {
        $this->albums = DB::table('albums')->where('album_status', 'A')->orderBy('date', 'DESC')->get();

        return view('livewire.table-albums');
    }

    public function deleteAlbum($id)
    {
        try {
            DB::table('images')->where('id_album', $id)->update([
                'image_status' => 'E'
            ]);
            DB::table('albums')->where('id', $id)->update([
                'album_status' => 'E',
            ]);
            $this->dispatchBrowserEvent('success', ['message' => '']);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
