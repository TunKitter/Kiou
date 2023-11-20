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
                                    <a href="deposit-student-dashboard.html" class="btn btn-primary">Go to Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="settings-widget account-settings">
                        <div class="settings-menu">
                            <h3>ACCOUNT SETTINGS</h3>
                            <ul>
                                <li class="nav-item active">
                                    <a href="setting-edit-profile.html" class="nav-link">
                                        <i class="feather-settings"></i> Edit Profile
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/moderation" class="nav-link">
                                        <i class="feather-lock"></i> Profile Privacy
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="setting-student-security.html" class="nav-link">
                                        <i class="feather-user"></i> Security
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="setting-student-social-profile.html" class="nav-link">
                                        <i class="feather-refresh-cw"></i> Social Profiles
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="setting-student-notification.html" class="nav-link">
                                        <i class="feather-bell"></i> Notifications
                                    </a>
                                </li>
                               
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="feather-trash-2"></i> Delete Profile
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="setting-student-accounts.html" class="nav-link">
                                        <i class="feather-user"></i> Linked Accounts
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="setting-student-referral.html" class="nav-link">
                                        <i class="feather-user-plus"></i> Referrals
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="login.html" class="nav-link">
                                        <i class="feather-power"></i> Sign Out
                                    </a>
                                </li>
                            </ul>
                            <h3>SUBSCRIPTION</h3>
                            <ul>
                                <li class="nav-item">
                                    <a href="setting-student-subscription.html" class="nav-link ">
                                        <i class="feather-calendar"></i> My Subscriptions
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="setting-student-billing.html" class="nav-link">
                                        <i class="feather-credit-card"></i> Billing Info
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="setting-student-payment.html" class="nav-link">
                                        <i class="feather-credit-card"></i> Payment
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="setting-student-invoice.html" class="nav-link">
                                        <i class="feather-clipboard"></i> Invoice
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
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
