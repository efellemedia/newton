@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <div class="login" style="min-width: 400px;">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">Newton</h1>
            
                @if(config('newton.registration.domain'))
                    <div class="text-center mb-4">
                        <small>
                            Please register with a valid <b>{{ '@'.config('newton.registration.domain') }}</b> email address.
                        </small>
                    </div>
                @endif

                <div class="login-block">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <input type="text" name="name" class="form-control" placeholder="Full Name">
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" name="email" class="form-control" placeholder="E-Mail Address">
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>

                    <br>

                    <p class="text-center">
                        <small>
                            <a href="{{ url('/login') }}">Already have an account?</a>
                        </small>
                    </p>
                </div>
            </div>
        </div>
@endsection
