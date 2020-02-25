<?php $active = 'loans'; ?>
@extends('templates.layouts.main')
@section('content')  
    <div class="container-fluid" style="margin:1%; padding:1%; width:98%; margin-top: 2%; background-color: white;">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="c-table-responsive@desktop"> 
                    <table class="c-table">
                        <caption class="c-table__title">
                            Apply Loan
                        </caption> 
                    </table>
                <span class="c-divider u-mv-medium"></span>
                </div> 
            </div> 
            <div class="col-lg-12 col-md-12" style="padding: 2%;"> 
                <form method="post" action="{{ URL::route('leaves_apply_save',$data->id) }}"> 
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-12 col-md-12 u-mb-medium">
                            <img src="{{ URL::asset('assets') }}/{{ $data->photo }}" width="10%">
                        </div>
                        <div class="col-sm-4 col-md-4 u-mb-medium">
                            <div class="c-form-field">
                                <label class="c-field__label" for="input17">Employee ID</label>
                                <input class="c-input c-input--info" id="input17" type="text" readonly value="CYAN{{ date('Y',strtotime($data->created_at)).'00000'.$data->id }}">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 u-mb-medium">
                            <div class="c-form-field">
                                <label class="c-field__label" for="input17">Full Name</label>
                                <input class="c-input c-input--info" id="input17" type="text" readonly value="{{ $data->fname }} {{ $data->mname }} {{ $data->lname }}">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 u-mb-medium">
                            <div class="c-form-field">
                                <label class="c-field__label" for="input17">Designation</label>
                                <input class="c-input c-input--info" id="input17" type="text" readonly value="{{ $data->designation }}">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 u-mb-medium">
                            <div class="c-form-field">
                                <label class="c-field__label" for="input17">Leave Type</label>
                                <select class="c-select" id="select1" name="leave_type" required>
                                    @if($leaves_types)
                                        @foreach($leaves_types as $v)
                                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                                        @endforeach
                                    @endif
                                </select>    
                            </div> 
                            <div class="c-form-field">
                                <label class="c-field__label" for="input17">Start</label>
                                <input class="c-input c-input--info" id="input17" type="date" required name="start">
                            </div>
                            <div class="c-form-field">
                                <label class="c-field__label" for="input17">End</label>
                                <input class="c-input c-input--info" id="input17" type="date" required name="end">
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-8 u-mb-medium">
                            <div class="c-field">
                                <label class="c-field__label" for="input18">Notes</label>
                                <textarea class="c-input" rows="8" id="textarea5" required name="notes"></textarea>
                            </div>
                        </div> 

                        <div class="col-sm-12 col-md-12 u-mb-medium">
                            <span class="c-divider u-mv-medium"></span>
                        </div>

                        <div class="col-sm-2 col-md-2 u-mb-medium">
                            <div class="c-field">
                                <div class="col u-mb-medium">
                                    <button class="c-btn c-btn--info">Apply</button>
                                </div>
                            </div>
                        </div> 
                    </div> 
                </form> 
            </div> 
        </div> 
    </div>    
@endsection 