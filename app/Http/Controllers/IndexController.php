<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Albums;
use App\Models\Images;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    public function dashboard(Request $request)
    {   
        return view('admin.dashboard.index');
    }
}