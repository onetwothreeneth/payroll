<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class timekeeping extends Model
{
    public function employee(){
        return $this->hasOne('App\employees','id','emp_id')->first();
    } 
}
