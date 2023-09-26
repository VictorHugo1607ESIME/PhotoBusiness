<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Albums;
use App\Models\Images;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    public function dashboard(Request $request)
    {
        $result['visit_count'] = $result['visit_date'] = array();
        $end = date('Y-m-d');
        $start = date("Y-m-d", strtotime($end . "- 7 days"));
        $days = abs((strtotime($start) - strtotime($end)) / 86400);
        for ($i = 0; $i <= $days; $i++) {
            $fecha = date("Y-m-d", strtotime($start . "+ " . $i . " days"));
            $fecha2 = date("Y-m-d", strtotime($start . "+ " . ($i + 1) . " days"));
            $count = DB::table('user_visit')->whereBetween('created_at', [$fecha, $fecha2])->count();
            array_push($result['visit_count'], $count);
            array_push($result['visit_date'], $fecha);
        }
        $result['count_images'] = DB::table('images')->where('image_status', 'A')->count();
        $result['count_albums'] = DB::table('albums')->where('album_status', 'A')->count();
        $result['count_exclusive'] = DB::table('albums_exclusive')->count();
        $result['count_users'] = DB::table('users')->where('id_role', 2)->where('status', 'A')->count();

        return view('admin.dashboard.index')->with('result', $result);
    }
}
