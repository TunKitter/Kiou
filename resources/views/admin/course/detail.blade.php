@extends('admin.layout.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card p-0">
                    <div class="card-body p-0">
                        <div class="profile-content">
                            <ul class="nav nav-underline nav-justified gap-0">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" data-bs-target="#aboutme"
                                        type="button" role="tab" aria-controls="home" aria-selected="true"
                                        href="#aboutme">About</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#user-activities" type="button" role="tab" aria-controls="home"
                                        aria-selected="true" href="#user-activities">Watch</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" data-bs-target="#edit-profile"
                                        type="button" role="tab" aria-controls="home" aria-selected="true"
                                        href="#edit-profile">More</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" data-bs-target="#projects"
                                        type="button" role="tab" aria-controls="home" aria-selected="true"
                                        href="#projects">Action</a></li>
                            </ul>

                            <div class="tab-content m-0 p-4">
                                <div class="tab-pane active" id="aboutme" role="tabpanel" aria-labelledby="home-tab"
                                    tabindex="0">
                                    <div class="profile-desk">
                                        <img src="{{ asset('course/thumbnail/' . $course->image) }}"
                                            class="rounded rounded-circle">
                                        <br><br>
                                        <h5 class="text-uppercase fs-17 text-dark">{{ $course->name }}</h5>
                                        <div class="designation mb-4">{{ $course->description }}</div>
                                        {{-- <p class="text-muted fs-16">
                                                        I have 10 years of experience designing for the web, and
                                                        specialize
                                                        in the areas of user interface design, interaction design,
                                                        visual
                                                        design and prototyping. I’ve worked with notable startups
                                                        including
                                                        Pearl Street Software.
                                                    </p> --}}

                                        <h5 class="mt-4 fs-17 text-dark">Detail Information</h5>
                                        <table class="table table-condensed mb-0 border-top">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Complete Course Rate</th>
                                                    <td>
                                                        {{ $course->complete_course_rate }}/{{ $course->meta['total_lesson'] }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Category</th>
                                                    <td>
                                                        {{ $category_name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Total enrollment</th>
                                                    <td class="ng-binding">{{ $course->total_enrollment }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Mentor name</th>
                                                    <td class="ng-binding">{{ $course->mentor->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Price</th>
                                                    <td class="ng-binding">{{ $course->price }} $</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">View</th>
                                                    <td>
                                                        {{ $course->view }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Click</th>
                                                    <td>
                                                        {{ $course->click }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Total Time</th>
                                                    <td>
                                                        {{ round($course->meta['total_time'] / 60) }} hours
                                                        {{ $course->meta['total_time'] % 60 }} minutes
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Total Lesson</th>
                                                    <td>{{ $course->meta['total_lesson'] }} lessons</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Total Chapter</th>
                                                    <td>{{ $course->meta['total_chapter'] }} chapters</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Level</th>
                                                    <td>{{ $course->level->name }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- end profile-desk -->
                                </div> <!-- about-me -->

                                <!-- Activities -->
                                <div id="user-activities" class="tab-pane">
                                    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

                                    <link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}">
                                    <link rel="stylesheet"
                                        href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
                                    <link rel="stylesheet"
                                        href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

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
                                            color: #3bc0c3;
                                            transition-duration: 0.2s;
                                            cursor: pointer;
                                        }

                                        .controls i {
                                            margin-right: 0.5em;
                                        }

                                        .current-progress-video {
                                            width: 0%;
                                            height: 100%;
                                            background: #3bc0c3;
                                            position: absolute;
                                            top: 0;
                                            z-index: 100;
                                            border-radius: 10px
                                        }

                                        video::-webkit-media-controls-fullscreen-button,
                                        video::-webkit-media-controls-play-button,
                                        video::-webkit-media-controls-timeline,
                                        video::-webkit-media-controls-timeline-container,
                                        video::-webkit-media-controls-volume-slider,
                                        video::-webkit-media-controls-volume-slider-container,
                                        video::-webkit-media-controls-panel {
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
                                            top: -8em;
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
                                            color: #3bc0c3;
                                        }

                                        #progress {
                                            background: transparent;
                                            border: 7px solid #3bc0c3;
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
                                                        @foreach ($lessons as $key => $lesson)
                                                            @php
                                                                if ($loop->first) {
                                                                    $lesson_first = $lesson[0]->path;
                                                                    $name_first = $lesson[0]->name;
                                                                }
                                                            @endphp
                                                            <div class="course-card">
                                                                <h6 class="cou-title">
                                                                    <a class="collapsed" data-bs-toggle="collapse"
                                                                        href="#course_{!! $loop->index !!}"
                                                                        aria-expanded="false">{{ $chapter[$key] }}
                                                                        <span>{{ count($lesson) }} Lessons</span> </a>
                                                                </h6>
                                                                <div id="course_{!! $loop->index !!}"
                                                                    class="card-collapse collapse">
                                                                    <ul>
                                                                        @foreach ($lesson as $item)
                                                                            <li>
                                                                                <p>{{ $item->name }}</p>
                                                                                <div>
                                                                                    <i class="fa-solid fa-play"
                                                                                        style="color: #3bc0c3;"
                                                                                        onclick="playVideo('{{ $item->path }}','{{ $item->name }}')"></i>
                                                                                </div>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <br>
                                                    {{-- <p class="text-primary" id="timeline_feedback" style="display: none">45:02</p> --}}
                                                    {{-- <input type="text" class="form-control" placeholder="Enter your feedback" style="display: none" id="feedback"> --}}
                                                    {{-- <br> --}}
                                                    {{-- <button class="btn btn-primary d-block m-auto" onclick="reportForMentor(this)">Report for mentor</button> --}}
                                                </div>
                                                <div class="col-lg-8">

                                                    <div class="student-widget lesson-introduction">
                                                        <div class="lesson-widget-group">
                                                            <h4 id="title_video">Hello</h4>
                                                            <div class="introduct-video">
                                                                {{-- <a href="#"> --}}
                                                                {{-- <div class="play-icon">
                                                <i class="fa-solid fa-play" ></i>
                                                </div> --}}
                                                                {{-- <img class src="{{asset('assets/img/video-img-01.jpg')}}" id="video"> --}}

                                                                <div class="wrapper-video">
                                                                    <div class="rect interactive_wrapper"
                                                                        style="width: 20px;height: 20px;background: red;position:absolute;display:none;z-index:100;left:14%;top:15%"
                                                                        onclick="alert(99)"></div>
                                                                    <div class="parent_interactive position-absolute "
                                                                        style="left: 7%;bottom:4em;">
                                                                        <div class="interactive_wrapper"
                                                                            style="display: none">
                                                                            <div class="plan-box">
                                                                                <div>
                                                                                    <h6
                                                                                        style="color: #249c46 ; text-transform: capitalize">
                                                                                        Hello this is Tunkit</h6>
                                                                                    <p>Hello this is Tunkit</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="interactive_wrapper select_ideal"
                                                                            style="width: max-content;display: none">
                                                                            <div class="plan-box">
                                                                                <div>
                                                                                    <h6 style="text-transform: capitalize"
                                                                                        class="text-muted text-center">
                                                                                        Hello this is Tunkit</h6>
                                                                                    <button class="btn btn-secondary"
                                                                                        onclick="jumpVideo(300)">Hello this
                                                                                        is Tunkit</button>
                                                                                    <button class="btn btn-secondary"
                                                                                        onclick="jumpVideo()">Hello this is
                                                                                        Tunkit</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="interactive_wrapper"
                                                                            style="display: none">
                                                                            <div class="plan-box">
                                                                                <div>
                                                                                    <h6
                                                                                        style="color: #249c46 ; text-transform: capitalize">
                                                                                        Hello this is Tunkit</h6>
                                                                                    <p>Hello this is Tunkit 3</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div id="progress"></div> <video
                                                                        ondblclick="fullscreenVideo()" id="video"
                                                                        src="https://storage.googleapis.com/kiou_lesson/tunkit/tunkit.m3u8"
                                                                        width="100%"></video>
                                                                    <div class="video-player">

                                                                        <div class="controls">
                                                                            <i class="fa-solid fa-backward"
                                                                                onclick="backWardVideo()"></i>
                                                                            <i class="fa-solid fa-play"
                                                                                id="video-play-icon"
                                                                                onclick="play_video(this)"></i>
                                                                            <i class="fa-solid fa-forward"
                                                                                onclick="forwardVideo()"></i>
                                                                            <i style="font-style: normal;font-size: 0.9em"
                                                                                id="timeline">00:00</i>
                                                                        </div>
                                                                        <div class="progress-video"
                                                                            style="flex-grow: 1; position: relative;">
                                                                            <div style="height: 10px;background: #fff;border-radius: 10px;"
                                                                                onclick="changeVideoTime(this)">
                                                                                <div class="current-progress-video"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="controls"
                                                                            style="display: flex;align-items: center;">
                                                                            <i class="fa-solid feather-settings"
                                                                                id="setting" onclick="displayQuality()">
                                                                                <div class="video-quality">
                                                                                    <ul>
                                                                                        <li class="fw-light"
                                                                                            onclick="settingVideo(4,this)">
                                                                                            1080p</li>
                                                                                        <li class="fw-light"
                                                                                            onclick="settingVideo(3,this)">
                                                                                            720p</li>
                                                                                        <li class="fw-light"
                                                                                            onclick="settingVideo(2,this)">
                                                                                            480p</li>
                                                                                        <li class="fw-light"
                                                                                            onclick="settingVideo(1,this)">
                                                                                            360p</li>
                                                                                    </ul>
                                                                                </div>
                                                                            </i>
                                                                            <i class="fa-solid feather-file-text"
                                                                                onclick="changeCaption(this)"></i>
                                                                            <i class="fa-solid feather-volume-2"
                                                                                id="volume"></i>
                                                                            <div style="width: 80px;height:10px;background: white;margin:0 15px 0 -2px;border-radius:12px"
                                                                                onclick="changeVideoVolume(this)">
                                                                                <div style="width:100%;height:100%;background: #3bc0c3;border-radius: 12px"
                                                                                    id="current-volume"></div>
                                                                            </div>
                                                                            <i class="fa-solid feather-maximize"
                                                                                onclick="fullscreenVideo()"></i>
                                                                        </div>
                                                                    </div>
                                                                    <p class="bg-black w-100 text-white text-center position-absolute p-2"
                                                                        style="bottom: 1.5em;z-index: 1; cursor: pointer;"
                                                                        id="subtitle" onmouseover="hoverCaption(this)"
                                                                        onmouseout="hoverOutCaption(this)"></p>
                                                                </div>
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

                                        function play_video(obj) {
                                            if (!video_state) {
                                                video.play();
                                                obj.classList.remove('fa-play');
                                                obj.classList.add('fa-pause');
                                                video_state = true
                                            } else {
                                                video.pause();
                                                obj.classList.remove('fa-pause');
                                                obj.classList.add('fa-play');
                                                video_state = false
                                            }
                                        }
                                        var videoInterval;
                                        video.onplay = function() {
                                            videoInterval = setInterval(() => {
                                                let percent = (video.currentTime / video.duration) * 100;
                                                current_progress_video.style.width = percent + '%';
                                            }, 0)
                                        }
                                        video.onpause = function() {
                                            clearInterval(videoInterval);
                                        }
                                        video.onended = function() {
                                            clearInterval(videoInterval)
                                            video_play_icon.classList.remove('fa-pause');
                                            video_play_icon.classList.add('fa-play');
                                            video_state = false

                                        }

                                        function fullscreenVideo() {
                                            is_fullscreen ? document.exitFullscreen() : wrapper_video.requestFullscreen();
                                            is_fullscreen = !is_fullscreen;
                                        }

                                        function changeVideoTime(obj) {
                                            video_state = false
                                            play_video(video_play_icon)
                                            video.currentTime = (window.event.pageX - obj.getBoundingClientRect().left) / obj.clientWidth * video.duration
                                        }

                                        function changeVideoVolume(obj) {
                                            let temp_volume = (window.event.pageX - obj.getBoundingClientRect().left) / obj.clientWidth * 100
                                            current_volume.style.width = temp_volume + '%';
                                            video.volume = temp_volume / 100
                                        }
                                    </script>
                                    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
                                    <script>
                                        if (Hls.isSupported()) {
                                            var hls = new Hls({
                                                maxBufferLength: 5,
                                                maxBufferHole: 0,
                                                enableWorker: true
                                            });
                                            hls.loadSource('');
                                            hls.attachMedia(video);
                                            const progress = document.querySelector('#progress')

                                            hls.on(window.Hls.Events.FRAG_BUFFERED, () => {
                                                progress.style.display = 'none'
                                            })
                                            hls.on(window.Hls.Events.FRAG_LOADING, () => {
                                                progress.style.display = 'block'
                                            })

                                        }

                                        function backWardVideo() {
                                            if (video.currentTime > 5) {

                                                video.currentTime -= 5;
                                            }
                                        }

                                        function forwardVideo() {
                                            if (video.currentTime < video.duration - 5) {

                                                video.currentTime += 5;
                                            }
                                        }
                                        var old_quality;

                                        function settingVideo(quality, obj) {
                                            obj.style.color = '#3bc0c3';
                                            if (old_quality) {
                                                old_quality.style.color = 'black';
                                            }
                                            old_quality = obj
                                            hls.currentLevel = quality;
                                        }
                                        var video_quality = document.querySelector('.video-quality');

                                        function displayQuality() {
                                            let temp_video_quality = video_quality.style.display
                                            video_quality.style.display = temp_video_quality == 'block' ? 'none' : 'block'
                                        }
                                    </script>

                                </div>

                                <!-- settings -->
                                <div id="edit-profile" class="tab-pane">
                                    <div class="user-profile-content">
                                        <form>
                                            <div class="row row-cols-sm-2 row-cols-1">
                                                <div class="mb-2">
                                                    <label class="form-label" for="FullName">Full
                                                        Name</label>
                                                    <input type="text" value="John Doe" id="FullName"
                                                        class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="Email">Email</label>
                                                    <input type="email" value="first.last@example.com" id="Email"
                                                        class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="web-url">Website</label>
                                                    <input type="text" value="Enter website url" id="web-url"
                                                        class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="Username">Username</label>
                                                    <input type="text" value="john" id="Username"
                                                        class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="Password">Password</label>
                                                    <input type="password" placeholder="6 - 15 Characters" id="Password"
                                                        class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="RePassword">Re-Password</label>
                                                    <input type="password" placeholder="6 - 15 Characters"
                                                        id="RePassword" class="form-control">
                                                </div>
                                                <div class="col-sm-12 mb-3">
                                                    <label class="form-label" for="AboutMe">About Me</label>
                                                    <textarea style="height: 125px;" id="AboutMe" class="form-control">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</textarea>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="ri-save-line me-1 fs-16 lh-1"></i> Save</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- profile -->
                                <div id="projects" class="tab-pane">
                                    <div class="row m-t-10">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="header-title">Modal with Pages</h4>
                                                    <p class="text-muted mb-0">Examples of custom modals.</p>
                                                </div>
                                                <div class="card-body">
                                                    <!-- Signup modal content -->
                                                    <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                                                                    <h3>Course approval</h3>
                                                                    </div>
                
                                                                    <form class="ps-3 pe-3" action="{{route('admin.refuse-course-admin', $course->_id)}}">
                                                                        <div class="mb-3">
                                                                            <label for="username" class="form-label">Name course</label>
                                                                            <input id="AboutMe" class="form-control" value="{{$course->name}}" readonly/>
                                               
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="username" class="form-label">Response content</label>
                                                                            <textarea style="height: 70px;" id="AboutMe" class="form-control" name="res_content"></textarea>
                                               
                                                                        </div>
                
                                                                        <div class="mb-3">
                                                                            <button class="btn btn-danger" type="submit">Refuse</button>
                                                                        </div>
                                                                    </form>
                
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                
                
                                                    <div class="d-flex flex-wrap gap-2">
                                                        <!-- Sign Up modal -->
                                                        <form method="POST" action="{{ route('admin.accept-course-admin', $course->_id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-primary">Accept</button>
                                                        </form>
                                                        <!-- Log In modal -->
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#signup-modal">Refuse</button>
                                                    </div> 
                                                </div> <!-- end card-body -->
                                            </div> <!-- end card-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

    </div>
    <script src="assets/js/vendor.min.js"></script>

    <script src="assets/vendor/chart.js/chart.min.js"></script>

    <script src="assets/js/pages/profile.init.js"></script>
    <script>
        var title = document.getElementById('title_video');

        function playVideo(url, text) {
            hls.loadSource(url);
            title.innerHTML = text;
        }
        var subtitle = document.querySelector('#subtitle');
        var is_caption_on = false
        subtitle.style.display = 'none';
        var subtitle_result = null
        fetch("{{ asset('course/lesson/subtitle/tunkit.srt') }}").then(response => response.text()).then(data => {
            let formData = new FormData();
            formData.append('srt', data);
            fetch("https://kiou-subtitle-2-45833d111266.herokuapp.com/api/subtitle", {
                method: "POST",
                body: formData
            }).then(response => response.json()).then(result => {
                subtitle_result = result['message']

            })
        });

        function changeCaption(obj) {
            is_caption_on = !is_caption_on
            if (is_caption_on) {
                subtitle.style.display = 'block'
                obj.style.color = '#ff4667';
            } else {
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
        video.onplaying = function() {
            if (subtitle_result) {
                let current_subtitle = [0, 0]
                setInterval(() => {
                    if (video.currentTime <= current_subtitle[0] || video.currentTime >= current_subtitle[1]) {

                        let temp_subtitle = subtitle_result.find(e => (e.start <= video.currentTime && e.end >=
                            video.currentTime))
                        if (is_caption_on) {
                            temp_subtitle ? subtitle.style.display = 'block' : subtitle.style.display = 'none'
                        }
                        current_subtitle = [temp_subtitle.start, temp_subtitle.end]
                        if (temp_subtitle) {
                            // let temp_ =''
                            // temp_subtitle.content.split(' ').map(e => {
                            // let replace_e = e.replace("'",'___');
                            // temp_ += `<span onclick='lookUpWord(\`${replace_e}\`,this)'>${e}</span> `
                            // })
                            subtitle.innerHTML = temp_subtitle.content
                        }
                    }
                }, 1000);
            }
        }
        video.addEventListener('playing', () => {
            let arr = [
                [7, 10],
                [12, 16],
                [20, 22]
            ]
            let current_index = 0
            // let start_ = arr[current_index][0]
            // let end_ = arr[current_index][1]
            setInterval(() => {
                let minutes = Math.floor((parseInt(video.currentTime) % 3600) / 60);
                let formattedMinutes = minutes < 10 ? `0${minutes}` : minutes;
                let seconds = (parseInt(video.currentTime) % 60).toFixed(0);
                let formattedSeconds = seconds < 10 ? `0${seconds}` : seconds;
                document.querySelector('#timeline').innerHTML = `${formattedMinutes}:${formattedSeconds}`
                $('.interactive_wrapper').hide()
                let temp_ = arr.find((item, index) => {
                    current_index = index
                    return video.currentTime >= item[0] && video.currentTime <= item[1]
                })
                if (temp_) {
                    let temp_interact = $('.interactive_wrapper:eq(' + current_index + ')')
                    temp_interact.show()
                    if (temp_interact.hasClass('select_ideal')) {
                        video_state = true;
                        play_video(video_play_icon)
                    } else if (temp_interact.hasClass('rect')) {
                        // temp_interact.css('left',arr[current_index][0] + 'px')
                        // temp_interact.css('top',arr[current_index][1] + 'px')
                        // video_state = false;
                        // play_video(video_play_icon)
                    }
                    // else {
                    // video_state = false;
                    // play_video(video_play_icon)
                    // }
                } else {
                    $('.interactive_wrapper').hide()

                }
            }, 1000);
        })

        function jumpVideo(timeline) {
            if (!timeline) {
                timeline = video.currentTime;
            }
            video.currentTime = timeline
            video_state = false;
            play_video(video_play_icon)
        }
        var feedback = document.getElementById('feedback');
        var timeline_feedback = document.getElementById('timeline_feedback');
        var is_submit = false
    </script>
@endsection
