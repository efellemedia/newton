@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    @if(config('newton.registration.domain'))
        <div class="row">
            <div class="col text-center">
                <div class="card bg-info text-white mb-3">
                    <div class="card-body">
                        <p class="my-0"><b>Please register with a valid <b>{{ '@'.config('newton.registration.domain') }}</b> email address.</b></p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Register for a new account</h4>
                    
                    <div class="row">
                        <div class="col border border-top-0 border-left-0 border-bottom-0 border-light">
                            <div class="d-flex flex-column  align-items-center h-100">
                                <div>
                                    <p>
                                        By signing up for and by signing in to this service you accept our:
                                    </p>
                                    
                                    <ul>
                                        <li><a href="#">Privacy Policy</a></li>
                                        <li><a href="#">Terms & Conditions</a></li>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="col">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                                @csrf

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
                                
                                <hr>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-default">Register</button>
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
            </div>
        </div>
    </div>
@endsection
