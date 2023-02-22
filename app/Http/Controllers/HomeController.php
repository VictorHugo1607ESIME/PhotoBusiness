<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $result['title'] = 'Home';
        return view('web/home');
    }

    public function collections(){
        $result['title'] = 'Colecciones';
        return view('web/collections');
    }
}
