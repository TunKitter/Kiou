@extends('client.layouts.mentor_auth')
@section('content')
<div class="login-wrapper">
<div class="loginbox">
<div class="w-100">
<div class="img-logo">
<img src="{{asset('assets/img/logo.svg')}}" class="img-fluid" alt="Logo">

</div>
<h1>Đăng ký mentor</h1>
<form action="{{route('mentor-register')}}" method="POST">
    @csrf
<div class="form-group">
<label class="form-control-label">Full Name</label>
<input type="text" id="email" name="name" class="form-control" placeholder="Enter your mentor's name" oninput="enter_data()">
</div>
<label class="form-control-label">Describe Your Profession</label>
<div class="form-group d-flex justify-content-center gap-2 align-items-center">
<input type="text" id="profession" name="profession" class="form-control" onblur="document.querySelector('#loader').style.display = 'block';loadCate()" placeholder="My majority is IT" oninput="enter_data()">
<div class="spinner-border" id="loader" style="color: #f66962;display: none" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>
<div class="professions">
{{-- <div class="remember-me">
<label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> IT
<input type="checkbox" name="radio" onclick="demo()">
<span class="checkmark"></span>
{{-- </label> --}}
</div>
</div>

<div class="d-grid">
<button class="btn btn-primary btn-start" type="submit" disabled>Đăng ký mentor</button>
</div>
</form>
</div>
</div>
</div>
<script>
    var profession = document.querySelector('#profession')
    var API_KEY = 'AIzaSyBFUaOX3h_CxqI6Q6DtaMwNBj4Le3TV-NQ'
    var professions =  document.querySelector('.professions');
    var id_profession = "{{$id_professions}}".split(',')
function loadCate() {
fetch(`https://generativelanguage.googleapis.com/v1beta3/models/text-bison-001:generateText`,{
        method: 'POST',
        headers:{
            'Content-Type': 'application/json',
            'x-goog-api-key': API_KEY
        },
        body: JSON.stringify({
            prompt: { text: `categorize of these job : ${profession.value} in "{{$professions}}" . Return me a string with split by a comma that involve in this job. if these job is invalid or not exist in "{{$professions}}", just return "invalid"` }
        })
    }).then(res => (res.json())).then(data => {
        let result = data['candidates'][0]['output']
        if(result.includes('invalid')){
            professions.innerHTML = ''
            professions.innerHTML+= `<p class="text-danger">invalid</p>`
        document.querySelector('#loader').style.display = 'none';
        }
        else {

            professions.innerHTML = ''
        result.split(',').forEach((element,index) => {
            professions.innerHTML+= `<div class="remember-me">
<label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> ${element}
<input type="checkbox" name="${id_profession[index]}" value="${element}" class="profession_checkbox">
<span class="checkmark"></span>
</label>
</div>`
        });
        document.querySelector('#loader').style.display = 'none';
        checkbox_profession_method()
    }

    })

}

    var btn_login = document.querySelector('.btn-start');
    var inputs = (document.querySelectorAll('input[oninput="enter_data()"]'))
    var inputs_length = inputs.length
    function enter_data(){
    let check_ = true
        for(let i = 0 ; i < inputs_length; i++) {
            if(inputs[i].value.length < 5){
                btn_login.setAttribute('disabled', true);
                return;
            }
        }
        if(check_)    btn_login.removeAttribute('disabled');
        checkbox_profession_method()
    
    }
function checkbox_profession_method(){
    btn_login.setAttribute('disabled', true);
    let checkbox_profession = document.querySelectorAll('.profession_checkbox')
    checkbox_profession.forEach(element => {
        element.onchange = function(){
            let check_2 = false
            checkbox_profession.forEach(element2 => {
                if(element2.checked) {
                    btn_login.removeAttribute('disabled');
                    check_2 = true
                } 
            });
            if(!check_2) btn_login.setAttribute('disabled', true);
        }
    }); 
}
    </script>
@endsection
