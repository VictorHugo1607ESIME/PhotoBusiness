<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Libs\helpers;
use Illuminate\Support\Str;

class EditAlbum extends Component
{
    public $name;
    public $idAlbum;
    public $date;
    public $status;
    public $exclusive;
    public $album_keywords;
    public $albums_top;
    public $number_photos;

    public function mount($idAlbum = null)
    {
        $this->idAlbum = $idAlbum;
        $album = DB::table('albums')->where('id', $this->idAlbum)->first();
        if ($album) {
            $this->name = $album->album_name;
            $this->date = $album->date;
            $this->exclusive = $album->exclusive;
            $this->album_keywords = $album->album_keywords;
            $this->status = $album->album_status;
            $this->number_photos = $album->number_photos;
            $this->albums_top = $album->albums_top;
        }
    }
    public function render()
    {
        return view('livewire.edit-album');
    }
    public function updateData()
    {
        $count = DB::table('images')->where('id_album', $this->idAlbum)->count();
        $update = DB::table('albums')->where('id', $this->idAlbum)->update([
            'album_name' => trim($this->name),
            'album_slug' => $this->get_slug($this->name),
            'album_status' =>  $this->status,
            'number_photos' => $count,
            'album_keywords' => trim($this->album_keywords),
            'album_keywords_slug' => $this->keywords(trim($this->album_keywords)),
            'date' => $this->date,
        ]);

        if ($this->albums_top != null) {
            $top_albums = DB::table('albums')
                ->where('albums_top', $this->albums_top)->update([
                    'albums_top' => null
                ]);
            $new_top = DB::table('albums')
                ->where('id', $this->idAlbum)->update([
                    'albums_top' => $this->albums_top
                ]);
        }

        if ($this->status == 'E') {
            DB::table('images')->where('id_album', $this->idAlbum)->update([
                'image_status' => 'E'
            ]);
            DB::table('albums')->where('id', $this->idAlbum)->update([
                'album_status' => 'E',
            ]);
            return redirect()->to('/admin/albums');
        }
        $this->emit('render');
    }
    public function keywords($text)
    {
        if ($text == null) {
            return null;
        }
        try {
            $aux = array();
            $word = explode(',', $text);
            foreach ($word as $item) {
                if ($item != null) {
                    array_push($aux, $this->get_slug($item));
                }
            }
            return implode(",", $aux);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return null;
    }
    public function get_slug($data)
    {
        return Str::slug(trim($data), '_');
    }
}
