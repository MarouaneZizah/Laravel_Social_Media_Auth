@extends('layouts.master')

@section('title')
Student SignUp
@endsection

@section('content')

    <div>
        <a class="socialMediaLink" href="{{ url('oauth/student/facebook') }}"><i class="fab fa-facebook-f"></i> Facebook</a>

        <a class="socialMediaLink" href="{{ url('oauth/student/google') }}"><i class="fab fa-google-plus-g"></i> Google</a>
    </div>

    <form action="{{url('register-student')}}" method="post">
        
        {{ csrf_field() }}

        <div>
            <label for="firstName">First Name</label>
            <input type="text" name="firstName">
        </div>

        <div>
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName">
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email">
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>

        <div>
            <input type="submit" value="Register">
        </div>

    </form>

@endsection
           