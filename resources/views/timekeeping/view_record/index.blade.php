<?php $active = 'timekeeping'; ?>
@extends('templates.layouts.main')
@section('content')  
    <div class="container-fluid" style="margin:1%; padding:1%; width:98%; margin-top: 2%; background-color: white;">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="c-table-responsive@desktop"> 
                    <table class="c-table">
                        <caption class="c-table__title">
                            Attendance for <b>{{ date('M d, Y',strtotime($date)) }}</b>
                        </caption>
                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                                <th class="c-table__cell c-table__cell--head"></th>
                                <th class="c-table__cell c-table__cell--head">REG IN</th> 
                                <th class="c-table__cell c-table__cell--head">REG OUT</th> 
                                <th class="c-table__cell c-table__cell--head">REG HOURS</th> 
                                <th class="c-table__cell c-table__cell--head">OT HOURS</th> 
                                <th class="c-table__cell c-table__cell--head">NIGHT DIFF HOURS</th> 
                                <th class="c-table__cell c-table__cell--head">EARLY</th> 
                                <th class="c-table__cell c-table__cell--head">TARDY</th> 
                                <th class="c-table__cell c-table__cell--head">Double Pay</th>  
                                <th class="c-table__cell c-table__cell--head"></th> 
                            </tr>
                        </thead>

                        <tbody>
                            @if($data)
                                @foreach($data as $key => $value)
                                    <tr class="c-table__row"> 
                                        <form action="{{ URL::route('timekeeping_viewrecord_save',$date) }}" method="post">
                                            {{ csrf_field() }}
                                            <td class="c-table__cell c-table__cell--img o-media"> 
                                                <div class="o-media__img u-mr-xsmall"> 
                                                    <img src="{{ URL::asset('assets') }}/{{ App\timekeeping::find($value->id)->employee()->photo }}" style="width:56px;"> 
                                                </div>

                                                <div class="o-media__body">
                                                    {{ ucfirst(App\timekeeping::find($value->id)->employee()->fname) }}
                                                    {{ ucfirst(App\timekeeping::find($value->id)->employee()->mname) }}
                                                    {{ ucfirst(App\timekeeping::find($value->id)->employee()->lname) }}
                                                    <span class="u-block u-text-mute u-text-xsmall">{{ ucfirst( ucfirst(App\timekeeping::find($value->id)->employee()->designation) ) }}</span>
                                                </div>
                                            </td> 
                                            <td class="c-table__cell"> 
                                                <div class="input-group clockpicker">
                                                    <input type="text" class="c-input" value="{{ $value->time_in }}" name="time_in" required>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-time"></span>
                                                    </span>
                                                </div>
                                            </td>   
                                            <td class="c-table__cell"> 
                                                <div class="input-group clockpicker">
                                                    <input type="text" class="c-input" value="{{ $value->time_out }}" name="time_out" required>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-time"></span>
                                                    </span>
                                                </div>
                                            </td>   
                                            <td class="c-table__cell">
                                                {{ round($value->regular) }} hr/s
                                            </td>  
                                            <td class="c-table__cell">
                                                {{ round($value->ot) }} hr/s
                                            </td>  
                                            <td class="c-table__cell">
                                                {{ round($value->night_diff) }} hr/s
                                            </td> 
                                            <td class="c-table__cell">
                                                {{ round($value->early) }} hr/s
                                            </td>
                                            <td class="c-table__cell">
                                                {{ round($value->tardy) }} hr/s
                                            </td>    
                                            <td class="c-table__cell">
                                                <input class="c-input" type="checkbox" name="doublepay"  {{ $value->doublepay }}>
                                                <input class="c-input" type="hidden"   name="id" value="{{ $value->id }}">
                                            </td>   
                                            <td class="c-table__cell">  
                                                <button class="c-btn c-btn--info">Save</button> 
                                            </td>  
                                        </form>
                                    </tr> 
                                @endforeach
                            @else
                                <tr class="c-table__row">
                                    <td class="c-table__cell" colspan="8">
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
@section('extraJs')  
<script type="text/javascript">
$('.clockpicker').clockpicker({
    donetext: 'Done', 
});
</script>
@endsection
@section('extraCss')
    <style>
        .is-active{
            font-weight: bolder;
        }
    </style>
@endsection