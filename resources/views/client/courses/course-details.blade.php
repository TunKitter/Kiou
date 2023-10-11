@extends('client.layouts.master')
@section('content')
<div class="inner-banner">
<div class="container">
<div class="row">
<div class="col-lg-8">
<div class="instructor-wrap border-bottom-0 m-0">
<div class="about-instructor align-items-center">
<div class="abt-instructor-img">
<a href="instructor-profile.html"><img src="{{asset('mentor/avatar/'. $course->mentor->image['avatar'])}}" alt="img" class="img-fluid"></a>
</div>
<div class="instructor-detail me-3">
<h5><a href="instructor-profile.html">{{$course->mentor->name}}</a></h5>
<p id="mentor_profession">{{$mentor_professions}}</p>
</div>
<div class="rating mb-0">
{{-- <i class="fas fa-star filled"></i> --}}
{{-- <i class="fas fa-star filled"></i> --}}
{{-- <i class="fas fa-star filled"></i> --}}
<i class="fas fa-star filled"></i>
{{-- <i class="fas fa-star"></i> --}}
<span class="d-inline-block average-rating"><span>{{$course->complete_course_rate}}</span></span>
</div>
</div>
<span class="web-badge mb-3">{{$category_profession}}</span>
</div>
<h2>{{$course->name}}</h2>
<p>{{$course->description}}</p>
<div class="course-info d-flex align-items-center border-bottom-0 m-0 p-0">
<div class="cou-info">
<img src="assets/img/icon/icon-01.svg" alt>
<p>{{ $course->meta['total_lesson']}} Lessons</p>
</div>
<div class="cou-info">
<img src="assets/img/icon/timer-icon.svg" alt>
<p>{{round($course->meta['total_time']/60)}}hr {{round($course->meta['total_time']%60)}}min</p>
</div>
<div class="cou-info">
<img src="assets/img/icon/people.svg" alt>
<p>{{ $course->total_enrollment}} students enrolled</p>
</div>
</div>
</div>
</div>
</div>
</div>


<section class="page-content course-sec">
<div class="container">
<div class="row">
<div class="col-lg-8">

<div class="card overview-sec">
<div class="card-body">
<h5 class="subs-title">Overview</h5>
<h6>Course Description</h6>
<p id="description"></p>
<h6>What you'll learn</h6>
<div class="row">
<div class="col-md-6">
<ul id="objective">
</ul>
</div>
</div>
<h6>Requirements</h6>
<ul class="mb-0" id="requirements">

</ul>
</div>
</div>


<div class="card content-sec">
<div class="card-body">
<div class="row">
<div class="col-sm-6">
<h5 class="subs-title">Course Content</h5>
</div>
<div class="col-sm-6 text-sm-end">
<h6>{{$course->meta['total_lesson']}} Lectures <span id="total_time">{{$course->meta['total_time']}}</span></h6>
</div>
</div>
@foreach ($chapter->infor as $key => $value )
   <div class="course-card">
    <h6 class="cou-title">
    <a class="collapsed" data-bs-toggle="collapse" href="#collapse_{{$key}}" aria-expanded="false">{{$value}}</a>
</h6>
    <div id="collapse_{{$key}}" class="card-collapse collapse" >
    <ul id="ul_{{$key}}">
        @isset($lessons[$key])
            
        @foreach ($lessons[$key] as $lesson)
    <li>
    <p><img src="assets/img/icon/play.svg" alt class="me-2">{{($lesson)}}</p>
    <div>
    {{-- <a href="javascript:;">Preview</a> --}}
    <span>02:53</span>
    </div>
    </li>
    @endforeach
    @else
    <li><p class="text-muted">There are no lessons</p></li>
    @endisset

    </ul>
    </div>
    </div> 
@endforeach
</div>
</div>


<div class="card instructor-sec">
<div class="card-body">
<h5 class="subs-title">About the instructor</h5>
<div class="instructor-wrap">
<div class="about-instructor">
<div class="abt-instructor-img">
<a href="instructor-profile.html"><img src="{{asset('mentor/avatar/'. $course->mentor->image['avatar'] )}}" alt="img" class="img-fluid"></a>
</div>
<div class="instructor-detail">
<h5><a href="instructor-profile.html">{{$course->mentor->name}}</a></h5>
<p>{{$mentor_professions}}</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star"></i>
<span class="d-inline-block average-rating">4.5 Instructor Rating</span>
</div>
</div>
<div class="course-info d-flex align-items-center">
<div class="cou-info">
<img src="assets/img/icon/play.svg" alt>
<p>5 Courses</p>
</div>
<div class="cou-info">
<img src="assets/img/icon/icon-01.svg" alt>
<p>12+ Lesson</p>
</div>
<div class="cou-info">
<img src="assets/img/icon/icon-02.svg" alt>
<p>9hr 30min</p>
</div>
<div class="cou-info">
<img src="assets/img/icon/people.svg" alt>
<p>270,866 students enrolled</p>
</div>
</div>
<p>UI/UX Designer, with 7+ Years Experience. Guarantee of High Quality Work.</p>
<p>Skills: Web Design, UI Design, UX/UI Design, Mobile Design, User Interface Design, Sketch, Photoshop, GUI, Html, Css, Grid Systems, Typography, Minimal, Template, English, Bootstrap, Responsive Web Design, Pixel Perfect, Graphic Design, Corporate, Creative, Flat, Luxury and much more.</p>
<p>Available for:</p>
<ul>
<li>1. Full Time Office Work</li>
<li>2. Remote Work</li>
<li>3. Freelance</li>
<li>4. Contract</li>
<li>5. Worldwide</li>
</ul>
</div>
</div>


<div class="card review-sec">
<div class="card-body">
<h5 class="subs-title">Reviews</h5>
<div class="instructor-wrap">
<div class="about-instructor">
<div class="abt-instructor-img">
<a href="instructor-profile.html"><img src="assets/img/user/user1.jpg" alt="img" class="img-fluid"></a>
</div>
<div class="instructor-detail">
<h5><a href="instructor-profile.html">Nicole Brown</a></h5>
<p>UX/UI Designer</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star"></i>
<span class="d-inline-block average-rating">4.5 Instructor Rating</span>
</div>
</div>
<p class="rev-info">“ This is the second Photoshop course I have completed with Cristian. Worth every penny and recommend it highly. To get the most out of this course, its best to to take the Beginner to Advanced course first. The sound and video quality is of a good standard. Thank you Cristian. “</p>
<a href="javascript:;" class="btn btn-reply"><i class="feather-corner-up-left"></i> Reply</a>
</div>
</div>


<div class="card comment-sec">
<div class="card-body">
<h5 class="subs-title">Post A comment</h5>
<form>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<input type="text" class="form-control" placeholder="Full Name">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<input type="email" class="form-control" placeholder="Email">
</div>
</div>
</div>
<div class="form-group">
<input type="email" class="form-control" placeholder="Subject">
</div>
<div class="form-group">
<textarea rows="4" class="form-control" placeholder="Your Comments"></textarea>
</div>
<div class="submit-section">
<button class="btn submit-btn" type="submit">Submit</button>
</div>
</form>
</div>
</div>

</div>
<div class="col-lg-4">
<div class="sidebar-sec">

<div class="video-sec vid-bg">
<div class="card">
<div class="card-body">
<a href="#" class="video-thumbnail" data-fancybox>
<div class="play-icon">
<i class="fa-solid fa-play" onclick="play_overview()"></i>
</div>
<img class src="{{asset('assets/img/video.jpg')}}"  id="video-overview">
</a>
<div class="video-details">
<div class="course-fee">
<h2>FREE</h2>
<p><span>$99.00</span> 50% off</p>
</div>
<div class="row gx-2">
<div class="col-md-6">
<a href="course-wishlist.html" class="btn btn-wish w-100"><i class="feather-heart"></i> Add to Wishlist</a>
</div>
<div class="col-md-6">
<a href="javascript:;" class="btn btn-wish w-100"><i class="feather-share-2"></i> Share</a>
</div>
</div>
<a href="checkout.html" class="btn btn-enroll w-100">Enroll Now</a>
</div>
</div>
</div>
</div>


{{-- <div class="card include-sec">
<div class="card-body">
<div class="cat-title">
<h4>Includes</h4>
</div>
<ul>
<li><img src="assets/img/icon/import.svg" class="me-2" alt> 11 hours on-demand video</li>
<li><img src="assets/img/icon/play.svg" class="me-2" alt> 69 downloadable resources</li>
<li><img src="assets/img/icon/key.svg" class="me-2" alt> Full lifetime access</li>
<li><img src="assets/img/icon/mobile.svg" class="me-2" alt> Access on mobile and TV</li>
<li><img src="assets/img/icon/cloud.svg" class="me-2" alt> Assignments</li>
<li><img src="assets/img/icon/teacher.svg" class="me-2" alt> Certificate of Completion</li>
</ul>
</div>
</div> --}}


<div class="card feature-sec">
<div class="card-body">
<div class="cat-title">
<h4>Includes</h4>
</div>
<ul>
<li><img src="assets/img/icon/users.svg" class="me-2" alt> Enrolled: <span>{{ $course->total_enrollment}} students</span></li>
<li><img src="assets/img/icon/timer.svg" class="me-2" alt> Duration: <span>{{ round($course->meta['total_time'] /60,2)}} hours</span></li>
<li><img src="assets/img/icon/chapter.svg" class="me-2" alt> Chapters: <span>{{$course->meta['total_chapter']}}</span></li>
<li><img src="assets/img/icon/video.svg" class="me-2" alt> Lessons:<span> {{$course->meta['total_lesson']}}</span></li>
<li><img src="assets/img/icon/chart.svg" class="me-2" alt> Level: <span>{{$course->level->name}}</span></li>
</ul>
</div>
</div>

</div>
</div>
</div>
</div>
</section>
<script>

[... document.querySelectorAll('#loading')].map(e => e.style.display = 'block')
var mentor_pro = (document.querySelector('#mentor_profession'));
var mentor_pro_string = mentor_pro.innerHTML
mentor_pro.innerHTML = mentor_pro_string.substring(0,mentor_pro_string.lastIndexOf(','));
function play_overview(){
    var video = document.getElementById('video-overview');
    video.outerHTML = '<video id="video" style="width:100%;max-height:200px" controls src="https://storage.googleapis.com/kiou_lesson/Download%20(1).mp4"></video>';
    document.getElementById('video').play();
document.getElementsByClassName('play-icon')[0].style.display = 'none';

}
fetch('{{asset("course/overview/".$course->content_path)}}').then(response => response.json()).then(data => {
    document.getElementById('description').innerHTML = data['description'];
    let objectives = ''
    data['objective'].map(item => objectives+= `<li>${item}</li>`)
    document.getElementById('objective').innerHTML = objectives;
    objectives = ''
    data['requirements'].map(item => objectives+= `<li>${item}</li>`)
    document.getElementById('requirements').innerHTML = objectives; 
})
var total_time = document.getElementById('total_time')

total_time.innerHTML = parseInt(total_time.innerHTML)/60 + ' hr'
</script>
@endsection