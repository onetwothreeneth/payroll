<?php $active = 'employees'; ?>
@extends('templates.layouts.main')
@section('content')  
    <div class="container-fluid" style="margin:1%; padding:1%; width:98%; margin-top: 2%; background-color: white;">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="c-table-responsive@desktop"> 
                    <table class="c-table">
                        <caption class="c-table__title">
                            Employees   
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
                                <th class="c-table__cell c-table__cell--head">Gender</th> 
                                <th class="c-table__cell c-table__cell--head">Department</th> 
                                <th class="c-table__cell c-table__cell--head">Contact</th> 
                                <th class="c-table__cell c-table__cell--head">Total Earnings</th> 
                                <th class="c-table__cell c-table__cell--head">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($data)
                                @foreach($data as $key => $value)
                                    <tr class="c-table__row">
                                        <td class="c-table__cell c-table__cell--img o-media">

                                            <div class="o-media__img u-mr-xsmall"> 
                                                <img src="{{ URL::asset('assets') }}/{{ $value->photo }}" style="width:56px;"> 
                                            </div>

                                            <div class="o-media__body">
                                                {{ ucfirst($value->fname) }} {{ ucfirst($value->mname) }} {{ ucfirst($value->lname) }}
                                                <span class="u-block u-text-mute u-text-xsmall">{{ ucfirst($value->designation) }}</span>
                                            </div>
                                        </td>
          
                                        <td class="c-table__cell">CYAN{{ date('Y',strtotime($value->created_at)).'00000'.$value->id }}</td>  
                                        <td class="c-table__cell">{{ $value->gender }}</td>  
                                        <td class="c-table__cell">{{ App\employees::find($value->id)->dept() }}</td>  
                                        <td class="c-table__cell">{{ $value->contact }}</td>  
                                        <td class="c-table__cell" style="color:red;">P {{ App\employees::find($value->id)->earnings($value->id) }}</td>  
                                        <td class="c-table__cell">
                                            <div class="c-dropdown dropdown">
                                                <button class="c-btn c-btn--secondary has-dropdown dropdown-toggle" id="dropdownMenuButton21" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                                                
                                                <div class="c-dropdown__menu dropdown-menu" aria-labelledby="dropdownMenuButton21">
                                                    <a class="c-dropdown__item dropdown-item" href="{{ URL::route('employees_update',$value->id) }}">Update</a> 
                                                    <a class="c-dropdown__item dropdown-item" href="{{ URL::route('loan_apply',$value->id) }}">Apply Loan</a> 
                                                    <a class="c-dropdown__item dropdown-item" href="{{ URL::route('leaves_apply',$value->id) }}">Apply Leave</a> 
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