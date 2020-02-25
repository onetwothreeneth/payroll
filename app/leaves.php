<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class leaves extends Model
{
    public function type(){
        return $this->hasOne('App\leaves_meta','id','leave_type')->first()->name;
    }
    public function employee(){
        return $this->hasOne('App\employees','id','emp_id')->first();
    } 
}
