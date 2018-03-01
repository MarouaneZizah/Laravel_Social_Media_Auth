<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> @yield('title') </title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="{{url('js/fontawesome-all.js')}}"></script>
        <link rel="stylesheet" href="{{url('css/app.css')}}">
    </head>
    <body>
        <div class="flex-center full-height wrapper">

            @if($flash = session('message'))
                <div class="flashMsg flashMsgSuccess">
                    {{ $flash }}
                </div>
            @endif
    
            @if($flash = session('error'))
                <div class="flashMsg flashMsgError">
                    {{ $flash }}
                </div>
            @endif
    
            @include('layouts.errors')

            <div class="links">
                <a class="{{ Request::is('/') ? 'active' : '' }}" href="{{url('/')}}">Home</a>
                <a class="{{ Request::is('register-student') ? 'active' : '' }}" href="{{url('register-student')}}">Student Register Form</a>
                <a class="{{ Request::is('register-teacher') ? 'active' : '' }}" href="{{url('register-teacher')}}">Teacher Register Form</a>
                <a class="{{ Request::is('users') ? 'active' : '' }}" href="{{url('users')}}">All Users</a>
            </div>
            
            <div class="content">
                @yield('content')
            </div>
        </div>
    </body>
</html>
