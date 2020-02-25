<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;  
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Input; 
use App\Http\Requests;   

use App\employees;
use App\departments;
use App\mandatory_meta;

class Employee extends Controller
{   
    public function update_save(Request $request,$id){ 

            $emp               = employees::find($id);

        if (Input::file('file')) {
            $file = Input::file('file'); 
            $file->move('assets' , $file->getClientOriginalName()); 
            $img  = $file->getClientOriginalName();  
            $emp->photo        = $img; 
        }  
            $emp->fname        = $request->input('fname');
            $emp->mname        = $request->input('mname');
            $emp->lname        = $request->input('lname');
            $emp->contact      = $request->input('contact');
            $emp->birthday     = $request->input('birthday');
            $emp->gender       = $request->input('gender');
            $emp->address      = $request->input('address');
            $emp->department   = $request->input('department');
            $emp->designation  = $request->input('designation');
            $emp->basic_rate   = $request->input('basic');
            $emp->hourly_rate  = ($request->input('basic')/8);
            $emp->philhealth   = $request->input('philhealth');
            $emp->sss          = $request->input('sss');
            $emp->pagibig      = $request->input('pagibig');
            $emp->tax          = $request->input('tax'); 


            if ($emp->save()) {

                $this->audit_trail($request->session()->get('id'),'Employees','Updated employee ID #'.$id);

                return redirect()
                       ->route('employees')
                       ->with('success',  'Employee record has been updated !');  
            } else {
                return redirect()
                       ->route('employees')
                       ->with('success',  'Something went wrong !');  
            }
    }
    public function update(Request $request,$id){ 

        $data = employees::find($id);
        
        $dept = departments::whereIn('status',[1])->get();
  
        $sss        = mandatory_meta::whereIn('status',[1])->whereIn('type',['sss'])->get();
        $philhealth = mandatory_meta::whereIn('status',[1])->whereIn('type',['philhealth'])->get();
        $pagibig    = mandatory_meta::whereIn('status',[1])->whereIn('type',['pagibig'])->get();
        $tax        = mandatory_meta::whereIn('status',[1])->whereIn('type',['tax'])->get();


        return view('employee.update.index')
             ->with(["data"       => $data])
             ->with(["dept"       => $dept])
             ->with(["sss"        => $sss])
             ->with(["philhealth" => $philhealth])
             ->with(["pagibig"    => $pagibig])
             ->with(["tax"        => $tax]);
    }
    public function add_save(Request $request){ 
        if (Input::file('file')) {
            $file = Input::file('file'); 
            $file->move('assets' , $file->getClientOriginalName()); 
            $img  = $file->getClientOriginalName(); 

            $emp               = new employees;
            $emp->fname        = $request->input('fname');
            $emp->mname        = $request->input('mname');
            $emp->lname        = $request->input('lname');
            $emp->contact      = $request->input('contact');
            $emp->birthday     = $request->input('birthday');
            $emp->gender       = $request->input('gender');
            $emp->address      = $request->input('address');
            $emp->department   = $request->input('department');
            $emp->designation  = $request->input('designation');
            $emp->basic_rate   = $request->input('basic');
            $emp->hourly_rate  = ($request->input('basic')/8);
            $emp->philhealth   = $request->input('philhealth');
            $emp->sss          = $request->input('sss');
            $emp->pagibig      = $request->input('pagibig');
            $emp->tax          = $request->input('tax'); 
            $emp->photo        = $img;
            $emp->status       = '1';


            if ($emp->save()) {

                $this->audit_trail($request->session()->get('id'),'Employees','Added new employee');

                return redirect()
                       ->route('employees')
                       ->with('success',  'New Employee has been added !');  
            } else {
                return redirect()
                       ->route('employees')
                       ->with('success',  'Something went wrong !');  
            }
        } else {
            return redirect()
                   ->route('employees')
                   ->with('success',  'Something went wrong !'); 
        }  
    }
    public function add(){ 
        
        $dept = departments::whereIn('status',[1])->get();
 

        $sss        = mandatory_meta::whereIn('status',[1])->whereIn('type',['sss'])->get();
        $philhealth = mandatory_meta::whereIn('status',[1])->whereIn('type',['philhealth'])->get();
        $pagibig    = mandatory_meta::whereIn('status',[1])->whereIn('type',['pagibig'])->get();
        $tax        = mandatory_meta::whereIn('status',[1])->whereIn('type',['tax'])->get();


        return view('employee.add.index')
             ->with(["dept"       => $dept])
             ->with(["sss"        => $sss])
             ->with(["philhealth" => $philhealth])
             ->with(["pagibig"    => $pagibig])
             ->with(["tax"        => $tax]);
    }
    public function index(){

    	if(isset($_GET['q'])){
    		$model = employees::whereIn('status',[1])
				    		  ->where(function ($query) {
    						  	$query->orWhere('fname','LIKE','%'.$_GET['q'].'%') 
	    						      ->orWhere('mname','LIKE','%'.$_GET['q'].'%')
	    						      ->orWhere('lname','LIKE','%'.$_GET['q'].'%')
	    						      ->orWhere('address','LIKE','%'.$_GET['q'].'%')
	    						      ->orWhere('contact','LIKE','%'.$_GET['q'].'%')
	    						      ->orWhere('gender','LIKE','%'.$_GET['q'].'%')
	    						      ->orWhere('designation','LIKE','%'.$_GET['q'].'%');
				              });
    	} else {
    		$model = employees::whereIn('status',[1]);
    	}

    	$limit = 10;
    	
    	$paginator   = $this->paginator($limit,$model); 
    	$data        = $paginator['data']; 
    	    
    	return view('employee.view.index')
    		   ->with(['data'       => $data])
    		   ->with(['pagination'  => $paginator['pagination']]); 
    		   
    }

}
