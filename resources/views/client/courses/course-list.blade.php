@extends('client.layouts.master')
@section('content')
<style>
    .mentor_load {
        border: none !important;

        background: transparent !important;
    }
</style>
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
<a href="#" class="text-primary">How to search better?</a>
<br><br>
<div class="col-lg-6">
<div class="show-filter add-course-info ">
<form onsubmit="return searchCourse()" id="searchInput">
<div class="row gx-2 align-items-center">
<div class="col-md-6 col-item">
<div class=" search-group">
<i class="feather-search"></i>
<input type="text" class="form-control" placeholder="Search our courses" name="q" value="{{isset($q) ? $q : ''}}" id="search" >
<input type="hidden"  name="is_wrong_spell" id="is_wrong_spell">
</div>
</div>
<div class="col-md-6 col-lg-6 col-item">
<div class="form-group select-form mb-0">
<select class="form-select select" name="type">
<option value="auto">Auto</option>
<option value="course">Course</option>
<option value="mentor">Mentor</option>
</select>
<script>
    document.querySelector('option[value={{$type}}]').selected = true
</script>
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

@isset($courses)
@foreach ($courses as $course)
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
@endisset
@isset($mentors)
@foreach ($mentors as $mentor ) 
<div class="col-lg-12 col-md-12 d-flex">
    <div class="mentor_load course-box course-design list-course d-flex" style="border:none !important">
    <div class="product mentor_load">
    <div class="product-img">
    <a href="#">
    <img class="img-fluid rounded-circle" style="width: 200px;height: 200px" alt src="{{asset('mentor/avatar/'. $mentor->image['avatar'])}}">
    </a>
    </div>
    <div class="product-content">
    <div class="head-course-title">
    <h3 class="title">{{$mentor->name}}</h3>
    <div class="all-btn all-category d-flex align-items-center">
    <a href="checkout.html" class="btn btn-primary">See more</a>
    </div>
    </div>
    <p class="text-muted">{{'@'.$mentor->username}}</p>
    <div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
    <div class="rating-img d-flex align-items-center">
    <img src="assets/img/icon/icon-01.svg" alt>
    <p>{{$mentor->course->sum('total_enrollment')}} students</p>
    </div>
    <div class="course-view d-flex align-items-center">
    <img src="assets/img/icon/icon-02.svg" alt>
    <p>{{$mentor->course->count()}} courses</p>
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
<h4>Soft by</h4>
</div>
<div>
<label class="custom_check custom_one">
<input type="radio" name="soft_by">
<span class="checkmark"></span> Most Common
</label>
</div>
<div>
<label class="custom_check custom_one">
<input type="radio" name="soft_by">
<span class="checkmark"></span> Buy Most
</label>
</div>
<div>
<label class="custom_check custom_one">
<input type="radio" name="soft_by">
<span class="checkmark"></span> High Rating Most
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
{{-- <i class="fas fa-angle-down"></i> --}}
</div>
<div>
<label class="custom_check custom_one">
<input type="radio" name="select_specialist">
<span class="checkmark"></span> Free
</label>
</div>
<div>
<label class="custom_check custom_one">
<input type="radio" name="select_specialist">
<span class="checkmark"></span> 900$
</label>
</div>
<div>
<label class="custom_check custom_one mb-0">
<input type="radio" name="select_specialist" checked>
<span class="checkmark"></span> Most expensive
</label>
</div>
</div>
</div>
</div>

<div class="card search-filter">
<div class="card-body">
<div class="filter-widget mb-0">
<div class="categories-head d-flex align-items-center">
<h4>Levels</h4>
<i class="fas fa-angle-down"></i>
</div>
@inject('levels','App\Models\Level' )
@foreach($levels::all() as $level)
<div>
<label class="custom_check custom_one">
<input type="radio" name="level"  >
<span class="checkmark"></span> {{$level->name}}
</label>
</div>
@endforeach
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
@isset($courses)
    function loadMore(obj) {
        loading.style.display = 'block'
        obj.disabled = true;
        let formData = new FormData();
    @isset($q)
        formData.append('q', "{{$is_wrong_spell == '0' ? $q : $is_wrong_spell}}")
    @endisset;
fetch(`{{route("course-list")}}/${skip}/${take}`,{
    method: "POST",
    body: formData
}).then(response => response.json()).then(data => {
console.log(data);
if(data.length == 0){
    if(!is_no_more){
     courses.innerHTML += `<div class="col-lg-12 col-md-12 d-flex text-muted">There is no data</div>`
    is_no_more = true       
    }

}
else {
            data.forEach(element => {
                courses.innerHTML += `<div class="col-lg-12 col-md-12 d-flex">
<div class="course-box course-design list-course d-flex">
<div class="product">
<div class="product-img">
<a href="list/${element._id}">
<img class="img-fluid" alt src="${element.image}">
</a>
<div class="price">
<h3>${element.price} <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="head-course-title">
<h3 class="title">${element.name}</h3>
<div class="all-btn all-category d-flex align-items-center">
<a href="checkout.html" class="btn btn-primary">BUY NOW</a>
</div>
</div>
<div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="assets/img/icon/icon-01.svg" alt>
<p>${element.meta['total_lesson']} Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="assets/img/icon/icon-02.svg" alt>
<p>${(element.meta['total_time']/60).toFixed(1)}hr ${element.meta['total_time']%60}min</p>
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
<a href="instructor-profile.html"><img src="assets/img/user/user2.jpg" alt class="img-fluid"></a>
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
<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js" integrity="sha256-/H4YS+7aYb9kJ5OKhFYPUjSJdrtV6AeyJOtTkw6X72o=" crossorigin="anonymous"></script>
<script>
    
    var ids = (Cookies.get('tracker_man') ? (CryptoJS.AES.decrypt(Cookies.get('tracker_man'), "Tunkit").toString(CryptoJS.enc.Utf8)) : ((Date.now()+86400000) + ',')).toString() 
    let is_change = false
    document.querySelectorAll('.course-link').forEach(e=> {
        if(!ids.includes(e.innerText)){
        ids += e.innerText + ","
            is_change = true
        }
    });
    if(is_change) {
     let encrypted = CryptoJS.AES.encrypt(ids, "Tunkit");
Cookies.set('tracker_man', encrypted.toString());
    }
    if(ids.split(',')[0] <= Date.now().toString()) {
        let formData = new FormData()
        formData.append('ids', ids)
        formData.append('type', 'view')
        fetch('{{route("update-interactive-course")}}',{
            method: 'POST',
            body: formData

        }).then(res => res.json()).then(data => {
            if(data['status']) {
                Cookies.remove('tracker_man')
            }
        })
    }
</script>

@endsection