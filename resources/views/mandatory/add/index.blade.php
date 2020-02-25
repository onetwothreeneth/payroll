<?php $active = 'mandatory'; ?>
@extends('templates.layouts.main')
@section('content')  
    <div class="container-fluid" style="margin:1%; padding:1%; width:98%; margin-top: 2%; background-color: white;">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="c-table-responsive@desktop"> 
                    <table class="c-table">
                        <caption class="c-table__title">
                            Add contribution table
                        </caption> 
                    </table>
                <span class="c-divider u-mv-medium"></span>
                </div> 
            </div> 
            <div class="col-lg-12 col-md-12" style="padding: 2%;"> 
                <form method="post" action="{{ URL::route('mandatory_save') }}"> 
                    {{ csrf_field() }}
                    <div class="row">  
                        <div class="col-sm-4 col-md-4 u-mb-medium">
                            <div class="c-field">
                                <label class="c-field__label" for="input18">Contribution type</label>
                                <select class="c-select" id="select1" name="type" required>
                                    <option value="tax">Tax</option>
                                    <option value="sss">SSS</option>
                                    <option value="philhealth">Philhealth</option>
                                    <option value="pagibig">Pagibig</option>
                                </select>    
                            </div>
                        </div> 
                        <div class="col-sm-8 col-md-8 u-mb-medium">
                            <div class="c-form-field">
                                <label class="c-field__label" for="input17">Base Range</label>
                                <input class="c-input c-input--info" id="input17" type="text" required name="base_range">
                            </div>
                        </div> 
                        <div class="col-sm-4 col-md-4 u-mb-medium">
                            <div class="c-form-field">
                                <label class="c-field__label" for="input17">Monthly Contribution</label>
                                <input class="c-input c-input--info" id="input17" type="number" required name="monthly">
                            </div>
                        </div> 
                        <div class="col-sm-4 col-md-4 u-mb-medium">
                            <div class="c-form-field">
                                <label class="c-field__label" for="input17">Employee Share</label>
                                <input class="c-input c-input--info" id="input17" type="number" required name="employee">
                            </div>
                        </div> 
                        <div class="col-sm-4 col-md-4 u-mb-medium">
                            <div class="c-form-field">
                                <label class="c-field__label" for="input17">Employer Share</label>
                                <input class="c-input c-input--info" id="input17" type="number" required name="employer">
                            </div>
                        </div> 

                        <div class="col-sm-12 col-md-12 u-mb-medium">
                            <span class="c-divider u-mv-medium"></span>
                        </div>

                        <div class="col-sm-2 col-md-2 u-mb-medium">
                            <div class="c-field">
                                <div class="col u-mb-medium">
                                    <button class="c-btn c-btn--info">Save</button>
                                </div>
                            </div>
                        </div> 
                    </div> 
                </form> 
            </div> 
        </div> 
    </div>    
@endsection 