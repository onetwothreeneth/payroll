<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Input; 
use App\Http\Requests;   

use App\admin;
use App\admin_meta;

class Authentication extends Controller
{
    public function index(){   
    	return view('login.index');
    }
    public function auth(Request $request){

    	$username = $request->username;
    	$password = $request->password;

    	$sql      = admin::whereIn("username",[$username])
    				     ->whereIn('password',[$password])
    				     ->whereIn('status',  [1]);

    	if($sql->count() != 0){

    		$details = $sql->first();

        	$request->session()->put('id',    $details->id);
        	$request->session()->put('type',  $details->type);
            $request->session()->put('photo', $details->photo()->meta_value);
            $request->session()->put('name',  $details->name);

            $this->audit_trail($details->id,'Login','Logged In');

			return redirect()
			       ->route('dashboard')
			       ->with('success',  'Welcome '.ucfirst($details->type).' !');  

    	} else {

			return redirect()
			       ->route('login')
			       ->with('error',  'Invalid Login Input !');  

    	}	 
    }
    public function logout(Request $request){

        $this->audit_trail($request->session()->get('id'),'Dashboard','Logged Out');

    	$request->session()->flush();
 
    	return redirect()
    	       ->route('login');
    }
}
