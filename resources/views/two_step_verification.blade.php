@extends('layouts.app')
@section('title')
    Two Step Verification
@endsection
@section('navbar')
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Social Site</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        @auth
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                            </div>
                        @endauth
                    </li>
                </ul>
            </div>
        </nav>
        <br>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card form-holder">
                    <div class="card-body">
                        <h1>Two step verification</h1>
                        @if (Session::has('error'))
                            <p class="text-danger">{{ Session::get('error') }}</p>
                        @endif
                        @if (Session::has('success'))
                            <p class="text-success">{{ Session::get('success') }}</p>
                        @endif

                        <form action="{{ route('two.factor.authentication.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Code :</label>
                                <input type="text" name="code" class="form-control" value="{{ old('code') }}">
                                @if ($errors->has('code'))
                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <a href="{{ route('two.factor.authentication.resend') }}">Resend Code ?</a>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Verify
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
