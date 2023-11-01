@extends('client.layouts.auth')
@section('content')
    @if ($message = Session::get('success'))
        @include('client.section.message', ['message' => $message, 'type' => 'success'])
    @endif

    <div class="login-wrapper">
        <div class="loginbox">
            <div class="w-100">
                <div class="img-logo">
                    <img src="{{ asset('assets/img/logo.svg') }}" class="img-fluid" alt="Logo">
                    <div class="back-home">
                        <a href="{{ route('home') }}">Quay lại trang chủ</a>
                    </div>
                </div>
                <h1>Đăng nhập </h1>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="Nhập địa chỉ email" oninput="enter_data()">

                        <div class="error_message">
                            @error('email')
                                <span style="color: red;font-weight:lighter">{{ $message }}</span>
                                <br>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Mật khẩu</label>
                        <div class="pass-group">
                            <input type="password" name="password" id="password" class="form-control pass-input"
                                placeholder="Nhập mật khẩu" oninput="enter_data()">
                            <span class="feather-eye toggle-password"></span>
                            <div class="error_message">
                                @error('password')
                                    <span style="color: red;font-weight:lighter">{{ $message }}</span>
                                    <br>
                                @enderror
                            </div>
                            <p>Lượt nhập request: <span id="count">0</span></p>
                        </div>
                    </div>
                    <div class="forgot">
                        <span><a class="forgot-link" href="{{ route('enter-email') }}">Quên mật khẩu ?</a></span>
                    </div>
                    {{-- <div class="remember-me"> --}}
                    {{-- <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Ghi nhớ tài khoản --}}
                    {{-- <input type="checkbox" name="radio"> --}}
                    {{-- <span class="checkmark"></span> --}}
                    {{-- </label> --}}
                    {{-- </div> --}}
                    <div class="d-grid">
                        <button class="btn btn-primary btn-start" type="submit" id="submitButton" disabled>Đăng
                            nhập</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="google-bg text-center">
            <span><a href="#">Hoặc đăng nhập bằng</a></span>
            <div class="sign-google">
                <ul>
                    <li><a style="border-right: none !important;" href="{{ route('login.google') }}"><img
                                src="{{ asset('assets/img/net-icon-01.png') }}" class="img-fluid" alt="Logo"> Sign In
                            using Google</a></li>
                    {{-- <li><a href="#"><img src="{{asset('assets/img/net-icon-02.png')}}" class="img-fluid" alt="Logo">Sign In using Facebook</a></li> --}}
                </ul>
            </div>
            <p class="mb-0">Người dùng mới ? <a href="{{ route('register') }}">Đăng ký tại đây</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"
        integrity="sha256-/H4YS+7aYb9kJ5OKhFYPUjSJdrtV6AeyJOtTkw6X72o=" crossorigin="anonymous"></script>
    <script>
        var btn_login = document.querySelector('.btn-start');
        var inputs = (document.querySelectorAll('input[oninput="enter_data()"]'))
        var inputs_length = inputs.length

        function enter_data() {
            let check_ = true
            for (let i = 0; i < inputs_length; i++) {
                if (inputs[i].value.length < 5) {
                    btn_login.setAttribute('disabled', true);
                    return;
                }
            }
            if (check_) btn_login.removeAttribute('disabled');

        }


        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const submitButton = document.getElementById('submitButton');
        const countSpan = document.getElementById('count');

        // Xóa(reset) cookie
        function resetRequestCountCookie() {
            document.cookie = 'requestCount=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        }


        if (!Cookies.get('requestCount')) {
            Cookies.set('requestCount', 0);
            location.reload()
        }
        var requestCount = parseInt(Cookies.get('requestCount'));
        countSpan.innerHTML = requestCount;
        const maxAttempts = 10;
        var minisecond = 60000 * parseInt(requestCount);
        console.log('Date now: ' + Date.now(), 'get cookie: ' + Cookies.get('start_time'), 'date - start time :  ' + (
            parseInt(Date.now()) - parseInt(Cookies.get('start_time'))));


        submitButton.addEventListener('click', function() {
            Cookies.get('start_time') ? '' : Cookies.set('start_time', Date.now());
            console.log('//////Date now: ' + Date.now());
            console.log(Cookies.get('start_time'));
            console.log(minisecond);
            if (Date.now() - Cookies.get('start_time') <= minisecond || requestCount == 0) {
                requestCount++;
                Cookies.set('requestCount', requestCount); // Lưu giá trị vào cookie trong 1 ngày
                countSpan.innerHTML = requestCount;
            }
        });
        
        // Lược nhập sai tốt đa trong 2 phút 
        if ((requestCount % maxAttempts) == 0) {
            console.log('TIME_NOW: ' + Date.now());
            if (Date.now() - Cookies.get('start_time') <= 120000) {
                console.log('biet diem: ' + requestCount);
                var exponentiation = requestCount / maxAttempts;
                var waitFortime = giaothua(exponentiation) ** 2 * 60000;
                alert('Bạn đã nhập sai quá nhiều trong khoảng thời gian ngắn vui lòng đợi trong ' + waitFortime / 60000 + ' phút');
                document.cookie = 'time_now=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
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
