@extends('client.layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
<style>
 .add-to-card {
    border-color:#fc7f50 !important;
}   
.add-to-card:hover {
    background:#fc7f50 !important;
}
body {
    overflow-x: hidden !important;
}
</style>
@if ($message = Session::get('success'))
@include('client.section.message', ['message' => $message,'type'=>'success'])
@endif
@if ($message = Session::get('cart_already'))
@include('client.section.message', ['message' => $message,'type'=>'fail'])
@endif

<section class="course-content">
<div class="container">
<div class="row">
<div class="col-lg-12">

<div class="showing-list">
<div class="row">
<div class="col-lg-6">
<div class="d-flex align-items-center">
<div class="show-result">
@isset($id)
   <h1><span style="color: #f66962">{{ $id }} </span> Courses</h1>
   @else
   <h3>Explore Courses</h3>
@endisset
</div>
</div>
</div>
{{-- <div class="col-lg-6">
<div class="show-filter add-course-info">
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
<select class="form-select select" id="sel1" name="sellist1">
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
</div> --}}
</div>
</div>
<hr>
   <h3>Common Courses</h3>
   <div class="row courses_parent">
@foreach ($courses as $course) 
<div class="col-lg-4 col-md-6 d-flex">
<div class="course-box course-design d-flex ">
<div class="product">
<div class="product-img">
<a href="course-details.html">
<img class="img-fluid" alt src="{{$course->image}}">
</a>
<div class="price">
<h3 class="free-color">FREE</h3>
</div>
</div>
<div class="product-content">
<div class="course-group d-flex">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="{{asset('assets/img/user/user6.jpg')}}" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">{{$course->mentor->name}}</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
<a href="#rate"><i class="fa-regular fa-heart"></i></a>
</div>
</div>
<h3 class="title"><a href="course-details.html">{{$course->name}}</a></h3>
<div class="course-info d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="{{asset('assets/img/icon/icon-01.svg')}}" alt>
<p>{{$course->meta['total_lesson']}} Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="{{asset('assets/img/icon/icon-02.svg')}}" alt>
<p>{{round($course->meta['total_time']/60)}}hr {{$course->meta['total_time']%60}}min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
{{-- <i class="fas fa-star filled"></i> --}}
{{-- <i class="fas fa-star filled"></i> --}}
{{-- <i class="fas fa-star filled"></i> --}}
{{-- <i class="fas fa-star"></i> --}}
<span class="d-inline-block average-rating"><span>{{$course->complete_course_rate}}</span></span>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="checkout.html" class="btn btn-primary me-2">BUY NOW</a>
<form action="{{route('add-to-cart')}}" method="POST">
        @csrf
        <input type="hidden" value="{{ $course->_id }}" name="course_id">
        <input type="hidden" value="{{ $course->price }}" name="price">
        <button type="submit" class="btn btn-primary add-to-card">Add to cart</button>
    </form>
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
   <div class="col-md-12 mb-4">
       <button class="btn btn-primary d-block m-auto border-0" onclick="loadMore(this)">Load more</button>
   </div>
</div>
</div>
{{-- <div class="col-lg-3 theiaStickySidebar">
<div class="filter-clear">
<div class="clear-filter d-flex align-items-center">
<h4><i class="feather-filter"></i>Filters</h4>
<div class="clear-text">
<p>CLEAR</p>
</div>
</div>

<div class="card search-filter">
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
<a href="course-details.html">
<img class="img-fluid" src="assets/img/blog/blog-03.jpg" alt>
</a>
</div>
<div class="post-info free-color">
<h4>
<a href="course-details.html">Learning jQuery Mobile for Beginners</a>
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
<a href="course-details.html">Improve Your CSS Workflow with SASS</a>
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
</div> --}}
<section class="home-slide d-flex align-items-center">
            <div class="container">
                <div class="row ">
                    <div class="col-md-7">
                        <div class="home-slide-face aos" data-aos="fade-up">
                            <div class="home-slide-text ">
                                <h5>The Leader in Online Learning</h5>
                                <h1>Engaging & Accessible Online Courses For All</h1>
                                <p>Own your future learning new skills online</p>
                            </div>
                            <div class="banner-content">
                                <form class="form" action="course-list.html">
                                    <div class="form-inner">
                                        <div class="input-group">
                                            <i class="fa-solid fa-magnifying-glass search-icon"></i>
                                            <input type="email" class="form-control"
                                                placeholder="Search School, Online eductional centers, etc">
                                            <span class="drop-detail">
                                                <select class="form-select select">
                                                    <option>Category</option>
                                                    <option>Angular</option>
                                                    <option>Node Js</option>
                                                    <option>React</option>
                                                    <option>Python</option>
                                                </select>
                                            </span>
                                            <button class="btn btn-primary sub-btn" type="submit"><i
                                                    class="fas fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="trust-user">
                                <p>Trusted by over 15K Users <br>worldwide since 2022</p>
                                <div class="trust-rating d-flex align-items-center">
                                    <div class="rate-head">
                                        <h2><span>1000</span>+</h2>
                                    </div>
                                    <div class="rating d-flex align-items-center">
                                        <h2 class="d-inline-block average-rating">4.4</h2>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-flex align-items-center">
                        <div class="girl-slide-img aos" data-aos="fade-up">
                            <img src="{{asset('assets/img/object.png')}}" alt>
                        </div>
                    </div>
                </div>
            </div>
        </section>



<br><br>
<hr>
<br><br>
   <h3>Buy most Courses</h3>
   <div class="row courses_buy_most_parent">
@foreach ($courses_buy_most as $course) 
<div class="col-lg-12 col-md-12 d-flex">
   <div class="course-box course-design list-course d-flex">
   <div class="product">
   <div class="product-img">
   <a href="{{route('course-detail',$course->slug)}}">
   <span class="d-none course-link">{{$course->_id}}</span>
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
   <div class="all-cart align-items-center mx-2">
       <form action="{{route('add-to-cart')}}" method="POST">
           @csrf
           <input type="hidden" value="{{ $course->_id }}" name="course_id">
           <input type="hidden" value="{{ $course->price }}" name="price">
         
           <button type="submit" class="btn btn-primary">Add to cart</button>
       </form>
   </div>
   </div>
   <div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
   <div class="rating-img d-flex align-items-center">
   <img src="{{asset('assets/img/icon/icon-01.svg')}}" alt>
   <p>{{ $course->meta['total_lesson']}} Lesson</p>
   </div>
   <div class="course-view d-flex align-items-center">
   <img src="{{asset('assets/img/icon/icon-02.svg')}}" alt>
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
   <a href="instructor-profile.html"><img src="{{asset('assets/img/user/user2.jpg')}}" alt class="img-fluid"></a>
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
       <button class="btn btn-primary d-block m-auto border-0" onclick="loadMore(this,1)">Load more</button>
   </div>
</div>
</div>

<br><br>
<h3>Some others categories you might like</h3>
<br>
@foreach ($professions_others as $profession )
<button class="btn btn-dark me-2 mb-2 d-inline-block  border-0" onclick="location.href='{{route('course-explore',$profession['slug'])}}'">{{$profession['name']}}</button>
@endforeach
<br><br><br><br><br>
<h3>Most Cost-Effective Courses</h3>
<br>
<div class="courses_cost_most_parent">
@foreach ($courses_cost_most as $course) 
<div class="col-lg-12 col-md-12 d-flex">
   <div class="course-box course-design list-course d-flex">
   <div class="product">
   <div class="product-img">
   <a href="{{route('course-detail',$course->slug)}}">
   <span class="d-none course-link">{{$course->_id}}</span>
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
   <div class="all-cart align-items-center mx-2">
       <form action="{{route('add-to-cart')}}" method="POST">
           @csrf
           <input type="hidden" value="{{ $course->_id }}" name="course_id">
           <input type="hidden" value="{{ $course->price }}" name="price">
         
           <button type="submit" class="btn btn-primary">Add to cart</button>
       </form>
   </div>
   </div>
   <div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
   <div class="rating-img d-flex align-items-center">
   <img src="{{asset('assets/img/icon/icon-01.svg')}}" alt>
   <p>{{ $course->meta['total_lesson']}} Lesson</p>
   </div>
   <div class="course-view d-flex align-items-center">
   <img src="{{asset('assets/img/icon/icon-02.svg')}}" alt>
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
   <a href="instructor-profile.html"><img src="{{asset('assets/img/user/user2.jpg')}}" alt class="img-fluid"></a>
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
        <button class="btn btn-primary d-block m-auto border-0" onclick="loadMore(this,2)">Load more</button>
    </div>
 </div>
</div>
<br><br>
<div class="row courses_parent">
    <div class="feature-instructors">
        <div class="section-header aos" data-aos="fade-up">
            <div class="section-sub-head feature-head text-center">
                <h2>Top Instructors</h2>
                <div class="section-text aos" data-aos="fade-up">
                    <p class="mb-0">Top instructos you might reference about {{$id}} courses</p>
                </div>
            </div>
        </div>
        <div class="owl-carousel instructors-course owl-theme aos" data-aos="fade-up">
                        @php
                            $mentors = [];
                        @endphp
                        @foreach ($courses as $course) 
                        @php
                        if(in_array($course->mentor->_id, $mentors)) {
                            continue;
                        }
                            $mentors[] = $course->mentor->_id;
                        @endphp
                        <div class="instructors-widget">
                            <div class="instructors-img ">
                                <a href="instructor-list.html">
                                    <img class="img-fluid" alt src="{{asset('assets/img/user/'.$course->mentor->image['avatar'])}}">
                                </a>
                            </div>
                            <div class="instructors-content text-center">
                                <h5><a href="instructor-profile.html">{{$course->mentor->name}}</a></h5>
                                <p>{{$id}} Developer</p>
                                <div class="student-count d-flex justify-content-center">
                                    <i class="fa-solid fa-user-group"></i>
                                    <span>{{$course->mentor->course->sum('total_enrollment')}} Students   <span></span></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
</div>
</div>
</div>
</section>
<script>
   var loading = document.querySelector('#loading');
   var courses = document.querySelector('.courses_parent')
   var courses_cost_most = document.querySelector('.courses_cost_most_parent')
   let is_no_more = false
   let skip = 10, take = 10;
   let skip_buymost = 10, take_buymost =10;
   let skip_costmost = 10, take_costmost =10;
   function loadMore(obj,index = 0) {
       if(index ==1)  {
        document.querySelectorAll('#loading')[1].style.display = 'block'
        loadMoreBuyMost(obj)
        return;
       }
       else if(index ==2) {
        document.querySelectorAll('#loading')[2].style.display = 'block'
        loadMoreCostMost(obj)
        return;
       }
           loading.style.display = 'block'
           obj.disabled = true
           let formData = new FormData();
           formData.append('q', "{{$id}}")
   fetch(`{{route("course-list")}}/${skip}/${take}`,{
       method: "POST",
       body: formData
   }).then(response => response.json()).then(data => {
   console.log(data);
   if(data.length == 0){
       if(!is_no_more){
        courses.innerHTML += `<div class="col-lg-12 col-md-12 d-flex text-muted">There is no course</div>`
       is_no_more = true       
       }
   
   }
   else {
   
               data.forEach(element => {
                   courses.innerHTML += `<div class="col-lg-4 col-md-6 d-flex">
<div class="course-box course-design d-flex ">
<div class="product">
<div class="product-img">
<a href="course-details.html">
<img class="img-fluid" alt src="${element.image}">
</a>
<div class="price">
<h3 class="free-color">FREE</h3>
</div>
</div>
<div class="product-content">
<div class="course-group d-flex">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="{{asset('assets/img/user/user6.jpg')}}" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">${element.mentor_name}</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
<a href="#rate"><i class="fa-regular fa-heart"></i></a>
</div>
</div>
<h3 class="title"><a href="course-details.html">${element.name}</a></h3>
<div class="course-info d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="{{asset('assets/img/icon/icon-01.svg')}}" alt>
<p>${element.meta["total_lesson"]} Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="{{asset('assets/img/icon/icon-02.svg')}}" alt>
<p>${(element.meta['total_time']/60).toFixed(1)}hr ${element.meta['total_time']%60}min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
{{-- <i class="fas fa-star filled"></i> --}}
{{-- <i class="fas fa-star filled"></i> --}}
{{-- <i class="fas fa-star filled"></i> --}}
{{-- <i class="fas fa-star"></i> --}}
<span class="d-inline-block average-rating"><span>${element.complete_course_rate}</span></span>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="checkout.html" class="btn btn-primary me-2">BUY NOW</a>
<form action="{{route('add-to-cart')}}" method="POST">
        @csrf
        <input type="hidden" value="${element._id}" name="course_id">
        <input type="hidden" value="${element.price}" name="price">
        <button type="submit" class="btn btn-primary add-to-card">Add to cart</button>
    </form>
</div>
</div>
</div>
</div>
</div>`
               skip += 10
               });
           }
               loading.style.display = 'none'
               obj.disabled = false
   })
   
       }
   var courses_buy_most = document.querySelector('.courses_buy_most_parent')
   var courses_buy_most_is_not = false
    function loadMoreBuyMost(obj) {
        obj.disabled = true
        let formData = new FormData()
        formData.append('category','{{$profession_id}}')
        fetch(`{{route("course-list")}}/${skip_buymost}/${take_buymost}/buymost`,{
            method: "POST",
            body: formData
        }).then(response => response.json()).then(data => {
        if(data.length == 0 && !courses_buy_most_is_not) { courses_buy_most.innerHTML+= `There is no course available`;courses_buy_most_is_not = true }
            data.forEach(element => {
    courses_buy_most.innerHTML+= `
    <div class="col-lg-12 col-md-12 d-flex">
   <div class="course-box course-design list-course d-flex">
   <div class="product">
   <div class="product-img">
   <a href="{{route('course-list')}}/${element.slug}">
   <span class="d-none course-link">${element._id}</span>
   <img class="img-fluid" alt src="https://picsum.photos/200">
   </a>
   <div class="price">
   <h3>${element.price} <span></span></h3>
   </div>
   </div>
   <div class="product-content">
   <div class="head-course-title">
   <h3 class="title">${element.name}</h3>
   <div class="all-btn all-category d-flex align-items-center">
   <a href="checkout.html" class="btn btn-primary">BUY NOW</a>
   </div>
   <div class="all-cart align-items-center mx-2">
       <form action="{{route('add-to-cart')}}" method="POST">
           @csrf
           <input type="hidden" value="${element._id}" name="course_id">
           <input type="hidden" value="${element.price}" name="price">
         
           <button type="submit" class="btn btn-primary">Add to cart</button>
       </form>
   </div>
   </div>
   <div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
   <div class="rating-img d-flex align-items-center">
   <img src="{{asset('assets/img/icon/icon-01.svg')}}" alt>
   <p>${element.meta['total_lesson']} Lesson</p>
   </div>
   <div class="course-view d-flex align-items-center">
   <img src="{{asset('assets/img/icon/icon-02.svg')}}" alt>
   <p>${(element.meta['total_time']).toFixed(0)}hr ${element.meta['total_time']%60}min</p>
   </div>
   </div>
   <div class="rating">
   {{-- <i class="fas fa-star filled"></i> --}}
   {{-- <i class="fas fa-star filled"></i> --}}
   {{-- <i class="fas fa-star filled"></i> --}}
   <i class="fas fa-star filled"></i>
   {{-- <i class="fas fa-star"></i> --}}
   <span class="d-inline-block average-rating"><span>${element.complete_course_rate}</span></span>
   </div>
   <div class="course-group d-flex mb-0">
   <div class="course-group-img d-flex">
   <a href="instructor-profile.html"><img src="{{asset('assets/img/user/user2.jpg')}}" alt class="img-fluid"></a>
   <div class="course-name">
   <h4><a href="instructor-profile.html">${element.mentor_name}</a></h4>
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
   </div>`             })
   obj.disabled = false
            document.querySelectorAll('#loading')[1].style.display = 'none'
            skip_buymost+= 10
    })
    }
    var courses_cost_most_is_not = false
   function loadMoreCostMost(obj) {
       obj.disabled = true
       let formData = new FormData()
       formData.append('category','{{$profession_id}}')
       fetch(`{{route("course-list")}}/${skip_costmost}/${take_costmost}/costmost`,{
           method: "POST",
           body: formData
       }).then(response => response.json()).then(data => {
       if(data.length == 0 && !courses_cost_most_is_not) { courses_cost_most.innerHTML+= `There is no course available`;courses_cost_most_is_not = true }
       else {

           data.forEach(element => {
       courses_cost_most.innerHTML+= `
       <div class="col-lg-12 col-md-12 d-flex">
   <div class="course-box course-design list-course d-flex">
   <div class="product">
   <div class="product-img">
   <a href="{{route('course-list')}}/${element.slug}">
   <span class="d-none course-link">${element._id}</span>
   <img class="img-fluid" alt src="https://picsum.photos/200">
   </a>
   <div class="price">
   <h3>${element.price} <span></span></h3>
   </div>
   </div>
   <div class="product-content">
   <div class="head-course-title">
   <h3 class="title">${element.name}</h3>
   <div class="all-btn all-category d-flex align-items-center">
   <a href="checkout.html" class="btn btn-primary">BUY NOW</a>
   </div>
   <div class="all-cart align-items-center mx-2">
       <form action="{{route('add-to-cart')}}" method="POST">
           @csrf
           <input type="hidden" value="${element._id}" name="course_id">
           <input type="hidden" value="${element.price}" name="price">
         
           <button type="submit" class="btn btn-primary">Add to cart</button>
       </form>
   </div>
   </div>
   <div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
   <div class="rating-img d-flex align-items-center">
   <img src="{{asset('assets/img/icon/icon-01.svg')}}" alt>
   <p>${element.meta['total_lesson']} Lesson</p>
   </div>
   <div class="course-view d-flex align-items-center">
   <img src="{{asset('assets/img/icon/icon-02.svg')}}" alt>
   <p>${(element.meta['total_time']).toFixed(0)}hr ${element.meta['total_time']%60}min</p>
   </div>
   </div>
   <div class="rating">
   {{-- <i class="fas fa-star filled"></i> --}}
   {{-- <i class="fas fa-star filled"></i> --}}
   {{-- <i class="fas fa-star filled"></i> --}}
   <i class="fas fa-star filled"></i>
   {{-- <i class="fas fa-star"></i> --}}
   <span class="d-inline-block average-rating"><span>${element.complete_course_rate}</span></span>
   </div>
   <div class="course-group d-flex mb-0">
   <div class="course-group-img d-flex">
   <a href="instructor-profile.html"><img src="{{asset('assets/img/user/user2.jpg')}}" alt class="img-fluid"></a>
   <div class="course-name">
   <h4><a href="instructor-profile.html">${element.mentor_name}</a></h4>
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
   </div>`   
   
})
    }
obj.disabled = false
skip_costmost+= 10
document.querySelectorAll('#loading')[2].style.display = 'none'
       })

   }
       </script>



   <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>



@endsection