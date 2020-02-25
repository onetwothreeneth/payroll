<?php $active = 'payslips'; ?>
@extends('templates.layouts.main')
@section('content')  
    <div class="container-fluid" style="margin:1%; padding:1%; width:98%; margin-top: 2%; background-color: white;">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="c-table-responsive@desktop"> 
                    <table class="c-table">
                        <caption class="c-table__title">
                            Payroll Records 
                        </caption>
                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                                <th class="c-table__cell c-table__cell--head"></th>
                                <th class="c-table__cell c-table__cell--head">Processed</th>
                                <th class="c-table__cell c-table__cell--head">Cut off Start</th>
                                <th class="c-table__cell c-table__cell--head">Cut off End</th>
                                <th class="c-table__cell c-table__cell--head">Action</th> 
                            </tr>
                        </thead>

                        <tbody>
                            @if($payslip)
                                @foreach($payslip as $key => $value)
                                    <tr class="c-table__row"> 
                                        <td class="c-table__cell">{{ $value->id }}</td>  
                                        <td class="c-table__cell">{{ $value->created_at->diffForHumans() }}</td>  
                                        <td class="c-table__cell">{{ date('M d, Y',strtotime($value->cutoff_start)) }}</td>  
                                        <td class="c-table__cell">{{ date('M d, Y',strtotime($value->cutoff_end)) }}</td>  

                                        <td class="c-table__cell">
                                            <div class="c-dropdown dropdown">
                                                <button class="c-btn c-btn--secondary has-dropdown dropdown-toggle" id="dropdownMenuButton21" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                                                
                                                <div class="c-dropdown__menu dropdown-menu" aria-labelledby="dropdownMenuButton21">
                                                    <a class="c-dropdown__item dropdown-item" href="{{ URL::route('payslips_view',$value->id) }}">View</a>  
                                                    <a class="confirm c-dropdown__item dropdown-item" href="{{ URL::route('payslips_delete',$value->id) }}">Delete</a>
                                                </div>
                                            </div>
                                        </td> 
                                    </tr> 
                                @endforeach
                            @else
                                <tr class="c-table__row">
                                    <td class="c-table__cell" colspan="4">
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