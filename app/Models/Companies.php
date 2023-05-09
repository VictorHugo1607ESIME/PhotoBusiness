<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Libs\helpers;

class Companies extends Model
{
    use HasFactory;
    public $help;
    public function __construct()
    {
        $this->help = new helpers();
    }
    public function add($name)
    {
        try {
        $insert_id = DB::table('companies')->insertGetId([
            'company_name' => trim($name),
            'company_slug' => $this->help->get_slug($name),
            'company_status'=>'A',
        ]);
        return $insert_id;
        } catch (\Throwable $th) {
            //throw $th;
            return 0;
        }
    }
    public function edit($id,$name)
    {
        try {
        $update = DB::table('albums')->where('id',$id)->update([
            'company_name' => trim($name),
            'company_slug' => $this->help->get_slug($name),
        ]);
        return $id;
        } catch (\Throwable $th) {
            //throw $th;
            return 0;
        }
    }

    public function set_status($id)
    {
        try {
        $status='A';
        $row = DB::table('companies')->where('id',$id)->first();
        if ($row->company_status='A') {
            $status='E';
        }
        $update = DB::table('companies')->where('id',$id)->update([
            'company_status'=>$status,
        ]);
        return true;
    } catch (\Throwable $th) {
        //throw $th;
        return false;
    }
    }
}
