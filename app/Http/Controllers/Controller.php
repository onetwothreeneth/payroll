<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\audit_trail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function audit_trail($auth_id,$module,$action){

    	$create          = new audit_trail; 
    	$create->auth_id = $auth_id;
    	$create->module  = $module;
    	$create->action  = $action;

    	$create->save();
    	
    }
    public function paginator($limit,$model){
    	if (!empty($_GET['page']) && is_numeric($_GET['page'])) {
    		$page = $_GET['page']; 

    		$total = $model->get()->count();

    		if (is_float($total/$limit) && ($total/$limit) >= 1){
    			$pages = round($total/$limit) + 1;
    		} else {
    			$pages = round($total/$limit);
    		}
    		   
    		$offset = ($page - 1) * $limit;

    		$data = $model->orderBy('created_at','DESC')
					            ->limit($limit)
					            ->offset($offset)
								->get();

			$pagination = array(
				'pages'  => $pages,
				'active' => $page, 
				'total'  => $total 
			);

			return array(
				"data"       => $data,
				"pagination" => $pagination
			);
			
    	} else {
    		
    		$total = $model->get()->count();

            if (is_float($total/$limit) && ($total/$limit) >= 1){
    			$pages = round($total/$limit) + 1;
    		} else {
    			$pages = round($total/$limit);
    		}

    		$offset = (1 - 1) * $limit;
    		   
    		$data = $model->orderBy('created_at','DESC')
					            ->limit($limit)
					            ->offset($offset)
								->get();

			$pagination = array(
				'pages'  => $pages,
				'active' => 1, 
				'total'  => $total 
			);

			return array(
				"data"       => $data,
				"pagination" => $pagination
			);
			
    	}
    }
}
