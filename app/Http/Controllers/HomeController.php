<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

class HomeController extends Controller
{
    public function index(Request $request){

        $result['title'] = 'Home';
        $result['description'] = 'Las mejores fotos de los espectáculos';
        $result['generalData'] = $this->generalData();
        $result['isCoverPhoto'] = true;
        $result['page'] = 'home';
        return view('web/home')->with('result', $result);
    }

    public function collections(){
        $result['title'] = 'Colecciones';
        $result['description'] = 'Colecciones';
        $result['generalData'] = $this->generalData();
        $result['isCoverPhoto'] = true;
        $result['page'] = 'collections';
        return view('web/collections')->with('result', $result);;
    }

    public function exclusives(){
        $result['title'] = 'Exclusivas';
        $result['description'] = 'Exclusivas';
        $result['generalData'] = $this->generalData();
        $result['isCoverPhoto'] = true;
        $result['page'] = 'exclusive';
        return view('web/collections')->with('result', $result);;
    }

    public function politicas(){
        $result['title'] = 'Políticas de privacidad';
        $result['description'] = 'Políticas de privacidad';
        $result['generalData'] = $this->generalData();
        $result['page'] = null;
        return view('web/politicas')->with('result', $result);;
    }

    public function quienesSomos(){
        $result['title'] = 'Quienes Somos';
        $result['description'] = 'Quienes Somos';
        $result['generalData'] = $this->generalData();
        $result['page'] = null;
        return view('web/quienessomos')->with('result', $result);;
    }

    public function contact(){
        $result['title'] = 'Contacto';
        $result['description'] = 'Contacto';
        $result['generalData'] = $this->generalData();
        $result['page'] = null;
        return view('web/contact')->with('result', $result);;
    }

    public function album($nameAlbum){
        $result['title'] = $nameAlbum;
        $result['description'] = $nameAlbum;
        $result['generalData'] = $this->generalData();
        $result['isCoverPhoto'] = false;
        $result['page'] = 'collections';
        return view('web/album')->with('result', $result);;
    }

    public function comprar(){
        $result['title'] = 'Compara imágen';
        $result['description'] = 'Imágenes relacionadas';
        $result['generalData'] = $this->generalData();
        $result['isWideImage'] = false;
        $result['page'] = null;
        $result['isCoverPhoto'] = false;
        return view('web/comprar_imagen')->with('result', $result);;
    }

    public function myaccount(){
        $result['title'] = 'Mi cuenta';
        $result['description'] = 'Historial de descargas';
        $result['page'] = null;
        $result['isCoverPhoto'] = true;
        $result['generalData'] = $this->generalData();
        return view('web/myaccount')->with('result', $result);
    }

    public function shoppingcart(){
        $result['title'] = 'Mi cuenta';
        $result['page'] = null;
        $result['generalData'] = $this->generalData();
        return view('web/shoppingcart')->with('result', $result);
    }

    function generalData(){
        $generalData['isLogin'] = session('isLogin');
        $generalData['hasExclusives'] = true;
        return $generalData;
    }

    function login(Request $request){

        try {
            $dataUser = DB::table('users')->where('email', '=', $request->get('recipientEmail'))->first();
            if(isset($dataUser)){
                $credentials = ['email' => trim($request->recipientEmail), "password" => trim($request->recipientPass)];
                if (Auth::attempt($credentials)){
                    session(["isLogin" => true]);
                }else{
                    session(["isLogin" => false]);
                }
            }else{
                $request->session()->put('isLogin', false);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            dd($ex->getMessage());
        }
        return back();
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return back();
    }

    function getAlbum(){
        $dataAlbum = DB::table('users')->where('email', '=', $request->get('recipientEmail'))->first();
    }
}
