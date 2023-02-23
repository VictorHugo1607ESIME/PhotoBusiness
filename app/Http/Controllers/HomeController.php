<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $result['title'] = 'Home';
        $result['description'] = 'Las mejores fotos de los espectáculos';
        return view('web/home')->with('result', $result);
    }

    public function collections(){
        $result['title'] = 'Colecciones';
        $result['description'] = 'Colecciones';
        return view('web/collections')->with('result', $result);;
    }
}
