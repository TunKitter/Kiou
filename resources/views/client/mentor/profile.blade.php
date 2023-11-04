@extends('client.layouts.master')
@section('content')
@if (Session::has('success'))
    @include('client.section.message',['type' => 'success', 'message' => Session::get('success')])
@endif
@if (Session::has('already_username'))
    @include('client.section.message',['type' => 'fail', 'message' => Session::get('already_username')])
@endif
<style>
    .infor-input:focus {
        border: 1px solid #fca483 !important ;
    }
fieldset  input:first-of-type {
    border: none !important
}
</style>
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
<div class="page-content">
<div class="container">
<div class="row">

<div class="col-xl-3 col-md-4 theiaStickySidebar">
<div class="settings-widget dash-profile mb-3">
<div class="settings-menu p-0">
<div class="profile-bg">
<h5>Beginner</h5>
<img src="{{asset('assets/img/instructor-profile-bg.jpg')}}" alt>
<div class="profile-img">
<a href="student-profile.html"><img src="{{asset('mentor/avatar/'. $mentor->image['avatar'])}}" alt></a>
</div>
</div>
<div class="profile-group">
<div class="profile-name text-center">
<h4><a href="#">{{ $mentor->name }}</a></h4>
<p>Mentor</p>
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
{{-- <a href="student-profile.html"><img src="{{asset('avatar/'. $mentor->image['avatar'])}}" alt class="img-fluid"></a> --}}
<div class="course-name">
<h4><a href="student-profile.html">{{ auth()->user()->mentor->name }}</a></h4>
<p>PNG or JPG no bigger than 800px wide and tall.</p>
</div>
</div>
<div class="profile-share d-flex align-items-center justify-content-center">
<label for="avatar" class="btn btn-success" onclick="document.getElementById('avatar').disabled = false">Update</label>
<input  disabled type="file" id="avatar" form="mentor" name="avatar" style="display: none" accept="image/*" onchange="enable_btn()">
<label href="javascript:;" class="btn btn-danger" onclick="delete_avatar()">Delete</label>
</div>
</div>
<div class="checkout-form personal-address add-course-info ">
<div class="personal-info-head">
<h4>Personal Details</h4>
<p>Edit your personal information and address.</p>
</div>
<form action="{{ route('mentor-profile') }}" id="mentor" method="POST" enctype="multipart/form-data">
    @csrf
<div class="row">
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label">Full Name <i class="icon feather-edit" onclick="un_disabled_input('name')"></i></label>
<input type="text" class="form-control infor-input" name="name" value="{{ $mentor->name }}" placeholder="Enter your first Name" disabled id="name">
<input type="hidden" name="profession" form="mentor">
<div class="error_message">
@error('name')
    <Kspan style="color: red;font-weight:lighter">{{$message}}</span>
@enderror
</div> 
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label class="form-control-label">Username <i class="icon feather-edit" onclick="un_disabled_input('username')"></i></label>
<input type="text" class="form-control infor_input" name="username" value="{{ $mentor->username }}" placeholder="Enter your last Name" disabled id="username">
@error('username')
<span style="color: red;font-weight:lighter">{{$message}}</span>
@enderror
</div>
</div>
 <label class="form-control-label">Profession</label>
                    <div class="form-group">
                        <fieldset class="field-card">
                            <div class="form-group form-group-tagsinput">
                                <input type="text" form="profile-form" data-role="tagsinput" onchange="check_profession()" class="input-tags form-control" name="professions_input" value="{{$mentor_professions}}" id="profession_input">
                            </div>
                            <div class="add-course-info">
                        <select class="form-select select country-select"  name="profession_select" onchange="selectProfession(this)">
                            <option value="#" disabled>Choose type</option>
                        @foreach ($professions as $profession)
                        <option value="{{$profession->_id}}">{{$profession->name}}</option>
                        @endforeach
                        </select>
                        </fieldset>
                    {{-- <span onclick="getProfession()" class="btn btn-primary">Check</span> --}}
                    {{-- <input type="text" id="profession" name="profession" class="form-control" onblur="check_load_cate()"  placeholder="For example: Website designer, Graphic designer" oninput="enter_data()">   --}}
                    
                    </div>

                                                       </div>

</div>
 
<div class="col-lg-6">
</div>
<div class="update-profile">
<button disabled type="submit" class="btn btn-primary border-0" id="btn-submit" onclick="getProfession()">Update Profile</button>
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
<script>
function un_disabled_input(id){
    let temp_input =document.getElementById(id) 
    temp_input.disabled = false
    temp_input.focus()
    enable_btn()
}
function enable_btn(){
    document.getElementById('btn-submit').disabled = false
}
function delete_avatar(){
    if(confirm('Are you sure to delete your avatar?')){
        fetch(location.href,{
            method: 'DELETE',
        }).then(data => data.text()).then(data => {
            if(data==1) {
                alert('Avatar deleted successfully')
                setTimeout(() => {
                    location.reload()
                }, 1000);
            }
            
        })
    }
}
</script>
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script>
        var is_change =false
        var professions = {}
        @foreach ($professions as $profession)
        professions[`{{$profession->name}}`] = "{{$profession->_id}}";
        @endforeach
            function selectProfession(obj) {
                is_change = true
                document.querySelector('fieldset input').value+= document.querySelector(`option[value="${obj.value}"]`).innerHTML
                // professions[document.querySelector(`option[value="${obj.value}"]`).innerHTML] =  obj.value
                document.querySelector('fieldset input').click()
                console.log(professions);
                document.getElementById('btn-submit').disabled = false
                check_profession()
            }
        function getProfession() {
          let ids = (document.querySelector('#profession_input').value.split(',').map(profession=> {
                return professions[profession]
            }));
             document.querySelector('input[name=profession]').value = ids.join(',')
            //  alert(document.querySelector('input[name=profession]').value)
            // return false
            document.forms[0].submit()           
        }
        function check_profession(){
            if(is_change){
                
            // console.log(document.querySelector('#profession_input').value, '++', document.querySelector('fieldset input').value);
            if( document.querySelector('#profession_input').value.length == 0){ 
                document.getElementById('btn-submit').disabled = true
            }
            else {
                document.getElementById('btn-submit').disabled = false
            }
        }
            }
        </script>
@endsection
