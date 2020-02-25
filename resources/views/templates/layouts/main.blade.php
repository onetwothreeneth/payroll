<!Doctype html>
<html lang="en-us">
    <head>
            <meta charset="utf-8">
            <meta http-equiv="x-ua-compatible" content="ie=edge">
            <title>Cyan Payroll Management System</title> 
            <meta name="viewport" content="width=device-width, initial-scale=1"> 
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600" > 
            <link rel="icon" href="{{ URL::asset('assets/icon.png') }}"> 
            <link rel="stylesheet" href="{{ URL::asset('assets/css/main.min3661.css?v=2.0') }}">
            <link rel="stylesheet" href="{{ URL::asset('assets/css/animate.css') }}">
            <link rel="stylesheet" href="{{ URL::asset('assets/css/clock.css') }}">
    </head>
    <body class="o-page">  

        @if(session('type') == 'admin')
            @include('templates.sidebar.index') 
        @else
            @include('templates.sidebar.timekeeper') 
        @endif

        <main class="o-page__content" style="padding-bottom: 5%;">
            
            @include('templates.header.index')

            @yield('content')

        </main>  


        <script src="{{ URL::asset('assets/js/jquery.js') }}"></script>
        <script src="{{ URL::asset('assets/js/main.min3661.js?v=2.0') }}"></script>
        <script src="{{ URL::asset('assets/js/clock.js') }}"></script>
        <script type="text/javascript">
            $('body .confirm').click(function(){
                if(window.confirm("Are you sure you want to proceed ?")){
                    return true;
                } 
                return false;
            });
        </script>
        
        @yield('extraCss')

        @yield('extraJs')
        
        @include('templates.alerts.index') 
    </body> 
</html>