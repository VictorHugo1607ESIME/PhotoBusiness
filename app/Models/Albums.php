<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Libs\helpers;
use Illuminate\Support\Facades\DB;

class Albums extends Model
{
    use HasFactory;
    public $help;
    public function __construct()
    {
        $this->help = new helpers();
    }
    public function add($name,$date=null,$cont=0)
    {
        try {
        $insert_id = DB::table('albums')->insertGetId([
            'album_name' => trim($name),
            'album_slug' => $this->help->get_slug($name),
            'album_status'=>'A',
            'number_photos'=>$cont,
            'date'=>$date,
            'company_id'=>session('company_id')
        ]);
        return $insert_id;
        } catch (\Throwable $th) {
            //throw $th;
            return 0;
        }
    }
    public function edit($id,$name,$date=null,$cont=0)
    {
        try {
        $update = DB::table('albums')->where('id',$id)->update([
            'album_name' => trim($name),
            'album_slug' => $this->help->get_slug($name),
            'album_status'=>'A',
            'number_photos'=>$cont,
            'date'=>$date,
        ]);
        return $id;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
            return 0;
        }
    }

    public function set_status($id)
    {
        try {
        $status='A';
        $row = DB::table('albums')->where('id',$id)->first();
        if ($row->status='A') {
            $status='E';
        }
        $update = DB::table('albums')->where('id',$id)->update([
            'album_status'=>$status,
        ]);
        return true;
    } catch (\Throwable $th) {
        //throw $th;
        return false;
    }
    }
}
