<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\payslips_meta;

class employees extends Model
{
    public function dept(){
        return $this->hasOne('App\departments','id','department')->first()->dept;
    }
    public function manda($type){
        return $this->hasOne('App\mandatory_meta','id',$type)->first()->employee;
    }
    public function leaves(){
        return $this->hasOne('App\leaves','emp_id','id')->whereIn('status',[1])->first();
    }
    public function check_leaves(){
        return $this->hasOne('App\leaves','emp_id','id')->whereIn('status',[1])->count();
    }
    public function loans(){
        return $this->hasOne('App\loans','emp_id','id')->whereIn('status',[1])->first();
    }
    public function check_loans(){
        return $this->hasOne('App\loans','emp_id','id')->whereIn('status',[1])->count();
    } 
    public function earnings($id){
        $payslips = payslips_meta::whereIn("status",[1])->get();

        $earnings = 0;

        foreach ($payslips as $k => $v) {

            $data     = json_decode($v->data);   

            if (@$data->$id) {
                $earnings = $earnings + ($data->$id->rates->profit);
            }

        }

        return number_format(round($earnings),2,'.',',');
    } 
}