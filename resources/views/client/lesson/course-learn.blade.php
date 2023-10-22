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
#subtitle * {
    color: white;
}

#subtitle span:hover {
    color: #ff4667
}
    #lookup {
        width: 250px;
        height: 100px;
        background: white;
        position: absolute;
        z-index: 10000;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border-radius: 12px;
        display: none;
    }
    #definition {
        font-weight: bold;
        font-size: 1.5em;
        margin-bottom: 0.4em
    }
</style>
<section class="page-content course-sec course-lesson">
<div class="container">
<div class="row">
<div class="col-lg-4">
{{-- @php
    dd($lessons)
@endphp --}}
<div class="lesson-group">
@foreach ($chapters as $key => $value)
<div class="course-card">
<h6 class="cou-title">
<a class="collapsed" data-bs-toggle="collapse" href="#collapse_{{$key}}" aria-expanded="false">{{$value}} <span class="ul_length">0</span> </a>
</h6>
<div id="collapse_{{$key}}" class="card-collapse collapse" style>
<ul class="ul_">
<li>
<p class="play-intro">Introduction <i class="fa-solid fa-check d-inline-block m-auto"></i></p>
<div>
<img src="{{asset('assets/img/icon/play-icon.svg')}}" alt>
</div>
</li>
@foreach ($lessons as $lesson )
    @if($lesson['chapter'][1] == $key) 
    <li>
<p>{{$lesson['name']}}</p>
<div>
<img src="{{asset('assets/img/icon/lock.svg')}}" alt>
</div>
</li>
    @endif
@endforeach
</ul>
</div>
</div>
@endforeach
</div>
<br>
<h4>Your Bookmark <i onclick="addBookmark()" class="fa-feather feather-bookmark float-end"><sup><i class="fa-solid fa-add fs-6"></i></sup></i></h4>
<br>
<div class="bookmark-wrapper"></div>
<div class="bookmark mb-2" id="bookmarks_list">
 @foreach ($bookmarks as $bookmark)
 <span class="m-2 bookmark_list"  onclick="removeBookmark({{$loop->index}},this,{{$bookmark['timeline']}})"><i class="feather feather-x"></i></span>
 <span class="edit_icon"><i class="feather feather-edit" onclick="editBookmark({{$loop->index}})"></i></span>
 <div class="course-card bookmarks_list">
    <span class="d-none timeline_value">{{$bookmark['timeline']}}</span>
    <h6 class="cou-title">
    <a class="collapsed" data-bs-toggle="collapse" href="#boormark{{$loop->index}}" aria-expanded="false"><span class="bookmark-time" onclick="jumpVideo({{$bookmark['timeline']}})">{{floor($bookmark['timeline']/60). ':'. $bookmark['timeline']%60}} </span><span class="front_card_value">{{$bookmark['front_card']}}</span></a>
    </h6>
    <div id="boormark{{$loop->index}}" class="card-collapse collapse p-2 back_card_value">{{$bookmark['back_card']}}</div>
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

<div class="wrapper-video"> 
    <div class="rect interactive_wrapper" style="width: 20px;height: 20px;background: red;position:absolute;display:none;z-index:100" onclick="alert(99)"></div>
<div class="parent_interactive position-absolute " style="left: 7%;bottom:4em;">
    <div class="interactive_wrapper" style="display: none" > <div class="plan-box" >
        <div>
        <h6 style="color: #249c46 ; text-transform: capitalize">Hello this is Tunkit</h6>
        <p>Hello this is Tunkit</p>
        </div>
        </div>
</div>
<div class="interactive_wrapper select_ideal" style="width: max-content;display: none">
    <div class="plan-box">
        <div>
        <h6 style="text-transform: capitalize" class="text-muted text-center">Hello this is Tunkit</h6>
        <button class="btn btn-secondary" onclick="jumpVideo(300)">Hello this is Tunkit</button>
        <button class="btn btn-secondary" onclick="jumpVideo()">Hello this is Tunkit</button>
        </div>
        </div>
</div>
<div class="interactive_wrapper" style="display: none" >
            <div class="plan-box" >
        <div>
        <h6 style="color: #249c46 ; text-transform: capitalize">Hello this is Tunkit</h6>
        <p>Hello this is Tunkit 3</p>
        </div>
        </div>
</div>
 </div>
    <div id="progress" ></div> <video ondblclick="fullscreenVideo()" id="video" src="https://storage.googleapis.com/kiou_lesson/tunkit/tunkit.m3u8" width="100%"></video><div class="video-player">

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
        <i class="fa-solid feather-file-text" onclick="changeCaption(this)" ></i>
        <i class="fa-solid feather-volume-2" id="volume"></i>
        <div style="width: 80px;height:10px;background: white;margin:0 15px 0 -2px;border-radius:12px" onclick="changeVideoVolume(this)">
            <div style="width:100%;height:100%;background: #f66962;border-radius: 12px" id="current-volume"></div>
        </div>
        <i class="fa-solid feather-maximize" onclick="fullscreenVideo()"></i>
    </div>
</div>
<div id="lookup" onmouseover="hoverCaption(this)" onmouseout="hoverOutCaption(this)">
    <div id="definition"></div>
    <div id="explain"></div>
</div>

<p class="bg-black w-100 text-white text-center position-absolute p-2" style="bottom: 1.5em;z-index: 1; cursor: pointer;" id="subtitle" onmouseover="hoverCaption(this)" onmouseout="hoverOutCaption(this)"></p>

</div>
</a>
</div>
</div>
</div>
<style>
    .plan-box {
        animation: none;
        position: relative;
        z-index: 3 !important;
    }
</style>
</div>  
</div>
</div>

</section>
<script>
var is_caption_on = false
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
                <p class="front_card_in_video_{{$bookmark['timeline']}}">{{$bookmark['front_card']}}</p>
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
            let current_
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
    hls.loadSource('{{$path}}');
    hls.attachMedia(video);
    const progress = document.querySelector('#progress')

    hls.on(window.Hls.Events.FRAG_BUFFERED, () => {
        progress.style.display = 'none'
})
hls.on(window.Hls.Events.FRAG_LOADING, () => {
 progress.style.display = 'block'
})

 }
 
var lookupView = document.querySelector('#lookup');


  video.onplaying = function(){
        lookupView.style.display = 'none'   
      progress.style.display = 'none'
// if(is_cation_on){
    if(subtitle_result){

        let current_subtitle =[0,0]
        setInterval(() => {
            
           if(video.currentTime < current_subtitle[0] || video.currentTime > current_subtitle[1]){
            
                let temp_subtitle = subtitle_result.find(e => (e.start <= video.currentTime && e.end >= video.currentTime) )
                if(is_caption_on){
                    temp_subtitle ? subtitle.style.display = 'block' : subtitle.style.display = 'none'
                }
                current_subtitle = [temp_subtitle.start,temp_subtitle.end]
                if(temp_subtitle){
                    let temp_ =''
                    temp_subtitle.content.split(' ').map(e => {
                        let replace_e = e.replace("'",'___');
                        temp_ += `<span onclick='lookUpWord(\`${replace_e}\`,this)'>${e}</span> `
                    })
                    subtitle.innerHTML = temp_
                }
           } 
        }, 1000);
}
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
    fetch("{{route('lesson-bookmark-add',$id_lesson)}}", {
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
           <span class="m-2 bookmark_list" onclick="removeBookmark(${document.querySelectorAll('.bookmark_list').length},this,${(video.currentTime).toFixed(0)})"><i class="feather feather-x"></i></span>
          <span class="edit_icon"><i class="feather feather-edit" onclick="editBookmark(${document.querySelectorAll('.bookmark_list').length})"></i></span>
        <div class="course-card bookmarks_list">
    <span class="d-none timeline_value">${(video.currentTime).toFixed(0)}</span>
    <h6 class="cou-title">
    <a class="collapsed" data-bs-toggle="collapse" href="#boormark${document.querySelectorAll('.bookmark_list').length}" aria-expanded="false"><span class="bookmark-time" onclick="jumpVideo(${video.currentTime})">${Math.floor(video.currentTime/60).toFixed(0) + ':'+ (video.currentTime%60).toFixed()} </span><span class="front_card_value">${front_card.value}</span></a>
    </h6>
    <div id="boormark${document.querySelectorAll('.bookmark_list').length}" class="card-collapse collapse p-2 back_card_value">${back_card.value}</div>
    </div>`;     
    document.querySelector('#bookmarks').outerHTML =  `<div class="bookmark-in-video-wrapper bookmark_${(video.currentTime).toFixed(0)}" style="width: ${(100/video.duration) * video.currentTime}% ;z-index: ${bookmark_length+1}">
            <div class="bookmark-in-video bookmark_${(video.currentTime).toFixed(0)}">
                <div class="content-bookmark-in-video">
                <p class="front_card_in_video_${(video.currentTime).toFixed(0)}">${front_card.value}</p>
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
    if(!timeline) {
        timeline = video.currentTime;
    }
    video.currentTime = timeline
    video_state = false;
    play_video(video_play_icon)
}
// var bookmarks_list_class = document.querySelectorAll('.bookmarks_list');

function removeBookmark(index,obj,timeline) {
    if(confirm('Are you sure to remove this bookmark?')){
        let formData = new FormData();
        formData.append('timeline',timeline );
        fetch("{{route('lesson-bookmark-delete',$id_lesson)}}", {
            method: "POST",
            body: formData
        }).then(function (response) {
            return response.json();
        }).then(function (data) {
            if(data.status == 'success'){
                document.querySelector('.bookmark_'+ timeline).remove();
                document.querySelectorAll('.bookmarks_list')[index].style.display = 'none';
                obj.style.display = 'none';       
                document.querySelectorAll('.edit_icon')[index].style.display = 'none';
            }
        })
    }

}
var index_edit =null
function editBookmark(index) {


addBookmark()
    let front_card_value  = (document.querySelectorAll('.front_card_value')[index])
    let back_card_value = (document.querySelectorAll('.back_card_value')[index])
    let timeline_value = (document.querySelectorAll('.timeline_value')[index].innerHTML)
    index_edit = index
document.querySelector('#front-flash').value = front_card_value.innerHTML 
document.querySelector('#back-flash').value =  back_card_value.innerHTML
let btn_flash = document.querySelector('#btn-add-flash')
btn_flash.innerHTML = 'Update'
btn_flash.disabled = false
btn_flash.setAttribute('onclick', `updateBookmark(this,${timeline_value})`)
}
function updateBookmark(btn,timeline_value) {
    let formData = new FormData();
    formData.append('front_card', document.querySelector('#front-flash').value);
    formData.append('back_card',document.querySelector('#back-flash').value);
    formData.append('timeline', timeline_value);
    fetch("{{route('lesson-bookmark-update', $id_lesson)}}", {
       method: "POST", 
        body: formData
    }).then(function (response) {
        return response.text();
    }).then(function (data) {
        document.querySelectorAll('.front_card_value')[index_edit].innerHTML = document.querySelector('#front-flash').value
        document.querySelectorAll('.back_card_value')[index_edit].innerHTML = document.querySelector('#back-flash').value
        document.querySelector(`.front_card_in_video_${timeline_value}`).innerHTML = document.querySelector('#front-flash').value
        btn.setAttribute('onclick', `saveBookmark(btn)`);
        cancelAddBookmark()
        video_state = false;
        play_video(video_play_icon)
    })

}
var subtitle = document.querySelector('#subtitle');
subtitle.style.display = 'none';
var subtitle_result = null
fetch("{{asset('course/lesson/subtitle/tunkit.srt')}}").then(response => response.text()).then(data => {
    let formData = new FormData();
    formData.append('srt', data);
    fetch("https://kiou-subtitle-90168a6941e4.herokuapp.com/api/subtitle",{
        method: "POST",
        body: formData
    }).then(response => response.json()).then(result => {
        subtitle_result = result['message']

    })
});
function changeCaption(obj) {
    is_caption_on = !is_caption_on
    if(is_caption_on){
        subtitle.style.display = 'block'       
        obj.style.color = '#ff4667';
    }
    else{
        subtitle.style.display = 'none'
            obj.style.color = 'white';
    }
}
function hoverCaption(obj) {
video_state = true;
play_video(video_play_icon)
}
function hoverOutCaption(obj) {
    video_state = false;
    play_video(video_play_icon)
}
var definition = document.querySelector('#definition');
var explain = document.querySelector('#explain');
function lookUpWord(text,obj) {
    text = text.replace('___',"'")
    lookupView.style.display = 'flex';
    let obj_x_y = obj.getBoundingClientRect();
    if(is_fullscreen) {
      lookupView.style.left = ((obj_x_y.left + window.scrollX)-50) + 'px';
      lookupView.style.bottom= 'initial';
     lookupView.style.top = ((obj_x_y.top )-100) + 'px';       
    }
    else {
     lookupView.style.left = ((obj_x_y.left + window.scrollX)-300) / 2 + 'px'
     lookupView.style.top = 'initial';
     lookupView.style.bottom = '72px'
    }
        definition.innerText = text;
    let formData = new FormData();
    formData.append('q', text);
    formData.append('target', 'vi');
    formData.append('key', 'AIzaSyCMlt_uezOxZQ3Bd_AaZhxoFkYpo2Zth2c');

    fetch('https://translation.googleapis.com/language/translate/v2',{
        method:"POST",
        body: formData 
    }).then(response => response.json()).then(result => {
        explain.innerHTML = result.data.translations[0].translatedText
    })
}
video.addEventListener('playing', () => {
let arr = [[7,10],[12,16],[20,22]]
let current_index = 0
// let start_ = arr[current_index][0]
// let end_ = arr[current_index][1]
setInterval(() => {
$('.interactive_wrapper').hide()
let temp_ = arr.find((item,index) => {
    current_index = index
return video.currentTime >= item[0] && video.currentTime <= item[1]   
})
if(temp_){
        let temp_interact =  $('.interactive_wrapper:eq('+current_index+')')
        temp_interact.show()
        if(temp_interact.hasClass('select_ideal')){
            video_state = true;
            play_video(video_play_icon)
        }
        else if(temp_interact.hasClass('rect')){
            temp_interact.css('left',arr[current_index][0] + 'px')
            temp_interact.css('top',arr[current_index][1] + 'px')
            video_state = false;
            play_video(video_play_icon)
        }
        else {
            video_state = false;
            play_video(video_play_icon)
        }
 }
else {
    $('.interactive_wrapper').hide()
    
}
}, 1000);   
})
var uls = document.querySelectorAll('.ul_')
var uls_length = document.querySelectorAll('.ul_length')
uls.forEach((e,index) => {
    uls_length[index].innerHTML = e.children.length +  ' Lessons'
})
</script>

@endsection