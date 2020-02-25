<?php $active = 'employees'; ?>
@extends('templates.layouts.main')
@section('content')  
    <div class="container-fluid" style="margin:1%; padding:1%; width:98%; margin-top: 2%; background-color: white;">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="c-table-responsive@desktop"> 
                    <table class="c-table">
                        <caption class="c-table__title">
                            Add Employee
                        </caption> 
                    </table>
                <span class="c-divider u-mv-medium"></span>
                </div> 
            </div> 
            <div class="col-lg-12 col-md-12" style="padding: 2%;"> 
                <form method="post" action="{{ URL::route('employee_add_save') }}" enctype="multipart/form-data"> 
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-12 col-md-12"> 
                            <div class="col-lg-4 col-md-4 u-mb-medium">
                                <div class="c-field">
                                    <label class="c-field__label" for="input18">Photo</label>
                                    <input class="c-input c-input--info" id="input17" type="file" required name="file">
                                </div>
                            </div>   
                        </div>   
                        <div class="col-lg-4 col-md-4 u-mb-medium">
                            <div class="c-field">
                                <label class="c-field__label" for="input18">First name</label>
                                <input class="c-input c-input--info" id="input17" type="text" required name="fname">
                            </div>
                        </div>   
                        <div class="col-lg-4 col-md-4 u-mb-medium">
                            <div class="c-field">
                                <label class="c-field__label" for="input18">Middle name</label>
                                <input class="c-input c-input--info" id="input17" type="text" required name="mname">
                            </div>
                        </div>   
                        <div class="col-lg-4 col-md-4 u-mb-medium">
                            <div class="c-field">
                                <label class="c-field__label" for="input18">Last name</label>
                                <input class="c-input c-input--info" id="input17" type="text" required name="lname">
                            </div>
                        </div>   
                        <div class="col-lg-4 col-md-4">
                            <div class="col-lg-12 col-md-12 u-mb-medium">
                                <div class="c-form-field">
                                    <label class="c-field__label" for="input17">Contact</label>
                                    <input class="c-input c-input--info" id="input17" type="number" required name="contact">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="row"> 
                                    <div class="col-lg-6 col-md-6 u-mb-medium">
                                        <div class="c-form-field">
                                            <label class="c-field__label" for="input17">Birthday</label>
                                            <input class="c-input c-input--info" id="input17" type="date" required name="birthday" value="10">
                                        </div>
                                    </div> 
                                    <div class="col-lg-6 col-md-6 u-mb-medium">
                                        <div class="c-form-field">
                                            <label class="c-field__label" for="input17">Gender</label>
                                                <select class="c-select" id="select1" name="gender">
                                                    <option value="Male" selected>Male</option> 
                                                    <option value="Female">Female</option> 
                                                </select>                                        
                                            </div>
                                        <!-- </div> -->
                                    </div>  
                                </div> 
                            </div> 
                        </div>
                        <div class="col-lg-8 col-md-8 u-mb-medium">
                            <div class="c-field">
                                <label class="c-field__label" for="input18">Address</label>
                                <textarea class="c-input" rows="6" id="textarea5" required name="address"></textarea>
                            </div>
                        </div>  
                        <div class="col-lg-4 col-md-4 u-mb-medium">
                            <div class="c-field">
                                <label class="c-field__label" for="input18">Department</label>
                                <select class="c-select" id="select2" name="department">
                                    @if($dept)
                                        @foreach($dept as $v)
                                            <option value="{{ $v->id }}">{{ $v->dept }}</option>
                                        @endforeach
                                    @endif
                                </select>        
                            </div>
                        </div>   
                        <div class="col-lg-4 col-md-4 u-mb-medium">
                            <div class="c-field">
                                <label class="c-field__label" for="input18">Designation</label>
                                <input class="c-input c-input--info" id="input17" type="text" required name="designation">
                            </div>
                        </div>    
                        <div class="col-lg-4 col-md-4 u-mb-medium">
                            <div class="c-field">
                                <label class="c-field__label" for="input18">Basic Rate Per Day</label>
                                <input class="c-input c-input--info" id="input17" type="number" required name="basic">
                            </div>
                        </div>    

                        <div class="col-lg-6 col-md-6 u-mb-medium">
                            <div class="c-field">
                                <label class="c-field__label" for="input18">PhilHealth Contribution Table</label>
                                <select class="c-select" id="select3" name="philhealth">
                                    @if($philhealth)
                                        @foreach($philhealth as $k => $v)
                                            <option value="{{ $v->id }}">{{ $k+1}}. P {{ $v->baserange }} - (P {{ $v->monthly }} monthly)</option>
                                        @endforeach
                                    @endif
                                </select>        
                            </div>
                        </div> 

                        <div class="col-lg-6 col-md-6 u-mb-medium">
                            <div class="c-field">
                                <label class="c-field__label" for="input18">SSS Contribution Table</label>
                                <select class="c-select" id="select4" name="sss">
                                    @if($sss)
                                        @foreach($sss as $k => $v)
                                            <option value="{{ $v->id }}">{{ $k+1}}. P {{ $v->baserange }} - (P {{ $v->monthly }} monthly)</option>
                                        @endforeach
                                    @endif
                                </select>        
                            </div>
                        </div> 

                        <div class="col-lg-6 col-md-6 u-mb-medium">
                            <div class="c-field">
                                <label class="c-field__label" for="input18">PAGIBIG Contribution Table</label>
                                <select class="c-select" id="select5" name="pagibig">
                                    @if($pagibig)
                                        @foreach($pagibig as $k => $v)
                                            <option value="{{ $v->id }}">{{ $k+1}}. P {{ $v->baserange }} - (P {{ $v->monthly }} monthly)</option>
                                        @endforeach
                                    @endif
                                </select>        
                            </div>
                        </div> 

                        <div class="col-lg-6 col-md-6 u-mb-medium">
                            <div class="c-field">
                                <label class="c-field__label" for="input18">Income Tax Table</label>
                                <select class="c-select" id="select6" name="tax">
                                    @if($tax)
                                        @foreach($tax as $k => $v)
                                            <option value="{{ $v->id }}">{{ $k+1}}. P {{ $v->baserange }} - (P {{ $v->monthly }}% monthly)</option>
                                        @endforeach
                                    @endif
                                </select>        
                            </div>
                        </div> 


                        <div class="col-lg-12 col-md-12 u-mb-medium">
                            <span class="c-divider u-mv-medium"></span>
                        </div>

                        <div class="col-lg-2 col-md-2 u-mb-medium">
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