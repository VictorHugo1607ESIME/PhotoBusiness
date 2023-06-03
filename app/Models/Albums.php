<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Libs\helpers;
use Illuminate\Support\Facades\DB;

class Albums extends Model
{
    use HasFactory;
    public $help;
    public function __construct()
    {
        $this->help = new helpers();
    }

    public function album_exclusiva($id, $exclusive)
    {
        try {
            $id = DB::table('albums')->where('id', $id)->update([
                'exclusive' => $exclusive == 'true' || $exclusive == true || $exclusive == 1 ? true : false
            ]);
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }

    public function add($name, $date = null, $cont = 0)
    {
        try {
            $slug = $this->help->get_slug(trim($name));
            $exist = DB::table('albums')->where('album_slug', $slug)->first();
            if ($exist) {
                return $exist->id;
            }
            $insert_id = DB::table('albums')->insertGetId([
                'album_name' => trim($name),
                'album_slug' => $slug,
                'album_status' => 'A',
                'number_photos' => $cont,
                'date' => $date,
                'company_id' => session('company_id')
            ]);
            return $insert_id;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
            return 0;
        }
    }
    public function edit($id, $name, $date = null, $album_keywords, $cont = 0)
    {
        try {
            $update = DB::table('albums')->where('id', $id)->update([
                'album_name' => trim($name),
                'album_slug' => $this->help->get_slug($name),
                'album_status' => 'A',
                // 'number_photos' => $cont,
                'album_keywords' => trim($album_keywords),
                'album_keywords_slug' => $this->keywords(trim($album_keywords)),
                'date' => $date,
            ]);
            return $id;
        } catch (\Throwable $th) {
            //throw $th;
            return 0;
        }
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
                    array_push($aux, $this->help->get_slug($item));
                }
            }
            return implode(",", $aux);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return null;
    }

    public function set_status($id)
    {
        try {
            $status = 'A';
            $row = DB::table('albums')->where('id', $id)->first();
            if ($row->status = 'A') {
                $status = 'E';
            }
            $update = DB::table('albums')->where('id', $id)->update([
                'album_status' => $status,
            ]);
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }
}
