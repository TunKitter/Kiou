@extends('client.layouts.auth')
@section('content')
    <div class="login-wrapper">
        @if ($message = Session::get('success'))
            @include('client.section.message', ['message' => $message, 'type' => 'success'])
        @endif
        @if ($message = Session::get('deny_register'))
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
                    <label class="form-check-label mb-0 d-flex align-items-center">
                        <input class="form-check-input me-2" onchange="enter_data()" id="remember" type="checkbox"
                            name="remember" />
                        <span>I agree to the terms</span>
                        <button type="button" class="btn btn-transparent text-danger" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            service
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content container-lg">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Service</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        The service utilizing a programming learning website may include various features and advantages to support learners in developing their programming skills. Here is a general description of the services that a programming learning website can provide:
                                    
                                        <p><strong>1. Online Learning:</strong> The website offers online programming courses, enabling learners to access content from anywhere and at any time. These courses are often divided into video lectures, online tutorials, and practical exercises.</p>
                                    
                                        <p><strong>2. Flexible Learning Platform:</strong> The service allows learners to proceed at their own pace, helping them grasp knowledge effectively. Progress tests and practical exercises can be utilized to assess and reinforce understanding.</p>
                                    
                                        <p><strong>3. Real-world Projects and Practice Exercises:</strong> It provides real-world projects and practical exercises for learners to apply the knowledge they have acquired to practical scenarios, as well as to hone problem-solving and teamwork skills.</p>
                                    
                                        <p><strong>4. Mentor Support and Community:</strong> It offers means of communication with teachers or mentors to address queries and provide support during the learning process. Additionally, there may be an online community for learners to share experiences and ask questions.</p>
                                    
                                        <p><strong>5. Online Coding Environment:</strong> An online programming environment facilitates coding conveniently without the need to install software on personal computers.</p>
                                    
                                        <p><strong>6. Progress Tracking and Analytics:</strong> Tools are provided to track learners' progress, including study hours, completed tests, and projects undertaken.</p>
                                    
                                        <p><strong>7. Diverse Programming Resources:</strong> The website offers a variety of learning resources, including study materials, lectures, and code examples to support programming education.</p>
                                    
                                        These services collectively contribute to creating a comprehensive and flexible programming learning experience for learners.
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <span>and </span>
                        <button type="button" class="btn btn-transparent text-danger" data-bs-toggle="modal"
                            data-bs-target="#exampleModal2">
                            privacy police
                        </button>
                        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content container-lg">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Privacy police</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        Welcome to <strong>Kiou</strong>!
                                        <br>
                                        Before using our website, please carefully read and understand the following terms and conditions. By accessing or using our website, you agree to abide by these terms. If you do not agree to any terms, please immediately cease using the website.
                                    
                                        <p><strong>Ownership and Copyright:</strong>
                                            <ul>
                                                <li>All content on this website is our property and is protected by copyright law.</li>
                                                <li>You are granted a license to use the content for personal and non-commercial purposes.</li>
                                            </ul>
                                        </p>
                                    
                                        <p><strong>User Responsibilities and Rights:</strong>
                                            <ul>
                                                <li>You commit not to use the website for any unlawful purposes.</li>
                                                <li>We are not responsible for users' misuse of the website.</li>
                                            </ul>
                                        </p>
                                    
                                        <p><strong>Information Security:</strong>
                                            <ul>
                                                <li>We are committed to protecting your personal information in accordance with the law and will not share this information with third parties without your consent.</li>
                                            </ul>
                                        </p>
                                    
                                        <p><strong>Limitation of Liability:</strong>
                                            <ul>
                                                <li>We are not liable for any loss or damage arising from the use of our website.</li>
                                            </ul>
                                        </p>
                                    
                                        <p><strong>Changes to Terms:</strong>
                                            <ul>
                                                <li>We reserve the right to adjust and change these terms without prior notice. You should check periodically for the latest information.</li>
                                            </ul>
                                        </p>
                                    
                                        <p><strong>Account Termination:</strong>
                                            <ul>
                                                <li>We have the right to terminate or suspend the account of any user who violates the terms of use.</li>
                                            </ul>
                                        </p>
                                    
                                        <p>Thank you for using <strong>Kiou</strong>!</p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="error_message">
                            @error('remember')
                                <span style="color: red;font-weight:lighter"></span>
                                <br>
                            @enderror
                        </div>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary btn-start" id="registerButton" disabled
                        type="submit">Register</button>
                </div>
            </form>
        </div>
        <div class="google-bg text-center">
            <span><a href="#">Or log in with</a></span>
            <div class="sign-google">
                <ul>
                    <li><a style="border-right: none !important" href="{{ route('login.google') }}"><img
                                src="{{ asset('assets/img/net-icon-01.png') }}" class="img-fluid" alt="Logo"> Sign In using Google</a></li>
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
