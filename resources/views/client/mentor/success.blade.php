<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Dreams LMS</title>

<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.svg')}}">

<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
<body class="error-page">

<div class="main-wrapper">
<div class="error-box">
<div class="error-logo">
<a href="index.html">
<img src="{{asset('assets/img/logo.svg')}}" class="img-fluid" alt="Logo">
</a>
</div>
<div class="error-box-img">
<img src="a')}}ssets/img/error-02.png" alt class="img-fluid">
</div>
<h3 class="h2 mb-3">Congratulations <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0,0,256,256">
    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.33333,5.33333)"><path d="M44,24c0,11.045 -8.955,20 -20,20c-11.045,0 -20,-8.955 -20,-20c0,-11.045 8.955,-20 20,-20c11.045,0 20,8.955 20,20z" fill="#fa5560"></path><path d="M34.586,14.586l-13.57,13.586l-5.602,-5.586l-2.828,2.828l8.434,8.414l16.395,-16.414z" fill="#ffffff"></path></g></g>
    </svg></h3>
<p class="h4 font-weight-normal">You successfully registered as a mentor</p>
<a href="{{route('mentor-profile')}}" class="btn btn-primary">Go to Dashboard</a>
</div>
</div>


<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>

<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('assets/js/script.js')}}"></script>
</body>
</html>