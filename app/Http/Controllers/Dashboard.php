<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\audit_trail; 
use App\admin_meta; 
use App\admin; 
use App\employees; 
use App\leaves; 
use App\loans; 
use App\deductions; 

class Dashboard extends Controller
{
    public function index(Request $request){  

    	$audit_trail = audit_trail::limit(10)->orderBy('created_at','DESC')->get();
    	$audit_array = array();

    	foreach ($audit_trail as $key => $value) {
    		$data = array(
    			'data'  => $value, 
    			'photo' => admin_meta::whereIn('auth_id',[$value->auth_id])->first()->meta_value, 
    			'name'  => admin::whereIn('id',[$value->auth_id])->first()->name, 
    			'type'  => admin::whereIn('id',[$value->auth_id])->first()->type, 
    		);

    		array_push($audit_array, $data);
    	}

    	$employee   = employees::whereIn("status",[1])->count();
    	$leaves     = leaves::whereIn("status",[1])->count();
    	$loans      = loans::whereIn("status",[1])->count();
    	$deductions = deductions::whereIn("status",[1])->count();

    	$counter = array(
    		'employee'   => $employee, 
    		'leaves'     => $leaves, 
    		'loans'      => $loans, 
    		'deductions' => $deductions, 
    	);
    	 
    	return view('dashboard.index')
    		   ->with(['audit_trail' => $audit_array])
    		   ->with(['counter'     => $counter]);
    }
}
