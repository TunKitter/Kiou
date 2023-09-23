
@extends('client.layouts.auth')
@section('content')
<div class="login-wrapper">
<div class="loginbox">
<div class="img-logo">
<img src="{{asset('assets/img/logo.svg')}}" class="img-fluid" alt="Logo">
<div class="back-home">
<a href="{{route('home')}}">Quay lại trang chủ</a>
</div>
</div>
<h1>Đăng ký</h1>
<form action="{{route('register.custom')}}" method="POST">
@csrf
<div class="form-group">
    <label class="form-control-label">Họ & tên</label>
    <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Nhập họ và tên">
    <div class="error_message">
        @error('name')
        <span style="color: red;font-weight:lighter">{{$message}}</span>
        <br>
    @enderror
    </div>   
</div>
<div class="form-group">
    <label class="form-control-label">Số điện thoại</label>
    <input type="text" name="phone"  value="{{old('phone')}}" class="form-control" placeholder="Nhập số điện thoại">
    <div class="error_message">
        @error('phone')
        <span style="color: red;font-weight:lighter">{{$message}}</span>
        <br>
    @enderror
    </div>   
</div>
<div class="form-group">
    <label class="form-control-label">Email</label>
    <input type="email" name="email"  value="{{old('email')}}" class="form-control" placeholder="Nhập địa chỉ email">
    <div class="error_message">
        @error('email')
        <span style="color: red;font-weight:lighter">{{$message}}</span>
        <br>
    @enderror
    </div>   
</div>
<div class="form-group">
    <label class="form-control-label">Tên tài khoản</label>
    <input type="text" name="username"  value="{{old('username')}}" class="form-control" placeholder="Nhập tên tài khoản">
    <div class="error_message">
        @error('username')
        <span style="color: red;font-weight:lighter">{{$message}}</span>
        <br>
    @enderror
    </div>   
</div>
<div class="form-group">
    <label class="form-control-label">Password</label>
    <div class="pass-group" id="passwordInput">
    <input type="password" name="password" class="form-control pass-input" placeholder="Enter your password">
    <span class="toggle-password feather-eye"></span>
    <span class="pass-checked"><i class="feather-check"></i></span>
    </div>
    <div class="password-strength" id="passwordStrength">
    <span id="poor"></span>
    <span id="weak"></span>
    <span id="strong"></span>
    <span id="heavy"></span>
    </div>
    <div id="passwordInfo"></div>
    <div class="error_message">
        @error('password')
        <span style="color: red;font-weight:lighter">{{$message}}</span>
        <br>
    @enderror
    </div>   
    </div>
<div class="form-check remember-me">
<label class="form-check-label mb-0">
<input class="form-check-input" id="remember" type="checkbox" name="remember"> Tôi đồng ý với các điều khoản <a href="term-condition.html">dịch vụ</a> và <a href="privacy-policy.html">chính sách riêng tư.</a>
</label>
<div class="error_message">
    @error('remember')
    <span style="color: red;font-weight:lighter"></span>
    <br>
@enderror
</div>   
</div>
<div class="d-grid">
<button class="btn-start" id="registerButton" type="submit">Đăng ký</button>
</div>
</form>
</div>
<div class="google-bg text-center">
<span><a href="#">Hoặc đăng nhập bằng</a></span>
<div class="sign-google">
<ul>
<li><a href="#"><img src="{{asset('assets/img/net-icon-01.png')}}" class="img-fluid" alt="Logo"> Sign In using Google</a></li>
<li><a href="#"><img src="{{asset('assets/img/net-icon-02.png')}}" class="img-fluid" alt="Logo">Sign In using Facebook</a></li>
</ul>
</div>
<p class="mb-0">Bạn có sẳn sàng để tạo một tài khoản? <a href="login.html">Đăng nhập</a></p>
</div>
</div>
@section('scripts')
<script>
$(document).ready(function () {
    var confirmCheckbox = $('#remember');
    var registerButton = $('#registerButton');

    confirmCheckbox.change(function () {
        if ($(this).is(':checked')) {
            // Kích hoạt nút đăng ký khi được tick
            registerButton.css('background-color', '#ff875a');
            registerButton.prop('disabled', false);
        } else {
            // Vô hiệu hóa nút đăng ký khi không được tick
            registerButton.prop('disabled', true);
        }
    });
});



</script>
@endsection
@endsection