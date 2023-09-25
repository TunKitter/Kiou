@extends('client.layouts.master')
@section('content')
<div class="page-content">
<div class="container">
<div class="row">

<div class="col-xl-3 col-md-4 theiaStickySidebar">
<div class="settings-widget dash-profile mb-3">
<div class="settings-menu p-0">
<div class="profile-bg">
<h5>Beginner</h5>
<img src="assets/img/profile-bg.jpg" alt>
<div class="profile-img">
<a href="student-profile.html"><img src="assets/img/user/user11.jpg" alt></a>
</div>
</div>
<div class="profile-group">
<div class="profile-name text-center">
<h4><a href="student-profile.html">Rolands R</a></h4>
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


<div class="col-xl-9 col-md-8">
<div class="settings-widget profile-details">
<div class="settings-menu p-0">
<div class="profile-heading">
<h3>Profile Details</h3>
<p>You have full control to manage your own account setting.</p>
</div>
<div class="course-group mb-0 d-flex">
<div class="course-group-img d-flex align-items-center">
<a href="student-profile.html"><img src="assets/img/user/user11.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="student-profile.html">Your avatar</a></h4>
<p>PNG or JPG no bigger than 800px wide and tall.</p>
</div>
</div>
<div class="profile-share d-flex align-items-center justify-content-center">
<a href="javascript:;" class="btn btn-success">Update</a>
<a href="javascript:;" class="btn btn-danger">Delete</a>
</div>
</div>
<div class="checkout-form personal-address add-course-info ">
<div class="personal-info-head">
<h4>Personal Details</h4>
<p>Edit your personal information and address.</p>
</div>
<form action="#">
<div class="row">
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label">First Name</label>
<input type="text" class="form-control" placeholder="Enter your first Name">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label">Last Name</label>
<input type="text" class="form-control" placeholder="Enter your last Name">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label">Phone</label>
<input type="text" class="form-control" placeholder="Enter your Phone">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label">Email</label>
<input type="text" class="form-control" placeholder="Enter your Email">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label">Birthday</label>
<input type="text" class="form-control" placeholder="Birth of Date">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label class="form-label">Country</label>
<select class="form-select select country-select" name="sellist1">
<option>Select country</option>
<option>India</option>
<option>America</option>
<option>London</option>
</select>
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label">Address Line 1</label>
<input type="text" class="form-control" placeholder="Address">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label">Address Line 2 (Optional)</label>
<input type="text" class="form-control" placeholder="Address">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label">City</label>
<input type="text" class="form-control" placeholder="Enter your City">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label">ZipCode</label>
<input type="text" class="form-control" placeholder="Enter your Zipcode">
</div>
</div>
<div class="update-profile">
<button type="button" class="btn btn-primary">Update Profile</button>
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

