@extends('layouts.app')

@section('navbar')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card form-holder">
                    <div class="card-body">
                        <h1>Reset Password</h1>
                        @if (Session::has('error'))
                            <p class="text-danger">{{ Session::get('error') }}</p>
                        @endif
                        @if (Session::has('success'))
                            <p class="text-success">{{ Session::get('success') }}</p>
                        @endif

                        <form action="{{ route('reset.password') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="email" id="" class="form-control"
                                    value="{{ $password_reset->email }}">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" id="" class="form-control"
                                    value="{{ old('password') }}">
                                @if ($errors->has('password'))
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input type="password" name="confirm_password" id="" class="form-control"
                                    value="{{ old('confirm_password') }}">
                                @if ($errors->has('confirm_password'))
                                    <p class="text-danger">{{ $errors->first('confirm_password') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
