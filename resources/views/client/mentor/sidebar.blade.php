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
            <h3>ACCOUNT SETTINGS</h3>
            <ul>
                <li class="nav-item active">
                    <a href="setting-edit-profile.html" class="nav-link">
                        <i class="feather-settings"></i> Edit Profile
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
                    <a href="setting-student-privacy.html" class="nav-link">
                        <i class="feather-lock"></i> Profile Privacy
                    </a>
                </li>
                <li class="nav-item">
                    <a href="setting-student-delete-profile.html" class="nav-link">
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