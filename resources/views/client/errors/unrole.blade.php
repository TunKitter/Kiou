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
<img src="{{asset('assets/img/error-02.png')}}" alt class="img-fluid">
</div>
<h3 class="h2 mb-3"> Something went wrong</h3>
<p class="h4 font-weight-normal">{{$msg}}</p>
<a href="index.html" class="btn btn-primary">Back to Home</a>
</div>
</div>


<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>

<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('assets/js/script.js')}}"></script>
</body>
</html>