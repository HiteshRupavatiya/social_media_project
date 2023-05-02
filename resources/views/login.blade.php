@extends('layouts.app')
@section('title')
    Login
@endsection
@section('navbar')
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Social Site</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register.view') }}">Register</a>
                    </li>
                </ul>
            </div>
        </nav>
        <br>
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card form-holder">
                    <div class="card-body">
                        <h1>Login</h1>
                        @if (Session::has('error'))
                            <p class="text-danger">{{ Session::get('error') }}</p>
                        @endif
                        @if (Session::has('success'))
                            <p class="text-success">{{ Session::get('success') }}</p>
                        @endif

                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Email :</label>
                                <input type="email" name="email" id="" class="form-control"
                                    value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Password :</label>
                                <input type="password" name="password" id="" class="form-control"
                                    value="{{ old('password') }}">
                                @if ($errors->has('password'))
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Remember Me</label>
                            </div>
                            <div class="row">
                                <div class="col-12 text-left">
                                    <br>
                                    <a href="{{ route('forgot.password.view') }}" class="btn btn-link">Forgot Password</a>
                                    <hr>
                                    <a href="{{ route('register.view') }}" class="btn btn-link">Don't have an account</a>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <a href="{{ route('login.github') }}" class="btn btn-dark mt-2">Github</a>
                                    <a href="{{ route('login.facebook') }}" class="btn btn-primary mt-2">Facebook</a>
                                    <a href="{{ route('login.google') }}" class="btn btn-danger mt-2">Google</a>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <input type="submit" class="btn btn-primary" value="Login">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
