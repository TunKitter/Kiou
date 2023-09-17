@extends('client.layouts.auth')
@section('content')
<div class="login-wrapper">
    <div class="loginbox">
        <div class="img-logo">
            <img src="{{asset('assets/img/logo.svg')}}" class="img-fluid" alt="Logo">
            <div class="back-home">
                <a href="index.html">Back to Home</a>
            </div>
        </div>
        <h1>Forgot Password ?</h1>
        <div class="reset-password">
            <p>Enter your email to reset your password.</p>
        </div>
        <form action="login.html">
            <div class="form-group">
                <label class="form-control-label">Email</label>
                <input type="email" class="form-control" placeholder="Enter your email address">
            </div>
            <div class="d-grid">
                <button class="btn btn-start" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection