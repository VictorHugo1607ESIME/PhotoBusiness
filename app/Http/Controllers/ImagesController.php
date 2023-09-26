<?php

namespace App\Http\Controllers;

use App\Models\ImagesProducts;
use Illuminate\Http\Request;
use ZipArchive;
use App\Models\Bitacora;
use Illuminate\Support\Facades\DB;
use File;
use Storage;
use App\Models\Images;
use App\Models\Albums;
use Illuminate\Support\Str;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['breadcrumb'] = array();
        array_push($result['breadcrumb'], ['title' => 'Imagenes', 'url' => url('admin/images')]);
        if (session('user_id') == 30) {
            return redirect('/products')->with('alert', true);
        }

        return view('admin.images.index')->with('result', $result);
    }

    public function table_index($id_album = null)
    {
        $images = DB::table('images')->where('id_album', $id_album)->orderBy('id', 'DESC')->get();
        return view('admin.albums.get_images')->with('images', $images)->render();
    }

    public function img_temporales()
    {
        $thefolder_temp = public_path() . "/temp_product/";
        $img_temp = [];
        if ($handler = opendir($thefolder_temp)) {
            while (false !== ($file = readdir($handler))) {
                if ($file != "..." && $file != '.' && $file != "..") {
                    array_push($img_temp, $file);
                }
            }
        }
        return view('images.table_tem')->with('img_temp', $img_temp);
    }
    public function news()
    {
        $images = DB::table('images_products')->where('image_type', 'THUMBNAIL')->orderBy('updated_at', 'DESC')->limit(20)->get();
        return view('images.news_table')->with('images', $images);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sync_uploadImages(Request $request)
    {
        $modelImage = new ImagesProducts();
        $thefolder_temp = public_path() . "/temp_product/";
        $thefolder = public_path() . "/img_product/";
        $productos = [];
        if ($handler = opendir($thefolder_temp)) {
            while (false !== ($file = readdir($handler))) {
                if ($file != "..." && $file != '.' && $file != "..") {
                    $product = explode(".", $file);
                    if (count($product) > 2) {
                        $number_img = $product[1];
                    } else {
                        $number_img = 0;
                    }
                    //
                    $ACTUAL = $modelImage->img_resize($file, 'ACTUAL', $number_img, $product[0]);
                    //
                    $MEDIUM = $modelImage->img_resize($file, 'MEDIUM', $number_img, $product[0]);
                    //
                    $THUMBNAIL = $modelImage->img_resize($file, 'THUMBNAIL', $number_img, $product[0]);
                    $this->img_delete($file);
                    array_push($productos, $product[0]);
                }
            }
            closedir($handler);
        }
        if (count($productos) > 0) {
            return response(['status' => true, 'products' => $productos]);
        } else {
            return response(['status' => false, 'message' => 'No hay imagenes por sincronizar']);
        }
    }

    function move_to($img)
    {
        $thefolder_temp = public_path() . "/temp_product/";
        $thefolder = public_path() . "/img_product/";
        if (!file_exists($thefolder)) {
            mkdir($thefolder, 0777, true);
        }
        copy($thefolder_temp . $img, $thefolder . $img);
        unlink($thefolder_temp . $img);
    }
    public function delete_temp()
    {
        try {
            $thefolder_temp = public_path() . "/temp_product/";
            if (!file_exists($thefolder_temp)) {
                mkdir($thefolder_temp, 0777, true);
            }
            $files = glob($thefolder_temp . '*'); //obtenemos todos los nombres de los ficheros
            if (count($files) > 0) {
                foreach ($files as $file) {
                    if (is_file($file)) {
                        unlink($file); //elimino el fichero
                    }
                }
            }
            return response(['success' => true]);
        } catch (\Throwable $th) {
            return response(['success' => false]);
            //throw $th;
        }
    }


    public function productimg(Request $request)
    {
        $modelo = $request->model;
        $thefolder_temp = public_path() . "/temp_ind_product/";
        $imgs = $_FILES["file"]['name'];
        foreach ($imgs as $key => $img) {
            // var_dump($img.'----'.$modelo.'---'.strpos($img,$modelo).'<br>');
            if (strpos($img, $modelo) !== false) {
                if (!file_exists($thefolder_temp)) {
                    mkdir($thefolder_temp, 0777, true);
                }
                copy($_FILES["file"]["tmp_name"][$key], $thefolder_temp . $img);
            }
        }
        $modelImage = new ImagesProducts();
        $thefolder = public_path() . "/img_product/";
        $productos = [];
        if ($handler = opendir($thefolder_temp)) {
            while (false !== ($file = readdir($handler))) {
                if ($file != "..." && $file != '.' && $file != "..") {
                    $product = explode(".", $file);
                    if (count($product) > 2) {
                        $number_img = $product[1];
                    } else {
                        $number_img = 0;
                    }
                    if ($product[0] == $modelo) {
                        // //
                        $ACTUAL = $modelImage->img_resize_ind($file, 'ACTUAL', $number_img, $product[0]);
                        //
                        $MEDIUM = $modelImage->img_resize_ind($file, 'MEDIUM', $number_img, $product[0]);
                        //
                        $THUMBNAIL = $modelImage->img_resize_ind($file, 'THUMBNAIL', $number_img, $product[0]);
                        array_push($productos, $product[0]);
                    }
                    $this->img_delete_ind($file);
                }
            }
            closedir($handler);
        }
        if (count($productos) > 0) {
            return response(['status' => true, 'products' => $productos]);
        } else {
            return response(['status' => false, 'message' => 'No hay imagenes por sincronzar']);
        }
    }
    function img_delete_ind($img)
    {
        $thefolder_temp = public_path() . "/temp_ind_product/";
        unlink($thefolder_temp . $img);
    }

    function img_delete($img)
    {
        $thefolder_temp = public_path() . "/temp_product/";
        unlink($thefolder_temp . $img);
    }

    public function upImage(Request $request)
    {
        try {
            $img = $_FILES["file"]['name'];
            $thefolder_temp = public_path() . "/temp_product/";
            if (!file_exists($thefolder_temp)) {
                mkdir($thefolder_temp, 0777, true);
            }
            copy($_FILES["file"]["tmp_name"], $thefolder_temp . $img);
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }
    public function sync_produc()
    {
        $images = DB::table('images_products')->where('image_number', 0)->where('image_type', 'ACTUAL')->get();
        if ($images) {
            foreach ($images as $image) {
                $product = DB::table('products')->where('model', $image->model_product)->update([
                    'id_img' => $image->id
                ]);
            }
        }
        return redirect()->back()->with('success', true)->with('message', 'Sincronización realizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function downloadFile()
    {
        $file = 'no-img.png';
        $pathtoFile = asset('/img/' . $file);
        return response(['status' => true, 'url' => $pathtoFile, 'name' => $file]);
    }
    public function search($model, $number)
    {
        $image = DB::table('images_products')->where('model_product', $model)->where('image_number', $number)->where('image_type', 'ACTUAL')->first();
        if ($image) {
            $pathtoFile = asset($image->path);
            $file = str_replace('/img_product/', '', $image->path);
            return response(['status' => true, 'url' => $pathtoFile, 'name' => $file]);
        } else {
            return response(['status' => false]);
        }
    }

    public function eliminar($id)
    {
        $bitacora = new Bitacora();
        $thefolder = public_path();
        if ($id > 0) {
            $image = DB::table('images_products')->where('id', $id)->first();
            $imagenes = DB::table('images_products')->where('image_number', $image->image_number)->where('model_product', $image->model_product)->get();
            if ($image && $imagenes) {
                foreach ($imagenes as $item) {
                    if (file_exists($thefolder . $item->path)) {
                        unlink($thefolder . $item->path);
                    }
                    $image_delete = DB::table('images_products')->where('id', $item->id)->delete();
                }
                $bitacora->add("Eliminó la imagen $image->model_product No. $image->image_number", 'Imagenes');
                return response(['status' => true, 'message' => 'Imagen eliminada con éxito.', 'modelo' => $image->model_product]);
            }
        }
        return response(['status' => false, 'message' => 'La imagen no se eliminó.']);
    }
    public function notExist()
    {
        $images = DB::table('images_products')->whereRaw(" model_product NOT IN (SELECT model FROM products) AND image_type = 'ACTUAL'")
            ->orderBy('model_product')
            ->orderBy('id', 'DESC')
            ->get();
        return view('images.notExit')->with('images', $images);
    }
    public function notExist_update(Request $request)
    {
        $ids = $request->check;
        if (count($ids) > 0) {
            if ($request->action == 'e') {
                foreach ($ids as $id) {
                    $imagen = DB::table('images_products')->where('id', $id)->first();
                    if ($imagen) {
                        $imagenes = DB::table('images_products')
                            ->where('model_product', $imagen->model_product)
                            ->where('image_number', $imagen->image_number)
                            ->get();
                        if ($imagenes) {
                            foreach ($imagenes as $item) {
                                $path = $imagenes = DB::table('images_products')->where('path', $item->path)
                                    ->where('id', '!=', $item->id)
                                    ->first();
                                if (!$path) {
                                    if (file_exists(public_path($item->path))) {
                                        unlink(public_path($item->path));
                                    }
                                }
                                $eliminar = DB::table('images_products')->where('id', $item->id)->delete();
                            }
                        }
                    }
                }
            } else {
                foreach ($ids as $id) {
                    $imagen = DB::table('images_products')->where('id', $id)->first();
                    if ($imagen) {
                        $imagenes = DB::table('images_products')
                            ->where('model_product', $imagen->model_product)
                            ->where('image_number', $imagen->image_number)
                            ->update([
                                'model_product' => trim($request->modelo),
                            ]);
                    }
                }
            }

            return response(['status' => true]);
        }
        return response(['status' => false]);
    }
    public function delete_img_repited()
    {
        $products = DB::table('products')->where('status', 'A')->get();
        if ($products) {
            foreach ($products as $key => $product) {
                $count_img = DB::table('images_products')->where('model_product', $product->model)->max('image_number');
                for ($i = 0; $i <= $count_img; $i++) {
                    $count = DB::table('images_products')
                        ->where('model_product', $product->model)
                        ->where('image_number', $i)
                        ->where('image_type', 'ACTUAL')
                        ->count();
                    if ($count > 1) {

                        $ACTUAL = DB::table('images_products')
                            ->where('model_product', $product->model)
                            ->where('image_number', $i)
                            ->where('image_type', 'ACTUAL')
                            ->limit(1)->delete();

                        $THUMBNAIL = DB::table('images_products')
                            ->where('model_product', $product->model)
                            ->where('image_number', $i)
                            ->where('image_type', 'THUMBNAIL')
                            ->limit(1)->delete();

                        $MEDIUM = DB::table('images_products')
                            ->where('model_product', $product->model)
                            ->where('image_number', $i)
                            ->where('image_type', 'MEDIUM')
                            ->limit(1)->delete();
                    }
                }
            }
        }
        return redirect(URL('/images'));
    }

    public function deleted($id = 0)
    {
        try {
            if ($id != 0 && is_numeric($id)) {
                $imagen = DB::table('images')->where('id', $id)->first();
                if ($imagen && file_exists(public_path($imagen->image_path))) {
                    unlink(public_path($imagen->image_path));
                }
                if ($imagen && $imagen->optimice_path != null && file_exists(public_path($imagen->optimice_path))) {
                    unlink(public_path($imagen->optimice_path));
                }
                DB::table('images')->where('id', $id)->delete();
                $table = $this->table_index($imagen->id_album);
                return response(['success' => true, 'html' => $table], 200);
            }
            return response(['success' => false], 404);
        } catch (\Throwable $th) {
            //throw $th;
            return response(['success' => false], 404);
        }
    }
    public function info($id)
    {
        try {
            $image = DB::table('images')
                ->select('images.*', 'albums.album_name')
                ->Join('albums', 'albums.id', '=', 'images.id_album', 'left outer')
                ->where('images.id', $id)
                ->first();
            return view('admin.images.info')->with('image', $image);
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
            return '';
        }
    }
    function get_iptc_data($image_path)
    {
        $return = array('title' => '', 'subject' => '', 'tags' => '');
        $size = getimagesize($image_path, $info);

        if (is_array($info)) {
            $iptc = iptcparse($info["APP13"]);
            // var_dump($iptc); // this will show all the data retrieved but I'm only concerned with a few
            $return['title'] = $iptc['2#005'][0];
            $return['subject'] = $iptc['2#120'][0];
            $return['tags'] = $iptc['2#025'];
        }
        return $return;
    }

    public function automatic_optimiceImage()
    {
        try {
            $modelImage = new Images();
            $image = DB::table('images')
                ->where('images.optimice_path', null)
                ->orderBy('id', 'DESC')
                ->limit(50)
                ->get();
            if ($image) {
                foreach ($image as $item) {
                    var_dump($item->id);
                    $new = $modelImage->optimice($item->id);
                    var_dump('----' . $new . '<br>');
                }
            }
            // return response(['success' => true], 200);
        } catch (\Throwable $th) {
            return response(['error' => true], 200);
            //throw $th;
        }
    }
    public function automatic_checkImage()
    {
        try {
            $count = $image = DB::table('images')
                ->where('checkImage', false)
                ->where('image_status', 'A')
                ->count();
            if ($count < 1) {
                $image = DB::table('images')->update([
                    'checkImage' => false
                ]);
            }
            $images = $image = DB::table('images')
                ->where('checkImage', false)
                ->orderBy('id', 'DESC')
                ->where('image_status', 'A')
                ->limit(50)
                ->get();
            foreach ($images as $item) {
                var_dump('<br>' . $item->id);
                if (!file_exists(public_path($item->image_path))) {
                    DB::table('images')->where('id', $item->id)->update([
                        'image_status' => 'E'
                    ]);
                    var_dump('--delete');
                    continue;
                }
                if ($item->optimice_path != 1 && !file_exists(public_path($item->optimice_path))) {
                    DB::table('images')->where('id', $item->id)->update([
                        'optimice_path' => null
                    ]);
                    var_dump('--optimice null');
                }
                if ($item->id_album > 0) {
                    $count = DB::table('images')->where('id_album', $item->id_album)->get()->count();
                    DB::table('albums')->where('id', $item->id_album)->update(['number_photos' => $count]);
                }
                $this->getInfo($item->id);
                DB::table('images')->where('id', $item->id)->update([
                    'checkImage' => true
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function getInfo($id)
    {
        try {
            $modelo = new Images();
            $imagen = DB::table('images')->where('id', $id)->first();
            $modelo->get_titule(public_path($imagen->image_path));
            if ($imagen->image_info == null || $imagen->image_with == 0 || $imagen->image_height == 0) {
                $data = getimagesize(public_path($imagen->image_path), $i);
                if ($data) {
                    DB::table('images')->where('id', $id)->update([
                        'image_with' => $data[0],
                        'image_height' => $data[1],
                    ]);
                }
                $info = exif_read_data(public_path($imagen->image_path), 0, true);
                if ($info) {
                    DB::table('images')->where('id', $id)->update([
                        'image_info' => json_encode($info),
                    ]);
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function automatic_check_folder($carpeta = null)
    {
        $this->reade_folder();
        $folders = DB::table('temp_file')->where('type', 'folder')->orderBy('created_at', 'desc')->get();
        if ($folders) {
            foreach ($folders as $key => $folder) {
                $this->reade_folder($folder->name, 'file', $folder->id);
            }
            $this->delete_folder_empty();
        }
    }

    public function delete_folder_empty()
    {
        $thefolder = public_path('/upImg');
        $folders = DB::table('temp_file')->where('type', 'folder')->where('count', 0)->get();
        if ($folders) {
            foreach ($folders as $key => $item) {
                if (file_exists($thefolder . '/' . $item->name)) {
                    if (!is_dir($thefolder . '/' . $item->name)) {
                        mkdir($thefolder . '/' . $item->name);
                    } else {
                        rmdir($thefolder . '/' . $item->name);
                    }
                    DB::table('temp_file')->where('id', $item->id)->delete();
                    DB::table('temp_file')->where('id_folder', $item->id)->delete();
                }
            }
        }
    }

    public function reade_folder($folder = null, $type = 'folder', $id = 0)
    {
        if ($folder == null) {
            $thefolder = public_path('/upImg');
        } else {
            $thefolder = public_path('/upImg/' . $folder);
            if (!file_exists($thefolder)) {
                return null;
            }
            // DB::table('temp_file')->where('id_folder',$id)->delete();
        }
        // chmod($thefolder, 0777);
        if ($handler = opendir($thefolder)) {
            while (false !== ($file = readdir($handler))) {
                if ($file == '.' || $file == '..' || $file == '...') {
                    continue;
                }
                // chmod($thefolder . '/' . $file, 0777);
                if ($file == '.BridgeSort' || $file == '.DS_Store') {
                    // dd($thefolder . '/' . $file);
                    if (file_exists($thefolder . '/' . $file)) {
                        unlink($thefolder . '/' . $file);
                    }
                    continue;
                }
                // echo '<br>' . $file;
                $exists = DB::table('temp_file')->where('name', $file)->where('type', $type)->first();
                if (!$exists) {
                    DB::table('temp_file')->insert([
                        'name' => $file,
                        'type' => $type,
                        'ruta' => public_path($folder) . '/' . $file,
                        'id_folder' => $id
                    ]);
                }
            }
            closedir($handler);
        }
        if ($id != 0) {
            $count = DB::table('temp_file')->where('id_folder', $id)->count();
            DB::table('temp_file')->where('id', $id)->update([
                'count' => $count
            ]);
        }
    }
    public function automatic_sync()
    {
        try {
            $modelAlbums = new Albums();
            $path = public_path('img');
            $tem_path = public_path('upImg');
            $folder = DB::table('temp_file')->where('type', 'folder')
                ->where('count', '!=', 0)
                ->orderBy('count', 'DESC')
                ->first();
            if ($folder) {
                if (!is_dir($path . '/' . $folder->name)) {
                    mkdir($path . '/' . $folder->name, 0777, true);
                }
                $album = $modelAlbums->add($folder->name);
                $archivos = DB::table('temp_file')->where('id_folder', $folder->id)->limit(20)->get();
                foreach ($archivos as $item) {
                    $exists = DB::table('images')->where('image_name', $item->name)->first();
                    if (!$exists) {
                        $id = DB::table('images')->insertGetId([
                            'id_album' => $album,
                            'image_name' => $item->name,
                            'image_path' => '/img/' . $folder->name . '/' . $item->name,
                            'image_url' => public_path('/img/' . $folder->name . '/' . $item->name)
                        ]);
                        copy($tem_path . '/' . $folder->name . '/' . $item->name, $path . '/' . $folder->name . '/' . $item->name);
                        $this->getInfo($id);
                    }
                    // echo '<br>' . $item->name;
                    DB::table('temp_file')->where('id', $item->id)->delete();
                    unlink($tem_path . '/' . $folder->name . '/' . $item->name);
                }
                $count = DB::table('temp_file')->where('id_folder', $folder->id)->count();
                DB::table('temp_file')->where('id', $folder->id)->update([
                    'count' => $count
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function sync_manual()
    {
        try {
            $file = 0;
            $files = DB::table('temp_file')->where('type', 'file')
                ->count();
            if ($files > 0) {
                $this->automatic_sync();
                return response(['success' => true, 'code' => 200]);
            }
            $this->reade_folder();
            return response(['success' => false, 'code' => 404]);
        } catch (\Throwable $th) {
            //throw $th;
            return response(['success' => false, 'code' => 404]);
        }
    }
    public function automatic_delete_images()
    {
        try {

            $albums = DB::table('albums')->where('album_status', 'E')->get();

            if ($albums) {
                foreach ($albums as $key => $value) {
                    $img = DB::table('images')->where('id_album', $value->id)->update([
                        'image_status' => 'E'
                    ]);
                    $mis_fotos = public_path('img/' . $value->album_slug);
                    foreach (glob($mis_fotos . "/*.*") as $archivos_carpeta) {
                        unlink($archivos_carpeta);     // Eliminamos todos los archivos de la carpeta hasta dejarla vacia
                    }
                    $album = DB::table('albums')->where('id', $value->id)->delete();
                    // rmdir($mis_fotos);         // Eliminamos la carpeta vacia
                }
            }

            $images = DB::table('images')->where('image_status', 'E')->limit(100)->get();

            if ($images) {
                foreach ($images as $key => $item) {
                    if (file_exists(public_path($item->image_path))) {
                        unlink(public_path($item->image_path));
                    }
                    if (file_exists(public_path($item->optimice_path))) {
                        unlink(public_path($item->optimice_path));
                    }
                    DB::table('images')->where('id', $item->id)->delete();
                    var_dump('imagenes.-' . $item->id);
                    var_dump('<hr>');
                }
            }
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }

    function borrar_directorio($dirname)
    {
        //si es un directorio lo abro
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        //si no es un directorio devuelvo false para avisar de que ha habido un error
        if (!$dir_handle)
            return false;
        //recorro el contenido del directorio fichero a fichero
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                //si no es un directorio elemino el fichero con unlink()
                if (!is_dir($dirname . "/" . $file)) {
                    unlink($dirname . "/" . $file);
                } else { //si es un directorio hago la llamada recursiva con el nombre del directorio
                    $this->borrar_directorio($dirname . '/' . $file);
                }
            }
        }
        closedir($dir_handle);
        //elimino el directorio que ya he vaciado
        rmdir($dirname);
        return true;
    }

    public function automatic_primary_image()
    {
        $array_album = array();

        $main_image = DB::table('main_images')->select('album_id')->get();
        foreach ($main_image as $item) {
            array_push($array_album, $item->album_id);
        }
        $albums = DB::table('albums')
            ->where('album_status', 'A')
            ->whereNotIn('albums.id', $array_album)
            ->limit(50)
            ->orderBy('date', 'desc')
            ->get();
        if ($albums) {
            foreach ($albums as $item) {
                var_dump('album : ' . $item->id . '<br>');
                $images = DB::table('images')->where('id_album', $item->id)->get();
                if ($images) {
                    $count = $images->count();
                    $select = rand(0, $count);
                    if ($select < $count && $select > 0) {
                        $main = $images[$select];
                        if ($main) {
                            DB::table('main_images')->insert([
                                'image_id' => $main->id,
                                'album_id' => $item->id,
                                'created_at' => date('Y-m-d H:i:s')
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function viewImageInfo()
    {
        $result = array();
        $result['title'] = 'Automatic';
        return view('web.getImageInfo')->with('result', $result);
    }

    public function getImageInfo()
    {
        // $update = DB::table('images')->update(['image_check' => 0]);
        try {
            $image = DB::table('images')->where('image_status', 'A')->where('image_check', 0)->orderBy('id_album', 'ASC')->first();
            if ($image) {
                $update = DB::table('images')->where('id', $image->id)->update([
                    'image_check' => 2
                ]);
                return response(['image' => URL($image->image_path), 'id' => $image->id], 200);
            }
            return response(['image' => '', 'id' => ''], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }
    public function setImageInfo(Request $request)
    {
        try {
            $array_key = array();
            $datos = null;
            $image = DB::table('images')->where('id', $request->id)->first();
            if ($image) {
                if (isset($request->data['title']['description'])) {
                    $image = DB::table('images')->where('id', $request->id)->update([
                        'image_title' => trim($request->data['title']['description']),
                        'image_check' => 1
                    ]);
                    array_push($array_key, trim($request->data['title']['description']));
                }
                if (isset($request->data['Keywords'])) {
                    foreach ($request->data['Keywords'] as $key => $value) {
                        if (isset($value['description'])) {
                            array_push($array_key, $value['description']);
                        }
                    }
                }
                if (count($array_key) > 0) {
                    $datos = implode(',', $array_key);
                    $datos_slug = Str::slug($datos, ',');
                    $image = DB::table('images')->where('id', $request->id)->update([
                        'image_key' => $datos,
                        'image_key_slug' => $datos_slug,
                        'image_check' => 1
                    ]);
                }
                return response([], 200);
            }
            return response([], 404);
        } catch (\Throwable $th) {
            //throw $th;
            return response([], 404);
        }
    }
}
