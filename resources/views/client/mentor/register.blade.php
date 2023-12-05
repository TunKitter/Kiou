@extends('client.layouts.mentor_auth')
@section('content')
@if(Session::has('not_found_profession'))
@include('client.section.message',['type' => 'Fail','message' => Session::get('not_found_profession')])
@endif
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
<div class="login-wrapper">
<div class="loginbox">
<div class="w-100">
<div class="img-logo">
<img src="{{asset('assets/img/logo.svg')}}" class="img-fluid" alt="Logo">

</div>
<h1>Register mentor</h1>
<form action="{{route('mentor-register')}}" method="POST">
    @csrf
<div class="form-group">
<label class="form-control-label">Full Name</label>
<input type="text" id="email" name="name" class="form-control" placeholder="Enter your mentor's name" oninput="enter_data()">
<div class="error_message">
    @error('name')
    <span style="color: red;font-weight:lighter">{{$message}}</span>
    <br>
@enderror
</div>   
</div>
<div class="form-group">
<label class="form-control-label">Username</label>
<input type="text" name="username" class="form-control" placeholder="Enter your username" oninput="enter_data()">
<input type="hidden" name="profession" >
<div class="error_message">
    @error('username')
    <span style="color: red;font-weight:lighter">{{$message}}</span>
    <br>
@enderror
</div>   
</div>
<label class="form-control-label">Profession</label>
<div class="form-group">
    <fieldset class="field-card">
        <div class="form-group form-group-tagsinput">
            <input type="text" data-role="tagsinput" oninput="enter_data()" class="input-tags form-control " name="professions_input" value="" id="profession_input" >
        </div>
        <div class="add-course-info">
    <select class="form-select select country-select"  name="profession_select" onchange="selectProfession(this)">
        <option value="#" disabled>Choose type</option>
    @foreach ($data as $profession)
    <option value="{{$profession->_id}}">{{$profession->name}}</option>
    @endforeach
    </select>
    </fieldset>
{{-- <span onclick="getProfession()" class="btn btn-primary">Check</span> --}}
{{-- <input type="text" id="profession" name="profession" class="form-control" onblur="check_load_cate()"  placeholder="For example: Website designer, Graphic designer" oninput="enter_data()">   --}}

</div>
<div class="error_message">
    @error('profession')
    <span style="color: red;font-weight:lighter">{{$message}}</span>
    <br>
@enderror
</div> 
<div class="d-grid">
<button class="btn btn-primary btn-start" type="submit" disabled onclick="getProfession()">Register mentor</button>
</div>
</form>
</div>
</div>
</div>
<script>
    var API_KEY = 'AIzaSyBFUaOX3h_CxqI6Q6DtaMwNBj4Le3TV-NQ'
    var btn_login = document.querySelector('.btn-start');
    var inputs = (document.querySelectorAll('input[oninput="enter_data()"]'))
    var inputs_length = inputs.length
    function enter_data(){
    let check_ = true
        for(let i = 0 ; i < inputs_length; i++) {
            if(i == inputs_length-1){
                if(inputs[i].value.length > 0){
                    btn_login.removeAttribute('disabled');
                return;
                }
            }
            if(inputs[i].value.length < 5){
                btn_login.setAttribute('disabled', true);
                return;
            }
        }
        if(check_)    btn_login.removeAttribute('disabled');
    
    }
    </script>
    <script>
        var professions = {}
            function selectProfession(obj) {
                document.querySelector('fieldset input').value+= document.querySelector(`option[value="${obj.value}"]`).innerHTML
                professions[document.querySelector(`option[value="${obj.value}"]`).innerHTML] =  obj.value
                document.querySelector('fieldset input').click()
                console.log(professions);
            }
            document.querySelector('fieldset input').onchange = function(){
                enter_data()
            }
        function getProfession() {
          let ids = (document.querySelector('#profession_input').value.split(',').map(profession=> {
                return professions[profession]
            }));
          document.querySelector('input[name=profession]').value = ids.join(',')
            document.forms[0].submit()
        }
        </script>
        <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
        <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js')}}"></script>
        <script src="{{asset('assets/js/script.js')}}"></script>
@endsection
