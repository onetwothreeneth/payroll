<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use App\mandatory_meta;  

class Mandatory extends Controller
{
    public function update_save(Request $request,$id){   
 
    	$manda             = mandatory_meta::find($id);
    	$manda->type       = $request->input('type');
    	$manda->baserange  = $request->input('base_range');
    	$manda->monthly    = $request->input('monthly');
    	$manda->employee   = $request->input('employee');
    	$manda->employer   = $request->input('employer'); 

    	if($manda->save()){
    		$this->audit_trail($request->session()->get('id'),'Deductions','Uddate table ID #'.$id);

			return redirect()
			       ->route('mandatory',$request->input('type'))
			       ->with('success',  'Contribution tablehas been deleted');  
    	} else { 

			return redirect()
			       ->route('mandatory',$request->input('type'))
			       ->with('error',  'Something went wrong !');  
    	}
	        
    }
    public function delete(Request $request,$id){   
 
    	$manda             = mandatory_meta::find($id);  	
    	$manda->status     = 0;

    	if($manda->save()){
    		$this->audit_trail($request->session()->get('id'),'Deductions','Deleted table ID # '.$id);

			return redirect()
			       ->route('mandatory_add')
			       ->with('success',  'Contribution table has been deleted');  
    	} else { 

			return redirect()
			       ->route('mandatory_add')
			       ->with('error',  'Something went wrong !');  

    	}
	        
    }
    public function update(Request $request,$id){   

    	$data = mandatory_meta::find($id);

    	return view('mandatory.update.index')
    		 ->with(["data" => $data]);
    }
    public function save(Request $request){   
 
    	$manda             = new mandatory_meta;
    	$manda->type       = $request->input('type');
    	$manda->baserange  = $request->input('base_range');
    	$manda->monthly    = $request->input('monthly');
    	$manda->employee   = $request->input('employee');
    	$manda->employer   = $request->input('employer');
    	$manda->status     = 1;

    	if($manda->save()){
    		$this->audit_trail($request->session()->get('id'),'Deductions','Added new table');

			return redirect()
			       ->route('mandatory',$request->input('type'))
			       ->with('success',  'New Contribution table Added');  
    	} else { 

			return redirect()
			       ->route('mandatory_add')
			       ->with('error',  'Something went wrong !');  
    	}
	        
    }
    public function add(Request $request){   
    	return view('mandatory.add.index');
    }
    public function index(Request $request,$type){  

    	$model = mandatory_meta::whereIn('status',[1])->whereIn('type',[$type]);
    	$limit = 10;
    	
    	$paginator   = $this->paginator($limit,$model);
    	  
    	$mandatory   = $paginator['data'];
 
    	  
    	return view('mandatory.view.index')
    		   ->with(['mandatory'   => $mandatory])
    		   ->with(['type'        => $type])
    		   ->with(['pagination'  => $paginator['pagination']]);
    }
}
