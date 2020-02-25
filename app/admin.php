<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    public function photo(){
        return $this->hasOne('App\admin_meta','auth_id')->first();
    }
}
