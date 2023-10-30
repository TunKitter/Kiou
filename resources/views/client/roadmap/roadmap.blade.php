@extends('client.layouts.master')
@section('content')
<style>
.tooltip-inner {
    background: #f66962  !important
}
.tooltip-arrow::before {
    border-top-color: #f66962 !important
}
    .mentor_load {
        border: none !important;

        background: transparent !important;
    }
    .card-collapse.collapse {
 background:  white !important;
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
<br><br>
<div class="col-lg-6">
<div class="show-filter add-course-info ">
<form onsubmit="return searchCourse()" id="searchInput">
<div class="row gx-2 align-items-center">
<div class="col-md-12 col-item">
<div class="search-group">
<i class="feather-search"></i>
<input type="text" class="form-control" placeholder="Search roadmap" name="q" value="{{isset($q) ? $q : ''}}" id="search" >
<input type="hidden"  name="is_wrong_spell" id="is_wrong_spell">
</div>
</div>
<div class="col-md-6 col-lg-6 col-item">
<div class="form-group select-form mb-0">
</div>
</div>
</div>
</form>
</div>
@isset($courses)
@isset($q)
@if($is_wrong_spell != '0')
<br>
<div class="col-lg-12 col-md-12 d-flex ">Is your mean: <span class="text-primary px-1">{{$is_wrong_spell}}</span> ?</div>
@endif
@endisset
@endisset
</div>

<div class="col-lg-3">
    <input type="submit" form="searchInput" class="btn btn-primary" value="Search"/>
</div>
</div>
</div>


<div class="row courses_parent">
@isset($is_not_found)
@if($is_not_found == true)
<div class="text-danger text-center">There is no data available</div>
<br><br><br>
<h4>Some others you may like</h4>
<br><br>
@endisset
@endif
@isset($roadmap)
@foreach ($roadmap as $item) 
<div class="col-lg-12 col-md-12 d-flex">
    <div class="mentor_load course-box course-design list-course d-flex" style="border:none !important">
<div class="product-img">
    <a href="#">
    <img class="img-fluid rounded-circle" style="width: 200px;height: 200px" alt src="{{asset('roadmap/'. $item->thumbnail)}}">
    </a>
    </div>
    <div class="product mentor_load">
    {{-- <div class="product-img">
    <a href="#">
    <img class="img-fluid rounded-circle" style="width: 200px;height: 200px" alt src="{{asset('roadmap/'. $item->thumbnail)}}">
    </a>
    </div> --}}
    <div class="product-content">
    <div class="head-course-title">
    <h3 class="title">{{$item->name}}</h3>
    <div class="all-btn all-category d-flex align-items-center">
    <a href="{{route('roadmap-detail', ['slug' => $item->slug])}}" class="btn btn-primary">See detail</a>
    </div>
    </div>
    <p class="text-muted">{{$item->description}}</p>
    <span class="text-primary">{{'@'.$item->mentor['username']}}</span>
    <div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
        <div class="rating-img d-flex align-items-center">
        <i class="fa-regular fa-heart"></i>
        <p>{{$item->interaction['like']}} Heart</p>
        </div>
        <div class="course-view d-flex align-items-center">
        <i class="fa-regular fa-heart" style="transform: scaleY(-1)"></i>
        <p>{{$item->interaction['dislike']}} Unheart</p>
        </div>
        </div>
    <div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
    <div class="rating-img d-flex align-items-center w-100"> 
        <div class="course-card w-100">
<h6 class="cou-title">
<a class="collapsed" data-bs-toggle="collapse" href="#course2_{{$loop->index}}" aria-expanded="false">Roadmap</a>
</h6>
<div id="course2_{{$loop->index}}" class="card-collapse collapse" style>
<ul>
    @foreach($item->content as $course)
@if($course['type'] == 'course' || $course['type'] == 'lesson')
<li>
    @php
        $temp_data_roadmap = $course['type']  == 'course' ? $course_name[$course['type_id']]['name'] : ($lesson_name[$course['type_id']]['name']. '<sup style="background:#f66962;color:white;border-radius:12px;padding: 5px;margin-left:-3.5em;line-height:1">Lesson</sup>') 
    @endphp
<p class="play-intro w-50 d-flex align-items-center justify-content-between flex-wrap" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$course['type_description']}}" > {!!$temp_data_roadmap!!}  <img src="https://picsum.photos/200" style="width:75px"></p>
{{-- <img src="{{asset('assets/img/icon/play-icon.svg')}}" alt> --}}
<div class="course-info border-bottom-0 pb-0 d-flex align-items-center ps-3 pe-2 flex-fill" @if($course['type'] == 'lesson')data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $lesson_name[$course['type_id']]['course_name']}}"  @endif>
    <div class="rating-img d-flex align-items-center">
    <img src="{{asset('assets/img/icon/icon-01.svg')}}" alt>
    <p>{{ ($course['type'] == 'course')?  $course_name[$course['type_id']]['total_lesson'] : $lesson_name[$course['type_id']]['total_lesson']}} Lesson</p>
    </div>
    <div class="course-view d-flex align-items-center">
    <img src="{{asset('assets/img/icon/icon-02.svg')}}" alt>
    <p>{{$a = (($course['type'] == 'course')?  round($course_name[$course['type_id']]['total_time']/60) : round($lesson_name[$course['type_id']]['total_time']/60))}}hr {{($course['type'] == 'course')?  $a%60 : round($lesson_name[$course['type_id']]['total_time']%60)}}min</p>
    </div>
    </div>
</li>
@else
<li>
    <div class="course-card w-100"> 
        <h6 class="cou-title">
            <a class="collapsed" style="background:white;border-radius:0;text-decoration: none  " data-bs-toggle="collapse" href="#course3_{{$loop->index}} " aria-expanded="false">{{$multiple['description']}}</a>
        </h6>
        <div id="course3_{{$loop->index}}" class="card-collapse collapse" style>
<ul style="border: 1px solid #f06760">
@foreach ($multiple['multiple'] as $mul)
@if($mul['type'] == 'course')
<li>
<p class="play-intro w-50 d-flex align-items-center justify-content-between flex-wrap" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$mul['description']}}" >{{$course_name[$mul['type_id']]['name']}}  <img src="https://picsum.photos/200" style="width:75px"></p>
{{-- <img src="{{asset('assets/img/icon/play-icon.svg')}}" alt> --}}
<div class="course-info border-bottom-0 pb-0 d-flex align-items-center ps-3 pe-2 flex-fill" >
    <div class="rating-img d-flex align-items-center">
    <img src="{{asset('assets/img/icon/icon-01.svg')}}" alt>
    <p>{{$course_name[$mul['type_id']]['total_lesson']}} Lesson</p>
    </div>
    <div class="course-view d-flex align-items-center">
    <img src="{{asset('assets/img/icon/icon-02.svg')}}" alt>
    <p>{{round($course_name[$mul['type_id']]['total_time']/60)}}hr {{$course_name[$mul['type_id']]['total_time']%60}}min</p>
    </div>
    </div>
</li>
@elseif($mul['type'] == 'lesson')
<li>
    @php
        $temp_data_roadmap =  ($lesson_name[$mul['type_id']]['name']. '<sup style="background:#f66962;color:white;border-radius:12px;padding: 5px;margin-left:-3.5em;line-height:1">Lesson</sup>') 
    @endphp
<p class="play-intro w-50 d-flex align-items-center justify-content-between flex-wrap" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$mul['description']}}" > {!!$temp_data_roadmap!!}  <img src="https://picsum.photos/200" style="width:75px"></p>
{{-- <img src="{{asset('assets/img/icon/play-icon.svg')}}" alt> --}}
<div class="course-info border-bottom-0 pb-0 d-flex align-items-center ps-3 pe-2 flex-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $lesson_name[$mul['type_id']]['course_name']}}" >
    <div class="rating-img d-flex align-items-center">
    <img src="{{asset('assets/img/icon/icon-01.svg')}}" alt>
    <p>{{  $lesson_name[$mul['type_id']]['total_lesson']}} Lesson</p>
    </div>
    <div class="course-view d-flex align-items-center">
    <img src="{{asset('assets/img/icon/icon-02.svg')}}" alt>
    <p>{{ round($lesson_name[$mul['type_id']]['total_time']/60)}}hr {{round($lesson_name[$mul['type_id']]['total_time']%60)}}min</p>
    </div>
    </div>
</li>
@endif
@endforeach
</ul>
</div>
</div>
</li>
@endif
@endforeach
{{-- <li>
<p>Building Our Scenario</p>
<div>
<img src="assets/img/icon/lock.svg" alt>
</div>
</li> --}}
</ul>
</div>
</div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
@endforeach
@endisset
</div>
<div class="row">
    <div class="col-md-12 d-flex justify-content-center mb-4">
        @include('client.section.loading')
    </div>
    <div class="col-md-12">
        <button class="btn btn-primary d-block m-auto border-0" onclick="loadMore(this)">Load more</button>
    </div>
</div>
</div>
<div class="col-lg-3 theiaStickySidebar">
<div class="filter-clear">
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
var courses = document.querySelector('.courses_parent')
let is_no_more = false
let skip = 10, take = 10;
@isset($mentor)
function loadMore(obj) {
        loading.style.display = 'block'
        obj.disabled = true
        let formData = new FormData();
        @isset($q)
        formData.append('q', "{{$q}}")
        @endisset
fetch(`{{route("course-list")}}/${skip}/${take}/mentor`,{
    method: "POST",
    body: formData
}).then(response => response.json()).then(data => {
console.log(data);
if(data.length == 0){
    if(!is_no_more){
     courses.innerHTML += `<div class="col-lg-12 col-md-12 d-flex text-muted">There is no mentor</div>`
    is_no_more = true       
    }

}
else {

            data.forEach(element => {
                courses.innerHTML += `<div class="col-lg-12 col-md-12 d-flex">
    <div class="mentor_load course-box course-design list-course d-flex" style="border:none !important">
    <div class="product mentor_load">
    <div class="product-img">
    <a href="#">
    <img class="img-fluid rounded-circle" style="width: 200px;height: 200px" alt src="{{asset('mentor/avatar/')}}/${element.image['avatar']}">
    </a>
    </div>
    <div class="product-content">
    <div class="head-course-title">
    <h3 class="title">${element.name}</h3>
    <div class="all-btn all-category d-flex align-items-center">
    <a href="checkout.html" class="btn btn-primary">See more</a>
    </div>
    </div>
    <p class="text-muted">@${element.username}</p>
    <div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
    <div class="rating-img d-flex align-items-center">
    <img src="assets/img/icon/icon-01.svg" alt>
    <p>${element['total_enrollment']} students</p>
    </div>
    <div class="course-view d-flex align-items-center">
    <img src="assets/img/icon/icon-02.svg" alt>
    <p>${element['total_course']} courses</p>
    </div>
    </div>
    <div class="course-group d-flex mb-0">
    <div class="course-group-img d-flex">
    <a href="instructor-profile.html"><img src="assets/img/user/user2.jpg" alt class="img-fluid"></a>
    <div class="course-name">
    </div>
    </div>
    <div class="course-share d-flex align-items-center justify-content-center">
    </div>
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
@endisset
const API_KEY = 'AIzaSyBFUaOX3h_CxqI6Q6DtaMwNBj4Le3TV-NQ'
const search_input = document.querySelector('#search')
const is_wrong_spell = document.querySelector('#is_wrong_spell')
const training_senteces = `
input: Pithon and Vietnemae
output: Python and Vietnamese
input: Englisdhsh
output: English
input: dasdasdasdas
output: 0
input: 423423
output: 0
input: EnglishAndLaravel
output: English And Laravel
input: Menago DB
output: Mongo DB
input: Javascript,Laravel
output: Javascript,Laravel
input: javascript,laravel,MongodBb
output: Javascript, Laravel, Mongo DB 
input:`
const is_mentor_or_course = 
`input: laravel
output: course
input: mongodb
output: course
input: javascript
output: course
input: Tunkit
output: mentor
input: Tuấn Kiệt
output: mentor
input: frontend
output: course
input: react
output: course
input: angular
output: course
input: John
output: mentor
input: golang
output: course
input: mobile-app
output: course
input: lenathon
output: mentor
input: dasd1231asda
output: mentor
input: tunkit123
output: mentor
input: sfda34
output: mentor
input:`
function searchCourse() {
    let keyword =document.querySelector('select[name=type]')
    if(keyword.value == 'auto'){ 
        fetch(`https://generativelanguage.googleapis.com/v1beta3/models/text-bison-001:generateText`,{
        method: 'POST',
        headers:{
            'Content-Type': 'application/json',
            'x-goog-api-key': API_KEY
        },
        body: JSON.stringify({
            prompt: { text: `${is_mentor_or_course} ${search_input.value} \n output:` },
        })
    }).then(res => (res.json())).then(data => {
        document.querySelector(`option[value=${data['candidates'][0]['output']}]`).selected = true
    // (data['candidates'][0]['output']);
    })
    }
    fetch(`https://generativelanguage.googleapis.com/v1beta3/models/text-bison-001:generateText`,{
        method: 'POST',
        headers:{
            'Content-Type': 'application/json',
            'x-goog-api-key': API_KEY
        },
        body: JSON.stringify({
            prompt: { text: `${training_senteces} ${search_input.value} \n output:` },
        })
    }).then(res => (res.json())).then(data => {
        if((data['candidates'][0]['output']).toLowerCase().includes((search_input.value).toLowerCase())){
            is_wrong_spell.value = '0'
        }
        else {
            is_wrong_spell.value = data['candidates'][0]['output']
    }
    document.forms.namedItem("searchInput").submit()
    })
 
}
</script>

@endsection