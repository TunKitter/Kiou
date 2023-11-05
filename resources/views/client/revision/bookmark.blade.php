@extends('client.layouts.master')
@section('content')
<style>
    .table-responsive {
        overflow: hidden !important;
    }
</style>
<div class="page-content">
<div class="container">
<div class="row">
{{-- <div class="col-xl-3 col-lg-4 col-md-12 theiaStickySidebar"> --}}
{{-- <div class="settings-widget dash-profile">
<div class="settings-menu p-0">
<div class="profile-bg">
<h5>Beginner</h5>
<img src="assets/img/instructor-profile-bg.jpg" alt>
<div class="profile-img">
<a href="instructor-profile.html"><img src="assets/img/user/user15.jpg" alt></a>
</div>
</div>
<div class="profile-group">
<div class="profile-name text-center">
<h4><a href="instructor-profile.html">Jenny Wilson</a></h4>
<p>Instructor</p>
</div>
<div class="go-dashboard text-center">
<a href="add-course.html" class="btn btn-primary">Create New Course</a>
</div>
</div>
</div>
</div> --}}
{{-- <div class="settings-widget account-settings">
<div class="settings-menu">
<h3>DASHBOARD</h3>
<ul>
<li class="nav-item ">
<a href="instructor-dashboard.html" class="nav-link">
<i class="feather-home"></i> My Dashboard
</a>
</li>
<li class="nav-item active">
<a href="instructor-course.html" class="nav-link">
<i class="feather-book"></i> My Courses
</a>
</li>
<li class="nav-item">
<a href="instructor-reviews.html" class="nav-link">
<i class="feather-star"></i> Reviews
</a>
</li>
<li class="nav-item">
<a href="instructor-earnings.html" class="nav-link">
<i class="feather-pie-chart"></i> Earnings
</a>
</li>
<li class="nav-item">
<a href="instructor-orders.html" class="nav-link">
<i class="feather-shopping-bag"></i> Orders
</a>
</li>
<li class="nav-item">
<a href="instructor-student-grid.html" class="nav-link">
<i class="feather-users"></i> Students
</a>
</li>
<li class="nav-item">
<a href="instructor-payouts.html" class="nav-link">
<i class="feather-dollar-sign"></i> Payouts
</a>
</li>
<li class="nav-item">
<a href="instructor-tickets.html" class="nav-link">
<i class="feather-server"></i> Support Tickets
</a>
</li>
</ul>
<div class="instructor-title">
<h3>ACCOUNT SETTINGS</h3>
</div>
<ul>
<li class="nav-item">
<a href="instructor-edit-profile.html" class="nav-link ">
<i class="feather-settings"></i> Edit Profile
</a>
</li>
<li class="nav-item">
<a href="instructor-security.html" class="nav-link">
<i class="feather-user"></i> Security
</a>
</li>
<li class="nav-item">
<a href="instructor-social-profiles.html" class="nav-link">
<i class="feather-refresh-cw"></i> Social Profiles
</a>
</li>
<li class="nav-item">
<a href="instructor-notification.html" class="nav-link">
<i class="feather-bell"></i> Notifications
</a>
</li>
<li class="nav-item">
<a href="instructor-profile-privacy.html" class="nav-link">
<i class="feather-lock"></i> Profile Privacy
</a>
</li>
<li class="nav-item">
<a href="instructor-delete-profile.html" class="nav-link">
<i class="feather-trash-2"></i> Delete Profile
</a>
</li>
<li class="nav-item">
<a href="instructor-linked-account.html" class="nav-link">
<i class="feather-user"></i> Linked Accounts
</a>
</li>
<li class="nav-item">
<a href="index.html" class="nav-link">
<i class="feather-power"></i> Sign Out
</a>
</li>
</ul>
</div>
</div> --}}
{{-- </div> --}}


<div class="col-xl-12 col-lg-12 col-md-12">
<div >
<div class="row">
<div class="col-md-4 d-flex">
<div class="card instructor-card w-100">
<div class="card-body">
<div class="instructor-inner">
<h6>TOTAL BOOKMARKS</h6>
<h4 class="instructor-text-success" id="total_bookmarks">0</h4>
<p>Your total bookmarks</p>
</div>
</div>
</div>
</div>
<div class="col-md-4 d-flex">
<div class="card instructor-card w-100">
<div class="card-body">
<div class="instructor-inner">
<h6>TOTAL RELEARN BOOKMARKS</h6>
<h4 class="instructor-text-info" id="total_relearn_bookmarks">0</h4>
<p>Your total relearn bookmarks</p>
</div>
</div>
</div>
</div>
<div class="col-md-4 d-flex">
<div class="card instructor-card w-100">
<div class="card-body">
<div class="instructor-inner">
<h6>TOTAL LEARNED BOOKMARKS</h6>
<h4 class="instructor-text-success" id="total_learned_bookmarks">0</h4>
<p>Your total learned bookmarks</p>
</div>
</div>
</div>
</div>
</div>
{{-- <div class="row">
<div class="col-md-12">
<div class="card instructor-card">
<div class="card-header">
<h4>Earnings</h4>
</div>
<div class="card-body">
<div id="instructor_chart"></div>
</div>
</div>
</div>
</div> --}}
{{-- <div class="row">
<div class="col-md-12">
<div class="settings-widget">
<div class="settings-inner-blk p-0">
<div class="sell-course-head comman-space">
<h3>Your Bookmakrs</h3>
</div>
<div class="comman-space pb-0">
<div class="settings-tickets-blk course-instruct-blk table-responsive">

<table class="table table-nowrap">
<thead>
<tr>
<th>COURSES</th>
<th>SALES</th>
<th>AMOUNT</th>
</tr>
</thead>
<tbody>
<tr>
<td>
<div class="sell-table-group d-flex align-items-center">
<div class="sell-group-img">
<a href="course-details.html">
<img src="assets/img/course/course-10.jpg" class="img-fluid " alt>
</a>
</div>
<div class="sell-tabel-info">
<p><a href="course-details.html">Information About UI/UX Design Degree</a></p>
</div>
</div>
</td>
<td>34</td>
<td>$3,145.23</td>
</tr>
<tr>
<td>
<div class="sell-table-group d-flex align-items-center">
<div class="sell-group-img">
<a href="course-details.html">
<img src="assets/img/course/course-11.jpg" class="img-fluid " alt>
</a>
</div>
<div class="sell-tabel-info">
<p><a href="course-details.html">Wordpress for Beginners - Master Wordpress Quickly</a></p>
</div>
</div>
</td>
<td>34</td>
<td>$3,145.23</td>
</tr>
<tr>
<td>
<div class="sell-table-group d-flex align-items-center">
<div class="sell-group-img">
<a href="course-details.html">
<img src="assets/img/course/course-12.jpg" class="img-fluid " alt>
</a>
</div>
<div class="sell-tabel-info">
<p><a href="course-details.html">Sketch from A to Z (2022): Become an app designer</a></p>
</div>
</div>
</td>
<td>34</td>
<td>$3,145.23</td>
</tr>
</tbody>
</table>

</div>
</div>
</div>
</div>
</div>
</div> --}}
</div>
<div class="row">
<div class="col-md-12">
<div class="settings-widget">
<div class="settings-inner-blk p-0">
<div class="sell-course-head comman-space">
<h3>Your bookmarks <span class="float-end"><button class="btn btn-primary" onclick="location.href = '{{ route('revision-bookmark-all') }}'">See all</button> <button class="btn border" onclick="location.href = '{{ route('revision-bookmark-revise') }}'">Revise all</button></span></h3>
{{-- <p>Manage your courses and its update like live, draft and insight.</p> --}}
</div>
<div class="comman-space pb-0">
{{-- <div class="instruct-search-blk">
<div class="show-filter choose-search-blk">
<form action="#">
<div class="row gx-2 align-items-center">
<div class="col-md-6 col-item">
<div class=" search-group">
<i class="feather-search"></i>
<input type="text" class="form-control" placeholder="Search our courses">
</div>
</div>
<div class="col-md-6 col-lg-6 col-item">
<div class="form-group select-form mb-0">
<select class="form-select select" name="sellist1">
<option>Choose</option>
<option>Angular</option>
<option>React</option>
<option>Node</option>
</select>
</div>
</div>
</div>
</form>
</div>
</div> --}}
<div class="settings-tickets-blk course-instruct-blk table-responsive">

<table class="table table-nowrap mb-2">
<thead>
<tr>
<th>COURSES</th>
<th>TOTAL</th>
<th>STATUS</th>
</tr>
</thead>
<tbody>
@foreach ($result as $name => $bookmark )
@php
$temp_count = 0;
$is_any_relearn = false;
@endphp
<tr>
<td>
<div class="sell-table-group d-flex align-items-center">
<div class="sell-group-img">
<a href="course-details.html">
<img src="https://picsum.photos/200" class="img-fluid " alt>
</a>
</div>
<div class="sell-tabel-info" style="max-width: 100%">
<p><a href="course-details.html">{{$name}}</a></p>
<br>
<div class="d-flex flex-column">
@foreach ($bookmark as $item )
    <div class="course-card w-100">
    <h6 class="cou-title">
    <a class="collapsed" data-bs-toggle="collapse" href="#course2_{{$loop->index.'_'.$loop->parent->index}}" aria-expanded="false" style="width: 512px">{{$item[0]}}</a>
    </h6>
    <div id="course2_{{$loop->index.'_'.$loop->parent->index}}" class="card-collapse collapse">
    <ul>
@php
    $temp_count+=count($item[1]);
@endphp
        @foreach ($item[1] as $bookmark_child )
        <li>
        {{-- <p class="play-intro w-50 d-flex align-items-center justify-content-between flex-wrap" data-bs-toggle="tooltip" data-bs-placement="top" title="dasdas" > dasdsA  <img src="https://picsum.photos/200" style="width:75px"></p> --}}
        {{-- <img src="{{asset('assets/img/icon/play-icon.svg')}}" alt> --}}
        <div class="course-info border-bottom-0 pb-0 d-flex align-items-center ps-3 pe-2 flex-fill">
            {{-- <div class="rating-img d-flex align-items-center"> --}}
            {{-- <img src="{{asset('assets/img/icon/icon-01.svg')}}" alt> --}}
            <p class="timeline">{{$bookmark_child['timeline']}}</p>
            <p class="text-truncate text-muted">{{$bookmark_child['front_card']}}</p>
            <div class="course-view d-flex align-items-center">
            {{-- <img src="{{asset('assets/img/icon/icon-02.svg')}}" alt> --}}
            <p class="text-truncate text-muted">{{$bookmark_child['back_card']}} <sup class="badge bg-{{ $aa = (floor(microtime(true) * 1000) < $bookmark_child['repetition']['interval'] ? 'green' : 'warning' )}}" style="font-size: 10px;padding: 5px 0">{{$aa == 'green' ? 'Learned' : 'Relearn'}}</sup></p>
            </div>
            </div>
        </li>    
        @php
            if($aa == 'warning'){
                $is_any_relearn = true;
            }
        @endphp
        @endforeach
        
    </ul>
</div>
</div>
</div>
@endforeach
</td>
<td>{{$temp_count}}</td>
<td><span class="badge badge-{{$is_any_relearn ? 'warning' : 'green'}}">{{$is_any_relearn ? 'ReLearn' : 'Learned'}}</span></td>
</tr>
@endforeach
</tbody>
</table>

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
<script>
    var timeline = document.querySelectorAll('.timeline');
    const seconds = 600;
    timeline.forEach((e) => {
        e.innerHTML = (new Date(e.innerText * 1000).toISOString().slice(14, 19));
    })
    document.querySelector('#total_bookmarks').innerHTML = document.querySelectorAll('.course-info').length
    document.querySelector('#total_relearn_bookmarks').innerHTML = document.querySelectorAll('.bg-warning').length
    document.querySelector('#total_learned_bookmarks').innerHTML = document.querySelectorAll('.bg-green').length
</script>
@endsection