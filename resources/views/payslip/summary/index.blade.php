<?php $active = 'payslips'; ?>
@extends('templates.layouts.main')
@section('content')  
    <div class="container-fluid" style="margin:1%; padding:1%; width:98%; margin-top: 2%; background-color: white;">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="c-table-responsive@desktop"> 
                    @if($meta)
                        @foreach($meta as $k => $v)
                            <div class="payslip-card">
                                <div class="company-info">
                                    <div class="info">
                                        <p>
                                            <b>{{ ucfirst($company['name']) }}</b><br>
                                            <small>{{ $company['address'] }}</small><br>
                                            <small><i>{{ $company['contact'] }}</i></small>
                                        </p>
                                    </div>
                                    <div class="logo">
                                        <img src="{{ URL::asset('assets') }}/{{ $company['logo'] }}">
                                    </div>
                                </div>
                                <div class="employee-info">
                                    <div class="left">
                                        <table>
                                            <tr>
                                                <td class="info head">Employee ID</td>
                                                <td class="value">CYAN{{ date('Y',strtotime($v->details->created_at)).'00000'.$v->details->id }}</td>
                                            </tr>
                                            <tr>
                                                <td class="info head">Fullname</td>
                                                <td class="value">{{ $v->details->fname }} {{ $v->details->mname }} {{ $v->details->lname }}</td>
                                            </tr> 
                                            <tr>
                                                <td class="info head">Address</td>
                                                <td class="value">{{ $v->details->address }}</td>
                                            </tr>
                                            <tr>
                                                <td class="info head">Contact</td>
                                                <td class="value">{{ $v->details->contact }}</td>
                                            </tr>
                                            <tr>
                                                <td class="info head">Department</td>
                                                <td class="value">{{ $v->details->department }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="right">
                                        <table>
                                            <tr>
                                                <td class="info head">Designation</td>
                                                <td class="value">{{ $v->details->designation }}</td>
                                            </tr> 
                                            <tr>
                                                <td class="info head">TAX</td>
                                                <td class="value">TAX{{ $v->details->tax }}</td>
                                            </tr> 
                                            <tr>
                                                <td class="info head">SSS</td>
                                                <td class="value">SSS{{ $v->details->sss }}</td>
                                            </tr> 
                                            <tr>
                                                <td class="info head">PHILHEALTH</td>
                                                <td class="value">PH{{ $v->details->philhealth }}</td>
                                            </tr> 
                                            <tr>
                                                <td class="info head">PAGIBIG</td>
                                                <td class="value">PGBG{{ $v->details->pagibig }}</td>
                                            </tr> 
                                        </table>
                                    </div>
                                </div>
                                <div class="summary-info">
                                    <div class="card">
                                        <span class="title">Mandatory Deductions</span>
                                        <div class="data">
                                            <div class="meta">SSS</div>
                                            <div class="value">P {{ number_format($v->mandatory->sss,2,'.',',') }}</div>
                                        </div>
                                        <div class="data">
                                            <div class="meta">Philhealth</div>
                                            <div class="value">P {{ number_format($v->mandatory->philhealth,2,'.',',') }}</div>
                                        </div>
                                        <div class="data">
                                            <div class="meta">Pagibig</div>
                                            <div class="value">P {{ number_format($v->mandatory->pagibig,2,'.',',') }}</div>
                                        </div>
                                        <div class="data">
                                            <div class="meta">Tax</div>
                                            <div class="value">P {{ number_format($v->mandatory->tax,2,'.',',') }}</div>
                                        </div>
                                        <div class="data">
                                            <div class="meta">-</div>
                                            <div class="value">-</div>
                                        </div>
                                        <div class="total">
                                            <div class="meta"><b>Total</b></div>
                                            <div class="value">P {{ number_format(($v->mandatory->sss + $v->mandatory->philhealth + $v->mandatory->pagibig + $v->mandatory->tax),2,'.',',') }}</div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <span class="title">Loan Deductions</span>
                                        @if($v->loans->status != 'none')
                                            <div class="data">
                                                <div class="meta">Loan Type</div>
                                                <div class="value">{{ $v->loans->type }}</div>
                                            </div>
                                            <div class="data">
                                                <div class="meta">Total</div>
                                                <div class="value">{{ number_format($v->loans->total,2,'.',',') }}</div>
                                            </div>
                                            <div class="data">
                                                <div class="meta">Paid</div>
                                                <div class="value">{{ number_format($v->loans->paid,2,'.',',') }}</div>
                                            </div>
                                            <div class="data">
                                                <div class="meta">Balance</div>
                                                <div class="value">{{ number_format($v->loans->balance,2,'.',',') }}</div>
                                            </div>
                                            <div class="data">
                                                <div class="meta">Deduction</div>
                                                <div class="value">{{ number_format($v->loans->monthly,2,'.',',') }}</div>
                                            </div>
                                            <div class="total">
                                                <div class="meta"><b>Total</b></div>
                                                <div class="value">P {{ number_format($v->loans->monthly,2,'.',',') }}</div>
                                            </div>
                                        @else
                                            <div class="data">
                                                <div class="meta">Loan Type</div>
                                                <div class="value">-</div>
                                            </div>
                                            <div class="data">
                                                <div class="meta">Total</div>
                                                <div class="value">-</div>
                                            </div>
                                            <div class="data">
                                                <div class="meta">Monthly</div>
                                                <div class="value">-</div>
                                            </div>
                                            <div class="data">
                                                <div class="meta">Balance</div>
                                                <div class="value">-</div>
                                            </div>
                                            <div class="data">
                                                <div class="meta">Deduction</div>
                                                <div class="value">-</div>
                                            </div>
                                            <div class="total">
                                                <div class="meta"><b>Total</b></div>
                                                <div class="value">-</div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card">
                                        <span class="title">Rate</span>
                                        <div class="data">
                                            <div class="meta">Basic Rate</div>
                                            <div class="value">P {{ number_format($v->details->basic_rate,2,'.',',') }}</div>
                                        </div>
                                        <div class="data">
                                            <div class="meta">Regular Hours</div>
                                            <div class="value"> {{ $v->tender->regular }} Hrs</div>
                                        </div> 
                                        <div class="data">
                                            <div class="meta">OT Hours</div>
                                            <div class="value"> {{ $v->tender->ot }} Hrs</div>
                                        </div> 
                                        <div class="data">
                                            <div class="meta">Night Diff Hours</div>
                                            <div class="value"> {{ $v->tender->night_diff }} Hrs</div>
                                        </div> 
                                        <div class="data">
                                            <div class="meta">Total Hours</div>
                                            <div class="value"><b>{{ $v->tender->night_diff + $v->tender->ot  + $v->tender->regular }} Hrs</b></div>
                                        </div> 
                                        <div class="total">
                                            <div class="meta"><b>Total</b></div>
                                            <div class="value">P {{ number_format($v->rates->gross,2,'.',',') }}</div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <span class="title">Earnings</span>
                                        <div class="data">
                                            <div class="meta">Gross Earnings</div>
                                            <div class="value">P {{ number_format($v->rates->gross,2,'.',',') }}</div>
                                        </div> 
                                        <div class="data">
                                            <div class="meta">Mandatory Deductions</div>
                                            <div class="value">P {{ number_format($v->rates->mandatory,2,'.',',') }}</div>
                                        </div> 
                                        <div class="data">
                                            <div class="meta">Loan Deductions</div>
                                            <div class="value">P {{ number_format($v->rates->loan_deduct,2,'.',',') }}</div>
                                        </div> 
                                        <div class="data">
                                            <div class="meta">-</div>
                                            <div class="value">-</div>
                                        </div>  
                                        <div class="total">
                                            <div class="meta"><b>Total Profit</b></div>
                                            <div class="value overall">P {{ number_format($v->rates->profit,2,'.',',') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="payroll-summary">
                                    <p>
                                        <b>Payroll ID : <small class="val">{{ date('Y',strtotime($payslip->created_at)) }}0000{{ $payslip->id }}</small></b>
                                        <p class="right">
                                            <b>Date issued : <small class="val">{{ date("M d, Y",strtotime($payslip->created_at)) }}</small></b>
                                        </p>
                                    </p>
                                    <p>
                                        <b>Cut-off : <small class="val">{{  date("M d, Y",strtotime($payslip->cutoff_start)) }} - {{  date("M d, Y",strtotime($payslip->cutoff_end)) }}</small></b>
                                    </p>
                                   
                                </div>
                            </div>
                        @endforeach
                    @endif     
                </div>  
            </div>
        </div> 
    </div>    
@endsection 
@section('extraCss')
    <style type="text/css"> 
        .payslip-card{width: 100%; float: left; padding: 2%;}
        .payslip-card .company-info{width: 100%; float: left; border-bottom: 1px solid #333; padding-bottom: 2%;}
        .payslip-card .company-info .logo{width: 10%; float: left;}
        .payslip-card .company-info .logo img{width: 70%; float: right;}
        .payslip-card .company-info .info{width: 90%; float: left;}
        .payslip-card .company-info .info p b{font-size: 1.2em !important;}
        .payslip-card .employee-info{width: 100%; float: left; padding: 0%; border-left: 1px solid #333; border-right: 1px solid #333; border-bottom: 1px solid #333;}
        .payslip-card .employee-info .left{width: 50%; float: left; border-right: 1px solid #333;}
        .payslip-card .employee-info .right{width: 50%; float: left;}
        .payslip-card .employee-info .left table{width:100%;}
        .payslip-card .employee-info .right table{width:100%;}
        .payslip-card .employee-info .right table tr .head{font-weight: bolder;}
        .payslip-card .employee-info .left table tr td{font-size: 0.7em;}
        .payslip-card .employee-info .right table tr td{font-size: 0.7em;}
        .payslip-card .employee-info .right table tr .info{width: 40%;}
        .payslip-card .employee-info .right table tr .value{width: 60%;}
        .payslip-card .employee-info .left table tr .info{width: 30%;}
        .payslip-card .employee-info .left table tr .value{width: 70%;}
        .overall{font-size: 1.5em !important;}
        .payslip-card{border-bottom: 1px solid #333;}
        .payslip-card .payroll-summary{width: 100%; float: left;}
        .payslip-card .payroll-summary .right{float:right; font-size: 0.8em;}
        .payslip-card .payroll-summary p{font-size: 0.8em;}
        .payslip-card .payroll-summary p b .val{border-bottom: 1px solid #333; width:}
        .payslip-card .summary-info{width: 100%; float: left; border-right: 1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;}
        .payslip-card .summary-info .card{height:9em; padding:0.2%; width: 25%; float: left; background-color: xred; border-right: 1px solid #333;}
        .payslip-card .summary-info .card .title{font-weight: bolder;}
        .payslip-card .summary-info .card .data{width: 100%; float: left;}
        .payslip-card .summary-info .card .data .meta{width: 50%; float: left; text-align: left; font-size: 0.7em; font-weight: bolder;}
        .payslip-card .summary-info .card .data .value{width: 50%; float: left; text-align: right; font-size: 0.7em;}
        .payslip-card .summary-info .card .total{width: 100%; float: left; border-top: 1px solid #333;}
        .payslip-card .summary-info .card .total .meta{width: 50%; float: left; text-align: left; font-size: 0.7em; font-weight: bolder;}
        .payslip-card .summary-info .card .total .value{width: 50%; float: left; text-align: right; font-size: 0.8em; color: red;}

        @media print{
            .c-navbar{display: none;}
        }
    </style>
@endsection