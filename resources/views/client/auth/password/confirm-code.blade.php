@extends('client.layouts.auth')
@section('content')
<div class="login-wrapper">
    <div class="loginbox">
        <div class="img-logo">
            <img src="{{asset('assets/img/logo.svg')}}" class="img-fluid" alt="Logo">
            <div class="back-home">
                {{-- <a href="index.html">Back to Home</a> --}}
            </div>
        </div>
        <h1>Enter your confirm code</h1>
        <div class="reset-password">
            <p>We've sent a code to your email to confirm</p>
        </div>
        <form action="login.html">
            <div class="form-group d-flex gap-2">
                {{-- <label class="form-control-label">Email</label> --}}
                <input type="text" class="form-control" maxlength="1">
                <input type="text" class="form-control" maxlength="1">
                <input type="text" class="form-control" maxlength="1">
                <input type="text" class="form-control" maxlength="1">
                <input type="text" class="form-control" maxlength="1">
                <input type="text" class="form-control" maxlength="1">
            </div>
            <div class="d-grid">
                <button class="btn btn-start" type="submit">Confirm</button>
            </div>
        </form>
    </div>
</div>
@endsection