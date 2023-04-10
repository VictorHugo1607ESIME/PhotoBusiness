<?php

namespace App\Http\Controllers;

use App\Models\ImagesProducts;
use Illuminate\Http\Request;
use ZipArchive;
use App\Models\Bitacora;
use Illuminate\Support\Facades\DB;
use File;
use Storage;

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
        $result['images'] = DB::table('images')->orderBy('id', 'DESC')->get();
        return view('admin.images.index')->with('result', $result);
    }

    public function table_index()
    {
        $images = DB::table('images')->orderBy('id', 'DESC')->get();
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
                    DB::table('images')->where('id', $id)->delete();
                    $table= $this->table_index();
                    return response(['success' => true,'html'=>$table], 200);
            }
            return response(['success' => false], 404);
        } catch (\Throwable $th) {
            //throw $th;
            return response(['success' => false], 404);
        }
    }
}
