@extends('client.layouts.auth')
@section('content')
@if ($message = Session::get('success'))
@include('client.section.message', ['message' => $message,'type'=>'success'])
@endif
@if ($message = Session::get('need_login'))
@include('client.section.message', ['message' => $message,'type'=>'fail'])
@endif
<div class="login-wrapper">
<div class="loginbox">
<div class="w-100">
<div class="img-logo">
<img src="{{asset('assets/img/logo.svg')}}" class="img-fluid" alt="Logo">
<div class="back-home">
<a href="{{route('home')}}">Quay lại trang chủ</a>
</div>
</div>
<h1>Đăng nhập </h1>
<form action="{{route('login')}}" method="POST">
    @csrf
<div class="form-group">
<label class="form-control-label">Email</label>
<input type="email" id="email" name="email" class="form-control" placeholder="Nhập địa chỉ email" oninput="enter_data()">
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
<input type="password" name="password" id="password" class="form-control pass-input" placeholder="Nhập mật khẩu" oninput="enter_data()">
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
<span><a class="forgot-link" href="{{route('enter-email')}}">Quên mật khẩu ?</a></span>
</div>
{{-- <div class="remember-me"> --}}
{{-- <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Ghi nhớ tài khoản --}}
{{-- <input type="checkbox" name="radio"> --}}
{{-- <span class="checkmark"></span> --}}
{{-- </label> --}}
{{-- </div> --}}
<div class="d-grid">
<button class="btn btn-primary btn-start" type="submit" disabled>Đăng nhập</button>
</div>
</form>
</div>
</div>
<div class="google-bg text-center">
<span><a href="#">Hoặc đăng nhập bằng</a></span>
<div class="sign-google">
<ul>
<li><a style="border-right: none !important;" href="{{route('login.google')}}"><img src="{{asset('assets/img/net-icon-01.png')}}" class="img-fluid" alt="Logo"> Sign In using Google</a></li>
{{-- <li><a href="#"><img src="{{asset('assets/img/net-icon-02.png')}}" class="img-fluid" alt="Logo">Sign In using Facebook</a></li> --}}
</ul>
</div>
<p class="mb-0">Người dùng mới ? <a href="{{route('register')}}">Đăng ký tại đây</a></p>
</div>
</div>
<script>
    var btn_login = document.querySelector('.btn-start');
    var inputs = (document.querySelectorAll('input[oninput="enter_data()"]'))
    var inputs_length = inputs.length
    function enter_data(){
    let check_ = true
        for(let i = 0 ; i < inputs_length; i++) {
            if(inputs[i].value.length < 5){
                btn_login.setAttribute('disabled', true);
                return;
            }
        }

        function giaothua(n) {
            if (n == 1) {
                return 1;
            }
            return n * giaothua(n - 1)
        }
        console.log(giaothua(4));
    </script>
@endsection
