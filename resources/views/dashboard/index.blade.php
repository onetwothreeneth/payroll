<?php $active = 'dashboard'; ?>
@extends('templates.layouts.main')
@section('content')
    <div class="c-toolbar u-justify-center u-mb-small">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="row">
                <div class="col-6 col-md-3 c-toolbar__state">
                    <h4 class="c-toolbar__state-number">{{ $counter['employee'] }}</h4>
                    <span class="c-toolbar__state-title">Employees</span>
                </div>
                <div class="col-6 col-md-3 c-toolbar__state">
                    <h4 class="c-toolbar__state-number">{{ $counter['leaves'] }}</h4>
                    <span class="c-toolbar__state-title">Leaves</span>
                </div>
                <div class="col-6 col-md-3 c-toolbar__state">
                    <h4 class="c-toolbar__state-number">{{ $counter['loans'] }}</h4>
                    <span class="c-toolbar__state-title">Loans</span>
                </div>
                <div class="col-6 col-md-3 c-toolbar__state">
                    <h4 class="c-toolbar__state-number">{{ $counter['deductions'] }}</h4>
                    <span class="c-toolbar__state-title">Deductions</span>
                </div>
            </div>
        </div>
    </div> 

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="c-table-responsive@desktop">
                    <table class="c-table">
                        <caption class="c-table__title">
                            Audit Trail <small>total of <b style="color: red">{{ count($audit_trail) }}</b> result/s</small>
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
                                    <td colspan="4">
                                        <center>No Results Found !</center>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>  
    </div>   
@endsection