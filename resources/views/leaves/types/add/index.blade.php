<?php $active = 'leaves'; ?>
@extends('templates.layouts.main')
@section('content')  
    <div class="container-fluid" style="margin:1%; padding:1%; width:98%; margin-top: 2%; background-color: white;">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="c-table-responsive@desktop"> 
                    <table class="c-table">
                        <caption class="c-table__title">
                            Add leave Types
                        </caption> 
                    </table>
                <span class="c-divider u-mv-medium"></span>
                </div> 
            </div> 
            <div class="col-lg-12 col-md-12" style="padding: 2%;"> 
                <form method="post" action="{{ URL::route('leaves_types_save') }}"> 
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="col-sm-12 col-md-12 u-mb-medium">
                                <div class="c-form-field">
                                    <label class="c-field__label" for="input17">Leave Type</label>
                                    <input class="c-input c-input--info" id="input17" type="text" required name="name">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="row"> 
                                    <div class="col-sm-4 col-md-4 u-mb-medium">
                                        <div class="c-form-field">
                                            <label class="c-field__label" for="input17">Allowed Days</label>
                                            <input class="c-input c-input--info" id="input17" type="number" required name="days" value="10">
                                        </div>
                                    </div> 
                                    <div class="col-sm-8 col-md-8 u-mb-medium">
                                        <div class="c-form-field">
                                            <label class="c-field__label" for="input17">Pay</label>
                                                <select class="c-select" id="select1" name="pay">
                                                    <option value="1">With Pay</option> 
                                                    <option value="0" selected>Without Pay</option> 
                                                </select>                                        
                                            </div>
                                    </div>  
                                </div> 
                            </div> 
                        </div>
                        <div class="col-sm-8 col-md-8 u-mb-medium">
                            <div class="c-field">
                                <label class="c-field__label" for="input18">Description</label>
                                <textarea class="c-input" rows="6" id="textarea5" required name="description"></textarea>
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