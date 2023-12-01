@extends('client.layouts.master')
@section('content')
@if ($message = Session::get('success'))
@include('client.section.message', ['message' => $message,'type'=>'success'])
@endif
<style>
    .infor_input:focus {
        border: 1px solid #fca483 !important ;
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
                                <img src="{{asset('assets/img/profile-bg.jpg')}}" alt>
                                <div class="profile-img">
                                    @if($user->image['avatar'] == null)
                                        <a href="student-profile.html"><img src="{{asset('assets/img/user/avatar.jpg')}}" alt></a>
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
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="feather-settings"></i> Edit Profile
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('mycourses')}}" class="nav-link">
                                        <i class="feather-book"></i> My Courses
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('userskill') }}" class="nav-link">
                                        <i class="feather-user"></i>  User Chart
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
                                    <a href="{{route('profile-password', $user->id)}}" class="nav-link">
                                        <i class="feather-lock"></i> Password
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
                                <h3>Profile Details</h3>
                                <p>You have full control to manage your own account setting.</p>
                            </div>
                            <div class="course-group mb-0 d-flex">
                                <div class="course-group-img d-flex align-items-center">
                                  
                                        {{-- <a href="student-profile.html"><img src="{{$user->image" alt class="img-fluid"></a> --}}
                                       
                            
                                    <div class="course-name">
                                        <h4><a href="student-profile.html">Your avatar</a></h4>
                                        <p>PNG or JPG no bigger than 800px wide and tall.</p>
                                        
                                    </div>
                                </div>
                                <div class="profile-share d-flex align-items-center justify-content-center">
                                    <label class="btn btn-success" for="avatar" onclick="document.getElementById('avatar').disabled = false" >
                                       Update 
                                    </label>
                                    <input onchange="document.getElementById('btn-submit').disabled = false" disabled type="file" name="avatar" style="display: none" id="avatar"accept="image/*" form="profile-form">
                                    <label  class="btn btn-danger" onclick="delete_avatar()">Delete</label>
                                </div> 
                            </div>
                            @error('avatar')
        <span class="text-danger text-center d-block">{{$message}}</span>
                            @enderror
                            <div class="checkout-form personal-address add-course-info ">
                                <div class="personal-info-head">
                                    <h4>Personal Details</h4>
                                    <p>Edit your personal information and address.</p>
                                </div>
                                <form action="{{route('profile')}}" method="POST" id="profile-form" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Username <i class="icon feather-edit" onclick="un_disabled_input('username')"></i></i></label>
                                                <input type="text" class="form-control infor_input" placeholder="Enter your Username" id="username"
                                                    name="username" value="{{ $user->username }}" disabled>
                                                @error('username')
                                                    <span style="color: red">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Full Name <i class="icon feather-edit" onclick="un_disabled_input('name')"></i></label>
                                                <input type="text" class="form-control infor_input" disabled
                                                    placeholder="Enter your first Name" name="name" value="{{$user->name}}" id="name">
                                                    @error('name')
                                                    <span style="color: red">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Phone <i class="icon feather-edit" onclick="un_disabled_input('phone')"></i></label>
                                                <input type="text" class="form-control infor_input" disabled placeholder="Enter your Phone"
                                                    name="phone" value="{{ $user->phone }}" id="phone">
                                                @error('phone')
                                                    <span style="color: red">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Email <i class="icon feather-edit" onclick="un_disabled_input('email')"></i></label>
                                                <input type="text" class="form-control infor_input" placeholder="Enter your Email" id="email"
                                                    name="email" value="{{ $user->email }}" disabled>
                                                @error('email')
                                                    <span style="color: red">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                    <label class="form-control-label">Profession</label>
                    <div class="form-group">
                        <fieldset class="field-card">
                            <div class="form-group form-group-tagsinput">
                                <input type="text" form="profile-form" data-role="tagsinput" onchange="check_profession()" class="input-tags form-control" name="professions_input" value="{{$user_professions}}" id="profession_input">
                                <input type="hidden" name="profession">
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
                                                   
                                        <div class="d-flex justify-content-center  gap-2">
                                         <div class="update-profile">
                                            <button type="submit" class="btn btn-primary border-0" id="btn-submit" disabled onclick="getProfession()">Update Profile</button>
                                        </div>
                                        @unless(auth()->user()->auth['google'])
                                        <div class="update-profile">
                                            <label class="btn btn-primary text-white" id="update_password" onclick="location.href='{{route('profile-password')}}'" >Change Password</label>
                                            <style>
                                                #update_password:hover{
                                                    color: #fc7f50 !important;
                                                }
                                            </style>
                                        </div>
                                        @endunless
                                            
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
        let input_temp = document.getElementById(id)
        input_temp.disabled = false
        input_temp.focus()
        document.getElementById('btn-submit').disabled = false
        
    }
function delete_avatar(){
    if(confirm('Are you sure to delete your avatar?')){
        fetch(location.href,{
            method: 'DELETE',
        }).then(data => data.json()).then(data => {
            console.log(data);
            if(data.status=='success') {
                alert('Avatar deleted successfully')
                setTimeout(() => {
                    location.reload()
                }, 1000);
            }
            
        })
    }
}
</script>
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
            // console.log(professions);
            document.getElementById('btn-submit').disabled = false
            check_profession()
        }
    function getProfession() {
      let ids = (document.querySelector('#profession_input').value.split(',').map(profession=> {
            return professions[profession]
        }));
         document.querySelector('input[name=profession]').value = ids.join(',')
        return false
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
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
@endsection
