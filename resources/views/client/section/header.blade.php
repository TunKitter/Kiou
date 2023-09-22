<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>@yield('title')</title>

<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.svg')}}">

<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">

<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css')}}">

<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css')}}">

<link rel="stylesheet" href="{{ asset('assets/plugins/slick/slick.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/slick/slick-theme.css')}}">

<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css')}}">

<link rel="stylesheet" href="{{ asset('assets/plugins/aos/aos.css')}}">

<link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
</head>
<header class="header">
    <div class="header-fixed">
    <nav class="navbar navbar-expand-lg header-nav scroll-sticky">
    <div class="container">
    <div class="navbar-header">
    <a id="mobile_btn" href="javascript:void(0);">
    <span class="bar-icon">
    <span></span>
    <span></span>
    <span></span>
    </span>
    </a>
    <a href="index.html" class="navbar-brand logo">
    <img src="{{ asset('assets/img/logo.svg')}}" class="img-fluid" alt="Logo">
    </a>
    </div>
    <div class="main-menu-wrapper">
    <div class="menu-header">
    <a href="index.html" class="menu-logo">
    <img src="{{ asset('assets/img/logo.svg')}}" class="img-fluid" alt="Logo">
    </a>
    <a id="menu_close" class="menu-close" href="javascript:void(0);">
    <i class="fas fa-times"></i>
    </a>
    </div>
    <ul class="main-nav">
    <li class="has-submenu active">
    <a class href="{{route('home')}}">Home</a>
    </li>
    <li class="has-submenu">
    <a href>Courses <i class="fas fa-chevron-down"></i></a>
<ul class="submenu first-submenu">
   <li><a href="setting-student-invoice.html">Course</a></li>
    <li><a href="setting-support-tickets.html">Roadmap</a></li>
    </ul>
    </li>
    <li class="has-submenu">
    <a href>Student <i class="fas fa-chevron-down"></i></a>
    <ul class="submenu first-submenu">
    <li class="has-submenu ">
    <a href="students-list.html">Student</a>
    <ul class="submenu">
    <li><a href="students-list.html">List</a></li>
    <li><a href="students-grid.html">Grid</a></li>
    </ul>
    </li>
    <li><a href="setting-edit-profile.html">Student Profile</a></li>
    <li><a href="setting-student-security.html">Security</a></li>
    <li><a href="setting-student-social-profile.html">Social profile</a></li>
    <li><a href="setting-student-notification.html">Notification</a></li>
    <li><a href="setting-student-privacy.html">Profile Privacy</a></li>
    <li><a href="setting-student-accounts.html">Link Accounts</a></li>
    <li><a href="setting-student-referral.html">Referal</a></li>
    <li><a href="setting-student-subscription.html">Subscribtion</a></li>
    <li><a href="setting-student-billing.html">Billing</a></li>
    <li><a href="setting-student-payment.html">Payment</a></li>
    <li><a href="setting-student-invoice.html">Invoice</a></li>
    <li><a href="setting-support-tickets.html">Support Tickets</a></li>
    </ul>
    </li>
    <li class="has-submenu">
    <a href>Pages <i class="fas fa-chevron-down"></i></a>
    <ul class="submenu">
    <li><a href="notifications.html">Notification</a></li>
    <li><a href="pricing-plan.html">Pricing Plan</a></li>
    <li><a href="wishlist.html">Wishlist</a></li>
    <li class="has-submenu">
    <a href="course-list.html">Course</a>
    <ul class="submenu">
    <li><a href="add-course.html">Add Course</a></li>
    <li><a href="course-list.html">Course List</a></li>
    <li><a href="course-grid.html">Course Grid</a></li>
    <li><a href="course-details.html">Course Details</a></li>
    </ul>
    </li>
    <li class="has-submenu">
    <a href="come-soon.html">Error</a>
    <ul class="submenu">
    <li><a href="come-soon.html">Comeing soon</a></li>
    <li><a href="error-404.html">404</a></li>
    <li><a href="error-500.html">500</a></li>
    <li><a href="under-construction.html">Under Construction</a></li>
    </ul>
    </li>
    <li><a href="faq.html">FAQ</a></li>
    <li><a href="support.html">Support</a></li>
    <li><a href="job-category.html">Category</a></li>
    <li><a href="cart.html">Cart</a></li>
    <li><a href="checkout.html">Checkout</a></li>
    <li><a href="login.html">Login</a></li>
    <li><a href="register.html">Register</a></li>
    <li><a href="forgot-password.html">Forgot Password</a></li>
    </ul>
    </li>
    <li class="has-submenu">
    <a href>Blog <i class="fas fa-chevron-down"></i></a>
    <ul class="submenu">
    <li><a href="blog-list.html">Blog List</a></li>
    <li><a href="blog-grid.html">Blog Grid</a></li>
    <li><a href="blog-masonry.html">Blog Masonry</a></li>
    <li><a href="blog-modern.html">Blog Modern</a></li>
    <li><a href="blog-details.html">Blog Details</a></li>
    </ul>
    </li>
    <li class="login-link">
    <a href="login.html">Login / Signup</a>
    </li>
    </ul>
    </div>
    <ul class="nav header-navbar-rht">
        @guest
        <li class="nav-item">
            <a class="nav-link header-login" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link header-sign" href="{{ route('register') }}">Register</a>
        </li>
        @else
            <li class="nav-item">
                <div class="user-info" id="user-info-dropdown">
                    <a class="nav-link header-sign" href="#">
                        Xin chào, {{ Auth::user()->username }}
                    </a>
                    <div class="user-dropdown">
                        <ul>
                            <li><a href="">Cập nhật tài khoản</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Đăng xuất
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        @endguest
    </ul>
    
    
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    </div>
    </nav>
    </div>
    </header>
    <body>
        <div class="main-wrapper">