@extends('layouts.app')
@section('title')
    Register
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
                        <a class="nav-link" href="{{ route('login.view') }}">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
        <br>
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card form-holder">
                    <div class="card-body">
                        <h1>Register</h1>
                        @if (Session::has('error'))
                            <p class="text-danger">{{ Session::get('error') }}</p>
                        @endif

                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">User Name :</label>
                                <input type="text" name="name" id="" class="form-control"
                                    value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
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
                            <div class="form-group">
                                <label for="">Confirm Password :</label>
                                <input type="password" name="password_confirmation" id="" class="form-control">
                                @if ($errors->has('password_confirmation'))
                                    <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-8 text-left">
                                    <a href="{{ route('login.view') }}" class="btn btn-link">Already Have Account</a>
                                </div>
                                <div class="col-4 text-right">
                                    <input type="submit" class="btn btn-primary" value="Register">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
