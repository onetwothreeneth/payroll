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
    </head>
    <body class="o-page o-page--center">  
        @include('templates.alerts.index') 
        <div class="o-page__card">
            <div class="c-card u-mb-xsmall">
                <header class="c-card__header u-pt-large"> 
                    <img src="{{ URL::asset('assets/logo.png') }}">  
                </header>
                
                <form class="c-card__body" method="post" action="{{ URL::route('login_authenticate') }}">
                    {{ csrf_field() }}
                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input1">Username</label> 
                        <input class="c-input" type="text" id="input1" placeholder="username" required name="username"> 
                    </div>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="input2">Password</label> 
                        <input class="c-input" type="password" id="input2" placeholder="password" required name="password"> 
                    </div>

                    <button class="c-btn c-btn--info c-btn--fullwidth" type="submit">Sign in to Dashboard</button> 
                </form>
            </div> 
        </div>

        <script src="{{ URL::asset('assets/js/main.min3661.js?v=2.0') }}"></script>  
    </body> 
</html>