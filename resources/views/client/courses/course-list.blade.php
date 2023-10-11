@extends('client.layouts.master')
@section('content')
<section class="course-content">
<div class="container">
<div class="row">
<div class="col-lg-9">

<div class="showing-list">
<div class="row">
{{-- <div class="col-lg-6">
<div class="d-flex align-items-center">
<div class="show-result">
<h4>Showing 1-9 of 50 results</h4>
</div>
</div>
</div> --}}
<div class="col-lg-6">
<div class="show-filter add-course-info ">
<form action="#">
<div class="row gx-2 align-items-center">
<div class="col-md-6 col-item">
<div class=" search-group">
<i class="feather-search"></i>
<input type="text" class="form-control" placeholder="Search our courses">
</div>
</div>
<div class="col-md-6 col-lg-6 col-item">
<div class="form-group select-form mb-0">
<select class="form-select select" name="sellist1">
<option>Newly published </option>
<option>published 1</option>
<option>published 2</option>
<option>published 3</option>
</select>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>

<div class="row">
@foreach ($courses as $course)
<div class="col-lg-12 col-md-12 d-flex">
<div class="course-box course-design list-course d-flex">
<div class="product">
<div class="product-img">
<a href="{{route('course-detail',$course->slug)}}">
<img class="img-fluid" alt src="{{ asset($course->image)}}">
</a>
<div class="price">
<h3>{{ $course->price}} <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="head-course-title">
<h3 class="title">{{ $course->name}}</h3>
<div class="all-btn all-category d-flex align-items-center">
<a href="checkout.html" class="btn btn-primary">BUY NOW</a>
</div>
</div>
<div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="assets/img/icon/icon-01.svg" alt>
<p>{{ $course->meta['total_lesson']}} Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="assets/img/icon/icon-02.svg" alt>
<p>{{round($course->meta['total_time']/60)}}hr {{round($course->meta['total_time']%60)}}min</p>
</div>
</div>
<div class="rating">
{{-- <i class="fas fa-star filled"></i> --}}
{{-- <i class="fas fa-star filled"></i> --}}
{{-- <i class="fas fa-star filled"></i> --}}
<i class="fas fa-star filled"></i>
{{-- <i class="fas fa-star"></i> --}}
<span class="d-inline-block average-rating"><span>{{$course->complete_course_rate}}</span></span>
</div>
<div class="course-group d-flex mb-0">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user2.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">{{$course->mentor->name}}</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
<a href="#rate"><i class="fa-regular fa-heart"></i></a>
</div>
</div>
</div>
</div>
</div>
</div>
@endforeach
</div>
<div class="row">
    <div class="col-md-12 d-flex justify-content-center mb-4">
        @include('client.section.loading')
    </div>
    <div class="col-md-12">
        <button class="btn btn-primary d-block m-auto border-0" onclick="loadMore(this)">Load more</button>
    </div>
</div>
{{-- <div class="row">
<div class="col-md-12">
<ul class="pagination lms-page">
<li class="page-item prev">
<a class="page-link" href="javascript:void(0)" tabindex="-1"><i class="fas fa-angle-left"></i></a>
</li>
<li class="page-item first-page active">
<a class="page-link" href="javascript:void(0)">1</a>
</li>
<li class="page-item">
<a class="page-link" href="javascript:void(0)">2</a>
</li>
<li class="page-item">
<a class="page-link" href="javascript:void(0)">3</a>
</li>
<li class="page-item">
<a class="page-link" href="javascript:void(0)">4</a>
</li>
<li class="page-item">
<a class="page-link" href="javascript:void(0)">5</a>
</li>
<li class="page-item next">
<a class="page-link" href="javascript:void(0)"><i class="fas fa-angle-right"></i></a>
</li>
</ul>
</div>
</div> --}}

</div>
<div class="col-lg-3 theiaStickySidebar">
<div class="filter-clear">
<div class="clear-filter d-flex align-items-center">
<h4><i class="feather-filter"></i>Filters</h4>
<div class="clear-text">
<p>CLEAR</p>
</div>
</div>

<div class="card search-filter categories-filter-blk">
<div class="card-body">
<div class="filter-widget mb-0">
<div class="categories-head d-flex align-items-center">
<h4>Course categories</h4>
<i class="fas fa-angle-down"></i>
</div>
<div>
<label class="custom_check">
<input type="checkbox" name="select_specialist">
<span class="checkmark"></span> Backend (3)
</label>
</div>
<div>
<label class="custom_check">
<input type="checkbox" name="select_specialist">
<span class="checkmark"></span> CSS (2)
</label>
</div>
<div>
<label class="custom_check">
<input type="checkbox" name="select_specialist">
<span class="checkmark"></span> Frontend (2)
</label>
</div>
<div>
<label class="custom_check">
<input type="checkbox" name="select_specialist" checked>
<span class="checkmark"></span> General (2)
</label>
</div>
<div>
<label class="custom_check">
<input type="checkbox" name="select_specialist" checked>
<span class="checkmark"></span> IT & Software (2)
</label>
</div>
<div>
<label class="custom_check">
<input type="checkbox" name="select_specialist">
<span class="checkmark"></span> Photography (2)
</label>
</div>
<div>
<label class="custom_check">
<input type="checkbox" name="select_specialist">
<span class="checkmark"></span> Programming Language (3)
</label>
</div>
<div>
<label class="custom_check mb-0">
<input type="checkbox" name="select_specialist">
<span class="checkmark"></span> Technology (2)
</label>
</div>
</div>
</div>
</div>


<div class="card search-filter">
<div class="card-body">
<div class="filter-widget mb-0">
<div class="categories-head d-flex align-items-center">
<h4>Instructors</h4>
<i class="fas fa-angle-down"></i>
</div>
<div>
<label class="custom_check">
<input type="checkbox" name="select_specialist">
<span class="checkmark"></span> Keny White (10)
</label>
</div>
<div>
<label class="custom_check">
<input type="checkbox" name="select_specialist">
<span class="checkmark"></span> Hinata Hyuga (5)
</label>
</div>
<div>
<label class="custom_check">
<input type="checkbox" name="select_specialist">
<span class="checkmark"></span> John Doe (3)
</label>
</div>
<div>
<label class="custom_check mb-0">
<input type="checkbox" name="select_specialist" checked>
<span class="checkmark"></span> Nicole Brown
</label>
</div>
</div>
</div>
</div>


<div class="card search-filter ">
<div class="card-body">
<div class="filter-widget mb-0">
<div class="categories-head d-flex align-items-center">
<h4>Price</h4>
<i class="fas fa-angle-down"></i>
</div>
<div>
<label class="custom_check custom_one">
<input type="radio" name="select_specialist">
<span class="checkmark"></span> All (18)
</label>
</div>
<div>
<label class="custom_check custom_one">
<input type="radio" name="select_specialist">
<span class="checkmark"></span> Free (3)
</label>
</div>
<div>
<label class="custom_check custom_one mb-0">
<input type="radio" name="select_specialist" checked>
<span class="checkmark"></span> Paid (15)
</label>
</div>
</div>
</div>
</div>


<div class="card post-widget ">
<div class="card-body">
<div class="latest-head">
<h4 class="card-title">Latest Courses</h4>
</div>
<ul class="latest-posts">
<li>
<div class="post-thumb">
<a href="course-details.html">
<img class="img-fluid" src="assets/img/blog/blog-01.jpg" alt>
</a>
</div>
<div class="post-info free-color">
<h4>
<a href="course-details.html">Introduction LearnPress – LMS plugin</a>
</h4>
<p>FREE</p>
</div>
</li>
<li>
<div class="post-thumb">
<a href="course-details.html">
<img class="img-fluid" src="assets/img/blog/blog-02.jpg" alt>
</a>
</div>
<div class="post-info">
<h4>
<a href="course-details.html">Become a PHP Master and Make Money</a>
</h4>
<p>$200</p>
</div>
</li>
<li>
<div class="post-thumb">
<a href="#">
<img class="img-fluid" src="assets/img/blog/blog-03.jpg" alt>
</a>
</div>
<div class="post-info free-color">
<h4>
<a href="blog-details.html">Learning jQuery Mobile for Beginners</a>
</h4>
<p>FREE</p>
</div>
</li>
<li>
<div class="post-thumb">
<a href="course-details.html">
<img class="img-fluid" src="assets/img/blog/blog-01.jpg" alt>
</a>
</div>
<div class="post-info">
<h4>
<a href="course-details.html.html">Improve Your CSS Workflow with SASS</a>
</h4>
<p>$200</p>
</div>
</li>
<li>
<div class="post-thumb ">
<a href="course-details.html">
<img class="img-fluid" src="assets/img/blog/blog-02.jpg" alt>
</a>
</div>
<div class="post-info free-color">
<h4>
<a href="course-details.html">HTML5/CSS3 Essentials in 4-Hours</a>
</h4>
<p>FREE</p>
</div>
</li>
</ul>
</div>
</div>

</div>
</div>
</div>
</div>
</section>
<script>
var loading = document.querySelector('#loading');
    function loadMore(obj) {
        loading.style.display = 'block'
        obj.disabled = true
        setTimeout(() => {
            loading.style.display = 'none'
            obj.disabled = false
        }, 1000);
    }
</script>

@endsection