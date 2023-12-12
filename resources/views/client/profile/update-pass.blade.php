@extends('client.layouts.master')
@section('content')
@if ($message = Session::get('success'))
@include('client.section.message', ['message' => $message,'type'=>'success'])
@endif
@if($message = Session::get('error'))
@include('client.section.message', ['message' => $message,'type'=>'error'])
@endif
    <div class="page-content">
        <div class="container">
            <div class="row">

                <div class="col-xl-3 col-md-4 theiaStickySidebar">
                    <div class="settings-widget dash-profile mb-3">
                        <div class="settings-menu p-0">
                            <div class="profile-bg">
                                <h5>Beginner</h5>
                                <img src="{{asset('assets/img/profile-bg.jpg')}}" alt>
                                <div class="profile-img">
                                    @if($user->image['avatar'] == null)
                                        <a href="student-profile.html"><img src="{{asset('user/avatar/avatar.jpg')}}" alt></a>
                                    @else
                                         <a href="student-profile.html"><img src="{{($image = auth()->user()->image['avatar']) ? ((str_starts_with($image,'http')) ? $image : ( asset('user/avatar/'.$image))) :  asset('assets/img/user/avatar.jpg')}}" alt></a>
                                    @endif
                                </div>
                            </div>
                            <div class="profile-group">
                                <div class="profile-name text-center">
                                    <h4><a href="student-profile.html">{{ $user->name }}</a></h4>
                                    <p>Student</p>
                                </div>
                                <div class="go-dashboard text-center">
                                    <a href="{{route('home')}}" class="btn btn-primary">Go to Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('client.section.menuprofile')
                </div>


                <div class="col-xl-9 col-md-8">
                    <div class="settings-widget profile-details">
                        <div class="settings-menu p-0">
                            <div class="profile-heading">
                                <h3>Password</h3>
                                <p>You have full control to manage your own account setting.</p>
                            </div>
                            <div class="checkout-form personal-address add-course-info ">
                               
                                <form action="{{route('profile-password', $user->id)}}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label">Old Password</label>
                                                <input type="password" class="form-control" placeholder="Enter your old password"
                                                    name="password">
                                                @error('password')
                                                    <span style="color: red">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label">New password</label>
                                                <input type="password" class="form-control"
                                                    placeholder="Enter your new password" name="new_password">
                                                @error('new_password')
                                                    <span style="color: red">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label">Confirm password</label>
                                                <input type="password" class="form-control" placeholder="Enter your confirm password"
                                                    name="cf_password" >
                                                @error('cf_password')
                                                    <span style="color: red">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        <div class="update-profile">
                                            <button type="submit" class="btn btn-primary">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                          
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
