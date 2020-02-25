<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;  
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Input; 
use App\Http\Requests;   

use App\loans as loaned;
use App\loans_types;
use App\employees;

class Loans extends Controller
{ 
    public function update_save(Request $request,$id){
  
        $apply            = loaned::find($id); 
        $apply->loan_type = $request->input('loan_type');
        $apply->notes     = $request->input('notes'); 
        $apply->amount    = $request->input('amount'); 
        $apply->months    = $request->input('months'); 
        $apply->interest  = round($request->input('amount') * 0.07); 
        $apply->total     = round(($request->input('amount') * 0.07) + $request->input('amount')); 
        $apply->monthly   = round(round(($request->input('amount') * 0.07) + $request->input('amount')) / $request->input('months'));  

        if ($apply->save()) { 

            $this->audit_trail($request->session()->get('id'),'Loan Application','Updated loan application ID #'.$id);

            return redirect()
                   ->route('loans')
                   ->with('success',  'Application for loan has been updated !');  
        } else { 
            return redirect()
                   ->route('loans')
                   ->with('error',  'Something went wrong !');  
        } 

    }
    public function update(Request $request,$id){

        $data = loaned::find($id);
        $loans_types = loans_types::whereIn('status',[1])->get();  

        return view('loans.update.index')
             ->with(['data' => $data])
             ->with(["loans_types"       => $loans_types]);
        
    }
    public function delete(Request $request,$id){
  
        $apply            = loaned::find($id); 
        $apply->status    = 0; 

        if ($apply->save()) { 

            $this->audit_trail($request->session()->get('id'),'Loan Application','Deleted loan application ID #'.$id);

            return redirect()
                   ->route('loans')
                   ->with('success',  'Application for loan has been deleted !');  
        } else { 
            return redirect()
                   ->route('loans')
                   ->with('error',  'Something went wrong !');  
        } 
        
    }
    public function index(){  

        $model = loaned::whereIn('status',[1]);
        $limit = 10;
        
        $paginator   = $this->paginator($limit,$model);
          
        $data       = $paginator['data'];

        return view('loans.view.index')
             ->with(["data" => $data])
             ->with(["pagination" => $paginator['pagination']]);
    }
    public function apply_save(Request $request,$id){
  
        $apply            = new loaned;
        $apply->emp_id    = $id;
        $apply->loan_type = $request->input('loan_type');
        $apply->notes     = $request->input('notes'); 
        $apply->amount    = $request->input('amount'); 
        $apply->months    = $request->input('months'); 
        $apply->interest  = round($request->input('amount') * 0.07); 
        $apply->total     = round(($request->input('amount') * 0.07) + $request->input('amount')); 
        $apply->monthly   = round(round(($request->input('amount') * 0.07) + $request->input('amount')) / $request->input('months')); 
        $apply->status    = 1; 

        if ($apply->save()) { 

            $this->audit_trail($request->session()->get('id'),'Loan Application','Added loan application for employee ID #'.$id);

            return redirect()
                   ->route('loans')
                   ->with('success',  'Application for loan has been saved !');  
        } else { 
            return redirect()
                   ->route('loan_apply')
                   ->with('error',  'Something went wrong !');  
        } 

    }
    public function apply(Request $request,$id){

        $data = employees::find($id);
        
        $loans_types = loans_types::whereIn('status',[1])->get(); 

        return view('loans.apply.index')
             ->with(["data"       => $data])
             ->with(["loans_types"       => $loans_types]);

    }
    public function types_delete(Request $request,$id){
  
    	$types = loans_types::find($id);

    	$types->status        = 0; 

    	if ($types->save()) {

            $this->audit_trail($request->session()->get('id'),'Loan Types','Deleted data with ID # '.$id);

			return redirect()
			       ->route('loan_types')
			       ->with('success',  'Loan type has been Deleted !');  
    	} else {
			return redirect()
			       ->route('loan_types')
			       ->with('error',  'Something went wrong !');  
    	}
    	
    }
    public function types_update_save(Request $request,$id){
  
    	$types = loans_types::find($id);

    	$types->type        = $request->input('type');
    	$types->description = $request->input('description'); 

    	if ($types->save()) {

            $this->audit_trail($request->session()->get('id'),'Loan Types','Update data with ID # '.$id);

			return redirect()
			       ->route('loan_types')
			       ->with('success',  'Loan type has been updated !');  
    	} else {
			return redirect()
			       ->route('loan_types')
			       ->with('error',  'Something went wrong !');  
    	}
    	
    }
    public function types_update(Request $request,$id){
  		
  		$data = loans_types::find($id);

    	return view('loans.types.update.index')
    		 ->with(['data' => $data]);

    }
    public function types_save(Request $request){
  
    	$types = new loans_types;

    	$types->type        = $request->input('type');
    	$types->description = $request->input('description');
    	$types->status      = '1';

    	if ($types->save()) {

            $this->audit_trail($request->session()->get('id'),'Loan Types','Added new data');

			return redirect()
			       ->route('loan_types')
			       ->with('success',  'New Loan type has been added !');  
    	} else {
			return redirect()
			       ->route('loan_types')
			       ->with('error',  'Something went wrong !');  
    	}
    	 
    }
    public function types_add(){
  
    	return view('loans.types.add.index');

    }
    public function types(Request $request){

    	$model = loans_types::whereIn('status',[1]);
    	$limit = 10;
    	
    	$paginator   = $this->paginator($limit,$model); 
    	$types       = $paginator['data']; 
    	  
    	return view('loans.types.view.index')
    		   ->with(['types'       => $types])
    		   ->with(['pagination'  => $paginator['pagination']]); 
    }

}
