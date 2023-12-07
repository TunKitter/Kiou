@php
    $route_name= (\Illuminate\Support\Facades\Route::currentRouteName());
@endphp
<div class="col-xl-3 col-md-4 theiaStickySidebar">
    <div class="settings-widget dash-profile mb-3">
        <div class="settings-menu p-0">
            <div class="profile-bg">
                <h5>Beginner</h5>
                <img src="{{ asset('assets/img/instructor-profile-bg.jpg') }}" alt>
                <div class="profile-img">
                    <a href="student-profile.html"><img
                            src="{{ asset('mentor/avatar/' . $mentor->image['avatar']) }}" alt></a>
                </div>
            </div>
            <div class="profile-group">
                <div class="profile-name text-center">
                    <h4><a href="#">{{ $mentor->name }}</a></h4>
                    <p>Mentor</p>
                </div>
                <div class="go-dashboard text-center"> <a href="{{route('course-add')}}" class="btn btn-primary">Create New Course</a>
                </div>
            </div>
        </div>
    </div>
    <div class="settings-widget account-settings">
        <div class="settings-menu">
            <h3>DASHBOARD</h3>
            <ul>
                
                <li class="nav-item {{$route_name == 'mentor-dashboard' ? 'active' : ''}}">
                    <a href="{{route('mentor-dashboard')}}" class="nav-link">
                        <i class="feather-home"></i> My Dashboard
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('mentor-profile')}}" class="nav-link">
                        <i class="feather-settings"></i> Edit Profile
                    </a>
                </li>
                <li class="nav-item {{$route_name == 'mentor-cp' ? 'active' : ''}}">
                    <a href="{{route('mentor-cp')}}" class="nav-link">
                        <i class="feather-star"></i> CP
                    </a>
                </li>
                <li class="nav-item {{$route_name == 'mentor-roadmap' ? 'active' : ''}}">
                    <a href="{{route('mentor-roadmap')}}" class="nav-link">
                        <i class="feather-pie-chart"></i> Roadmap
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>