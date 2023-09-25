<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Dreams LMS</title>

<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.svg">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="assets/css/owl.theme.default.min.css">

<link rel="stylesheet" href="assets/plugins/slick/slick.css">
<link rel="stylesheet" href="assets/plugins/slick/slick-theme.css">

<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

<link rel="stylesheet" href="assets/plugins/aos/aos.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
@if ($message = Session::get('success'))
@include('client.section.message', ['message' => $message,'type'=>'success'])
@endif
<div class="main-wrapper">

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
<img src="assets/img/logo.svg" class="img-fluid" alt="Logo">
</a>
</div>
<div class="main-menu-wrapper">
<div class="menu-header">
<a href="index.html" class="menu-logo">
<img src="assets/img/logo.svg" class="img-fluid" alt="Logo">
</a>
<a id="menu_close" class="menu-close" href="javascript:void(0);">
<i class="fas fa-times"></i>
</a>
</div>
<ul class="main-nav">
<li class="has-submenu active">
<a class href>Home <i class="fas fa-chevron-down"></i></a>
<ul class="submenu">
<li class="active"><a href="index.html">Home</a></li>
<li><a href="index-two.html">Home Two</a></li>
<li><a href="index-three.html">Home Three</a></li>
<li><a href="index-four.html">Home Four</a></li>
</ul>
</li>
<li class="has-submenu">
<a href>Instructor <i class="fas fa-chevron-down"></i></a>
<ul class="submenu">
<li><a href="instructor-dashboard.html">Dashboard</a></li>
<li class="has-submenu">
<a href="instructor-list.html">Instructor</a>
<ul class="submenu">
<li><a href="instructor-list.html">List</a></li>
<li><a href="instructor-grid.html">Grid</a></li>
</ul>
</li>
<li><a href="instructor-course.html">My Course</a></li>
<li><a href="instructor-reviews.html">Reviews</a></li>
<li><a href="instructor-earnings.html">Earnings</a></li>
<li><a href="instructor-orders.html">Orders</a></li>
<li><a href="instructor-payouts.html">Payouts</a></li>
<li><a href="instructor-tickets.html">Support Ticket</a></li>
<li><a href="instructor-edit-profile.html">Instructor Profile</a></li>
<li><a href="instructor-security.html">Security</a></li>
<li><a href="instructor-social-profiles.html">Social Profiles</a></li>
<li><a href="instructor-notification.html">Notifications</a></li>
<li><a href="instructor-profile-privacy.html">Profile Privacy</a></li>
<li><a href="instructor-delete-profile.html">Delete Profile</a></li>
<li><a href="instructor-linked-account.html">Linked Accounts</a></li>
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
@auth
@inject('auth', 'Illuminate\Support\Facades\Auth') 
<ul class="nav header-navbar-rht">
    <li class="nav-item">
    <a href="course-message.html"><img src="assets/img/icon/messages.svg" alt="img"></a>
    </li>
    <li class="nav-item cart-nav">
    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
    <img src="assets/img/icon/cart.svg" alt="img">
    </a>
    <div class="wishes-list dropdown-menu dropdown-menu-right">
    <div class="wish-header">
    <a href="#">View Cart</a>
    <a href="javascript:void(0)" class="float-end">Checkout</a>
    </div>
    <div class="wish-content">
    <ul>
    <li>
    <div class="media">
    <div class="d-flex media-wide">
    <div class="avatar">
    <a href="course-details.html">
    <img alt="" src="assets/img/course/course-04.jpg">
    </a>
    </div>
    <div class="media-body">
    <h6><a href="course-details.html">Learn Angular...</a></h6>
    <p>By Dave Franco</p>
    <h5>$200 <span>$99.00</span></h5>
    </div>
    </div>
    <div class="remove-btn">
    <a href="#" class="btn">Remove</a>
    </div>
    </div>
    </li>
    <li>
    <div class="media">
    <div class="d-flex media-wide">
    <div class="avatar">
    <a href="course-details.html">
    <img alt="" src="assets/img/course/course-14.jpg">
    </a>
    </div>
    <div class="media-body">
    <h6><a href="course-details.html">Build Responsive Real...</a></h6>
    <p>Jenis R.</p>
    <h5>$200 <span>$99.00</span></h5>
    </div>
    </div>
    <div class="remove-btn">
    <a href="#" class="btn">Remove</a>
    </div>
    </div>
    </li>
    <li>
    <div class="media">
    <div class="d-flex media-wide">
    <div class="avatar">
    <a href="course-details.html">
    <img alt="" src="assets/img/course/course-15.jpg">
    </a>
    </div>
    <div class="media-body">
    <h6><a href="course-details.html">C# Developers Double ...</a></h6>
    <p>Jesse Stevens</p>
    <h5>$200 <span>$99.00</span></h5>
    </div>
    </div>
    <div class="remove-btn">
    <a href="#" class="btn">Remove</a>
    </div>
    </div>
    </li>
    </ul>
    <div class="total-item">
    <h6>Subtotal : $ 600</h6>
    <h5>Total : $ 600</h5>
    </div>
    </div>
    </div>
    </li>
    <li class="nav-item wish-nav">
    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
    <img src="assets/img/icon/wish.svg" alt="img">
    </a>
    <div class="wishes-list dropdown-menu dropdown-menu-right">
    <div class="wish-content">
    <ul>
    <li>
    <div class="media">
    <div class="d-flex media-wide">
    <div class="avatar">
    <a href="course-details.html">
    <img alt="" src="assets/img/course/course-04.jpg">
    </a>
    </div>
    <div class="media-body">
    <h6><a href="course-details.html">Learn Angular...</a></h6>
    <p>By Dave Franco</p>
    <h5>$200 <span>$99.00</span></h5>
    <div class="remove-btn">
    <a href="#" class="btn">Add to cart</a>
    </div>
    </div>
    </div>
    </div>
    </li>
    <li>
    <div class="media">
    <div class="d-flex media-wide">
    <div class="avatar">
    <a href="course-details.html">
    <img alt="" src="assets/img/course/course-14.jpg">
    </a>
    </div>
    <div class="media-body">
    <h6><a href="course-details.html">Build Responsive Real...</a></h6>
    <p>Jenis R.</p>
    <h5>$200 <span>$99.00</span></h5>
    <div class="remove-btn">
    <a href="#" class="btn">Add to cart</a>
    </div>
    </div>
    </div>
    </div>
    </li>
    <li>
    <div class="media">
    <div class="d-flex media-wide">
    <div class="avatar">
    <a href="course-details.html">
    <img alt="" src="assets/img/course/course-15.jpg">
    </a>
    </div>
    <div class="media-body">
    <h6><a href="course-details.html">C# Developers Double ...</a></h6>
    <p>Jesse Stevens</p>
    <h5>$200 <span>$99.00</span></h5>
    <div class="remove-btn">
    <a href="#" class="btn">Remove</a>
    </div>
    </div>
    </div>
    </div>
    </li>
    </ul>
    </div>
    </div>
    </li>
    <li class="nav-item noti-nav">
    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
    <img src="assets/img/icon/notification.svg" alt="img">
    </a>
    <div class="notifications dropdown-menu dropdown-menu-right">
    <div class="topnav-dropdown-header">
    <span class="notification-title">Notifications
    <select>
    <option>All</option>
    <option>Unread</option>
    </select>
    </span>
    <a href="javascript:void(0)" class="clear-noti">Mark all as read <i class="fa-solid fa-circle-check"></i></a>
    </div>
    <div class="noti-content">
    <ul class="notification-list">
    <li class="notification-message">
    <div class="media d-flex">
    <div>
    <a href="notifications.html" class="avatar">
    <img class="avatar-img" alt="" src="assets/img/user/user1.jpg">
    </a>
    </div>
    <div class="media-body">
    <h6><a href="notifications.html">Lex Murphy requested <span>access to</span> UNIX directory tree hierarchy </a></h6>
    <button class="btn btn-accept">Accept</button>
    <button class="btn btn-reject">Reject</button>
    <p>Today at 9:42 AM</p>
    </div>
    </div>
    </li>
    <li class="notification-message">
    <div class="media d-flex">
    <div>
    <a href="notifications.html" class="avatar">
    <img class="avatar-img" alt="" src="assets/img/user/user2.jpg">
    </a>
    </div>
    <div class="media-body">
    <h6><a href="notifications.html">Ray Arnold left 6 <span>comments on</span> Isla Nublar SOC2 compliance report</a></h6>
    <p>Yesterday at 11:42 PM</p>
    </div>
    </div>
    </li>
    <li class="notification-message">
    <div class="media d-flex">
    <div>
    <a href="notifications.html" class="avatar">
    <img class="avatar-img" alt="" src="assets/img/user/user3.jpg">
    </a>
    </div>
    <div class="media-body">
    <h6><a href="notifications.html">Dennis Nedry <span>commented on</span> Isla Nublar SOC2 compliance report</a></h6>
    <p class="noti-details">“Oh, I finished de-bugging the phones, but the system's compiling for eighteen minutes, or twenty. So, some minor systems may go on and off for a while.”</p>
    <p>Yesterday at 5:42 PM</p>
    </div>
    </div>
    </li>
    <li class="notification-message">
    <div class="media d-flex">
    <div>
    <a href="notifications.html" class="avatar">
    <img class="avatar-img" alt="" src="assets/img/user/user1.jpg">
    </a>
    </div>
    <div class="media-body">
    <h6><a href="notifications.html">John Hammond <span>created</span> Isla Nublar SOC2 compliance report </a></h6>
    <p>Last Wednesday at 11:15 AM</p>
    </div>
    </div>
    </li>
    </ul>
    </div>
    </div>
    </li>
    <li class="nav-item user-nav">
    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
    <span class="user-img">
    <img src="assets/img/user/user11.jpg" alt="">
    <span class="status online"></span>
    </span>
    </a>
    <div class="users dropdown-menu dropdown-menu-right" data-popper-placement="bottom-end">
    <div class="user-header">
    <div class="avatar avatar-sm">
    <img src="assets/img/user/user11.jpg" alt="User Image" class="avatar-img rounded-circle">
    </div>
    <div class="user-text">
    <h6>{{$auth::user()->name}}</h6>
    <p class="text-muted mb-0">Student</p>
    </div>
    </div>
    <a class="dropdown-item" href="{{route('profile')}}"><i class="feather-user me-1"></i> Profile</a>
    <a class="dropdown-item" href="{{route('mentor-overview')}}"><i class="feather-user me-1"></i> Mentor </a>
    <div class="dropdown-item night-mode">
    <span><i class="feather-moon me-1"></i> Night Mode </span>
    <div class="form-check form-switch check-on m-0">
    <input class="form-check-input" type="checkbox" id="night-mode">
    </div>
    </div>
    <a class="dropdown-item" href="http://127.0.0.1:8000/logout"><i class="feather-log-out me-1"></i> Logout</a>
    </div>
    </li>
    </ul>
@endauth
@guest
 <ul class="nav header-navbar-rht">
<li class="nav-item">
<a class="nav-link header-sign" href="{{route('login')}}">Signin</a>
</li>
<li class="nav-item">
<a class="nav-link header-login" href="{{route('register')}}">Signup</a>
</li>
</ul>   
@endguest

</div>
</nav>
</div>
</header>


<section class="home-slide d-flex align-items-center">
<div class="container">
<div class="row ">
<div class="col-md-7">
<div class="home-slide-face aos" data-aos="fade-up">
<div class="home-slide-text ">
<h5>The Leader in Online Learning</h5>
<h1>Engaging & Accessible Online Courses For All</h1>
<p>Own your future learning new skills online</p>
</div>
<div class="banner-content">
<form class="form" action="course-list.html">
<div class="form-inner">
<div class="input-group">
<i class="fa-solid fa-magnifying-glass search-icon"></i>
<input type="email" class="form-control" placeholder="Search School, Online eductional centers, etc">
<span class="drop-detail">
<select class="form-select select">
<option>Category</option>
<option>Angular</option>
<option>Node Js</option>
<option>React</option>
<option>Python</option>
</select>
</span>
<button class="btn btn-primary sub-btn" type="submit"><i class="fas fa-arrow-right"></i></button>
</div>
</div>
</form>
</div>
<div class="trust-user">
<p>Trusted by over 15K Users <br>worldwide since 2022</p>
<div class="trust-rating d-flex align-items-center">
<div class="rate-head">
<h2><span>1000</span>+</h2>
</div>
<div class="rating d-flex align-items-center">
<h2 class="d-inline-block average-rating">4.4</h2>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-5 d-flex align-items-center">
<div class="girl-slide-img aos" data-aos="fade-up">
<img src="assets/img/object.png" alt>
</div>
</div>
</div>
</div>
</section>

<section class="section student-course">
<div class="container">
<div class="course-widget">
<div class="row">
<div class="col-lg-3 col-md-6">
<div class="course-full-width">
<div class="blur-border course-radius align-items-center aos" data-aos="fade-up">
<div class="online-course d-flex align-items-center">
<div class="course-img">
<img src="assets/img/pencil-icon.svg" alt>
</div>
<div class="course-inner-content">
<h4><span>10</span>K</h4>
<p>Online Courses</p>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6 d-flex">
<div class="course-full-width">
<div class="blur-border course-radius aos" data-aos="fade-up">
<div class="online-course d-flex align-items-center">
<div class="course-img">
<img src="assets/img/cources-icon.svg" alt>
</div>
<div class="course-inner-content">
<h4><span>200</span>+</h4>
<p>Expert Tutors</p>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6 d-flex">
<div class="course-full-width">
<div class="blur-border course-radius aos" data-aos="fade-up">
<div class="online-course d-flex align-items-center">
<div class="course-img">
<img src="assets/img/certificate-icon.svg" alt>
</div>
<div class="course-inner-content">
<h4><span>6</span>K+</h4>
<p>Ceritified Courses</p>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6 d-flex">
<div class="course-full-width">
<div class="blur-border course-radius aos" data-aos="fade-up">
<div class="online-course d-flex align-items-center">
<div class="course-img">
<img src="assets/img/gratuate-icon.svg" alt>
</div>
<div class="course-inner-content">
<h4><span>60</span>K +</h4>
<p>Online Students</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>


<section class="section how-it-works">
<div class="container">
<div class="section-header aos" data-aos="fade-up">
<div class="section-sub-head">
<span>Favourite Course</span>
<h2>Top Category</h2>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="job-category.html" class="btn btn-primary">All Categories</a>
</div>
</div>
<div class="section-text aos" data-aos="fade-up">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan bibendum gravida maecenas augue elementum et neque. Suspendisse imperdiet.</p>
</div>
<div class="owl-carousel mentoring-course owl-theme aos" data-aos="fade-up">
<div class="feature-box text-center ">
<div class="feature-bg">
<div class="feature-header">
<div class="feature-icon">
<img src="assets/img/categories-icon.png" alt>
</div>
<div class="feature-cont">
<div class="feature-text">Angular Development</div>
</div>
</div>
<p>40 Instructors</p>
</div>
</div>
<div class="feature-box text-center ">
<div class="feature-bg">
<div class="feature-header">
<div class="feature-icon">
<img src="assets/img/categories-icon-01.png" alt>
</div>
<div class="feature-cont">
<div class="feature-text">Docker Development</div>
</div>
</div>
<p>45 Instructors</p>
</div>
</div>
<div class="feature-box text-center ">
<div class="feature-bg">
<div class="feature-header">
<div class="feature-icon">
<img src="assets/img/categories-icon-02.png" alt>
</div>
<div class="feature-cont">
<div class="feature-text">Node JS Frontend</div>
</div>
</div>
<p>40 Instructors</p>
</div>
</div>
<div class="feature-box text-center ">
<div class="feature-bg">
<div class="feature-header">
<div class="feature-icon">
<img src="assets/img/categories-icon-03.png" alt>
</div>
<div class="feature-cont">
<div class="feature-text">Swift Development</div>
</div>
</div>
<p>23 Instructors</p>
</div>
</div>
<div class="feature-box text-center ">
<div class="feature-bg">
<div class="feature-header">
<div class="feature-icon">
<img src="assets/img/categories-icon-04.png" alt>
</div>
<div class="feature-cont">
<div class="feature-text">Python Development</div>
</div>
</div>
<p>30 Instructors</p>
</div>
</div>
<div class="feature-box text-center ">
<div class="feature-bg">
<div class="feature-header">
<div class="feature-icon">
<img src="assets/img/categories-icon-05.png" alt>
</div>
<div class="feature-cont">
<div class="feature-text">React<br> Native</div>
</div>
</div>
<p>80 Instructors</p>
</div>
</div>
<div class="feature-box text-center ">
<div class="feature-bg">
<div class="feature-header">
<div class="feature-icon">
<img src="assets/img/categories-icon-04.png" alt>
</div>
<div class="feature-cont">
<div class="feature-text">Angular Development</div>
</div>
</div>
<p>40 Instructors</p>
</div>
</div>
<div class="feature-box text-center ">
<div class="feature-bg">
<div class="feature-header">
<div class="feature-icon">
<img src="assets/img/categories-icon-01.png" alt>
</div>
<div class="feature-cont">
<div class="feature-text">Docker Development</div>
</div>
</div>
<p>45 Instructors</p>
</div>
</div>
<div class="feature-box text-center ">
<div class="feature-bg">
<div class="feature-header">
<div class="feature-icon">
<img src="assets/img/categories-icon-02.png" alt>
</div>
<div class="feature-cont">
<div class="feature-text">Node JS Frontend</div>
</div>
</div>
<p>40 Instructors</p>
</div>
</div>
<div class="feature-box text-center ">
<div class="feature-bg">
<div class="feature-header">
<div class="feature-icon">
<img src="assets/img/categories-icon-03.png" alt>
</div>
<div class="feature-cont">
<div class="feature-text">Swift Development</div>
</div>
</div>
<p>23 Instructors</p>
</div>
</div>
<div class="feature-box text-center ">
<div class="feature-bg">
<div class="feature-header">
<div class="feature-icon">
<img src="assets/img/categories-icon-04.png" alt>
</div>
<div class="feature-cont">
<div class="feature-text">Python Development</div>
</div>
</div>
<p>30 Instructors</p>
</div>
</div>
<div class="feature-box text-center ">
<div class="feature-bg">
<div class="feature-header">
<div class="feature-icon">
<img src="assets/img/categories-icon-01.png" alt>
</div>
<div class="feature-cont">
<div class="feature-text">Docker Development</div>
</div>
</div>
<p>45 Instructors</p>
</div>
</div>
<div class="feature-box text-center ">
<div class="feature-bg">
<div class="feature-header">
<div class="feature-icon">
<img src="assets/img/categories-icon-02.png" alt>
</div>
<div class="feature-cont">
<div class="feature-text">Node JS Frontend</div>
</div>
</div>
<p>40 Instructors</p>
</div>
</div>
<div class="feature-box text-center ">
<div class="feature-bg">
<div class="feature-header">
<div class="feature-icon">
<img src="assets/img/categories-icon-03.png" alt>
</div>
<div class="feature-cont">
<div class="feature-text">Swift Development</div>
</div>
</div>
<p>23 Instructors</p>
</div>
</div>
<div class="feature-box text-center ">
<div class="feature-bg">
<div class="feature-header">
<div class="feature-icon">
<img src="assets/img/categories-icon-04.png" alt>
</div>
<div class="feature-cont">
<div class="feature-text">Python Development</div>
</div>
</div>
<p>30 Instructors</p>
</div>
</div>
</div>
</div>
</section>


<section class="section new-course">
<div class="container">
<div class="section-header aos" data-aos="fade-up">
<div class="section-sub-head">
<span>What’s New</span>
<h2>Featured Courses</h2>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="course-list.html" class="btn btn-primary">All Courses</a>
</div>
</div>
<div class="section-text aos" data-aos="fade-up">
<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan bibendum gravida maecenas augue elementum et neque. Suspendisse imperdiet.</p>
</div>
<div class="course-feature">
<div class="row">
<div class="col-lg-4 col-md-6 d-flex">
<div class="course-box d-flex aos" data-aos="fade-up">
<div class="product">
<div class="product-img">
<a href="course-details.html">
<img class="img-fluid" alt src="assets/img/course/course-01.jpg">
</a>
<div class="price">
<h3>$300 <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="course-group d-flex">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user1.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">Nicole Brown</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
<a href="#"><i class="fa-regular fa-heart"></i></a>
</div>
</div>
<h3 class="title instructor-text"><a href="course-details.html">Information About UI/UX Design Degree</a></h3>
<div class="course-info d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="assets/img/icon/icon-01.svg" alt>
<p>12+ Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="assets/img/icon/icon-02.svg" alt>
<p>9hr 30min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star"></i>
<span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="checkout.html" class="btn btn-primary">BUY NOW</a>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-4 col-md-6 d-flex">
<div class="course-box d-flex aos" data-aos="fade-up">
<div class="product">
<div class="product-img">
<a href="course-details.html">
<img class="img-fluid" alt src="assets/img/course/course-02.jpg">
</a>
<div class="price">
<h3>$400 <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="course-group d-flex">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user2.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">Jenis R.</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
<a href="#"><i class="fa-regular fa-heart"></i></a>
</div>
</div>
<h3 class="title instructor-text"><a href="course-details.html">Wordpress for Beginners - Master Wordpress Quickly</a></h3>
<div class="course-info d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="assets/img/icon/icon-01.svg" alt>
<p>11+ Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="assets/img/icon/icon-02.svg" alt>
<p>6hr 30min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star"></i>
<span class="d-inline-block average-rating"><span>4.3</span> (15)</span>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="checkout.html" class="btn btn-primary">BUY NOW</a>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-4 col-md-6 d-flex">
<div class="course-box d-flex aos" data-aos="fade-up">
<div class="product">
<div class="product-img">
<a href="course-details.html">
<img class="img-fluid" alt src="assets/img/course/course-03.jpg">
</a>
<div class="price combo">
<h3>FREE</h3>
</div>
</div>
<div class="product-content">
<div class="course-group d-flex">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user5.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">Jesse Stevens</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
<a href="#"><i class="fa-regular fa-heart"></i></a>
</div>
</div>
<h3 class="title instructor-text"><a href="course-details.html">Sketch from A to Z (2022): Become an app designer</a></h3>
<div class="course-info d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="assets/img/icon/icon-01.svg" alt>
<p>16+ Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="assets/img/icon/icon-02.svg" alt>
<p>12hr 30min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star"></i>
<span class="d-inline-block average-rating"><span>4.5</span> (15)</span>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="checkout.html" class="btn btn-primary">BUY NOW</a>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-4 col-md-6 d-flex">
<div class="course-box d-flex aos" data-aos="fade-up">
<div class="product">
<div class="product-img">
<a href="course-details.html">
<img class="img-fluid" alt src="assets/img/course/course-04.jpg">
</a>
<div class="price">
<h3>$500 <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="course-group d-flex">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user4.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">Nicole Brown</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
<a href="#"><i class="fa-regular fa-heart"></i></a>
</div>
</div>
<h3 class="title instructor-text"><a href="course-details.html">Learn Angular Fundamentals From beginning to advance lavel</a></h3>
<div class="course-info d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="assets/img/icon/icon-01.svg" alt>
<p>10+ Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="assets/img/icon/icon-02.svg" alt>
<p>8hr 30min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star"></i>
<span class="d-inline-block average-rating"><span>4.2</span> (15)</span>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="checkout.html" class="btn btn-primary">BUY NOW</a>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-4 col-md-6 d-flex">
<div class="course-box d-flex aos" data-aos="fade-up">
<div class="product">
<div class="product-img">
<a href="course-details.html">
<img class="img-fluid" alt src="assets/img/course/course-05.jpg">
</a>
<div class="price">
<h3>$300 <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="course-group d-flex">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user3.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">John Smith</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
<a href="#"><i class="fa-regular fa-heart"></i></a>
</div>
</div>
<h3 class="title instructor-text"><a href="course-details.html">Build Responsive Real World Websites with HTML5 and CSS3</a></h3>
<div class="course-info d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="assets/img/icon/icon-01.svg" alt>
<p>13+ Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="assets/img/icon/icon-02.svg" alt>
<p>10hr 30min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star"></i>
<span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="checkout.html" class="btn btn-primary">BUY NOW</a>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-4 col-md-6 d-flex">
<div class="course-box d-flex aos" data-aos="fade-up">
<div class="product">
<div class="product-img">
<a href="course-details.html">
<img class="img-fluid" alt src="assets/img/course/course-06.jpg">
</a>
<div class="price combo">
<h3>FREE</h3>
</div>
</div>
<div class="product-content">
<div class="course-group d-flex">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user6.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">Stella Johnson</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
<a href="#"><i class="fa-regular fa-heart"></i></a>
</div>
</div>
<h3 class="title instructor-text"><a href="course-details.html">C# Developers Double Your Coding Speed with Visual Studio</a></h3>
<div class="course-info d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="assets/img/icon/icon-01.svg" alt>
<p>7+ Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="assets/img/icon/icon-02.svg" alt>
<p>7hr 30min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star"></i>
<span class="d-inline-block average-rating"><span>4.6</span> (15)</span>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="checkout.html" class="btn btn-primary">BUY NOW</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>


<section class="section master-skill">
<div class="container">
<div class="row">
<div class="col-lg-7 col-md-12">
<div class="section-header aos" data-aos="fade-up">
<div class="section-sub-head">
<span>What’s New</span>
<h2>Master the skills to drive your career</h2>
</div>
</div>
<div class="section-text aos" data-aos="fade-up">
<p>Get certified, master modern tech skills, and level up your career — whether you’re starting out or a seasoned pro. 95% of eLearning learners report our hands-on content directly helped their careers.</p>
</div>
<div class="career-group aos" data-aos="fade-up">
<div class="row">
<div class="col-lg-6 col-md-6 d-flex">
<div class="certified-group blur-border d-flex">
<div class="get-certified d-flex align-items-center">
<div class="blur-box">
<div class="certified-img ">
<img src="assets/img/icon/icon-1.svg" alt class="img-fluid">
</div>
</div>
<p>Stay motivated with engaging instructors</p>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 d-flex">
<div class="certified-group blur-border d-flex">
<div class="get-certified d-flex align-items-center">
<div class="blur-box">
<div class="certified-img ">
<img src="assets/img/icon/icon-2.svg" alt class="img-fluid">
</div>
</div>
<p>Keep up with in the latest in cloud</p>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 d-flex">
<div class="certified-group blur-border d-flex">
<div class="get-certified d-flex align-items-center">
<div class="blur-box">
<div class="certified-img ">
<img src="assets/img/icon/icon-3.svg" alt class="img-fluid">
</div>
</div>
<p>Get certified with 100+ certification courses</p>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 d-flex">
<div class="certified-group blur-border d-flex">
<div class="get-certified d-flex align-items-center">
<div class="blur-box">
<div class="certified-img ">
<img src="assets/img/icon/icon-4.svg" alt class="img-fluid">
</div>
</div>
<p>Build skills your way, from labs to courses</p>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-5 col-md-12 d-flex align-items-end">
<div class="career-img aos" data-aos="fade-up">
<img src="assets/img/join.png" alt class="img-fluid">
</div>
</div>
</div>
</div>
</section>


<section class="section trend-course">
<div class="container">
<div class="section-header aos" data-aos="fade-up">
<div class="section-sub-head">
<span>What’s New</span>
<h2>TRENDING COURSES</h2>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="course-list.html" class="btn btn-primary">All Courses</a>
</div>
</div>
<div class="section-text aos" data-aos="fade-up">
<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan bibendum gravida maecenas augue elementum et neque. Suspendisse imperdiet.</p>
</div>
<div class="owl-carousel trending-course owl-theme aos" data-aos="fade-up">
<div class="course-box trend-box">
<div class="product trend-product">
<div class="product-img">
<a href="course-details.html">
<img class="img-fluid" alt src="assets/img/course/course-07.jpg">
</a>
<div class="price">
<h3>$200 <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="course-group d-flex">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">John Michael</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
<a href="#"><i class="fa-regular fa-heart"></i></a>
</div>
</div>
<h3 class="title"><a href="course-details.html">Learn JavaScript and Express to become a professional JavaScript</a></h3>
<div class="course-info d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="assets/img/icon/icon-01.svg" alt class="img-fluid">
<p>13+ Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="assets/img/icon/icon-02.svg" alt class="img-fluid">
<p>10hr 30min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star"></i>
<span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="checkout.html" class="btn btn-primary">BUY NOW</a>
</div>
</div>
</div>
</div>
<div class="course-box trend-box">
<div class="product trend-product">
<div class="product-img">
<a href="course-details.html">
<img class="img-fluid" alt src="assets/img/course/course-08.jpg">
</a>
<div class="price">
<h3>$300 <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="course-group d-flex">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user2.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">John Smith</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
<a href="#"><i class="fa-regular fa-heart"></i></a>
</div>
</div>
<h3 class="title"><a href="course-details.html">Responsive Web Design Essentials HTML5 CSS3 and Bootstrap</a></h3>
<div class="course-info d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="assets/img/icon/icon-01.svg" alt class="img-fluid">
<p>10+ Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="assets/img/icon/icon-02.svg" alt class="img-fluid">
<p>11hr 30min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star"></i>
<span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="checkout.html" class="btn btn-primary">BUY NOW</a>
</div>
</div>
</div>
</div>
<div class="course-box trend-box">
<div class="product trend-product">
<div class="product-img">
<a href="course-details.html">
<img class="img-fluid" alt src="assets/img/course/course-05.jpg">
</a>
<div class="price">
<h3>$100 <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="course-group d-flex">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user3.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">Lavern M.</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
<a href="#"><i class="fa-regular fa-heart"></i></a>
</div>
</div>
<h3 class="title"><a href="course-details.html">The Complete App Design Course - UX, UI and Design Thinking</a></h3>
<div class="course-info d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="assets/img/icon/icon-01.svg" alt class="img-fluid">
<p>8+ Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="assets/img/icon/icon-02.svg" alt class="img-fluid">
<p>8hr 30min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star"></i>
<span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="checkout.html" class="btn btn-primary">BUY NOW</a>
</div>
</div>
</div>
</div>
<div class="course-box trend-box">
<div class="product trend-product">
<div class="product-img">
<a href="course-details.html">
<img class="img-fluid" alt src="assets/img/course/course-08.jpg">
</a>
<div class="price">
<h3>$200 <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="course-group d-flex">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user5.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">John Smith</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
<a href="#"><i class="fa-regular fa-heart"></i></a>
</div>
</div>
<h3 class="title"><a href="course-details.html">Build Responsive Real World Websites with HTML5 and CSS3</a></h3>
<div class="course-info d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="assets/img/icon/icon-01.svg" alt class="img-fluid">
<p>13+ Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="assets/img/icon/icon-02.svg" alt class="img-fluid">
<p>10hr 30min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star"></i>
<span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="checkout.html" class="btn btn-primary">BUY NOW</a>
</div>
</div>
</div>
</div>
<div class="course-box trend-box">
<div class="product trend-product">
<div class="product-img">
<a href="course-details.html">
<img class="img-fluid" alt src="assets/img/course/course-07.jpg">
</a>
<div class="price">
<h3>$300 <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="course-group d-flex">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user2.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">John Smith</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
<a href="#"><i class="fa-regular fa-heart"></i></a>
</div>
</div>
<h3 class="title"><a href="course-details.html">Responsive Web Design Essentials HTML5 CSS3 and Bootstrap</a></h3>
<div class="course-info d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="assets/img/icon/icon-01.svg" alt class="img-fluid">
<p>10+ Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="assets/img/icon/icon-02.svg" alt class="img-fluid">
<p>11hr 30min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star"></i>
<span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="checkout.html" class="btn btn-primary">BUY NOW</a>
</div>
</div>
</div>
</div>
<div class="course-box trend-box">
<div class="product trend-product">
<div class="product-img">
<a href="course-details.html">
<img class="img-fluid" alt src="assets/img/course/course-09.jpg">
</a>
<div class="price">
<h3>$100 <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="course-group d-flex">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user4.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">Lavern M.</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
<a href="#"><i class="fa-regular fa-heart"></i></a>
</div>
</div>
<h3 class="title"><a href="course-details.html">The Complete App Design Course - UX, UI and Design Thinking</a></h3>
<div class="course-info d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="assets/img/icon/icon-01.svg" alt class="img-fluid">
<p>8+ Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="assets/img/icon/icon-02.svg" alt class="img-fluid">
<p>8hr 30min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star"></i>
<span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="checkout.html" class="btn btn-primary">BUY NOW</a>
</div>
</div>
</div>
</div>
<div class="course-box trend-box">
<div class="product trend-product">
<div class="product-img">
<a href="course-details.html">
<img class="img-fluid" alt src="assets/img/course/course-08.jpg">
</a>
<div class="price">
<h3>$200 <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="course-group d-flex">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user1.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">John Michael</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
<a href="#"><i class="fa-regular fa-heart"></i></a>
</div>
</div>
<h3 class="title"><a href="course-details.html">Learn JavaScript and Express to become a professional JavaScript</a></h3>
<div class="course-info d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="assets/img/icon/icon-01.svg" alt class="img-fluid">
<p>13+ Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="assets/img/icon/icon-02.svg" alt class="img-fluid">
<p>10hr 30min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star"></i>
<span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="checkout.html" class="btn btn-primary">BUY NOW</a>
</div>
</div>
</div>
</div>
<div class="course-box trend-box">
<div class="product trend-product">
<div class="product-img">
<a href="course-details.html">
<img class="img-fluid" alt src="assets/img/course/course-09.jpg">
</a>
<div class="price">
<h3>$300 <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="course-group d-flex">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user3.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">John Smith</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
<a href="#"><i class="fa-regular fa-heart"></i></a>
</div>
</div>
<h3 class="title"><a href="course-details.html">Responsive Web Design Essentials HTML5 CSS3 and Bootstrap</a></h3>
<div class="course-info d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="assets/img/icon/icon-01.svg" alt class="img-fluid">
<p>10+ Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="assets/img/icon/icon-02.svg" alt class="img-fluid">
<p>11hr 30min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star filled"></i>
<i class="fas fa-star"></i>
<span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
</div>
<div class="all-btn all-category d-flex align-items-center">
<a href="checkout.html" class="btn btn-primary">BUY NOW</a>
</div>
</div>
</div>
</div>
</div>

<div class="feature-instructors">
<div class="section-header aos" data-aos="fade-up">
<div class="section-sub-head feature-head text-center">
<h2>Featured Instructor</h2>
<div class="section-text aos" data-aos="fade-up">
<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan bibendum gravida maecenas augue elementum et neque. Suspendisse imperdiet.</p>
</div>
</div>
</div>
<div class="owl-carousel instructors-course owl-theme aos" data-aos="fade-up">
<div class="instructors-widget">
<div class="instructors-img ">
<a href="instructor-list.html">
<img class="img-fluid" alt src="assets/img/user/user7.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="instructor-profile.html">David Lee</a></h5>
<p>Web Developer</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-user-group"></i>
<span>50 Students</span>
</div>
</div>
</div>
<div class="instructors-widget">
<div class="instructors-img">
<a href="instructor-list.html">
<img class="img-fluid" alt src="assets/img/user/user8.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="instructor-profile.html">Daziy Millar</a></h5>
<p>PHP Expert</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-user-group yellow"></i>
<span>50 Students</span>
</div>
</div>
</div>
<div class="instructors-widget">
<div class="instructors-img">
<a href="instructor-list.html">
<img class="img-fluid" alt src="assets/img/user/user9.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="instructor-profile.html">Patricia Mendoza</a></h5>
<p>Web Developer</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-user-group violet"></i>
<span>50 Students</span>
</div>
</div>
</div>
<div class="instructors-widget">
<div class="instructors-img">
<a href="instructor-list.html">
<img class="img-fluid" alt src="assets/img/user/user10.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="instructor-profile.html">Skyler Whites</a></h5>
<p>UI Designer</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-user-group orange"></i>
<span>50 Students</span>
</div>
</div>
</div>
<div class="instructors-widget">
<div class="instructors-img ">
<a href="instructor-list.html">
<img class="img-fluid" alt src="assets/img/user/user7.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="instructor-profile.html">Patricia Mendoza</a></h5>
<p>Java Developer</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-user-group"></i>
<span>40 Students</span>
</div>
</div>
</div>
<div class="instructors-widget">
<div class="instructors-img">
<a href="instructor-list.html">
<img class="img-fluid" alt src="assets/img/user/user8.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="instructor-profile.html">David Lee</a></h5>
<p>Web Developer</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-user-group"></i>
<span>50 Students</span>
</div>
</div>
</div>
<div class="instructors-widget">
<div class="instructors-img ">
<a href="instructor-list.html">
<img class="img-fluid" alt src="assets/img/user/user9.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="instructor-profile.html">Daziy Millar</a></h5>
<p>PHP Expert</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-user-group"></i>
<span>40 Students</span>
</div>
</div>
</div>
<div class="instructors-widget">
<div class="instructors-img ">
<a href="instructor-list.html">
<img class="img-fluid" alt src="assets/img/user/user10.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="instructor-profile.html">Patricia Mendoza</a></h5>
<p>Web Developer</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-user-group"></i>
<span>20 Students</span>
</div>
</div>
</div>
<div class="instructors-widget">
<div class="instructors-img ">
<a href="instructor-list.html">
<img class="img-fluid" alt src="assets/img/user/user7.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="instructor-profile.html">Skyler Whites</a></h5>
<p>UI Designer</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-user-group"></i>
<span>30 Students</span>
</div>
</div>
</div>
<div class="instructors-widget">
<div class="instructors-img">
<a href="instructor-list.html">
<img class="img-fluid" alt src="assets/img/user/user8.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="instructor-profile.html">Patricia Mendoza</a></h5>
<p>Java Developer</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-user-group"></i>
<span>40 Students</span>
</div>
</div>
</div>
</div>
</div>

</div>
</section>


<section class="section lead-companies">
<div class="container">
<div class="section-header aos" data-aos="fade-up">
<div class="section-sub-head feature-head text-center">
<span>Trusted By</span>
<h2>500+ Leading Universities And Companies</h2>
</div>
</div>
<div class="lead-group aos" data-aos="fade-up">
<div class="lead-group-slider owl-carousel owl-theme">
<div class="item">
<div class="lead-img">
<img class="img-fluid" alt src="assets/img/lead-01.png">
</div>
</div>
<div class="item">
<div class="lead-img">
<img class="img-fluid" alt src="assets/img/lead-02.png">
</div>
</div>
<div class="item">
<div class="lead-img">
<img class="img-fluid" alt src="assets/img/lead-03.png">
</div>
</div>
<div class="item">
<div class="lead-img">
<img class="img-fluid" alt src="assets/img/lead-04.png">
</div>
</div>
<div class="item">
<div class="lead-img">
<img class="img-fluid" alt src="assets/img/lead-05.png">
</div>
</div>
<div class="item">
<div class="lead-img">
<img class="img-fluid" alt src="assets/img/lead-06.png">
</div>
</div>
</div>
</div>
</div>
</section>


<section class="section share-knowledge">
<div class="container">
<div class="row">
<div class="col-md-6">
<div class="knowledge-img aos" data-aos="fade-up">
<img src="assets/img/share.png" alt class="img-fluid">
</div>
</div>
<div class="col-md-6 d-flex align-items-center">
<div class="join-mentor aos" data-aos="fade-up">
<h2>Want to share your knowledge? Join us a Mentor</h2>
<p>High-definition video is video of higher resolution and quality than standard-definition. While there is no standardized meaning for high-definition, generally any video.</p>
<ul class="course-list">
<li><i class="fa-solid fa-circle-check"></i>Best Courses</li>
<li><i class="fa-solid fa-circle-check"></i>Top rated Instructors</li>
</ul>
<div class="all-btn all-category d-flex align-items-center">
<a href="instructor-list.html" class="btn btn-primary">Read More</a>
</div>
</div>
</div>
</div>
</div>
</section>


<section class="section user-love">
<div class="container">
<div class="section-header white-header aos" data-aos="fade-up">
<div class="section-sub-head feature-head text-center">
<span>Check out these real reviews</span>
<h2>Users-love-us Don't take it from us.</h2>
</div>
</div>
</div>
</section>


<section class="testimonial-four">
<div class="review">
<div class="container">
<div class="testi-quotes">
<img src="assets/img/qute.png" alt>
</div>
<div class="mentor-testimonial lazy slider aos" data-aos="fade-up" data-sizes="50vw ">
<div class="d-flex justify-content-center">
<div class="testimonial-all d-flex justify-content-center">
<div class="testimonial-two-head text-center align-items-center d-flex">
<div class="testimonial-four-saying ">
<div class="testi-right">
<img src="assets/img/qute-01.png" alt>
</div>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
<div class="four-testimonial-founder">
<div class="fount-about-img">
<a href="instructor-profile.html"><img src="assets/img/user/user1.jpg" alt class="img-fluid"></a>
</div>
<h3><a href="instructor-profile.html">Daziy Millar</a></h3>
<span>Founder of Awesomeux Technology</span>
</div>
</div>
</div>
</div>
</div>
<div class="d-flex justify-content-center">
<div class="testimonial-all d-flex justify-content-center">
<div class="testimonial-two-head text-center align-items-center d-flex">
<div class="testimonial-four-saying ">
<div class="testi-right">
<img src="assets/img/qute-01.png" alt>
</div>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
<div class="four-testimonial-founder">
<div class="fount-about-img">
<a href="instructor-profile.html"><img src="assets/img/user/user3.jpg" alt class="img-fluid"></a>
</div>
<h3><a href="instructor-profile.html">john smith</a></h3>
<span>Founder of Awesomeux Technology</span>
</div>
</div>
</div>
</div>
</div>
<div class="d-flex justify-content-center">
<div class="testimonial-all d-flex justify-content-center">
<div class="testimonial-two-head text-center align-items-center d-flex">
<div class="testimonial-four-saying ">
<div class="testi-right">
<img src="assets/img/qute-01.png" alt>
</div>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
<div class="four-testimonial-founder">
<div class="fount-about-img">
<a href="instructor-profile.html"><img src="assets/img/user/user2.jpg" alt class="img-fluid"></a>
</div>
<h3><a href="instructor-profile.html">David Lee</a></h3>
<span>Founder of Awesomeux Technology</span>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>


<section class="section become-instructors aos" data-aos="fade-up">
<div class="container">
<div class="row">
<div class="col-lg-6 col-md-6 d-flex">
<div class="student-mentor cube-instuctor ">
<h4>Become An Instructor</h4>
<div class="row">
<div class="col-lg-7 col-md-12">
<div class="top-instructors">
<p>Top instructors from around the world teach millions of students on Mentoring.</p>
</div>
</div>
<div class="col-lg-5 col-md-12">
<div class="mentor-img">
<img class="img-fluid" alt src="assets/img/become-02.png">
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 d-flex">
<div class="student-mentor yellow-mentor">
<h4>Transform Access To Education</h4>
<div class="row">
<div class="col-lg-8 col-md-12">
<div class="top-instructors">
<p>Create an account to receive our newsletter, course recommendations and promotions.</p>
</div>
</div>
<div class="col-lg-4 col-md-12">
<div class="mentor-img">
<img class="img-fluid" alt src="assets/img/become-01.png">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>


<section class="section latest-blog">
<div class="container">
<div class="section-header aos" data-aos="fade-up">
<div class="section-sub-head feature-head text-center mb-0">
<h2>Latest Blogs</h2>
<div class="section-text aos" data-aos="fade-up">
<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan bibendum gravida maecenas augue elementum et neque. Suspendisse imperdiet.</p>
</div>
</div>
</div>
<div class="owl-carousel blogs-slide owl-theme aos" data-aos="fade-up">
<div class="instructors-widget blog-widget">
<div class="instructors-img">
<a href="blog-list.html">
<img class="img-fluid" alt src="assets/img/blog/blog-01.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="blog-list.html">Attract More Attention Sales And Profits</a></h5>
<p>Marketing</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-calendar-days"></i>
<span>Jun 15, 2022</span>
</div>
</div>
</div>
<div class="instructors-widget blog-widget">
<div class="instructors-img">
<a href="blog-list.html">
<img class="img-fluid" alt src="assets/img/blog/blog-02.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="blog-list.html">11 Tips to Help You Get New Clients</a></h5>
<p>Sales Order</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-calendar-days"></i>
<span>May 20, 2022</span>
</div>
</div>
</div>
<div class="instructors-widget blog-widget">
<div class="instructors-img">
<a href="blog-list.html">
<img class="img-fluid" alt src="assets/img/blog/blog-03.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="blog-list.html">An Overworked Newspaper Editor</a></h5>
<p>Design</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-calendar-days"></i>
<span>May 25, 2022</span>
</div>
</div>
</div>
<div class="instructors-widget blog-widget">
<div class="instructors-img">
<a href="blog-list.html">
<img class="img-fluid" alt src="assets/img/blog/blog-04.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="blog-list.html">A Solution Built for Teachers</a></h5>
<p>Seo</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-calendar-days"></i>
<span>Jul 15, 2022</span>
</div>
</div>
</div>
<div class="instructors-widget blog-widget">
<div class="instructors-img">
<a href="blog-list.html">
<img class="img-fluid" alt src="assets/img/blog/blog-02.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="blog-list.html">Attract More Attention Sales And Profits</a></h5>
<p>Marketing</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-calendar-days"></i>
<span>Sep 25, 2022</span>
</div>
</div>
</div>
<div class="instructors-widget blog-widget">
<div class="instructors-img">
<a href="blog-list.html">
<img class="img-fluid" alt src="assets/img/blog/blog-03.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="blog-list.html">An Overworked Newspaper Editor</a></h5>
<p>Marketing</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-calendar-days"></i>
<span>May 25, 2022</span>
</div>
</div>
</div>
<div class="instructors-widget blog-widget">
<div class="instructors-img">
<a href="blog-list.html">
<img class="img-fluid" alt src="assets/img/blog/blog-04.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="blog-list.html">A Solution Built for Teachers</a></h5>
<p>Analysis</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-calendar-days"></i>
<span>May 15, 2022</span>
</div>
</div>
</div>
<div class="instructors-widget blog-widget">
<div class="instructors-img">
<a href="blog-list.html">
<img class="img-fluid" alt src="assets/img/blog/blog-02.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="blog-list.html">11 Tips to Help You Get New Clients</a></h5>
<p>Development</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-calendar-days"></i>
<span>Jun 20, 2022</span>
</div>
</div>
</div>
<div class="instructors-widget blog-widget">
<div class="instructors-img">
<a href="blog-list.html">
<img class="img-fluid" alt src="assets/img/blog/blog-03.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="blog-list.html">An Overworked Newspaper Editor</a></h5>
<p>Sales</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-calendar-days"></i>
<span>May 25, 2022</span>
</div>
</div>
</div>
<div class="instructors-widget blog-widget">
<div class="instructors-img">
<a href="blog-list.html">
<img class="img-fluid" alt src="assets/img/blog/blog-04.jpg">
</a>
</div>
<div class="instructors-content text-center">
<h5><a href="blog-list.html">A Solution Built for Teachers</a></h5>
<p>Marketing</p>
<div class="student-count d-flex justify-content-center">
<i class="fa-solid fa-calendar-days"></i>
<span>April 15, 2022</span>
</div>
</div>
</div>
</div>
<div class="enroll-group aos" data-aos="fade-up">
<div class="row ">
<div class="col-lg-4 col-md-6">
<div class="total-course d-flex align-items-center">
<div class="blur-border">
<div class="enroll-img ">
<img src="assets/img/icon/icon-07.svg" alt class="img-fluid">
</div>
</div>
<div class="course-count">
<h3><span class="counterUp">253,085</span></h3>
<p>STUDENTS ENROLLED</p>
</div>
</div>
</div>
<div class="col-lg-4 col-md-6">
<div class="total-course d-flex align-items-center">
<div class="blur-border">
<div class="enroll-img ">
<img src="assets/img/icon/icon-08.svg" alt class="img-fluid">
</div>
</div>
<div class="course-count">
<h3><span class="counterUp">1,205</span></h3>
<p>TOTAL COURSES</p>
</div>
</div>
</div>
<div class="col-lg-4 col-md-6">
<div class="total-course d-flex align-items-center">
<div class="blur-border">
<div class="enroll-img ">
<img src="assets/img/icon/icon-09.svg" alt class="img-fluid">
</div>
</div>
<div class="course-count">
<h3><span class="counterUp">127</span></h3>
<p>COUNTRIES</p>
</div>
</div>
</div>
</div>
</div>
<div class="lab-course">
<div class="section-header aos" data-aos="fade-up">
<div class="section-sub-head feature-head text-center">
<h2>Unlimited access to 360+ courses <br>and 1,600+ hands-on labs</h2>
</div>
</div>
<div class="icon-group aos" data-aos="fade-up">
<div class="offset-lg-1 col-lg-12">
<div class="row">
<div class="col-lg-1 col-3">
<div class="total-course d-flex align-items-center">
<div class="blur-border">
<div class="enroll-img ">
<img src="assets/img/icon/icon-09.svg" alt class="img-fluid">
</div>
</div>
</div>
</div>
<div class="col-lg-1 col-3">
<div class="total-course d-flex align-items-center">
<div class="blur-border">
<div class="enroll-img ">
<img src="assets/img/icon/icon-10.svg" alt class="img-fluid">
</div>
</div>
</div>
</div>
<div class="col-lg-1 col-3">
<div class="total-course d-flex align-items-center">
<div class="blur-border">
<div class="enroll-img ">
<img src="assets/img/icon/icon-16.svg" alt class="img-fluid">
</div>
</div>
</div>
</div>
<div class="col-lg-1 col-3">
<div class="total-course d-flex align-items-center">
<div class="blur-border">
<div class="enroll-img ">
<img src="assets/img/icon/icon-12.svg" alt class="img-fluid">
</div>
</div>
</div>
</div>
<div class="col-lg-1 col-3">
<div class="total-course d-flex align-items-center">
<div class="blur-border">
<div class="enroll-img ">
<img src="assets/img/icon/icon-13.svg" alt class="img-fluid">
</div>
</div>
</div>
</div>
<div class="col-lg-1 col-3">
<div class="total-course d-flex align-items-center">
<div class="blur-border">
<div class="enroll-img ">
<img src="assets/img/icon/icon-14.svg" alt class="img-fluid">
</div>
</div>
</div>
</div>
<div class="col-lg-1 col-3">
<div class="total-course d-flex align-items-center">
<div class="blur-border">
<div class="enroll-img ">
<img src="assets/img/icon/icon-15.svg" alt class="img-fluid">
</div>
</div>
</div>
</div>
<div class="col-lg-1 col-3">
<div class="total-course d-flex align-items-center">
<div class="blur-border">
<div class="enroll-img ">
<img src="assets/img/icon/icon-16.svg" alt class="img-fluid">
</div>
</div>
</div>
</div>
<div class="col-lg-1 col-3">
<div class="total-course d-flex align-items-center">
<div class="blur-border">
<div class="enroll-img ">
<img src="assets/img/icon/icon-17.svg" alt class="img-fluid">
</div>
</div>
</div>
</div>
<div class="col-lg-1 col-3">
<div class="total-course d-flex align-items-center">
<div class="blur-border">
<div class="enroll-img ">
<img src="assets/img/icon/icon-18.svg" alt class="img-fluid">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>


<footer class="footer">

<div class="footer-top aos" data-aos="fade-up">
<div class="container">
<div class="row">
<div class="col-lg-4 col-md-6">

<div class="footer-widget footer-about">
<div class="footer-logo">
<img src="assets/img/logo.svg" alt="logo">
</div>
<div class="footer-about-content">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut consequat mauris Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut consequat mauris</p>
</div>
</div>

</div>
<div class="col-lg-2 col-md-6">

<div class="footer-widget footer-menu">
<h2 class="footer-title">For Instructor</h2>
<ul>
<li><a href="instructor-profile.html">Profile</a></li>
<li><a href="login.html">Login</a></li>
<li><a href="register.html">Register</a></li>
<li><a href="instructor-list.html">Instructor</a></li>
<li><a href="deposit-instructor-dashboard.html"> Dashboard</a></li>
</ul>
</div>

</div>
<div class="col-lg-2 col-md-6">

<div class="footer-widget footer-menu">
<h2 class="footer-title">For Student</h2>
<ul>
<li><a href="student-profile.html">Profile</a></li>
<li><a href="login.html">Login</a></li>
<li><a href="register.html">Register</a></li>
<li><a href="students-list.html">Student</a></li>
<li><a href="deposit-student-dashboard.html"> Dashboard</a></li>
</ul>
</div>

</div>
<div class="col-lg-4 col-md-6">

<div class="footer-widget footer-contact">
<h2 class="footer-title">News letter</h2>
<div class="news-letter">
<form>
<input type="text" class="form-control" placeholder="Enter your email address" name="email">
</form>
</div>
<div class="footer-contact-info">
<div class="footer-address">
<img src="assets/img/icon/icon-20.svg" alt class="img-fluid">
<p> 3556 Beech Street, San Francisco,<br> California, CA 94108 </p>
</div>
<p>
<img src="assets/img/icon/icon-19.svg" alt class="img-fluid">
<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="d9bdabbcb8b4aab5b4aa99bca1b8b4a9b5bcf7bab6b4">[email&#160;protected]</a>
</p>
<p class="mb-0">
<img src="assets/img/icon/icon-21.svg" alt class="img-fluid">
+19 123-456-7890
</p>
</div>
</div>

</div>
</div>
</div>
</div>


<div class="footer-bottom">
<div class="container">

<div class="copyright">
<div class="row">
<div class="col-md-6">
<div class="privacy-policy">
<ul>
<li><a href="term-condition.html">Terms</a></li>
<li><a href="privacy-policy.html">Privacy</a></li>
</ul>
</div>
</div>
<div class="col-md-6">
<div class="copyright-text">
<p class="mb-0">&copy; 2023 DreamsLMS. All rights reserved.</p>
</div>
</div>
</div>
</div>

</div>
</div>

</footer>

</div>


<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/jquery.waypoints.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>

<script src="assets/plugins/select2/js/select2.min.js"></script>

<script src="assets/js/owl.carousel.min.js"></script>

<script src="assets/plugins/slick/slick.js"></script>

<script src="assets/plugins/aos/aos.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>