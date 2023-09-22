@extends('client.layouts.auth')
@section('content')
@if ($message = Session::get('success'))
<div style="padding-left: 20px">
    <p class="alert alert-success">{{ $message }}</p>
</div>
@endif

<div class="login-wrapper">
<div class="loginbox">
<div class="w-100">
<div class="img-logo">
<img src="{{asset('assets/img/logo.svg')}}" class="img-fluid" alt="Logo">
<div class="back-home">
<a href="index.html">Quay lại trang chủ</a>
</div>
</div>
<h1>Đăng nhập vào tài khoản của bạn</h1>
<form action="{{route('login.custom')}}" method="POST">
    @csrf
<div class="form-group">
<label class="form-control-label">Email</label>
<input type="email" name="email" class="form-control" placeholder="Nhập địa chỉ email">
<div class="error_message">
    @error('email')
    <span style="color: red;font-weight:lighter">{{$message}}</span>
    <br>
@enderror
</div>   
</div>
<div class="form-group">
<label class="form-control-label">Mật khẩu</label>
<div class="pass-group">
<input type="password" name="password" class="form-control pass-input" placeholder="Nhập mật khẩu">
<span class="feather-eye toggle-password"></span>
<div class="error_message">
    @error('password')
    <span style="color: red;font-weight:lighter">{{$message}}</span>
    <br>
@enderror
</div>   
</div>
</div>
<div class="forgot">
<span><a class="forgot-link" href="forgot-password.html">Quên mật khẩu ?</a></span>
</div>
<div class="remember-me">
<label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Ghi nhớ tài khoản
<input type="checkbox" name="radio">
<span class="checkmark"></span>
</label>
</div>
<div class="d-grid">
<button class="btn btn-primary btn-start" type="submit">Đăng nhập</button>
</div>
</form>
</div>
</div>
<div class="google-bg text-center">
<span><a href="#">Hoặc đăng nhập bằng</a></span>
<div class="sign-google">
<ul>
<li><a href="#"><img src="{{asset('assets/img/net-icon-01.png')}}" class="img-fluid" alt="Logo"> Sign In using Google</a></li>
<li><a href="#"><img src="{{asset('assets/img/net-icon-02.png')}}" class="img-fluid" alt="Logo">Sign In using Facebook</a></li>
</ul>
</div>
<p class="mb-0">Người dùng mới ? <a href="{{route('register')}}">Đăng ký tại đây</a></p>
</div>
</div>
@endsection