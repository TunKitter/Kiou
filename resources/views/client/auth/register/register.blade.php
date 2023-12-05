@extends('client.layouts.auth')
@section('content')
    <div class="login-wrapper">
        @if ($message = Session::get('success'))
            @include('client.section.message', ['message' => $message, 'type' => 'success'])
        @endif
        @if($message = Session::get('deny_register'))
            @include('client.section.message', ['message' => $message, 'type' => 'error'])
        @endif
        <div class="loginbox">
            <div class="img-logo">
                <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" alt="Logo">
                <div class="back-home">
                    <a href="{{ route('home') }}">Go back to home</a>
                </div>
            </div>
            <h1>Register</h1>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-control-label">Full name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                        placeholder="Enter your full name" oninput="enter_data()">
                    <div class="error_message">
                        @error('name')
                            <span style="color: red;font-weight:lighter">{{ $message }}</span>
                            <br>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Phone</label>
                    <input type="text" pattern="[0-9]{10}" required name="phone" value="{{ old('phone') }}"
                        class="form-control" placeholder="Enter your phone" oninput="enter_data()">
                    <div class="error_message">
                        @error('phone')
                            <span style="color: red;font-weight:lighter">{{ $message }}</span>
                            <br>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                        placeholder="Enter your email" oninput="enter_data()">
                    <div class="error_message">
                        @error('email')
                            <span style="color: red;font-weight:lighter">{{ $message }}</span>
                            <br>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter your user name"
                        oninput="enter_data()">
                    <div class="error_message">
                        @error('username')
                            <span style="color: red;font-weight:lighter">{{ $message }}</span>
                            <br>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-control-label">Password</label>
                    <div class="pass-group" id="passwordInput">
                        <input type="password" name="password" class="form-control pass-input"
                            placeholder="Enter your password" oninput="enter_data()">
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
                            <span style="color: red;font-weight:lighter">{{ $message }}</span>
                            <br>
                        @enderror
                    </div>
                </div>
                <div class="form-check remember-me">
                    <label class="form-check-label mb-0">
                        <input class="form-check-input" onchange="enter_data()" id="remember" type="checkbox"
                            name="remember"> I agree to the terms <a href="term-condition.html">service</a> and <a
                            href="privacy-policy.html">privacy policy.</a>
                    </label>
                    <div class="error_message">
                        @error('remember')
                            <span style="color: red;font-weight:lighter"></span>
                            <br>
                        @enderror
                    </div>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary btn-start" id="registerButton" disabled type="submit">Register</button>
                </div>
            </form>
        </div>
        <div class="google-bg text-center">
            <span><a href="#">Or log in with</a></span>
            <div class="sign-google">
                <ul>
                    <li><a style="border-right: none !important" href="{{ route('login.google') }}"><img
                                src="{{ asset('assets/img/net-icon-01.png') }}" class="img-fluid" alt="Logo"> Sign In
                            using Google</a></li>
                    {{-- <li><a href="#"><img src="{{asset('assets/img/net-icon-02.png')}}" class="img-fluid" alt="Logo">Sign In using Facebook</a></li> --}}
                </ul>
            </div>
            <p class="mb-0">Are you ready to create an account?<a href="{{ route('login') }}">Login</a></p>
        </div>
    </div>
    <script>
        var btn_login = document.querySelector('#registerButton');
        var accept_term_checkbox = document.querySelector('#remember');
        var inputs = (document.querySelectorAll('input[oninput="enter_data()"]'))
        var inputs_length = inputs.length
        var poor = document.getElementById('poor');
        var weak = document.getElementById('weak');
        var strong = document.getElementById('strong');
        var heavy = document.getElementById('heavy');
        var password_input = inputs[inputs_length - 1]

        function enter_data() {
            if (password_input.value.length > 5) {
                poor.style.backgroundColor = '#ff725e';
            } else {
                poor.style.backgroundColor = '#e3e3e3';
            }
            if (/\d/.test(password_input.value)) {
                weak.style.backgroundColor = '#ff725e';
            } else {
                weak.style.backgroundColor = '#e3e3e3';
            }
            if (!(password_input.value.includes(inputs[inputs_length - 2].value)) && inputs[inputs_length - 2].value
                .length > 3 && password_input.value.length > 5) {
                strong.style.backgroundColor = '#ff725e';
            } else {
                strong.style.backgroundColor = '#e3e3e3';
            }
            if ((/[^a-zA-Z0-9\s]/.test(password_input.value)) && password_input.value.length > 5) {
                heavy.style.backgroundColor = '#ff725e';
            } else {
                heavy.style.backgroundColor = '#e3e3e3';
            }
            let check_ = true
            for (let i = 0; i < inputs_length; i++) {
                if (inputs[i].value.length < 5 || !accept_term_checkbox.checked) {
                    btn_login.setAttribute('disabled', true);
                    return;
                }
            }
            if (check_) btn_login.removeAttribute('disabled');

        }
    </script>
@endsection
