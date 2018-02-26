@extends('layouts.auth')

@section('title', 'Log In')

@section('content')
    <div class="row">
        <div class="col text-center">
            <div class="card bg-info text-white mb-3">
                <div class="card-body">
                    <p class="my-0"><b>You need to log in before continuing.</b></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Log in with your account</h4>
                    
                    <div class="row">
                        <div class="col border border-top-0 border-left-0 border-bottom-0 border-light">
                            <div class="d-flex justify-content-center align-items-center h-100">
                                <a href="/login/redirect" class="btn btn-primary"> Log In With Efelle</a>
                            </div>
                        </div>
                        
                        <div class="col">
                            <form method="POST" action="/login" accept-charset="UTF-8">
                                @csrf
                                
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" name="email" type="text" id="email">
                                </div>

                                <div class="form-group ">
                                    <label for="password">Password</label>
                                    <input class="form-control" name="password" type="password" value="" id="password">
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input name="remember_me" type="checkbox" value="1"> <small>Remember me</small>
                                    </label>
                                </div>
                                
                                <hr>

                                <p class="text-center">
                                    <input class="btn btn-default" type="submit" value="Log In">
                                </p>
                            </form>
                            
                            @if (config('newton.registration.enabled'))
                                <br>

                                <p class="text-center">
                                    <small>
                                        <a href="{{ url('/register') }}">Don't have an account?</a>
                                    </small>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
