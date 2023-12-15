@extends('client.layouts.master')
@section('content')
<br><br>
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
video::-webkit-media-controls-fullscreen-button,video::-webkit-media-controls-play-button,video::-webkit-media-controls-timeline,video::-webkit-media-controls-timeline-container,video::-webkit-media-controls-volume-slider,video::-webkit-media-controls-volume-slider-container,video::-webkit-media-controls-panel {
display: none !important;
}
video {
max-height: 400px;
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
.dropdown-item:hover {
    cursor: pointer;
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
.plan-box {
 top: initial;
 bottom: 1em;
}
</style>
<div class="modal fade" id="notification_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title_modal">Show message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
    <div class="modal-body">
        <p class="badge bg-warning" id="current_video_time"></p>
        <input type="text" name="notification_input" id="notification_input" class="form-control" placeholder="Enter your message">
        <br>
        <input type="number" name="notification_duration_input" id="notification_duration_input" class="form-control" placeholder="Enter your duration">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addNewNotification()">Confirm</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="notification_update_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title_modal">Update notification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
    <div class="modal-body">
        <p class="badge bg-warning" id="current_video_time_update"></p>
        <input type="text" name="notification_update_input" id="notification_update_input" class="form-control" placeholder="Enter your message">
        <br>
        <input type="number" name="notification_duration_update_input" id="notification_update_duration_input" class="form-control" placeholder="Enter your duration">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="handleUpdateNotification()">Confirm</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="select_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title_modal">Add select interactive</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
    <div class="modal-body">
        <button class="btn btn-primary" onclick="addNewSelect()">New select</button>
<br><br>
        <div class="select-wrapper">
        </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="handleAddNewSelect()">Confirm</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="update_select_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title_modal">Update select interactive</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
    <div class="modal-body">
        <button class="btn btn-primary" onclick="addNewSelect('.update-select-wrapper')">New select</button>
<br><br>
        <div class="update-select-wrapper">
        </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="handleUpdateSelect()">Confirm</button>
      </div>
    </div>
  </div>
</div>
<div class="video-wrapper d-flex justify-content-between">
<div class="interactive flex-fill" style="width: 400px">
    <h2 class="text-center">Event <div class="dropdown-center float-end me-2">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            New event
        </button>
        <ul class="dropdown-menu">
          <li class="dropdown-item" onclick="handleEvent('notification')" >Notification</li>
          <li class="dropdown-item" onclick="handleEvent('select')" >Select</li>
          <li class="dropdown-item" onclick="handleEvent('axis')" >Axis</li>
        </ul>
      </div></h2>
<ul class="mt-4 list-group" id="event_list">
</ul>
</div>
<div class="wrapper-video"> 
<div class="parent_interactive position-absolute" style="left: 7%;bottom:4em;">
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
                <ul class="video_quality_ul">
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
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script>
const video = document.querySelector('video');
    
        if(Hls.isSupported()) {
    var hls = new Hls({
        maxBufferLength:5,
        maxBufferHole: 0,
        enableWorker:true
    });
    // hls.loadSource('{{$lesson->path}}');
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
</script>
<script>
var current_update_select = ''
var is_caption_on = false
var video_inside = document.querySelector('#video_inside');
var video_state = false
var wrapper_video = document.querySelector('.wrapper-video');
var is_fullscreen = false 
var current_progress_video = document.querySelector('.current-progress-video');
var is_select_mode = false
var video_play_icon = document.querySelector('#video-play-icon');
var current_volume = document.getElementById('current-volume');
var parent_interactive = document.querySelector('.parent_interactive')
function play_video(obj){
        if(!video_state){
         video.play();
        video_play_icon.classList.remove('fa-play');
        video_play_icon.classList.add('fa-pause');
        video_state = true
        }
        else {
            video.pause();
            video_play_icon.classList.remove('fa-pause');
            video_play_icon.classList.add('fa-play');
            video_state = false
        }
            }
            var videoInterval;
var timeline = document.querySelector('#timeline'); 
           video.onplay = function(){
             if(is_select_mode){
                video.pause()
             }
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

for(let i in data_event) {
    if(video.currentTime >= data_event[i]['start_time'] && video.currentTime <= data_event[i]['start_time'] + data_event[i]['duration']){
      switch (data_event[i]['type']) {
        case 'notification': {
         document.querySelector(`.${data_event[i]['class_name']}`).style.display = 'block'
        setTimeout(() => {
            document.querySelector(`.${data_event[i]['class_name']}`).style.display = 'none'
        }, data_event[i]['duration'] * 1000);
    break       
        }
        case 'select' : {
          is_select_mode = true
          video_state = true
          play_video(video_play_icon)
          document.querySelector('.'+data_event[i]['class_name']).style.display = 'block'
          break
        }
      }
    }
}
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
function jumpVideo(timeline) {
    if(!timeline) {
        timeline = video.currentTime;
    }
    video.currentTime = timeline
    video_state = false;
    play_video(video_play_icon)
}
function handleEvent(event_type) {
    video_state = true
    play_video(video_play_icon)
    $('#current_video_time').html($('#timeline').html())
    switch(event_type){
        case 'notification' : {
            $('#notification_modal').modal('show')
            break
        }
        case 'select' : {
            $('#select_modal').modal('show')
            break
        }
        case 'axis' : {
            break
        }
    }
}
var event_list = document.querySelector('#event_list');
var data_event = []
function addNewNotification() {
let random_id = '_' + makeid();
event_list.innerHTML += `<li class="list-group-item border-0 list${random_id}"><i class="fa-solid fa-trash" onclick="removeNotification('${random_id}')" style="color:#f66962"></i> <i class="fa-solid fa-pen" onclick="updateNotification('${random_id}')"></i> Show notification <sup class="badge bg-info">Event</sup> <span class="float-end">${document.querySelector('#timeline').innerHTML}</span>`
    data_event[random_id] = {
        type: 'notification',
        class_name: random_id,
        start_time: parseInt(video.currentTime),
        duration: parseInt(document.querySelector('#notification_duration_input').value),
        message: document.querySelector('#notification_input').value
    }
$('#notification_modal').modal('hide')
parent_interactive.innerHTML += `
<div class="interactive_wrapper ${random_id}" style="display:none"> <div class="plan-box" style="bottom: 2em;top: initial" >
        <div>
        <h6 style="color: #249c46 ; text-transform: capitalize">Message</h6>
        <p class="message">${document.querySelector('#notification_input').value}</p>
        </div>
        </div>
</div>
`
document.querySelector('#bookmarks').innerHTML+= `
                <div class="bookmark-in-video-wrapper bookmark_${parseInt(video.currentTime)} bookmark${random_id}" style="width: ${100/video.duration * video.currentTime}% ;z-index: 1">
                    <div class="bookmark-in-video" style="background: #249c46 ">
                    </div>
                    </div>
`
// set empty value of input
document.querySelector('#notification_input').value = ''
document.querySelector('#notification_duration_input').value = ''
}
function makeid() {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    let counter = 0;
    while (counter < 4) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
      counter += 1;
    }
    return result;
}
function removeNotification(_id) {
    delete data_event[_id]
    $('.list' + _id).remove()
    $('.bookmark' + _id).remove()
}
var current_id_update = ''
function updateNotification(_id) {
    video_state = true
    play_video(video_play_icon)
    current_id_update = _id
    $('#notification_update_modal').modal('show')
    $('#current_video_time_update').html(document.querySelector('.list' + _id).querySelector('.float-end').innerHTML)
    $('#notification_update_input').val(data_event[_id]['message'])
    $('#notification_update_duration_input').val(data_event[_id]['duration'])
    
}
function handleUpdateNotification() {
    data_event[current_id_update]['message'] = $('#notification_update_input').val()
    data_event[current_id_update]['duration'] = parseInt($('#notification_update_duration_input').val())
    document.querySelector('.'+current_id_update + ' p').innerHTML = data_event[current_id_update]['message']
    $('#notification_update_modal').modal('hide')
}
function addNewSelect(_class_to_add = '.select-wrapper') {
    let random_chapter = '_' + makeid();
    let random_lesson = '_' + makeid();
    document.querySelector(_class_to_add).innerHTML += `
    <div class="curriculum-grid mt-4 ${random_chapter}">
                        <div class="curriculum-head">
                          <p class="chapter_name" contenteditable="">Enter select title</p>
                          <a href="javascript:void(0);"><button class="btn text-white border-0" style="background:#ff4667" onclick="removeSelect('${random_chapter}')">Remove select</button></a> 
                        </div>
                        <div class="curriculum-info">
                          <div id="accordion-${random_chapter}">
   <div class="faq-grid" id="${random_lesson}"> 
                              <div class="faq-header">
                                <a class="collapsed faq-collapse" data-bs-toggle="collapse" href="#collapse_${random_lesson}">
                                  <i class="fas fa-align-justify"></i>
                                  <span contenteditable="" class="event_name">Enter event name</span>
                                </a>
                              </div>
                              <div id="collapse_${random_lesson}" class="collapse" data-bs-parent="#accordion-one">
                                <div class="faq-body">
                                  <div class="add-article-btns">
                                    <div class="form-group">
                          <label class="add-course-label">Type event</label>
                          <select class="form-control select select${random_lesson}" onchange="handleTypeEvent('content${random_lesson}',this.value)">
                          <option value="show_message">Show message</option>
                          <option value="jump_timeline">Jump timeline</option>
                          <option value="send_link">Send a link</option>
                          <option value="increase_bloom">Increase Bloom Point</option>
                          <option value="decrease_bloom">Decrease Bloom Point</option>
                          </select>
                        </div>
                  <div class="form-group content${random_lesson}">
                    <input type="text" name="message" class="form-control message_select" placeholder="Enter value" />
                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>                           
                          </div>
                        </div>
                      </div>
    `
}
function removeSelect(_class){
  $('.'+_class).remove();
}
function handleTypeEvent(_class,_value) {
  switch (_value) {
    case 'show_message': {
      $('.'+_class).html(`<input type="text" name="message" class="form-control message_select" placeholder="Enter value" />`)
        break
    }
  case 'jump_timeline': {
      $('.'+_class).html(`<input type="text" name="message" class="form-control message_select" placeholder="Enter value" />`)
        break
    }
  case 'send_link': {
      $('.'+_class).html(`<input type="text" name="message" class="form-control message_select" placeholder="Enter value" />`)
        break
    }
    case 'increase_bloom': {
      $('.'+_class).html(`<input type="number" name="bloom_point" class="form-control" placeholder="Enter a value" />`)
      break;
    }
    case 'decrease_bloom': {
      $('.'+_class).html(`<input type="number" name="bloom_point" class="form-control" placeholder="Enter a value" />`)
      break;
    }
  }
}
var html_select = []
function handleAddNewSelect() {
let random_id = '_'+makeid()
html_select[random_id] = document.querySelector('.select-wrapper').innerHTML
let temp_type = []
let temp_value = []
data_event[random_id] = {
  type: 'select',
  start_time: parseInt(video.currentTime),
  duration: 1,
  class_name: random_id,
  event: [...document.querySelectorAll('.select-wrapper .curriculum-grid')].map(e => {
  temp_type.push(e.querySelector('select').value)
  temp_value.push(e.querySelector('input').value)
 return {[e.querySelector('select').value]: [e.querySelector('.chapter_name').innerHTML,e.querySelector('.event_name').innerHTML,e.querySelector('input').value]}
})
}
parent_interactive.innerHTML+= `
<div class="interactive_wrapper select_ideal ${random_id}" style="width: max-content;display: none">
    <div class="plan-box" style="top:initial;bottom:1em">
        <div class="row">
        <h6 style="text-transform: capitalize" class="text-muted text-center">Please choose an option</h6>
        `+ 
        ([... document.querySelectorAll('.select-wrapper .chapter_name')].map((e,index) => ` <button class="btn col mx-1 btn-secondary" onclick="actionNow('${random_id}','${temp_type[index]}','${temp_value[index]}')">${e.innerHTML}</button>`)).join('')
        +`
        </div>
        </div>
</div>
`
document.querySelector('#bookmarks').innerHTML+= `
                <div class="bookmark-in-video-wrapper bookmark_${parseInt(video.currentTime)} bookmark${random_id}" style="width: ${100/video.duration * video.currentTime}% ;z-index: 1">
                    <div class="bookmark-in-video" style="background: #392c7d">
                    </div>
                    </div>
`
event_list.innerHTML += `<li class="list-group-item border-0 list${random_id}"><i class="fa-solid fa-trash" onclick="removeNotification('${random_id}')" style="color:#f66962"></i> <i class="fa-solid fa-pen" onclick="updateSelect('${random_id}')"></i> Select <sup class="badge bg-info">Event</sup> <span class="float-end">${document.querySelector('#timeline').innerHTML}</span>`
$('.select-wrapper').html('')
$('#select_modal').modal('hide')
 
}
function actionNow(_id,_type,_value) {
  is_select_mode =false
  video_state = false
  document.querySelector('.'+_id).style.display = 'none'
  play_video(video_play_icon)
  switch (_type) {
    case 'show_message':
       {
   let random_id = '_'+ makeid()
  video.currentTime = video.currentTime + 1
 parent_interactive.innerHTML+= `
 <div class="interactive_wrapper ${random_id}"> <div class="plan-box" >
        <div>
        <h6 style="color: #249c46 ; text-transform: capitalize">Message</h6>
        <p>${_value}</p>
        </div>
        </div>
</div>
` 
setTimeout(() => {
$('.'+random_id).remove()
},4000)       
      break;
       }
      case 'jump_timeline' : {
        video.currentTime = parseInt(_value)
        break
      }
  
    default:
      break;
  }

}
function updateSelect(_id) {
  current_update_select = _id;
  $('#update_select_modal').modal('show');
  document.querySelector('.update-select-wrapper').innerHTML = '';
  data_event[_id]['event'].map(e => {
    let random_id = '_'+ makeid()
  document.querySelector('.update-select-wrapper').innerHTML += `
<div class="curriculum-grid mt-4 ${random_id}">
                        <div class="curriculum-head">
                          <p class="chapter_name" contenteditable="">${e[Object.keys(e)[0]][0]}</p>
                          <a href="javascript:void(0);"><button class="btn text-white border-0" style="background:#ff4667" onclick="removeSelect('${random_id}')">Remove select</button></a> 
                        </div>
                        <div class="curriculum-info">
                          <div id="accordion-${random_id}">
   <div class="faq-grid" id="${random_id}"> 
                              <div class="faq-header">
                                <a class="collapsed faq-collapse" data-bs-toggle="collapse" href="#collapse_${random_id}">
                                  <i class="fas fa-align-justify"></i>
                                  <span contenteditable="" class="event_name">${e[Object.keys(e)[0]][1]}</span>
                                </a>
                              </div>
                              <div id="collapse_${random_id}" class="collapse" data-bs-parent="#accordion-one">
                                <div class="faq-body">
                                  <div class="add-article-btns">
                                    <div class="form-group">
                          <label class="add-course-label">Type event</label>
                          <select class="form-control select select${random_id}" value="${Object.keys(e)[0]}" onchange="handleTypeEvent('content${random_id}',this.value)">
                          <option value="show_message">Show message</option>
                          <option value="jump_timeline">Jump timeline</option>
                          <option value="send_link">Send a link</option>
                          <option value="increase_bloom">Increase Bloom Point</option>
                          <option value="decrease_bloom">Decrease Bloom Point</option>
                          </select>
                        </div>
                  <div class="form-group content${random_id}">
                    <input type="text" name="message" class="form-control message_select" placeholder="Enter value" value="${e[Object.keys(e)[0]][2]}">
                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>                           
                          </div>
                        </div>
                      </div>
  `;
  });
}
function handleUpdateSelect() {
let random_id = current_update_select;
let temp_type = [];
let temp_value = [];
data_event[random_id] = {
  type: 'select',
  start_time: data_event[random_id]['start_time'],
  duration: 1,
  class_name: random_id,
  event: [...document.querySelectorAll('.update-select-wrapper .curriculum-grid')].map(e => {
  temp_type.push(e.querySelector('select').value)
  temp_value.push(e.querySelector('input').value)
 return {[e.querySelector('select').value]: [e.querySelector('.chapter_name').innerHTML,e.querySelector('.event_name').innerHTML,e.querySelector('input').value]}
})
};
document.querySelector('.'+random_id).innerHTML= `
    <div class="plan-box" style="top:initial;bottom:1em">
        <div class="row">
        <h6 style="text-transform: capitalize" class="text-muted text-center">Please choose an option</h6>
        `+ 
        ([... document.querySelectorAll('.update-select-wrapper .chapter_name')].map((e,index) => ` <button class="btn col mx-1 btn-secondary" onclick="actionNow('${random_id}','${temp_type[index]}','${temp_value[index]}')">${e.innerHTML}</button>`)).join('')
        +`
        </div>
        </div>`;
$('#update_select_modal').modal('hide');
}
</script>
@endsection