<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\audit_trail; 
use App\admin_meta; 
use App\admin;  

class Audittrail extends Controller
{
    public function index(Request $request){  

    	$model = audit_trail::whereIn('status',[1]);
    	$limit = 10;
    	
    	$paginator   = $this->paginator($limit,$model);
    	  
    	$audit_trail = $paginator['data'];

    	$audit_array = array();

    	foreach ($audit_trail as $key => $value) {

            $sql = admin::whereIn('id',[$value->auth_id])->first();

    		$data = array(
    			'data'  => $value, 
    			'photo' => $sql->photo()->meta_value, 
    			'name'  => $sql->name, 
    			'type'  => $sql->type, 
    		);

    		array_push($audit_array, $data);
    	} 
    	  
    	return view('audit_trail.index')
    		   ->with(['audit_trail' => $audit_array])
    		   ->with(['pagination'  => $paginator['pagination']]);
    }
}
