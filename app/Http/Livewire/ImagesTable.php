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
    public $delete;
    public $view_images;
    public $update;
    public $id_principal;

    function mount($album_id = 0, $view_images = false, $update = false)
    {
        $this->id_principal = 0;
        $this->btndelete = false;
        $this->album_id = $album_id;
        $this->imagesCheck = array();
        $this->view_images = $view_images;
        $this->update = $update;
    }
    public function updatingAlbumId()
    {
        $this->resetPage();
    }
    public function actualizar()
    {
        $this->emit('render');
    }


    public function  updatedImagesCheck()
    {
        try {
            if (count($this->imagesCheck) == 2) {
                arsort($this->imagesCheck);
                if ((int)$this->imagesCheck[0] > (int)$this->imagesCheck[1]) {
                    if (($this->imagesCheck[0] - $this->imagesCheck[1]) > 1) {
                        $aux = ($this->imagesCheck[0] - $this->imagesCheck[1]);
                        for ($i = 0; $i <= $aux; $i++) {
                            $this->imagesCheck[$i] = (int)$this->imagesCheck[0] - $i;
                        }
                    }
                }
            } else {
                $aux = $this->imagesCheck;
                $this->imagesCheck = array();
                foreach ($aux as $key => $value) {
                    array_push($this->imagesCheck, (int)$value);
                }
            }
        } catch (\Throwable $th) {
            // dd($th);
            //throw $th;
        }
    }


    public function render()
    {
        try {
            if (count($this->imagesCheck) > 0) {
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

            if ($this->album_id > 0) {
                $principal = DB::table('main_images')->where('album_id', $this->album_id)->first();
                if ($principal) {
                    $this->id_principal = $principal->image_id;
                }
            }
            return view('livewire.images-table')->with('images', $images);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function desmarcar()
    {
        $this->imagesCheck = array();
    }

    public function principal($id)
    {
        // dd($this->album_id, $id);
        try {
            $exist = DB::table('main_images')->where('album_id', $this->album_id)->first();
            if ($exist) {
                $exist = DB::table('main_images')->where('album_id', $this->album_id)->delete();
            }
            $principal = DB::table('main_images')->insert([
                'album_id' => (int)$this->album_id,
                'image_id' => (int)$id
            ]);
            $this->dispatchBrowserEvent('success', ['message' => '']);
            $this->emit('render');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deleteImages()
    {
        if (count($this->imagesCheck) > 0) {
            foreach ($this->imagesCheck as $key => $value) {
                DB::table('images')->where('id', $value)->update([
                    'image_status' => 'E'
                ]);
            }

            $this->btndelete = false;
            $this->imagesCheck = array();
            $this->dispatchBrowserEvent('success', ['message' => '']);
        }
        $this->emit('render');
    }
    public function deleteOnlyImg()
    {
        try {
            DB::table('images')->where('id', $this->delete)->update([
                'image_status' => 'E'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
        $this->delete = 0;
        $this->emit('render');
    }

    public function dehydrate()
    {
        $this->dispatchBrowserEvent('close', ['message' => '']);
    }
}
