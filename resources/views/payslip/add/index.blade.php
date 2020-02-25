<?php $active = 'payslips'; ?>
@extends('templates.layouts.main')
@section('content')  
    <div class="container-fluid" style="margin:1%; padding:1%; width:98%; margin-top: 2%; background-color: white;">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="c-table-responsive@desktop"> 
                    <table class="c-table">
                        <caption class="c-table__title">
                            Process Payroll
                        </caption> 
                    </table>
                <span class="c-divider u-mv-medium"></span>
                </div> 
            </div> 
            <div class="col-lg-12 col-md-12" style="padding: 2%;"> 
                <form method="post" action="{{ URL::route('payslips_process_save') }}"> 
                    {{ csrf_field() }}
                    <div class="row">   
                        <div class="col-sm-6 col-md-6 u-mb-medium">
                            <div class="c-form-field">
                                <label class="c-field__label" for="input17">Cut-off start</label>
                                <input class="c-input c-input--info" id="input17" type="date" required name="start">
                            </div>
                        </div>  
 
                        <div class="col-sm-6 col-md-6 u-mb-medium">
                            <div class="c-form-field">
                                <label class="c-field__label" for="input17">Cut-off end</label>
                                <input class="c-input c-input--info" id="input17" type="date" required name="end">
                            </div>
                        </div>  

                        <div class="col-sm-12 col-md-12 u-mb-medium">
                            <span class="c-divider u-mv-medium"></span>
                        </div>

                        <div class="col-sm-2 col-md-2 u-mb-medium">
                            <div class="c-field">
                                <div class="col u-mb-medium">
                                    <button class="c-btn c-btn--info">Process</button>
                                </div>
                            </div>
                        </div> 
                    </div> 
                </form> 
            </div> 
        </div> 
    </div>    
@endsection 