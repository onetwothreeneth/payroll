<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loans extends Model
{ 
    public function type(){
        return $this->hasOne('App\loans_types','id','loan_type')->first()->type;
    }
    public function employee(){
        return $this->hasOne('App\employees','id','emp_id')->first();
    }
    public function status(){
        return $this->hasMany('App\loans_meta','loan_id','id')->sum('amount');
    } 
}
