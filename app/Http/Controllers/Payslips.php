<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Input; 
use App\Http\Requests;   

use App\employees; 
use App\leaves as leaveds;
use App\leaves_meta;
use App\loans as loaned;
use App\loans_types;
use App\loans_meta;
use App\mandatory_meta;
use App\timekeeping; 
use App\payslips as payslip;
use App\payslips_meta;
use App\company_meta;

class Payslips extends Controller
{
	public function viewpayslip(Request $request,$id){

		$payslip =  payslip::find($id);
		$meta    =  $payslip->data();
		$company =  array(
			"name"     => company_meta::whereIn("meta_key",['company_name'])->first()->meta_value,
			"address"  => company_meta::whereIn("meta_key",['company_address'])->first()->meta_value,
			"contact"  => company_meta::whereIn("meta_key",['company_contact'])->first()->meta_value,
			"logo"     => company_meta::whereIn("meta_key",['company_logo'])->first()->meta_value
		);

		return view('payslip.summary.index')
			 ->with(["payslip" => $payslip])
			 ->with(["company"    => $company])
			 ->with(["meta"    => $meta]);
	}
	public function process_save(Request $request){
		$from = date('Y-m-d',strtotime($request->input('start')));
		$to   = date('Y-m-d',strtotime($request->input('end')));

		$dates = timekeeping::whereBetween('date', array($from,$to));

		$records = array();

		if ($dates->count() == 0) {
			return 'Not enough attendance records';
		} else {
			foreach ($dates->get() as $k => $v) {
				if (@!$records[$v->emp_id]['details']) {

					// employee details
					$records[$v->emp_id]['details'] = array();
					$records[$v->emp_id]['details'] = employees::find($v->emp_id);

					//mandatory deductions
					$records[$v->emp_id]['mandatory'] = array();
					$records[$v->emp_id]['mandatory'] = array(
						'sss'        => employees::find($v->emp_id)->manda('sss'), 
						'tax'        => employees::find($v->emp_id)->manda('tax'), 
						'philhealth' => employees::find($v->emp_id)->manda('philhealth'), 
						'pagibig'    => employees::find($v->emp_id)->manda('pagibig'), 
					);

					//leaves
					$records[$v->emp_id]['leaves'] = array();
					if (employees::find($v->emp_id)->check_leaves() != 0) {
						$records[$v->emp_id]['leaves'] = array(
							'status' => 'On Leave', 
							'type'   => leaves_meta::find(employees::find($v->emp_id)->leaves()->id)->first()->name, 
							'start'  => employees::find($v->emp_id)->leaves()->start, 
							'end'    => employees::find($v->emp_id)->leaves()->end, 
							'pay'    => leaves_meta::find(employees::find($v->emp_id)->leaves()->id)->first()->pay, 
						);
					} else {
						$records[$v->emp_id]['leaves'] = array(
							'status' => 'none' 
						);
					}

					//loans
					$records[$v->emp_id]['loans'] = array();
					if (employees::find($v->emp_id)->check_loans() != 0) {
						$records[$v->emp_id]['loans'] = array(
							'status'    => 'With Loan',    
							'id'        => employees::find($v->emp_id)->loans()->id,  
							'type'      => loans_types::find(employees::find($v->emp_id)->loans()->loan_type)->first()->type,  
							'amount'    => employees::find($v->emp_id)->loans()->amount,  
							'interest'  => employees::find($v->emp_id)->loans()->interest,   
							'total'     => employees::find($v->emp_id)->loans()->total,    
							'monthly'   => employees::find($v->emp_id)->loans()->monthly,  
							'paid'      => loaned::find(employees::find($v->emp_id)->loans()->id)->status(),  
							'balance'   => employees::find($v->emp_id)->loans()->total - loaned::find(employees::find($v->emp_id)->loans()->id)->status()
						);
					} else {
						$records[$v->emp_id]['loans'] = array(
							'status' => 'none' 
						);
					}


					//basic rate
					$basic       = employees::find($v->emp_id)->basic_rate;
					$gross       = 0;
					$profit      = 0;
					$mandatory   = 0;
					$loan_deduct = 0;

					//rate
					$records[$v->emp_id]['rates'] = array();
					$records[$v->emp_id]['rates'] = array(
						'basic'        => $basic, 
						'gross'        => $gross, 
						'profit'       => $profit,
						'mandatory'    => $mandatory,
						'loan_deduct'  => $loan_deduct,
					);
					
						


				}

				if (@$records[$v->emp_id]['tender']) {
					if ($v->doublepay == 'checked') { 
						$records[$v->emp_id]['tender'] = array(
							'regular'    => $records[$v->emp_id]['tender']['regular']     + ($v->regular * 2),  
							'ot'         => $records[$v->emp_id]['tender']['ot']          + ($v->ot * 2),  
							'night_diff' => $records[$v->emp_id]['tender']['night_diff']  + ($v->night_diff * 2)   
						);
					} else {
						$records[$v->emp_id]['tender'] = array(
							'regular'    => $records[$v->emp_id]['tender']['regular']     + $v->regular,  
							'ot'         => $records[$v->emp_id]['tender']['ot']          + $v->ot,  
							'night_diff' => $records[$v->emp_id]['tender']['night_diff']  + $v->night_diff  
						);
					} 
				} else { 
					$records[$v->emp_id]['tender'] = array();
					if ($v->doublepay == 'checked') { 
						$records[$v->emp_id]['tender'] = array(
							'regular'    => ($v->regular * 2),  
							'ot'         => ($v->ot * 2),  
							'night_diff' => ($v->night_diff * 2)   
						);
					} else {
						$records[$v->emp_id]['tender'] = array(
							'regular'    => $v->regular,  
							'ot'         => $v->ot,  
							'night_diff' => $v->night_diff  
						);
					} 	
				}
			} 
		} 

		// ready deductions to save
		$to_deduct_loan = array();

		// calculate earnings
		foreach ($records as $k => $v) {
			$id         = $v['details']->id;
			$rate       = ($records[$id]['rates']['basic']/8);
			$regular    = ($rate * $records[$id]['tender']['regular']);
			$ot         = ((($rate * 0.0125) + $rate ) * $records[$id]['tender']['ot']);
			$night_diff = ((($rate * 0.1) + $rate)    * $records[$id]['tender']['night_diff']);

			$records[$id]['rates']['gross']  = $regular + $ot + $night_diff;

			if ($records[$id]['loans']['status'] != 'none') {
				$profit = ($regular + $ot + $night_diff) - 
							($records[$id]['mandatory']['tax'] +
							 $records[$id]['mandatory']['sss'] + 
							 $records[$id]['mandatory']['philhealth'] + 
							 $records[$id]['mandatory']['pagibig']);

				if($records[$id]['loans']['monthly'] <= $profit){
					$records[$id]['rates']['profit'] = (($regular + $ot + $night_diff) - 
							($records[$id]['mandatory']['tax'] +
							 $records[$id]['mandatory']['sss'] + 
							 $records[$id]['mandatory']['philhealth'] + 
							 $records[$id]['mandatory']['pagibig']) - $records[$id]['loans']['monthly']);

					$records[$id]['rates']['loan_deduct'] = $records[$id]['loans']['monthly']; 

					array_push($to_deduct_loan,array( 
						'loan_id' => $records[$id]['loans']['id'], 
						'amount'  => $records[$id]['loans']['monthly']
					));

				} else {
					$records[$id]['rates']['loan_deduct'] = 0; 
				} 
			} else {
				$records[$id]['rates']['profit'] = ($regular + $ot + $night_diff) - 
						($records[$id]['mandatory']['tax'] +
						 $records[$id]['mandatory']['sss'] + 
						 $records[$id]['mandatory']['philhealth'] + 
						 $records[$id]['mandatory']['pagibig']);

				$records[$id]['rates']['loan_deduct'] = 0; 

			}

			$records[$id]['rates']['mandatory'] =  
					($records[$id]['mandatory']['tax'] +
					 $records[$id]['mandatory']['sss'] + 
					 $records[$id]['mandatory']['philhealth'] + 
					 $records[$id]['mandatory']['pagibig']);


		} 

		$payroll = new payslip;
		$payroll->cutoff_start  = $from;
		$payroll->cutoff_end    = $to; 
		$payroll->status        = 1; 
 
		if ($payroll->save()) { 
			$payroll_id = payslip::whereIn('cutoff_start',[$from])
								  ->whereIn('cutoff_end',[$to])->first()->id;

			$save = new payslips_meta;
			$save->payroll_id = $payroll_id;
			$save->data       = json_encode($records);
			$save->status     = 1; 

			if ($save->save()) { 

				// save deducted loans
				foreach ($to_deduct_loan as $k => $v) {

					$ld             = new loans_meta;
					$ld->loan_id    = $v['loan_id'];
					$ld->payroll_id = $payroll_id;
					$ld->amount     = $v['amount'];
					$ld->status     = 1;
					$ld->save();

				}
					
				
            	$this->audit_trail($request->session()->get('id'),'Payroll','Processed Payroll & Payslips'); 
				return redirect()
				       ->route('payslips')
				       ->with('success',  'Payroll has been processed');

			} else {

				return redirect()
				       ->route('payslips_process')
				       ->with('error',  'Something went wrong');

			}
			
		} else { 

			return redirect()
			       ->route('payslips_process')
			       ->with('error',  'Something went wrong');

		}
		
	}
    public function delete(Request $request,$id){ 

		$payroll = payslip::find($id); 
		$payroll->status        = 0; 
 
		if ($payroll->save()) {   

			$paydata           = payslips_meta::whereIn('payroll_id',[$id]);
			$paydata->status   = 0;
			$paydata->delete();

			$loan_paid         = loans_meta::whereIn('payroll_id',[$id]);
			$loan_paid->status = 0;
			$loan_paid->delete();

        	$this->audit_trail($request->session()->get('id'),'Payroll','Delted Processed Payroll & Payslips'); 

			return redirect()
				       ->route('payslips')
				       ->with('success',  'Payroll has been deleted');
		} else {
			return redirect()
				       ->route('payslips')
				       ->with('error',  'Something went wrong');
		}

    }
    public function records(Request $request){  

    	$model = payslip::whereIn('status',[1]);
    	$limit = 10;
    	
    	$paginator   = $this->paginator($limit,$model);
    	  
    	$payslip = $paginator['data'];
 
    	return view('payslip.view.index')
    		   ->with(['payslip' => $payslip])
    		   ->with(['pagination'  => $paginator['pagination']]);
    }
	public function process(){
		return view('payslip.add.index');
	}
}
