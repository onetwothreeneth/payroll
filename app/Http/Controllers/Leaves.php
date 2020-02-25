<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;  
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Input; 
use App\Http\Requests;   

use App\leaves as leaveds;
use App\leaves_meta;
use App\employees;

class Leaves extends Controller
{ 
    public function update_save(Request $request,$id){
  
        $apply            = leaveds::find($id);  
        $apply->emp_id     = $id;
        $apply->leave_type = $request->input('leave_type');
        $apply->notes      = $request->input('notes'); 
        $apply->start      = $request->input('start'); 
        $apply->end        = $request->input('end');   

        if ($apply->save()) { 

            $this->audit_trail($request->session()->get('id'),'Leaves Application','Updated leaves application ID #'.$id);

            return redirect()
                   ->route('leaves')
                   ->with('success',  'Application for leaves has been updated !');  
        } else { 
            return redirect()
                   ->route('leaves')
                   ->with('error',  'Something went wrong !');  
        } 

    }
    public function update(Request $request,$id){

        $data = leaveds::find($id);
        $emp = leaveds::find($id)->employee();
        $leaves_meta = leaves_meta::whereIn('status',[1])->get();  

        return view('leaves.update.index')
             ->with(['data' => $data])
             ->with(["leaves_meta"  => $leaves_meta])
             ->with(["emp"          => $emp]);
        
    }
    public function delete(Request $request,$id){
  
        $apply            = leaveds::find($id); 
        $apply->status    = 0; 

        if ($apply->save()) { 

            $this->audit_trail($request->session()->get('id'),'Leaves Application','Deleted leaves application ID #'.$id);

            return redirect()
                   ->route('leaves')
                   ->with('success',  'Application for leave has been deleted !');  
        } else { 
            return redirect()
                   ->route('leaves')
                   ->with('error',  'Something went wrong !');  
        } 
        
    }
    public function index(){  

        $model = leaveds::whereIn('status',[1]);
        $limit = 10;
        
        $paginator   = $this->paginator($limit,$model);
          
        $data       = $paginator['data'];

        return view('leaves.view.index')
             ->with(["data" => $data])
             ->with(["pagination" => $paginator['pagination']]);
    }
    public function apply_save(Request $request,$id){
  
        $apply             = new leaveds;
        $apply->emp_id     = $id;
        $apply->leave_type = $request->input('leave_type');
        $apply->notes      = $request->input('notes'); 
        $apply->start      = $request->input('start'); 
        $apply->end        = $request->input('end');  
        $apply->status     = 1; 

        if ($apply->save()) { 

            $this->audit_trail($request->session()->get('id'),'Leaves Application','Added leave application for employee ID #'.$id);

            return redirect()
                   ->route('leaves')
                   ->with('success',  'Application for leave has been saved !');  
        } else { 
            return redirect()
                   ->route('leaves_apply')
                   ->with('error',  'Something went wrong !');  
        } 

    }
    public function apply(Request $request,$id){

        $data = employees::find($id);
        
        $leaves_types = leaves_meta::whereIn('status',[1])->get(); 

        return view('leaves.apply.index')
             ->with(["data"       => $data])
             ->with(["leaves_types"       => $leaves_types]);

    }
    public function types_delete(Request $request,$id){
  
    	$types = leaves_meta::find($id);

    	$types->status        = 0; 

    	if ($types->save()) {

            $this->audit_trail($request->session()->get('id'),'Leave Types','Deleted data with ID # '.$id);

			return redirect()
			       ->route('leaves_types')
			       ->with('success',  'Leave type has been Deleted !');  
    	} else {
			return redirect()
			       ->route('leaves_types')
			       ->with('error',  'Something went wrong !');  
    	}
    	
    }
    public function types_update_save(Request $request,$id){
  
    	$types = leaves_meta::find($id);

    	$types->name        = $request->input('name');
    	$types->description = $request->input('description'); 
    	$types->days        = $request->input('days');
    	$types->pay         = $request->input('pay');

    	if ($types->save()) {

            $this->audit_trail($request->session()->get('id'),'Leave Types','Update data with ID # '.$id);

			return redirect()
			       ->route('leaves_types')
			       ->with('success',  'Leave type has been updated !');  
    	} else {
			return redirect()
			       ->route('leaves_types')
			       ->with('error',  'Something went wrong !');  
    	}
    	
    }
    public function types_update(Request $request,$id){
  		
  		$data = leaves_meta::find($id);

    	return view('leaves.types.update.index')
    		 ->with(['data' => $data]);

    }
    public function types_save(Request $request){
  
    	$types = new leaves_meta;

    	$types->name        = $request->input('name');
    	$types->description = $request->input('description'); 
    	$types->days        = $request->input('days');
    	$types->pay         = $request->input('pay');
    	$types->status      = '1';

    	if ($types->save()) {

            $this->audit_trail($request->session()->get('id'),'Leave Types','Added new data');

			return redirect()
			       ->route('leaves_types')
			       ->with('success',  'New leave type has been added !');  
    	} else {
			return redirect()
			       ->route('leaves_types')
			       ->with('error',  'Something went wrong !');  
    	}
    	 
    }
    public function types_add(){
  
    	return view('leaves.types.add.index');

    }
    public function types(Request $request){

    	$model = leaves_meta::whereIn('status',[1]);
    	$limit = 10;
    	
    	$paginator   = $this->paginator($limit,$model); 
    	$types       = $paginator['data']; 
    	  
    	return view('leaves.types.view.index')
    		   ->with(['types'       => $types])
    		   ->with(['pagination'  => $paginator['pagination']]); 
    }

}
