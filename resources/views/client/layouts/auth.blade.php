<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>
        @if(!empty($meta_title))
        {{$meta_title}} | KIOU
        @else
        Khóa học online - Học mọi thứ theo lịch trình của bạn | KIOU
        @endif
    </title>
    @if(!empty($meta_description))
    <meta name="description" content="{{$meta_description}}">
    @endif
    @if(!empty($meta_keywords))
    <meta name="keywords" content="{{$meta_keywords}}">
    @endif
    <link rel="canoical" href="{{url()->current()}}"/>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.svg') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>

    <div class="main-wrapper log-wrap">
        <div class="row">

            <div class="col-md-6 login-bg">
                <div class="owl-carousel login-slide owl-theme">
                    <div class="welcome-login">
                        <div class="login-banner">
                            <img src="{{ asset('assets/img/login-img.png') }}" class="img-fluid" id="img-banner"
                                alt="Logo">
                        </div>
                        <div class="mentor-course text-center">
                            <h2>Welcome to <br>KIOU Courses.</h2>
                            <p>An interactive online video course help you learn better with scientists methods.</p>
                        </div>
                    </div>
                    <div class="welcome-login">
                        <div class="login-banner">
                            <img src="{{ asset('assets/img/login-img.png') }}" class="img-fluid" alt="Logo">
                        </div>
                        <div class="mentor-course text-center">
                            <h2>Welcome to <br>KIOU Courses.</h2>
                            <p>An interactive online video course help you learn better with scientists methods.</p>
                        </div>
                    </div>
                    <div class="welcome-login">
                        <div class="login-banner">
                            <img src="{{ asset('assets/img/login-img.png') }}" class="img-fluid" alt="Logo">
                        </div>
                        <div class="mentor-course text-center">
                            <h2>Welcome to <br>KIOU Courses.</h2>
                            <p>An interactive online video course help you learn better with scientists methods.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 login-wrap-bg">
                @yield('content')
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
