<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
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

    function generalData(){
        $generalData['isLogin'] = false;
        return $generalData;
    }
}
