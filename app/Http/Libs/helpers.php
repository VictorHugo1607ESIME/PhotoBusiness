<?php

namespace App\Libs;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class helpers 
{
    public function get_slug($data)
    {
        return Str::slug(trim($data),'_');
    }
}