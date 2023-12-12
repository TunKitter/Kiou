@extends('client.layouts.master')
@section('content')
<div class="page-content">
    <div class="container">
        <div class="row">
            @include('client.mentor.sidebar')
            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card instructor-card">
                            <div class="card-header">
                                <h4 class="d-flex justify-content-between w-100">Your Courses</h4>
                            </div>
                            <div class="card-body">
                                @foreach ($myCourses as $course)
<div class="col-lg-12 col-md-12 d-flex">
<div class="course-box course-design list-course d-flex">
<div class="product">
<div class="product-img">
<a href="{{route('course-detail',$course->slug)}}">
<span class="d-none course-link">{{$course->_id}}</span>
<img class="img-fluid" alt src="{{ asset('course/thumbnail/'.$course->image)}}">
</a>
<div class="price">
<h3>{{ $course->price}} <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="head-course-title">
<h3 class="title">{{ $course->name}}</h3>
<div class="all-btn all-category d-flex align-items-center">
<a href="{{route('mentor-detail-my-courses',$course->slug)}}" class="btn btn-primary">Detail</a>
</div>
</div>
<div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="{{asset('assets/img/icon/icon-01.svg')}}" alt>
<p>{{ $course->meta['total_lesson']}} Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="{{asset('assets/img/icon/icon-02.svg')}}" alt>
<p>{{round(round($course->meta['total_time']/60)/60)}}hr {{(round($course->meta['total_time']/60)%60)}}min</p>
</div>
</div>
<div class="rating">
{{-- <i class="fas fa-star filled"></i> --}}
{{-- <i class="fas fa-star filled"></i> --}}
{{-- <i class="fas fa-star filled"></i> --}}
<i class="fas fa-star filled"></i>
{{-- <i class="fas fa-star"></i> --}}
<span class="d-inline-block average-rating"><span>{{$course->complete_course_rate}}</span> <span>( {{ $course->total_enrollment}} enrolled)</span></span>
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
</div>
</div>
</div>
</div>
</div>
</div>
@endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection