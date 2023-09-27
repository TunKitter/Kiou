@extends('client.layouts.master')
@section('content')
<section class="home-three-slide d-flex align-items-center">
<div class="container">
<div class="row ">
<div class="col-xl-6 col-lg-8 col-md-12 col-12" data-aos="fade-down">
<div class="home-three-slide-face">
<div class="home-three-slide-text">
<h5>The Leader in Online Learning</h5>
<h1>Engaging <span>&</span> Accessible Online Courses For All</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan bibendum gravida maecenas augue elementum et</p>
</div>
<div class="banner-three-content">
{{-- <form class="form" action="{{}}"> --}}
<div class="form-inner-three" style="box-shadow: none !important">
<div class="input-group">
{{-- <input type="email" class="form-control" placeholder="Search School, Online eductional centers, etc"> --}}
<span class="drop-detail-three" >
</span>
<button class="btn btn-three-primary sub-btn w-50" type="submit" onclick="location.href='{{route('mentor-register')}}'">Join now</button>
</div>
</div>
{{-- </form> --}}
</div>
</div>
</div>
<div class="col-xl-6 col-lg-4 col-md-6 col-12" data-aos="fade-up">
<div class="girl-slide-img aos">
<img class="img-fluid" src="{{asset('assets/img/home-slider.png')}}" alt>
</div>
</div>
</div>
</div>
</section>


<section class="section student-course home-three-course">
<div class="container">
<div class="course-widget-three">
<div class="row">
<div class="col-lg-3 col-md-6 d-flex" data-aos="fade-up">
<div class="course-details-three">
<div class="align-items-center">
<div class="course-count-three course-count ms-0">
<div class="course-img">
<img class="img-fluid" src="assets/img/icon-three/course-01.svg" alt>
</div>
<div class="course-content-three">
<h4 class="text-blue"><span class="counterUp">10</span>K</h4>
<p>Online Courses</p>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6 d-flex" data-aos="fade-up">
<div class="course-details-three">
<div class="align-items-center">
<div class="course-count-three course-count ms-0">
<div class="course-img">
<img class="img-fluid" src="assets/img/icon-three/course-02.svg" alt>
</div>
<div class="course-content-three">
<h4 class="text-yellow"><span class="counterUp">200</span>+</h4>
<p>Expert Tutors</p>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6 d-flex" data-aos="fade-up">
<div class="course-details-three">
<div class="align-items-center">
<div class="course-count-three course-count ms-0">
<div class="course-img">
<img class="img-fluid" src="assets/img/icon-three/course-03.svg" alt>
</div>
<div class="course-content-three">
<h4 class="text-info"><span class="counterUp">6</span>K+</h4>
<p>Ceritified Courses</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<style>
    footer {
        display: none;
    }
</style>
@endsection