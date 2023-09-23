@extends('client.layouts.auth')
@section('content')
    <div class="login-wrapper">
        <div class="loginbox">
            <div class="img-logo">
                <img src="{{ asset('assets/img/logo.svg') }}" class="img-fluid" alt="Logo">
                <div class="back-home">
                    {{-- <a href="index.html">Back to Home</a> --}}
                </div>
            </div>
            <h1>Enter your new password</h1>
            <div class="reset-password">
                {{-- <p>You might to reset your password to protect your account</p> --}}
            </div>
            <form action="{{ route('post-change-fp') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-control-label">New password</label>
                    <input type="password" class="form-control" placeholder="Enter your email address" name="newPassword">
                </div>
                @if ($errors->has('newPassword'))
                    <small class="text-danger">
                        {{ $errors->first('newPassword') }}
                    </small>
                @endif
                <div class="form-group">
                    <label class="form-control-label">Repeat new password</label>
                    <input type="password" class="form-control" placeholder="Enter your email address"
                        name="confirmPassword">
                </div>
                @if ($errors->has('confirmPassword'))
                    <small class="text-danger">
                        {{ $errors->first('confirmPassword') }}
                    </small>
                @endif
                <div class="d-grid">
                    <button class="btn btn-start" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
