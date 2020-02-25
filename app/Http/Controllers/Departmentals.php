<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;  
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Input; 
use App\Http\Requests;   

use App\departments;

class Departmentals extends Controller
{ 
    public function delete(Request $request,$id){
  
    	$types = departments::find($id);

    	$types->status        = 0; 

    	if ($types->save()) {

            $this->audit_trail($request->session()->get('id'),'Departments','Deleted data with ID # '.$id);

			return redirect()
			       ->route('department')
			       ->with('success',  'Department has been Deleted !');  
    	} else {
			return redirect()
			       ->route('department')
			       ->with('error',  'Something went wrong !');  
    	}
    	
    }
    public function update_save(Request $request,$id){
  
    	$types = departments::find($id);

    	$types->dept        = $request->input('dept'); 

    	if ($types->save()) {

            $this->audit_trail($request->session()->get('id'),'Departments','Update data with ID # '.$id);

			return redirect()
			       ->route('department')
			       ->with('success',  'Department has been updated !');  
    	} else {
			return redirect()
			       ->route('department')
			       ->with('error',  'Something went wrong !');  
    	}
    	
    }
    public function update(Request $request,$id){
  		
  		$data = departments::find($id);

    	return view('departments.update.index')
    		 ->with(['data' => $data]);

    }
    public function save(Request $request){
  
    	$types = new departments;

        $types->dept        = $request->input('dept'); 
    	$types->status      = '1';

    	if ($types->save()) {

            $this->audit_trail($request->session()->get('id'),'Departments','Added new data');

			return redirect()
			       ->route('department')
			       ->with('success',  'New department has been added !');  
    	} else {
			return redirect()
			       ->route('department')
			       ->with('error',  'Something went wrong !');  
    	}
    	 
    }
    public function add(){
  
    	return view('departments.add.index');

    }
    public function index(Request $request){

    	$model = departments::whereIn('status',[1]);
    	$limit = 10;
    	
    	$paginator   = $this->paginator($limit,$model); 
    	$types       = $paginator['data']; 
    	  
    	return view('departments.view.index')
    		   ->with(['types'       => $types])
    		   ->with(['pagination'  => $paginator['pagination']]); 
    }

}
