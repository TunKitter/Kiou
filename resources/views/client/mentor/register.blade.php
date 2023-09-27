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
<div class="error_message">
    @error('name')
    <span style="color: red;font-weight:lighter">{{$message}}</span>
    <br>
@enderror
</div>   
</div>
<label class="form-control-label">Profession</label>
<div class="form-group d-flex justify-content-center gap-2 align-items-center">
<input type="text" id="profession" name="profession" class="form-control" onblur="check_load_cate()"  placeholder="For example: Website designer, Graphic designer" oninput="enter_data()">  
<div class="spinner-border" id="loader" style="color: #f66962;display: none" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>
<div class="error_message">
    @error('profession')
    <span style="color: red;font-weight:lighter">{{$message}}</span>
    <br>
@enderror
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
    const promptString = `
Input categorize of these job :"Website Designer" in "{{$professions}}" . Return me a string with split by a comma that involve in this job. if "Website Designer" is invalid or not exist in "{{$professions}}", just return "invalid". if "Website Designer" not a job , just return "invalid"
Output HTML,CSS,Javascript,Front End
Input categorize of these job :"sdasde231" in "{{$professions}}" . Return me a string with split by a comma that involve in this job. if "sdasde231" is invalid or not exist in "{{$professions}}", just return "invalid". if "sdasde231" not a job , just return "invalid"
Output invalid
Input categorize of these job :"Front end" in "{{$professions}}" . Return me a string with split by a comma that involve in this job. if "Front end" is invalid or not exist in "{{$professions}}", just return "invalid". if "Front End" not a job , just return "invalid"
Output Front end,HTML,CSS,Javascript
Input categorize of these job :"Doctor" in "{{$professions}}" . Return me a string with split by a comma that involve in this job. if "Doctor" is invalid or not exist in "{{$professions}}", just return "invalid". if "Doctor" not a job , just return "invalid"
Output invalid
Input categorize of these job :"HTML" in "{{$professions}}" . Return me a string with split by a comma that involve in this job. if "HTML" is invalid or not exist in "{{$professions}}", just return "invalid". if "HTML" not a job , just return "invalid"
Output HTML, Front End
Input categorize of these job :"Full stack" in "{{$professions}}" . Return me a string with split by a comma that involve in this job. if "Full stack" is invalid or not exist in "{{$professions}}", just return "invalid". if "Full stack" not a job , just return "invalid"
Output Front End,Back End
Input categorize of these job :"PHP" in "{{$professions}}" . Return me a string with split by a comma that involve in this job. if "PHP" is invalid or not exist in "{{$professions}}", just return "invalid". if "PHP" not a job , just return "invalid"
Output PHP, Back End
Input categorize of these job :"Javascript" in "{{$professions}}" . Return me a string with split by a comma that involve in this job. if "Javascript" is invalid or not exist in "{{$professions}}", just return "invalid". if "Javascript" not a job , just return "invalid"
Output Javascript,Front End, Back End
Input categorize of these job :"Angular" in "{{$professions}}" . Return me a string with split by a comma that involve in this job. if "Angular" is invalid or not exist in "{{$professions}}", just return "invalid". if "Angular" not a job , just return "invalid"
Output Front End
Input categorize of these job :"React Native" in "{{$professions}}" . Return me a string with split by a comma that involve in this job. if "React Native" is invalid or not exist in "{{$professions}}", just return "invalid". if "React Native" not a job , just return "invalid"
Output Front End, Javascript
Input categorize of these job :"MongoDB" in "{{$professions}}" . Return me a string with split by a comma that involve in this job. if "MongoDB" is invalid or not exist in "{{$professions}}", just return "invalid". if "MongoDB" not a job , just return "invalid"
Output Back end
Input categorize of these job :"NextJs" in "{{$professions}}" . Return me a string with split by a comma that involve in this job. if "NextJs" is invalid or not exist in "{{$professions}}", just return "invalid". if "NextJs" not a job , just return "invalid"
Output Front End,Back End
Input categorize of these job :"Drawing" in "{{$professions}}" . Return me a string with split by a comma that involve in this job. if "Drawing" is invalid or not exist in "{{$professions}}", just return "invalid". if "Drawing" not a job , just return "invalid"
Output Graphic Designer
Input categorize of these job :"Ruby" in "{{$professions}}" . Return me a string with split by a comma that involve in this job. if "Ruby" is invalid or not exist in "{{$professions}}", just return "invalid". if "Ruby" not a job , just return "invalid"
Output Back End
Input`;
function loadCate() {
 let Input = `categorize of these job : ${profession.value} in "{{$professions}}" . Return me a string with split by a comma that involve in this job. if ${profession.value} is invalid or not exist in "{{$professions}}", just return "invalid". if "${profession.value}" not a job , just return "invalid"`   
fetch(`https://generativelanguage.googleapis.com/v1beta3/models/text-bison-001:generateText`,{
        method: 'POST',
        headers:{
            'Content-Type': 'application/json',
            'x-goog-api-key': API_KEY
        },
        body: JSON.stringify({
            prompt: { text: promptString + ' ' + Input + '\n' + 'Output' },
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
<input type="checkbox" name="${id_profession['{{$professions}}'.split(',').indexOf(element.trim())]}" value="${element}" class="profession_checkbox">
<span class="checkmark"></span>
</label>
</div>`
        });
        document.querySelector('#loader').style.display = 'none';
        checkbox_profession_method()
    }

    })

}
function check_load_cate(){
    if(profession.value.length > 3) {
    document.querySelector('#loader').style.display = 'block';
    loadCate()
    }
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
