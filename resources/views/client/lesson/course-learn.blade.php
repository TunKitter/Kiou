@extends('client.layouts.master')
@section('content')
<style>
body {
    box-sizing: border-box !important;
}
.video-player {
width: 100%;
height: 50px;
bottom: -200px;
transition-duration: 0.5s;
position: absolute;
color: white;
z-index: 100;
background: #1b0b0b5d;
font-size: 1.4em;
display: flex;
align-items: center;
justify-content: center;
gap: 1em;
padding: 0 2em;
user-select: none;
}
.wrapper-video {
overflow: hidden;
position: relative;
}
.wrapper-video:hover .video-player {
bottom: 0
}
.video-player i:hover {
color: #f66962;
transition-duration: 0.2s;
cursor: pointer;
}
.controls i {
    margin-right:  0.5em;
}
.current-progress-video {
width: 0%;
height: 100%;
background: #f66962;
position: absolute;
top: 0;
z-index: 1;
border-radius: 10px;
border-end-end-radius: 0;
border-top-right-radius: 0
}
.bookmark-in-video {
    z-index: 999;
    height: 100%;
    background:black;
    width: 3px;
    margin-right: -3px;
    float: right;
    position: relative
}
.bookmark-in-video-wrapper {
   position: absolute;
   height: 100%;
   background: transparent;
}
.content-bookmark-in-video {
    width: max-content;
    height: max-content;
    padding: 10px 10px 0 10px;  
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: -2.5em;
    background: white;
    border-radius: 10px;
    color: black;
    display: none;
}
.bookmark-in-video:hover .content-bookmark-in-video {
    display: block;
}
video::-webkit-media-controls-fullscreen-button,video::-webkit-media-controls-play-button,video::-webkit-media-controls-timeline,video::-webkit-media-controls-timeline-container,video::-webkit-media-controls-volume-slider,video::-webkit-media-controls-volume-slider-container,video::-webkit-media-controls-panel {
display: none !important;
}
video {
max-height: 700px;
/* max-width: 100%; */
margin: auto;
display: block;
}
.video-quality {
    position: absolute;
    top:-8em;
    font-size: 0.7em;
    background: white;
    width: 100px;
    border-radius: 10px;
    z-index: 1000;
    display: none;
}
.video-quality ul {
    list-style: none;
    padding: 1em 0 0 10px;
    display: flex;
    flex-direction: column;
    border-radius: 5px;
    gap: 0.8em;
    color: black;
}
.video-quality ul li:hover {
    color: #f66962;
}
#progress {
    background: transparent;
    border: 7px solid #f66962;
    border-left: 7px solid transparent;
    border-radius: 50%;
    width: 70px;
    height: 70px;
    position: absolute;
    top: 1em;
    left: 1em;
    animation: spin 1s linear infinite;
}
@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
.bookmark-time {
    color:#ff4667 !important;
}
</style>
<section class="page-content course-sec course-lesson">
<div class="container">
<div class="row">
<div class="col-lg-4">

<div class="lesson-group">
<div class="course-card">
<h6 class="cou-title">
<a class="collapsed" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="false">Chapter 1 <span>5 Lessons</span> </a>
</h6>
<div id="collapseOne" class="card-collapse collapse" style>
<div class="progress-stip">
<div class="progress-bar bg-success progress-bar-striped active-stip"></div>
</div>
<div class="student-percent lesson-percent">
<p>10hrs<span>50%</span></p>
</div>
<ul>
<li>
<p class="play-intro">Introduction</p>
<div>
<img src="{{asset('assets/img/icon/play-icon.svg')}}" alt>
</div>
</li>
<li>
<p>Course Introduction </p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>About the Exam</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>About the Course</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>Building Our Scenario</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>Learnings</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
</ul>
</div>
</div>
<div class="course-card">
<h6 class="cou-title">
<a class="collapsed" data-bs-toggle="collapse" href="#course2" aria-expanded="false">Chapter 2 <span>8 Lessons</span> </a>
</h6>
<div id="course2" class="card-collapse collapse" style>
<div class="progress-stip">
<div class="progress-bar bg-success progress-bar-striped active-stip"></div>
</div>
<div class="student-percent lesson-percent">
<p>10hrs<span>50%</span></p>
</div>
<ul>
<li>
<p class="play-intro">Introduction</p>
<div>
<img src="{{asset('assets/img/icon/play-icon.svg')}}" alt>
</div>
</li>
<li>
<p>Course Introduction </p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>About the Exam</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>About the Course</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>Building Our Scenario</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>Learnings</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
</ul>
</div>
</div>
<div class="course-card">
<h6 class="cou-title">
<a class="collapsed" data-bs-toggle="collapse" href="#course3" aria-expanded="false">Chapter 3 <span>7 Lessons</span> </a>
</h6>
<div id="course3" class="card-collapse collapse" style>
<div class="progress-stip">
<div class="progress-bar bg-success progress-bar-striped active-stip"></div>
</div>
<div class="student-percent lesson-percent">
<p>12hrs<span>50%</span></p>
</div>
<ul>
<li>
<p class="play-intro">Introduction</p>
<div>
<img src="{{asset('assets/img/icon/play-icon.svg')}}" alt>
</div>
</li>
<li>
<p>Course Introduction </p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>About the Exam</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>About the Course</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>Building Our Scenario</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>Learnings</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
</ul>
</div>
</div>
<div class="course-card">
<h6 class="cou-title">
<a class="collapsed" data-bs-toggle="collapse" href="#coursefour" aria-expanded="false">Chapter 4 <span>5 Lessons</span> </a>
</h6>
<div id="coursefour" class="card-collapse collapse">
<div class="progress-stip">
<div class="progress-bar bg-success progress-bar-striped active-stip"></div>
</div>
<div class="student-percent lesson-percent">
<p>8hrs<span>50%</span></p>
</div>
<ul>
<li>
<p class="play-intro">Introduction</p>
<div>
<img src="{{asset('assets/img/icon/play-icon.svg')}}" alt>
</div>
</li>
<li>
<p>Course Introduction </p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>About the Exam</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>About the Course</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>Building Our Scenario</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>Learnings</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
</ul>
</div>
</div>
<div class="course-card">
<h6 class="cou-title">
<a class="collapsed" data-bs-toggle="collapse" href="#coursefive" aria-expanded="false">Chapter 5 <span>8 Lessons</span> </a>
</h6>
<div id="coursefive" class="card-collapse collapse">
<div class="progress-stip">
<div class="progress-bar bg-success progress-bar-striped active-stip"></div>
</div>
<div class="student-percent lesson-percent">
<p>15hrs<span>40%</span></p>
</div>
<ul>
<li>
<p class="play-intro">Introduction</p>
<div>
<img src="{{asset('assets/img/icon/play-icon.svg')}}" alt>
</div>
</li>
<li>
<p>Course Introduction </p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>About the Exam</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>About the Course</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>Building Our Scenario</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
<li>
<p>Learnings</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
</ul>
</div>
</div>
</div>
<br>
<h4>Your Bookmark <i onclick="addBookmark()" class="fa-feather feather-bookmark float-end"><sup><i class="fa-solid fa-add fs-6"></i></sup></i></h4>
<br>
<div class="bookmark-wrapper"></div>
<div class=" bookmark mb-2" id="bookmarks_list">
 @foreach ($bookmarks as $bookmark)
 <div class="m-2 bookmark_list" onclick="removeBookmark({{$loop->index}},this,{{$bookmark['timeline']}})"><i class="feather feather-x"></i></div>
 <div class="course-card bookmarks_list">
    <h6 class="cou-title">
    <a class="collapsed" data-bs-toggle="collapse" href="#boormark{{$loop->index}}" aria-expanded="false"><span class="bookmark-time" onclick="jumpVideo({{$bookmark['timeline']}})">{{floor($bookmark['timeline']/60). ':'. $bookmark['timeline']%60}} </span>{{$bookmark['front_card']}}</a>
    </h6>
    <div id="boormark{{$loop->index}}" class="card-collapse collapse p-2">{{$bookmark['back_card']}}</div>
    </div>
 @endforeach 
 
</div>
</div>
<div class="col-lg-8">

<div class="student-widget lesson-introduction">
<div class="lesson-widget-group">
<h4 class="tittle">Introduction</h4>
<div class="introduct-video">
{{-- <a href="#"> --}}
{{-- <div class="play-icon">
<i class="fa-solid fa-play" ></i>
</div> --}}
{{-- <img class src="{{asset('assets/img/video-img-01.jpg')}}" id="video"> --}}

<div class="wrapper-video"> <div id="progress" ></div> <video ondblclick="fullscreenVideo()" id="video" src="https://storage.googleapis.com/kiou_lesson/tunkit/tunkit.m3u8" width="100%"></video><div class="video-player">

    <div class="controls">
        <i class="fa-solid fa-backward" onclick="backWardVideo()"></i>
        <i class="fa-solid fa-play" id="video-play-icon" onclick="play_video(this)"></i>
        <i class="fa-solid fa-forward" onclick="forwardVideo()"></i>
        <i style="font-style: normal;font-size: 0.9em" id="timeline">00:00</i>
    </div>
    <div class="progress-video" style="flex-grow: 1; position: relative;">
        <div style="height: 10px;background: #fff;border-radius: 10px;width: 100%" onclick="changeVideoTime(this)" >
            <div class="current-progress-video"></div>
            <div id="bookmarks"></div>
        </div>
    </div>
    <div class="controls" style="display: flex;align-items: center;">
        <i class="fa-solid feather-settings" id="setting" onclick="displayQuality()">
            <div class="video-quality" >
                <ul>
                    <li class="fw-light" onclick="settingVideo(4,this)">1080p</li>
                    <li class="fw-light" onclick="settingVideo(3,this)">720p</li>
                    <li class="fw-light" onclick="settingVideo(2,this)">480p</li>
                    <li class="fw-light" onclick="settingVideo(1,this)">360p</li>
                </ul>
            </div>
        </i>
        <i class="fa-solid feather-volume-2" id="volume"></i>
        <div style="width: 80px;height:10px;background: white;margin:0 15px 0 -2px;border-radius:12px" onclick="changeVideoVolume(this)">
            <div style="width:100%;height:100%;background: #f66962;border-radius: 12px" id="current-volume"></div>
        </div>
        <i class="fa-solid feather-maximize" onclick="fullscreenVideo()"></i>
    </div>
</div></div>
</a>
</div>
</div>
</div>

</div>
</div>
</div>
</section>
<script>
var video_inside = document.querySelector('#video_inside');
var video = document.getElementById('video');
var video_state = false
var wrapper_video = document.querySelector('.wrapper-video');
var is_fullscreen = false 
var current_progress_video = document.querySelector('.current-progress-video');
var bookmarks_list = document.querySelector('#bookmarks_list');
var video_play_icon = document.querySelector('#video-play-icon');
var current_volume = document.getElementById('current-volume');
document.body.onload = function(){
let bookmarks_string = ``;
@foreach ($bookmarks as $bookmark)
bookmarks_string+= `<div class="bookmark-in-video-wrapper bookmark_{{$bookmark['timeline']}}" style="width: ${(100/video.duration) * {{$bookmark['timeline']}}}% ;z-index: $loop->count - $loop->index+1">
            <div class="bookmark-in-video">
                <div class="content-bookmark-in-video">
                <p>{{$bookmark['front_card']}}</p>
                </div>
            </div>
            </div>`;
@endforeach
document.querySelector('#bookmarks').outerHTML = bookmarks_string + '<div id="bookmarks"></div>'
}
    function play_video(obj){
        if(!video_state){
         video.play();
        obj.classList.remove('fa-play');
        obj.classList.add('fa-pause');
        video_state = true
        }
        else {
            video.pause();
            obj.classList.remove('fa-pause');
            obj.classList.add('fa-play');
            video_state = false
        }
            }
           var videoInterval;
var timeline = document.querySelector('#timeline'); 
           video.onplay = function(){
                videoInterval = setInterval(() => {
                    let percent = (video.currentTime / video.duration) * 100;
                    current_progress_video.style.width = percent + '%';
                    let video_current = video.currentTime;
    let minutes = Math.floor((video_current % 3600) / 60);
    let formattedMinutes = minutes < 10 ? `0${minutes}` : minutes;
    let seconds = (video_current % 60).toFixed(0);
    let formattedSeconds = seconds < 10 ? `0${seconds}` : seconds;
                timeline.innerHTML = formattedMinutes + ':' + formattedSeconds;
            },0)
            }
video.onpause = function(){
    clearInterval(videoInterval);
}
video.onended = function(){
    clearInterval(videoInterval)
    video_play_icon.classList.remove('fa-pause');
    video_play_icon.classList.add('fa-play');
    video_state = false

}

function fullscreenVideo(){
    is_fullscreen ? document.exitFullscreen() : wrapper_video.requestFullscreen();
    is_fullscreen = !is_fullscreen;
}
function changeVideoTime(obj){
    video_state = false
    play_video(video_play_icon)
    video.currentTime = (window.event.pageX - obj.getBoundingClientRect().left) / obj.clientWidth * video.duration
}
function changeVideoVolume(obj){
    let temp_volume = (window.event.pageX - obj.getBoundingClientRect().left) / obj.clientWidth * 100
current_volume.style.width = temp_volume + '%';
video.volume = temp_volume / 100
}


</script>
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script>

        if(Hls.isSupported()) {
    var hls = new Hls({
        maxBufferLength:5,
        maxBufferHole: 0,
        enableWorker:true
    });
    hls.loadSource('https://demo.unified-streaming.com/k8s/features/stable/video/tears-of-steel/tears-of-steel.ism/.m3u8');
    hls.attachMedia(video);
    const progress = document.querySelector('#progress')

    hls.on(window.Hls.Events.FRAG_BUFFERED, () => {
        progress.style.display = 'none'
})
hls.on(window.Hls.Events.FRAG_LOADING, () => {
 progress.style.display = 'block'
})

 }

  video.onplaying = function(){
   
      progress.style.display = 'none'
  }
function backWardVideo(){
    if(video.currentTime > 5){
        
    video.currentTime -= 5;
    }
}
function forwardVideo(){
if(video.currentTime < video.duration - 5){
    
    video.currentTime += 5;
}
}
var old_quality;
function settingVideo(quality,obj){
    obj.style.color = '#f66962';
    if(old_quality){
        old_quality.style.color = 'black';
    }
    old_quality = obj
    hls.currentLevel = quality;
}
var video_quality = document.querySelector('.video-quality');
function displayQuality(){
    let temp_video_quality=  video_quality.style.display
 video_quality.style.display = temp_video_quality == 'block' ? 'none' : 'block'
}
function addBookmark(){
    video_state = true
    play_video(video_play_icon)
document.querySelector('.bookmark-wrapper').insertAdjacentHTML("beforeBegin",`
 <div class="add-new-card-wrapper">
<input type="text" id="front-flash"  class="form-control" placeholder="Enter your definition" oninput="enter_data()">
<br>
<input type="text" id="back-flash" class="form-control" placeholder="Enter your own meaning" oninput="enter_data()">
<br>
<button id="btn-add-flash" disabled class="btn btn-primary w-100" onclick="saveBookmark(this)">Add</button>
<br>
<br>
<button class="btn btn-outline-primary w-100 border-0" onclick="cancelAddBookmark()">Cancel</button>
</div>`);
}
function cancelAddBookmark(){
    document.querySelector('.add-new-card-wrapper').remove();  
}
function saveBookmark(obj) {
let front_card = document.querySelector('#front-flash');
let back_card = document.querySelector('#back-flash');
let formData = new FormData();
formData.append('front_card', front_card.value);
formData.append('back_card', back_card.value);
formData.append('timeline', parseInt(video.currentTime));

    obj.disabled = true;
    obj.innerHTML = 'Adding';
    fetch("{{route('lesson-bookmark-add','dsaas')}}", {
        method: "POST",
        body: formData  
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        if(data.status == 'success'){
            obj.innerHTML = 'Added bookmark successfully';
            obj.style.backgroundColor = '#00e676';
            setTimeout(() => {
        cancelAddBookmark()
        obj.disabled = false;
        obj.style.color = '#6bb0ec';
        obj.innerHTML = 'Add';
        let bookmark_length = bookmarks_list.children.length;
           bookmarks_list.innerHTML += `
           <div class="m-2 bookmark_list" onclick="removeBookmark(${document.querySelectorAll('.bookmark_list').length},this,${(video.currentTime).toFixed(0)})"><div class="bookmark_remove"><i class="feather feather-x"></i></div>
        <div class="course-card bookmarks_list">
    <h6 class="cou-title">
    <a class="collapsed" data-bs-toggle="collapse" href="#boormark${document.querySelectorAll('.bookmark_list').length}" aria-expanded="false"><span class="bookmark-time" onclick="jumpVideo(${video.currentTime})">${Math.floor(video.currentTime/60).toFixed(0) + ':'+ (video.currentTime%60).toFixed()} </span>${front_card.value}</a>
    </h6>
    <div id="boormark${document.querySelectorAll('.bookmark_list').length}" class="card-collapse collapse p-2">${back_card.value}</div>
    </div>`;     
    document.querySelector('#bookmarks').outerHTML =  `<div class="bookmark-in-video-wrapper bookmark_${(video.currentTime).toFixed(0)}" style="width: ${(100/video.duration) * video.currentTime}% ;z-index: ${bookmark_length+1}">
            <div class="bookmark-in-video bookmark_${(video.currentTime).toFixed(0)}">
                <div class="content-bookmark-in-video">
                <p>${front_card.value}</p>
                </div>
            </div>
            </div> <div id="bookmarks"></div>`;
            }, 1000);
 
        }
        })
        }

 function enter_data(){
let inputs = (document.querySelectorAll('input[oninput="enter_data()"]'))
let inputs_length = inputs.length
let btn_add_card = document.querySelector('#btn-add-flash');
    let check_ = true
        for(let i = 0 ; i < inputs_length; i++) {
            if(inputs[i].value.length < 5){
                btn_add_card.setAttribute('disabled', true);
                return;
            }
        }
        if(check_)   btn_add_card.removeAttribute('disabled');
    
}
function jumpVideo(timeline) {
    // alert(timeline)
    video.currentTime = timeline
    video_state = false;
    play_video(video_play_icon)
}
// var bookmarks_list_class = document.querySelectorAll('.bookmarks_list');
function removeBookmark(index,obj,timeline) {
    if(confirm('Are you sure to remove this bookmark?')){
        let formData = new FormData();
        formData.append('timeline',timeline );
        fetch("{{route('lesson-bookmark-delete','dsaas')}}", {
            method: "POST",
            body: formData
        }).then(function (response) {
            return response.json();
        }).then(function (data) {
            if(data.status == 'success'){
                document.querySelector('.bookmark_'+ timeline).remove();
            }
        })
        document.querySelectorAll('.bookmarks_list')[index].style.display = 'none';
    obj.style.display = 'none';       
    }

}
</script>
@endsection