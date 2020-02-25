<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;   
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Input; 
use App\Http\Requests;   

use App\timekeeping; 
use App\employees; 
use App\company_meta; 

class Timekeeper extends Controller
{
    public function viewrecord_save(Request $request,$date){  
    	$opening       = company_meta::whereIn('meta_key',['opening'])->first()->meta_value;
    	$working_hours = company_meta::whereIn('meta_key',['working_hours'])->first()->meta_value;
    	$closing       = date('H:i',strtotime($opening.' + '.$working_hours.' hours')); 
    	$in            = $request->input('time_in');
    	$out           = $request->input('time_out');

    	//check if time error
    	if(strtotime($in) > strtotime($out)) {  
    		$error = 1;
    	} else {
    		$error = 0; 
    	}

    	//check if early in 
    	if(strtotime($in) < strtotime($opening)) { 
    		$early_in = (((strtotime($opening) - strtotime($in))/60)/60);
    		$late_in  = 0;
    	} else {
    		$early_in = 0;
    		$late_in  = (((strtotime($in) - strtotime($opening))/60)/60);
    	}

    	// check for early out dump ot hours
    	if(strtotime($out) <= strtotime($closing)) { 
    		$early_out  = (((strtotime($closing) - strtotime($out))/60)/60);
    		$late_out   = 0;
    		$ot         = 0;
    		$night_diff = 0;

	    	if(strtotime($in) >= strtotime($opening)) { 
	    		$reg_hours  = (((strtotime($out) - strtotime($in))/60)/60);
	    	} else { 
	    		$reg_hours  = (((strtotime($out) - strtotime($opening))/60)/60);
	    	}
    	} else {
    		$early_out  = 0;
    		$late_out   = (((strtotime($out) - strtotime($closing))/60)/60);

    		// check for night diff
    		if(strtotime($out) >= strtotime('22:00')){
	    		$night_diff = (((strtotime($out) - strtotime('22:00'))/60)/60);
    			$ot         = (((strtotime($out) - strtotime($closing))/60)/60) - $night_diff;

	    		// check for regular hours depending on time in
	    		if ($early_in == 0) {
	    			$reg_hours  = (((strtotime($closing) - strtotime($in))/60)/60);
	    		} else {
	    			$reg_hours  = (((strtotime($closing) - strtotime($opening))/60)/60);
	    		} 
    		} else {
	    		$night_diff = 0;

	    		// check for regular hours depending on time in
	    		if ($early_in == 0) {
    				$ot         = (((strtotime($out) - strtotime($closing))/60)/60);
	    			$reg_hours  = (((strtotime($closing) - strtotime($in))/60)/60);
	    		} else {
    				$ot         = (((strtotime($out) - strtotime($closing))/60)/60);
	    			$reg_hours  = (((strtotime($closing) - strtotime($opening))/60)/60);
	    		} 
    		}
    	}
    	  
    	// return dd(array(
    	// 	'error'         => $error, 
    	// 	'opening'       => $opening, 
    	// 	'working_hours' => $working_hours, 
    	// 	'closing'       => $closing,
    	// 	'in'            => $in,
    	// 	'out'           => $out,
    	// 	'early_in'      => $early_in,
    	// 	'late_in'       => $late_in,
    	// 	'early_out'     => $early_out,
    	// 	'late_out'      => $late_out,
    	// 	'reg_hours'     => $reg_hours,
    	// 	'ot'            => $ot,
    	// 	'night_diff'    => $night_diff,
    	// ));


    	$rec = timekeeping::find($request->input('id'));
    	if ($request->input('doublepay') == 'on') {
    		$rec->doublepay = "checked";
    	} else {
    		$rec->doublepay = "unchecked";
    	}

    		$rec->time_in     = $in;
    		$rec->time_out    = $out;
    		$rec->regular     = $reg_hours;
    		$rec->ot          = $ot;
    		$rec->night_diff  = $night_diff; 
    		$rec->early       = $early_in;
    		$rec->tardy       = $late_in; 

    		$rec->save();

        $this->audit_trail($request->session()->get('id'),'Time keeping','Updated attendance record');

    	return redirect()	
    		   ->route('timekeeping_viewrecord',$date)
    		   ->with(['data'=>'Attendance Records has been updated']);
    }
    public function viewrecord(Request $request,$date){  
 
    	$data = timekeeping::whereIn('date',[$date])->get();
	 	
	 	return view('timekeeping.view_record.index')
	 		   ->with(["data" => $data])
	 		   ->with(["date" => $date]);

    }
    public function delete(Request $request,$date){  

    	$atd         = timekeeping::whereIn('date',[date('Y-m-d',strtotime($date))]);
    	$atd->status = 0;

    	$atd->delete();

    	return redirect()	
    		   ->route('timekeeping')
    		   ->with(['data'=>'Attendance Records has been deleted']);

    }
    public function save(Request $request){  

    	$employee = employees::whereIn('status',[1])->get();

    	foreach ($employee as $key => $value) {
    		$atd                 = new timekeeping;
    		$atd->date           = $request->input('date');
    		$atd->emp_id         = $value->id; 
    		$atd->doublepay      = 0; 
    		$atd->status         = 1;
    		$atd->save();
    	}

        $this->audit_trail($request->session()->get('id'),'Time keeping','Added attendance record');
    	
    	return redirect()	
    		   ->route('timekeeping')
    		   ->with(['data'=>'Attendance Records has been created']);
    }
    public function add(Request $request){  
 		return view('timekeeping.add.index');
    }
    public function index(Request $request){  
 
    	$data = DB::table('timekeepings')
                   ->select('date')
                   ->where('status','=',1)
                   ->groupBy('date')
                   ->get(); 
	 	
	 	return view('timekeeping.view.index')
	 		   ->with(["data" => $data]);

    }
}
