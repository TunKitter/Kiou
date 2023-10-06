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
z-index: 100;
border-radius: 10px
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
    </div>
    <div class="progress-video" style="flex-grow: 1; position: relative;">
        <div style="height: 10px;background: #fff;border-radius: 10px;" onclick="changeVideoTime(this)">
            <div class="current-progress-video"></div>
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
var video = document.getElementById('video');
var video_state = false
var wrapper_video = document.querySelector('.wrapper-video');
var is_fullscreen = false 
var current_progress_video = document.querySelector('.current-progress-video');
var video_play_icon = document.querySelector('#video-play-icon');
var current_volume = document.getElementById('current-volume');
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
           video.onplay = function(){
                videoInterval = setInterval(() => {
                    let percent = (video.currentTime / video.duration) * 100;
                    current_progress_video.style.width = percent + '%';
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
</script>
@endsection