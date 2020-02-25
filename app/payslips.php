<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payslips extends Model
{
    public function data(){
        return json_decode($this->hasOne('App\payslips_meta','payroll_id','id')->first()->data);
    }
}
