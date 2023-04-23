<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Libs\helpers;
use Illuminate\Support\Facades\DB;

use Image;


class Images extends Model
{
    use HasFactory;
    public $help;
    public function __construct()
    {
        $this->help = new helpers();
    }
    public function add($name, $id_album, $images_path, $images_url, $with, $height, $type = 'photo', $info = null)
    {
        try {
            $exist = $this->exist_imagen($id_album, $name, true);
            $insert_id = DB::table('images')->insertGetId([
                'id_album' => $id_album,
                'image_name' => trim(strtolower($name)),
                'image_path' => $images_path,
                'image_url' => $images_url,
                'image_with' => $with,
                'image_height' => $height,
                'image_type' => $type,
                'image_info' => $info != null ? json_encode($info) : null,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            return $insert_id;
        } catch (\Throwable $th) {
            //throw $th;
            return 0;
        }
    }
    public function exist_imagen($album, $name, $deleted = false)
    {
        try {
            $exist = DB::table('images')->where('id_album', $album)->where('image_name', trim(strtolower($name)))->first();
            if ($deleted && $exist) {
                if (file_exists(public_path($exist->image_path))) {
                    unlink(public_path($exist->image_path));
                }
                DB::table('images')->where('id_album', $album)->where('image_name', trim(strtolower($name)))->delete();
            }
            return $exist ?  $exist->id : 0;
        } catch (\Throwable $th) {
            //throw $th;
            return 0;
        }
    }

    public function download_img($idImage, $requestWith, $requestHeight)
    {
        try {
            $modelImage = new Images();
            $imagen = DB::table('images')->where('id', $idImage)->first();
            if ($imagen && file_exists(public_path($imagen->image_path))) {
                if ($imagen->image_height == $requestHeight && $imagen->image_with == $requestWith) {
                    return public_path($imagen->image_path);
                }
                $image_resize = Image::make(public_path($imagen->image_path));
                $image_resize->resize($requestWith, $requestHeight, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $micarpeta = public_path('/temporalResize');
                if (!file_exists($micarpeta)) {
                    mkdir($micarpeta, 0777, true);
                }
                $image_resize->save($micarpeta . '/resize-' . $imagen->image_name, 100, 'jpg');
                return $micarpeta . "/resize-" . $imagen->image_name;
            }
            return false;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }
}
