<?php $active = 'leaves'; ?>
@extends('templates.layouts.main')
@section('content')  
    <div class="container-fluid" style="margin:1%; padding:1%; width:98%; margin-top: 2%; background-color: white;">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="c-table-responsive@desktop"> 
                    <table class="c-table">
                        <caption class="c-table__title">
                            Leaves   
                            <form action="" method="get"> 
                                @if(isset($_GET['page']))
                                    <input type="hidden" name="page" value="{{ $_GET['page'] }}"> 
                                @endif 
                                <div class="c-form-field">
                                    <label class="c-field__label" for="input17">Search</label>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input class="c-input c-input--info" id="input17" type="text" required name="q">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="col u-mb-medium">
                                                <button class="c-btn c-btn--info">Search</button>
                                            </div>
                                        </div>
                                    </div> 
                                </div>  
                            </form> 
                        </caption>
                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                                <th class="c-table__cell c-table__cell--head"></th>
                                <th class="c-table__cell c-table__cell--head">Employee ID</th>
                                <th class="c-table__cell c-table__cell--head">Leave Type</th> 
                                <th class="c-table__cell c-table__cell--head">Start</th> 
                                <th class="c-table__cell c-table__cell--head">End</th>   
                                <th class="c-table__cell c-table__cell--head">Status</th> 
                                <th class="c-table__cell c-table__cell--head">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($data)
                                @foreach($data as $key => $value)
                                    <tr class="c-table__row">
                                        <td class="c-table__cell c-table__cell--img o-media">

                                            <div class="o-media__img u-mr-xsmall"> 
                                                <img src="{{ URL::asset('assets') }}/{{ App\leaves::find($value->id)->employee()->photo }}" style="width:56px;"> 
                                            </div>

                                            <div class="o-media__body">
                                                {{ ucfirst(App\leaves::find($value->id)->employee()->fname) }} 
                                                {{ ucfirst(App\leaves::find($value->id)->employee()->mname) }} 
                                                {{ ucfirst(App\leaves::find($value->id)->employee()->lname) }}
                                                <span class="u-block u-text-mute u-text-xsmall">{{ ucfirst(App\leaves::find($value->id)->employee()->designation) }}</span>
                                            </div>
                                        </td>
           
                                        <td class="c-table__cell">CYAN{{ date('Y',strtotime(App\leaves::find($value->id)->employee()->created_at)).'00000'.$value->emp_id }}</td>  
                                        <td class="c-table__cell">{{ App\leaves::find($value->id)->type() }}</td>   
                                        <td class="c-table__cell">{{ date('M d, Y',strtotime($value->start)) }}</td>   
                                        <td class="c-table__cell">{{ date('M d, Y',strtotime($value->end)) }}</td>   
                                        <td class="c-table__cell">
                                            @if($value->end < date("Y-m-d"))
                                                <span class="c-badge c-badge--danger">Expired</span> 
                                            @elseif($value->start <= date("Y-m-d") && $value->end >= date("Y-m-d"))
                                                <span class="c-badge c-badge--warning">On-going</span> 
                                            @elseif($value->start > date("Y-m-d"))
                                                <span class="c-badge c-badge--success">Pending</span> 
                                            @endif
                                        </td>  

                                        <td class="c-table__cell">
                                            <div class="c-dropdown dropdown">
                                                <button class="c-btn c-btn--secondary has-dropdown dropdown-toggle" id="dropdownMenuButton21" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                                                
                                                <div class="c-dropdown__menu dropdown-menu" aria-labelledby="dropdownMenuButton21">
                                                    <a class="c-dropdown__item dropdown-item" href="{{ URL::route('leaves_update',$value->id) }}">Update</a>  
                                                    <a class="confirm c-dropdown__item dropdown-item" href="{{ URL::route('leaves_delete',$value->id) }}">Delete</a>
                                                </div>
                                            </div>
                                        </td>  
                                    </tr> 
                                @endforeach
                            @else
                                <tr class="c-table__row">
                                    <td class="c-table__cell" colspan="7">
                                        <center>No Results Found !</center>
                                    </td> 
                                </tr> 
                            @endif
                        </tbody>
                    </table> 
                    
                    @include('templates.pagination.index') 
                </div> 
            </div>
        </div> 
    </div>   
          
@endsection
@section('extraCss')
    <style>
        .is-active{
            font-weight: bolder;
        }
    </style>
@endsection