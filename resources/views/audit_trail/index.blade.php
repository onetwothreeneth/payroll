<?php $active = 'audittrail'; ?>
@extends('templates.layouts.main')
@section('content')  
    <div class="container-fluid" style="margin:1%; padding:1%; width:98%; margin-top: 2%; background-color: white;">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="c-table-responsive@desktop"> 
                    <table class="c-table">
                        <caption class="c-table__title">
                            Audit Trail 
                        </caption>
                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                                <th class="c-table__cell c-table__cell--head"></th>
                                <th class="c-table__cell c-table__cell--head">Module</th>
                                <th class="c-table__cell c-table__cell--head">Action</th>
                                <th class="c-table__cell c-table__cell--head">Date</th> 
                            </tr>
                        </thead>

                        <tbody>
                            @if($audit_trail)
                                @foreach($audit_trail as $key => $value)
                                    <tr class="c-table__row">
                                        <td class="c-table__cell c-table__cell--img o-media">

                                            <div class="o-media__img u-mr-xsmall"> 
                                                <img src="{{ URL::asset('assets') }}/{{ $value['photo'] }}" style="width:56px;"> 
                                            </div>

                                            <div class="o-media__body">
                                                {{ ucfirst($value['name']) }}
                                                <span class="u-block u-text-mute u-text-xsmall">{{ ucfirst($value['type']) }}</span>
                                            </div>
                                        </td>
         
                                        <td class="c-table__cell">{{ ucfirst($value['data']->module) }}</td>  
                                        <td class="c-table__cell">{{ ucfirst($value['data']->action) }}</td>  
                                        <td class="c-table__cell">{{ $value['data']->created_at->diffForHumans() }}</td>  
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