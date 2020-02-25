<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


	 
	Route::middleware(['guest'])->group(function(){ 

		// Un Authenticated
		Route::get         ('/',                           'Authentication@index'                       )->name('login'); 
		Route::post        ('/authenticate',               'Authentication@auth'                        )->name('login_authenticate'); 
 
	});

	Route::middleware(['admin'])->group(function(){
 
		// Dashboard
		Route::get         ('/dashboard',                  'Dashboard@index'                            )->name('dashboard'); 

		// Logout
		Route::get         ('/logout',                     'Authentication@logout'                      )->name('logout'); 

		// Audit Trail 
		Route::get         ('/audittrail',                 'Audittrail@index'                           )->name('audit_trail'); 

		// Loans 
		Route::prefix('loans')->group(function(){

			// Loan Types
			Route::prefix('types')->group(function(){
				Route::get  ('',                           'Loans@types'                                )->name('loan_types'); 
				Route::get  ('/add',                       'Loans@types_add'                            )->name('loan_types_add'); 
				Route::post ('/save',                      'Loans@types_save'                           )->name('loan_types_save'); 
				Route::get  ('/update/{id}',               'Loans@types_update'                         )->name('loan_types_update'); 
				Route::post ('/update/{id}/save',          'Loans@types_update_save'                    )->name('loan_types_update_save'); 
				Route::get  ('/delete/{id}',               'Loans@types_delete'                         )->name('loan_delete'); 
			});

			// Apply Loan 
			Route::get      ('/apply/{id}',                'Loans@apply'                                )->name('loan_apply');  
			Route::post     ('/apply/{id}/save',           'Loans@apply_save'                           )->name('loan_apply_save');

			// Loans 
			Route::get      ('/',                          'Loans@index'                                )->name('loans');    
			Route::get      ('/update/{id}',               'Loans@update'                               )->name('loans_update');  
			Route::post     ('/update/{id}/save',          'Loans@update_save'                          )->name('loans_update_save');    
			Route::get      ('/delete/{id}',               'Loans@delete'                               )->name('loans_delete');    

		});

		// Leaves 
		Route::prefix('leaves')->group(function(){

			// Leaves Types
			Route::prefix('types')->group(function(){
				Route::get  ('',                           'Leaves@types'                                )->name('leaves_types'); 
				Route::get  ('/add',                       'Leaves@types_add'                            )->name('leaves_types_add'); 
				Route::post ('/save',                      'Leaves@types_save'                           )->name('leaves_types_save'); 
				Route::get  ('/update/{id}',               'Leaves@types_update'                         )->name('leaves_types_update'); 
				Route::post ('/update/{id}/save',          'Leaves@types_update_save'                    )->name('leaves_types_update_save'); 
				Route::get  ('/delete/{id}',               'Leaves@types_delete'                         )->name('leaves_delete'); 
			});

			// Apply Leaves 
			Route::get      ('/apply/{id}',                'Leaves@apply'                                )->name('leaves_apply');  
			Route::post     ('/apply/{id}/save',           'Leaves@apply_save'                           )->name('leaves_apply_save');

			// Leaves 
			Route::get      ('/',                          'Leaves@index'                                )->name('leaves');    
			Route::get      ('/update/{id}',               'Leaves@update'                               )->name('leaves_update');  
			Route::post     ('/update/{id}/save',          'Leaves@update_save'                          )->name('leaves_update_save');    
			Route::get      ('/delete/{id}',               'Leaves@delete'                               )->name('leaves_delete');      

		});

		// Employees 
		Route::prefix('employees')->group(function(){
 
			Route::get      ('/',                          'Employee@index'                              )->name('employees');  
			Route::get      ('/add',                       'Employee@add'                                )->name('employees_add');  
			Route::post     ('/add/save',                  'Employee@add_save'                           )->name('employee_add_save');  
			Route::get      ('/update/{id}',               'Employee@update'                             )->name('employees_update');  
			Route::post     ('/update/{id}/save',          'Employee@update_save'                        )->name('employee_update_save');  

		});

		// Departments 
		Route::prefix('departments')->group(function(){

			Route::get      ('',                           'Departmentals@index'                         )->name('department'); 
			Route::get      ('/add',                       'Departmentals@add'                           )->name('department_add'); 
			Route::post     ('/save',                      'Departmentals@save'                          )->name('department_save'); 
			Route::get      ('/update/{id}',               'Departmentals@update'                        )->name('department_update'); 
			Route::post     ('/update/{id}/save',          'Departmentals@update_save'                   )->name('department_update_save'); 
			Route::get      ('/delete/{id}',               'Departmentals@delete'                        )->name('department_delete');  

		});

		// Mandatory Deductions
		Route::prefix('deductions')->group(function(){

			Route::get      ('/view/{type}',               'Mandatory@index'                             )->name('mandatory');  
			Route::get      ('/add',                       'Mandatory@add'                               )->name('mandatory_add');   
			Route::post     ('/save',                      'Mandatory@save'                              )->name('mandatory_save');   
			Route::get      ('/update/{id}',               'Mandatory@update'                            )->name('mandatory_update');   
			Route::post     ('/update/{id}/save',          'Mandatory@update_save'                       )->name('mandatory_update_save');   
			Route::get      ('/delete/{id}',               'Mandatory@delete'                            )->name('mandatory_delete');   

		});

		// Timekeeping  
		Route::prefix('timekeeping')->group(function(){
 
			Route::get      ('/',                          'Timekeeper@index'                            )->name('timekeeping');   
			Route::get      ('/add',                       'Timekeeper@add'                              )->name('timekeeping_add');      
			Route::post     ('/save',                      'Timekeeper@save'                             )->name('timekeeping_save');          
			Route::get      ('/delete/{date}',             'Timekeeper@delete'                           )->name('timekeeping_delete');    
			Route::get      ('/view/{date}',               'Timekeeper@viewrecord'                       )->name('timekeeping_viewrecord'); 
			Route::post     ('/view/{date}/save',          'Timekeeper@viewrecord_save'                  )->name('timekeeping_viewrecord_save');    
		});

		// Timekeeping  
		Route::prefix('payslips')->group(function(){
 
			Route::get      ('/',                          'Payslips@records'                            )->name('payslips');    
			Route::get      ('/view/{id}',                 'Payslips@viewpayslip'                        )->name('payslips_view');   
			Route::get      ('/delete/{id}',               'Payslips@delete'                             )->name('payslips_delete');    
			Route::get      ('/process',                   'Payslips@process'                            )->name('payslips_process');    
			Route::post     ('/process/save',              'Payslips@process_save'                       )->name('payslips_process_save');        
		});

		

	});





 