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
.plan-box.send_link_type {
  animation: show_message_wingly 1s forwards
}
@keyframes show_message_wingly {
  0% {
    transform: translateX(0%);
  }
  100% {
    transform: translateX(-20%);
  }
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
<div class="modal fade" id="axis_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title_modal">Create a new event of the axis</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
    <div class="modal-body">
      <div class="curriculum-grid mt-4 _oiNN">
        <div class="curriculum-head">
          <p class="chapter_name_axis" contenteditable="">Enter select title</p>
        </div>
        <div class="curriculum-info">
          <div id="accordion-_oiNN">
<div class="faq-grid"> 
              <div class="faq-header">
                <a class="faq-collapse collapsed" data-bs-toggle="collapse" href="#collapse__PYiJ" aria-expanded="false">
                  <i class="fas fa-align-justify"></i>
                  <span contenteditable="" class="event_name_axis">Enter event name</span>
                </a>
              </div>
              <div id="collapse__PYiJ" class="collapse" data-bs-parent="#accordion-one" style="">
                <div class="faq-body">
                  <div class="add-article-btns">
                    <div class="form-group">
          <label class="add-course-label">Type event</label>
          <select class="form-control select_axis" onchange="handleTypeEvent('content_PYiJ',this.value)">
          <option value="show_message">Show message</option>
          <option value="jump_timeline">Jump timeline</option>
          <option value="send_link">Send a link</option>
          <option value="increase_bloom">Increase Bloom Point</option>
          <option value="decrease_bloom">Decrease Bloom Point</option>
          </select>
        </div>
  <div class="form-group content_PYiJ">
    <input type="text" name="message" class="form-control message_select" placeholder="Enter value">
    <br>
    </div>
                  </div>
                </div>
              </div>
            </div>                           
          </div>
        </div>
      </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addNewAxis()">Confirm</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="axis_update_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title_modal">Update axis</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
    <div class="modal-body">
      <div class="curriculum-grid mt-4 _oiNNss">
        <div class="curriculum-head">
          <p class="chapter_name_axis_update" contenteditable="">Enter select title</p>
        </div>
        <div class="curriculum-info">
          <div id="accordion-_oiNNss">
<div class="faq-grid"> 
              <div class="faq-header">
                <a class="faq-collapse collapsed" data-bs-toggle="collapse" href="#collapse__PYiJss" aria-expanded="false">
                  <i class="fas fa-align-justify"></i>
                  <span contenteditable="" class="event_name_axis_update">Enter event name</span>
                </a>
              </div>
              <div id="collapse__PYiJss" class="collapse" data-bs-parent="#accordion-one" style="">
                <div class="faq-body">
                  <div class="add-article-btns">
                    <div class="form-group">
          <label class="add-course-label">Type event</label>
          <select class="form-control select_axis_update" onchange="handleTypeEvent('content_PYiJss',this.value)">
          <option value="show_message">Show message</option>
          <option value="jump_timeline">Jump timeline</option>
          <option value="send_link">Send a link</option>
          <option value="increase_bloom">Increase Bloom Point</option>
          <option value="decrease_bloom">Decrease Bloom Point</option>
          </select>
        </div>
  <div class="form-group content_PYiJ">
    <input type="text" name="message" class="form-control message_select" placeholder="Enter value">
    <br>
    </div>
                  </div>
                </div>
              </div>
            </div>                           
          </div>
        </div>
      </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="handleAddNewAxis()">Confirm</button>
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
<div class="rect interactive_wrapper" style="width: 20px;height: 20px;background: red;position:absolute;z-index:100;display:none"></div>
<div class="parent_interactive position-absolute" style="left: 7%;bottom:4em;">
 </div>
    <div id="progress" ></div> <video ondblclick="fullscreenVideo()" id="video" src="https://storage.googleapis.com/kiou_lesson/tunkit/tunkit.m3u8" style="width: 100%;min-width: 50vw"></video><div class="video-player">
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
var rect_ = document.querySelector('.rect.interactive_wrapper');
var is_confirm_axis = false
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
        case 'axis' : {
          rect_.style.display = 'block'
          setTimeout(() => {
            rect_.style.display = 'none'
          },3400)
          rect_.style.left = data_event[i]['x']
          rect_.style.top = data_event[i]['y']
          rect_.onclick = function(){
            actionNow(i, Object.keys(data_event[i]['event'])[0], data_event[i]['event'][Object.keys(data_event[i]['event'])[0]][2],data_event[i]['event'][Object.keys(data_event[i]['event'])[0]][4],data_event[i]['event'][Object.keys(data_event[i]['event'])[0]][3])
          }
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
          rect_.style.display = 'block'
          is_confirm_axis = false
          rect_.onclick = function() {
            is_confirm_axis = true
            $('#axis_modal').modal('show')
          }
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
      $('.'+_class).html(`<input type="text" name="message" class="form-control message_select" placeholder="Enter value" /><br><input type="number" name="duration_sendlink" class="form-control duration_sendlink" placeholder="Enter duration" style="margin-top: -0.5em" />`)
        break
    }
    case 'increase_bloom': {
      $('.'+_class).html(`<input type="number" name="bloom_point" class="form-control bloom_point" placeholder="Enter a value" />`)
      break;
    }
    case 'decrease_bloom': {
      $('.'+_class).html(`<input type="number" name="bloom_point" class="form-control bloom_point" placeholder="Enter a value" />`)
      break;
    }
  }
}
function handleAddNewSelect() {
let random_id = '_'+makeid()
let temp_type = []
let temp_value = []
let random_ids = []
data_event[random_id] = {
  type: 'select',
  start_time: parseInt(video.currentTime),
  duration: 1,
  class_name: random_id,
  event: [...document.querySelectorAll('.select-wrapper .curriculum-grid')].map(e => {
  temp_type.push(e.querySelector('select').value)
  temp_value.push(e.querySelector('input').value)
  let type_action = e.querySelector('select').value
  if(type_action == 'send_link'){
    let random_id2 = '_'+makeid()
  random_ids.push(random_id2)
    let formData = new FormData();
    let duration_sendlink = e.querySelector('input').value
  console.log(duration_sendlink,duration_sendlink.substring(duration_sendlink.lastIndexOf('/')+1));
  formData.append('slug', duration_sendlink.substring(duration_sendlink.lastIndexOf('/')+1));
  fetch('{{route("course-detail-plain-data")}}', {
    method: 'POST',
    body: formData
  }).then(res => res.json()).then(data => {
 
    parent_interactive.innerHTML+= `
 <div class="interactive_wrapper ${random_id2}" style="display: none"> <div class="plan-box send_link_type p-0 px-2 pt-2" >
        <div>
        <h6 style="color: #249c46 ; text-transform: capitalize pt-2">Video course link</h6>
        <div class="col-lg-12 col-md-12 d-flex">
<div class="course-box course-design list-course d-flex border-0">
<div class="product">
<div class="product-img">
<a href="">
<img class="img-fluid" alt src="{{ asset('course/thumbnail/')}}/${data.data.image}">
</a>
<div class="price">
<h3>${data.data.price} <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="head-course-title">
<h3 class="title">${data.data.name}</h3>
<div class="all-btn all-category d-flex align-items-center">
<a href="#" class="btn btn-primary">See detail</a>
</div>
</div>
<div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="{{asset('assets/img/icon/icon-01.svg')}}" alt>
<p>${data.data.meta['total_lesson']} Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="{{asset('assets/img/icon/icon-02.svg')}}" alt>
<p>${(parseInt(data.data.meta['total_time'])/60).toFixed()}hr ${parseInt(data.data.meta['total_time'])%60}min</p>
</div>
</div>
<div class="rating">
<span class="d-inline-block average-rating"><span>${data.data.complete_course_rate}</span> <span>(${data.data.total_enrollment} enrolled)</span></span>
</div>

<div class="course-group d-flex mb-0">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user2.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">${data.mentor_name}</a></h4>
<p>Instructor</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
        </div>
        </div>
</div>
`;
  })
 return {[type_action]: [e.querySelector('.chapter_name').innerHTML,e.querySelector('.event_name').innerHTML,e.querySelector('input').value,e.querySelector('.duration_sendlink').value,random_ids[0]]}
  }
  else {
  return {[type_action]: [e.querySelector('.chapter_name').innerHTML,e.querySelector('.event_name').innerHTML,e.querySelector('input').value]}   
  }

})
}
parent_interactive.innerHTML+= `
<div class="interactive_wrapper select_ideal ${random_id}" style="width: max-content;display: none">
    <div class="plan-box" style="top:initial;bottom:1em">
        <div class="row">
        <h6 style="text-transform: capitalize" class="text-muted text-center">Please choose an option</h6>
        `+ 
        ([... document.querySelectorAll('.select-wrapper .chapter_name')].map((e,index) => ` <button class="btn col mx-1 btn-secondary" onclick="actionNow('${random_id}','${temp_type[index]}','${temp_value[index]}','${random_ids[0]}')">${e.innerHTML}</button>`)).join('')
        +`
        </div>
        </div>
</div>
`
delete random_ids[0]
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
function actionNow(_id,_type,_value,_id_link,time_duration) {
rect_.onclick = function() {
  is_confirm_axis = true
  $('#axis_modal').modal('show')
}
  is_select_mode =false
  video_state = false
  if(document.querySelector('.'+_id)){
  document.querySelector('.'+_id).style.display = 'none'
  }
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
    case 'send_link' : {
    let random_id = '_'+ makeid()
  video.currentTime = video.currentTime + 1
  // data_event[_id]['event'].find(e => e['send_link'][4] == _id_link)
  document.querySelector('.'+_id_link).style.display = 'block'
  let aaav = ''
  if(!time_duration) {
    let aaav = data_event[_id]['event'].find(e => {
 if(e['send_link']){
   return e['send_link'][4] == _id_link
 } 
 return false 
})['send_link'][3]
console.log(aaav);
  }
  else {
    aaav = time_duration
  }
 
setTimeout(() => {
$('.'+_id_link).css('display','none')
},parseInt(aaav)*1000);
      break;
  }
    case 'increase_bloom' : {
    let random_id = '_'+ makeid()
  video.currentTime = video.currentTime + 1;
 parent_interactive.innerHTML+= `
 <div class="interactive_wrapper ${random_id}"> <div class="plan-box" >
        <div>
        <h6 style="text-transform: capitalize">Notification<sup class="badge badge-info">Server</sup></h6>
        <p style="color: #249c46">+${_value} Point</p>
        </div>
        </div>
</div>
` 
setTimeout(() => {
$('.'+random_id).remove()
},4000)       
      break;
  }
  case 'decrease_bloom' :
{
    let random_id = '_'+ makeid()
  video.currentTime = video.currentTime + 1
 parent_interactive.innerHTML+= `
 <div class="interactive_wrapper ${random_id}"> <div class="plan-box" >
        <div>
        <h6 style="text-transform: capitalize">Notification<sup class="badge badge-info">Server</sup></h6>
        <p style="color: #f66962">-${_value} Point</p>
        </div>
        </div>
</div>
` 
setTimeout(() => {
$('.'+random_id).remove()
},4000)       
      break;
  }
  };

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
                          <select class="form-control select select${random_id}" onchange="handleTypeEvent('content${random_id}',this.value)">
                          <option value="show_message" ${Object.keys(e)[0] == "show_message" ? 'selected' : ''}>Show message</option>
                          <option value="jump_timeline" ${Object.keys(e)[0] == "jump_timeline" ? 'selected' : ''}>Jump timeline</option>
                          <option value="send_link" ${Object.keys(e)[0] == "send_link" ? 'selected' : ''}>Send a link</option>
                          <option value="increase_bloom" ${Object.keys(e)[0] == "increase_bloom" ? 'selected' : ''}>Increase Bloom Point</option>
                          <option value="decrease_bloom" ${Object.keys(e)[0] == "decrease_bloom" ? 'selected' : ''}>Decrease Bloom Point</option>
                          </select>
                        </div>
                  <div class="form-group content${random_id}">
                    <input type="text" name="message" class="form-control message_select" placeholder="Enter value" value="${e[Object.keys(e)[0]][2]}">
                    ${Object.keys(e)[0] == "send_link" ? `<br><input type="number" name="duration_sendlink" class="form-control duration_sendlink" placeholder="Enter duration" style="margin-top: -0.5em" value="${e[Object.keys(e)[0]][3]}">` : ''}
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
let temp_data_event = data_event[random_id]['event'].filter(e => {
  return e['send_link'];
}).map(i => i['send_link'][4]);
console.log(temp_data_event);
data_event[random_id] = {
  type: 'select',
  start_time: data_event[random_id]['start_time'],
  duration: 1,
  class_name: random_id,
  event: [...document.querySelectorAll('.update-select-wrapper .curriculum-grid')].map(e => {
  temp_type.push(e.querySelector('select').value)
  temp_value.push(e.querySelector('input').value)
  let type_action = e.querySelector('select').value
  if(type_action == 'send_link'){
 return {[type_action]: [e.querySelector('.chapter_name').innerHTML,e.querySelector('.event_name').innerHTML,e.querySelector('input').value,e.querySelector('.duration_sendlink').value,temp_data_event[0]]}
  }
  else {
  return {[e.querySelector('select').value]: [e.querySelector('.chapter_name').innerHTML,e.querySelector('.event_name').innerHTML,e.querySelector('input').value]}   
  }

})
};
document.querySelector('.'+random_id).innerHTML= `
    <div class="plan-box" style="top:initial;bottom:1em">
        <div class="row">
        <h6 style="text-transform: capitalize" class="text-muted text-center">Please choose an option</h6>
        `+ 
        ([... document.querySelectorAll('.update-select-wrapper .chapter_name')].map((e,index) => ` <button class="btn col mx-1 btn-secondary" onclick="actionNow('${random_id}','${temp_type[index]}','${temp_value[index]}','${temp_data_event[0]}')">${e.innerHTML}</button>`)).join('')
        +`
        </div>
        </div>`;
delete temp_data_event[0];
$('#update_select_modal').modal('hide');
}
var setint  = '';
$(document).ready(function() {
var val = 0;
$('.rect.interactive_wrapper').on('mousedown',function (e) {
   clearInterval(setint);
   val = 0;
   setint = setInterval(function () {
       $("#putdata").val(++val);
   },100);
});
$('.rect.interactive_wrapper').on("mouseleave mouseup", function () {
   val = 0;
   $("#putdata").val(val);
   clearInterval(setint);
});
})  
const element = document.querySelector('.wrapper-video');
const indicator = document.querySelector('.rect');
element.addEventListener('mousemove', (event) => {
if(!is_confirm_axis){ 
    const elementRect = element.getBoundingClientRect();
    const mouseX = event.clientX - elementRect.left;
    const mouseY = event.clientY - elementRect.top;

    const percentageX = (mouseX / elementRect.width) * 100;
    const percentageY = (mouseY / elementRect.height) * 100;

    indicator.style.left = `${percentageX}%`;
    indicator.style.top = `${percentageY}%`;
}
  });
rect_.onclick = function() {
  is_confirm_axis = true
  $('#axis_modal').modal('show')
}
function addNewAxis() {
let random_id = '_' + makeid();
event_list.innerHTML += `<li class="list-group-item border-0 list${random_id}"><i class="fa-solid fa-trash" onclick="removeNotification('${random_id}')" style="color:#f66962"></i> <i class="fa-solid fa-pen" onclick="updateAxis('${random_id}')"></i> Show notification <sup class="badge bg-info">Event</sup> <span class="float-end">${document.querySelector('#timeline').innerHTML}</span>`
  let select_type = document.querySelector('.select_axis').value
  let content_axis = ''
  switch (select_type) {
    case 'show_message': {
      content_axis = {'show_message':[document.querySelector('.chapter_name_axis').innerHTML,document.querySelector('.event_name_axis').innerHTML,document.querySelector('#axis_modal .message_select').value]}
      break;
    }
  case 'jump_timeline': {
    content_axis = {'jump_timeline':[document.querySelector('.chapter_name_axis').innerHTML,document.querySelector('.event_name_axis').innerHTML,document.querySelector('#axis_modal .message_select').value]}
    break
  }
  case 'send_link': {
    let random_id2 = '_'+makeid()
    let formData = new FormData();
    let duration_sendlink = document.querySelector('#axis_modal .message_select').value
  formData.append('slug', duration_sendlink.substring(duration_sendlink.lastIndexOf('/')+1));
  fetch('{{route("course-detail-plain-data")}}', {
    method: 'POST',
    body: formData
  }).then(res => res.json()).then(data => {
    parent_interactive.innerHTML+= `
 <div class="interactive_wrapper ${random_id2}" style="display: none"> <div class="plan-box send_link_type p-0 px-2 pt-2" >
        <div>
        <h6 style="color: #249c46 ; text-transform: capitalize pt-2">Video course link</h6>
        <div class="col-lg-12 col-md-12 d-flex">
<div class="course-box course-design list-course d-flex border-0">
<div class="product">
<div class="product-img">
<a href="">
<img class="img-fluid" alt src="{{ asset('course/thumbnail/')}}/${data.data.image}">
</a>
<div class="price">
<h3>${data.data.price} <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="head-course-title">
<h3 class="title">${data.data.name}</h3>
<div class="all-btn all-category d-flex align-items-center">
<a href="#" class="btn btn-primary">See detail</a>
</div>
</div>
<div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="{{asset('assets/img/icon/icon-01.svg')}}" alt>
<p>${data.data.meta['total_lesson']} Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="{{asset('assets/img/icon/icon-02.svg')}}" alt>
<p>${(parseInt(data.data.meta['total_time'])/60).toFixed()}hr ${parseInt(data.data.meta['total_time'])%60}min</p>
</div>
</div>
<div class="rating">
<span class="d-inline-block average-rating"><span>${data.data.complete_course_rate}</span> <span>(${data.data.total_enrollment} enrolled)</span></span>
</div>

<div class="course-group d-flex mb-0">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user2.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">${data.mentor_name}</a></h4>
<p>Instructor</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
        </div>
        </div>
</div>
`;
    content_axis = { 'send_link' : [document.querySelector('.chapter_name_axis').innerHTML,document.querySelector('.event_name_axis').innerHTML,document.querySelector('#axis_modal .message_select').value,document.querySelector('#axis_modal .duration_sendlink').value,random_id2]};
    data_event[random_id] = {
        type: 'axis',
        class_name: random_id,
        start_time: parseInt(video.currentTime),
        duration: 3.4,
        x: parseFloat(indicator.style.left),
        y:parseFloat(indicator.style.top),
        event: content_axis
    }
  })
  break
  }
  case 'increase_bloom': {
    content_axis = {'increase_bloom':[document.querySelector('.chapter_name_axis').value,document.querySelector('.event_name_axis').value,document.querySelector('#axis_modal .bloom_point').value]}
    break
  }
  case 'decrease_bloom': {
    content_axis = {'decrease_bloom':[document.querySelector('.chapter_name_axis').value,document.querySelector('.event_name_axis').value,document.querySelector('#axis_modal .bloom_point').value]}
    break
  }
  }
  if(select_type != 'send_link'){
    data_event[random_id] = {
        type: 'axis',
        class_name: random_id,
        start_time: parseInt(video.currentTime),
        duration: 3.4,
        x: parseFloat(indicator.style.left),
        y:parseFloat(indicator.style.top),
        event: content_axis
    }
  }
$('#axis_modal').modal('hide')
document.querySelector('#bookmarks').innerHTML+= `
                <div class="bookmark-in-video-wrapper bookmark_${parseInt(video.currentTime)} bookmark${random_id}" style="width: ${100/video.duration * video.currentTime}% ;z-index: 1">
                    <div class="bookmark-in-video" style="background: #ffb534">
                    </div>
                    </div>
`
rect_.style.display = 'none'
}
var current_id_axis = ''
function updateAxis(_id) {

  current_id_axis = _id
  $('#axis_update_modal').modal('show')
  switch (Object.keys(data_event[_id]['event'])[0]) {
    case 'show_message':
      case 'jump_timeline' :  
      {
        document.querySelector('.chapter_name_axis_update').innerHTML = data_event[_id]['event'][Object.keys(data_event[_id]['event'])[0]][0]
        document.querySelector('.event_name_axis_update').innerHTML = data_event[_id]['event'][Object.keys(data_event[_id]['event'])[0]][1]       
        document.querySelector('#axis_update_modal .message_select').value = data_event[_id]['event'][Object.keys(data_event[_id]['event'])[0]][2]
      break
    }

  }
}
function handleAddNewAxis() {

}
</script>
@endsection