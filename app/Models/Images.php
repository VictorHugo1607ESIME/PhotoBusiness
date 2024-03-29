<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Libs\helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Image;


class Images extends Model
{
    use HasFactory;
    // public $help;
    // public function __construct()
    // {
    //     $this->help = new helpers();
    // }
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
            if ($id_album > 0) {
                $count = DB::table('images')->where('id_album', $id_album)->get()->count();
                DB::table('albums')->where('id', $id_album)->update(['number_photos' => $count]);
            }
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
                $micarpeta = public_path('/temporalResize/' . Auth::id());
                if (!file_exists($micarpeta)) {
                    mkdir($micarpeta, 0777, true);
                }
                $image_resize->save($micarpeta . '/resize-' . $imagen->image_name, 100, 'jpg');

                DB::table('downloads')->insertGetId([
                    'id_image' => $idImage,
                    'id_user' => Auth::id(),
                    'download_with' => $requestWith,
                    'download_height' => $requestHeight,
                    'download_day' => date('d'),
                    'downloads_moth' => date('m'),
                    'download_year' => date('Y'),
                    'created_at' => date('Y-m-d H:s:i'),
                ]);

                return $micarpeta . "/resize-" . $imagen->image_name;
            }
            return false;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }
    public function moveImg($urlImg, $id_album)
    {
        try {
            $album = DB::table('albums')->where('id', $id_album)->first();
            $imagen = $urlImg;
            chmod($imagen, 0777);
            $ruta = public_path("img/" . trim($album->album_slug)) . '/';
            if (!file_exists($ruta)) {
                mkdir($ruta, 0777, true);
            }
            chmod($ruta, 0777);
            if (!$this->esImagen($imagen)) {
                unlink($imagen);
                return false;
            }
            $dataImagen = getimagesize($imagen);
            $arrayName = explode("/", $imagen);
            $nameImagen = $arrayName[count($arrayName) - 1];
            $ruta_asset = "/img/" . trim($album->album_slug) . '/' . $nameImagen;
            if (!empty($dataImagen)) {
                try {
                    $data = exif_read_data($imagen);
                    $data =  (object)$data;
                } catch (\Throwable $th) {
                    $data = null;
                }
                // add($id_album, $images_path, $images_url, $with, $height, $type = 'photo', $info = null)
                $set = $this->add($nameImagen, $album->id, $ruta_asset, asset($ruta_asset), $dataImagen[0], $dataImagen[1], 'photo', $data);
                copy($imagen, $ruta . $nameImagen);
                $optimice = $this->optimice($set);
                unlink($imagen);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function optimice($id)
    {
        try {
            $imagen = DB::table('images')->where('id', $id)->first();
            if ($imagen && file_exists(public_path($imagen->image_path))) {
                $image_resize = Image::make(public_path($imagen->image_path));
                // $image_resize->encode('jpg', 30);
                $micarpeta = public_path('/optimiceImg/');
                if (!file_exists($micarpeta)) {
                    mkdir($micarpeta, 0777, true);
                }
                $image_resize->save($micarpeta . '/optimice-' . $imagen->image_name, 15, 'jpg');
                $optimice = DB::table('images')->where('id', $id)->update([
                    'optimice_path' => '/optimiceImg/optimice-' . $imagen->image_name
                ]);
                chmod($micarpeta . '/optimice-' . $imagen->image_name, 0777);
                return true;
            }else{
                $optimice = DB::table('images')->where('id', $id)->update([
                    'optimice_path' => 1
                ]);
            }
            return false;
        } catch (\Throwable $th) {
            return false;
            //throw $th;
        }
    }

    function esImagen($path)
    {
        $imageSizeArray = getimagesize($path);
        $imageTypeArray = $imageSizeArray[2];
        return (bool)(in_array($imageTypeArray, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP)));
    }

    
}
