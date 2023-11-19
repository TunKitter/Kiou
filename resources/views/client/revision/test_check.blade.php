@extends('client.layouts.master')
@section('content')
<style>
    #rocket {
        overflow: hidden;
        animation: ttop 2s forwards;
        animation-delay: 1s;
    }
    #result {
        opacity: 0;
        animation: demo 2s forwards;
        animation-delay: 3s 
    }
@keyframes demo {
    100% {
opacity: 1;
    }
}
@keyframes ttop {
    50% {

    transform: translateY(-20%);
    }
100% {
transform: translateY(-20%) translateX(-150%);
    width: 100px;
}
}
</style>
<button type="button" class="btn btn-primary d-none" id="btn_modal" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button>
<div class="modal fade" tabindex="-1" id="exampleModal">
    <div class="modal-dialog" >
      <div class="modal-content">
        <div class="modal-header"  style="background: #ecf0f1">
          <h5 class="modal-title">Your result</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="background: #ecf0f1;height: 200px">
<img src="https://cdn.dribbble.com/users/285803/screenshots/1066705/dribbble.gif" id="rocket" width="70%" style="display: block;margin: auto"  alt="">
<div id="result">
    <ul class="list-group list-unstyled">
        <li>Total Correct: <span id="total_correct" class="text-green">0</span></li>
        <li>Total Wrong: <span id="total_wrong" class="text-danger">0</span></li>
    </ul>
    <button class="d-block w-100 btn text-white mt-2" id="noti_result">Your <span class="fw-bold">Js Data Type</span> point was</button>
</div>
        </div>
        <div class="modal-footer"  style="background: #ecf0f1">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>
<div style="min-height: 70vh; display: flex;align-items:center;flex-direction: column" class="container">
<h2 style="font-weight: 700;font-size: 2.9em">{{$category->name}}</h2>        
<button class="btn btn-primary mt-5" id="btn_start" onclick="this.style.display='none';$('.revision-wrapper').removeClass('d-none');$('#loading').css('display','block');getQuestion()">Click here to start your exam</button>
<div class="revision-wrapper d-none">
    <style>
        #loading {
            margin-top: 4em;
        }
    </style>
    @include('client.section.loading') 
    <br>
    <div id="quotes">
        <figure>
            <blockquote class="blockquote">
              <p id="quote">A well-known quote, contained in a blockquote element.</p>
            </blockquote>
            <figcaption class="blockquote-footer" id="author">
              Tunkit
            </figcaption>
          </figure>
    </div>
<div id="exam"></div>
</div>
</div>
<script>
    fetch('https://api.api-ninjas.com/v1/quotes?category=learning',{
        method: 'GET',
        headers:{
            'X-Api-Key': 'iyQzdhpq+hC+NhZ059//Mg==GTIq3SbQOh8S3PjE'
        }
    }).then(res => (res.json())).then(data => {
    document.querySelector('#quote').innerHTML = data[0]['quote'] 
    document.querySelector('#author').innerHTML = data[0]['author']
    })
   const API_KEY = 'AIzaSyBFUaOX3h_CxqI6Q6DtaMwNBj4Le3TV-NQ'
   const exam = document.getElementById('exam')
   var user_select = []
   var correct_select = []
   function getQuestion(){
   fetch(`https://generativelanguage.googleapis.com/v1beta3/models/text-bison-001:generateText`,{
        method: 'POST',
        headers:{
            'Content-Type': 'application/json',
            'x-goog-api-key': API_KEY
        },
        body: JSON.stringify({
            prompt: { text: `return me 7 questions that one correct answer with the key is "correctAnswer" and an array with key is "wrongAnswers" contains 3 wrong answers about {{$category->name}} with json as your response as json format`},
        })
    }).then(res => (res.json())).then(data => {
        document.querySelector('#quotes').style.display = 'none';
        console.log(data);
        let questions = (JSON.parse(data['candidates'][0]['output'].replace('```json','').replace('```','')));
        let index = 0;
        console.log(questions);
        questions.map(e => {
            correct_select[`question_${index}`] = e.correctAnswer
            let temp_e = ([e.correctAnswer,e.wrongAnswers[0],e.wrongAnswers[1],e.wrongAnswers[2]].sort(() => Math.random() - 0.5));
            exam.innerHTML += `
<div>    
<div class="categories-head d-flex align-items-center">
<h4 class="text-muted">${e.question}</h4>
</div>
<div>
<label class="custom_check custom_one">
<input type="radio" name="question_${index}" onclick="selectOption('question_${index}','${temp_e[0]}')">
<span class="checkmark"></span> <span ${temp_e[0] == e.correctAnswer ? 'class="question_'+ index + '_correct"' : ''}> ${temp_e[0]}</span>
</label>
</div>
<div>
<label class="custom_check custom_one">
<input type="radio" name="question_${index}" onclick="selectOption('question_${index}','${temp_e[1]}')">
<span class="checkmark"></span> <span ${temp_e[1] == e.correctAnswer ? 'class="question_' + index + '_correct"' : ''}> ${temp_e[1]}</span>
</label>
</div>
<div>
<label class="custom_check custom_one">
<input type="radio" name="question_${index}" onclick="selectOption('question_${index}','${temp_e[2]}')">
<span class="checkmark"></span> <span ${temp_e[2] == e.correctAnswer ? 'class="question_' + index + '_correct"' : ''}> ${temp_e[2]}</span>
</label>
</div>
<div>
<label class="custom_check custom_one">
<input type="radio" name="question_${index}" onclick="selectOption('question_${index}','${temp_e[3]}')">
<span class="checkmark"></span> <span ${temp_e[3] == e.correctAnswer ? 'class="question_' + index + '_correct"' : ''}> ${temp_e[3]}</span>
</label>
</div>
<br>
</div>
 `
 index++
        })
            document.getElementById('loading').style.display = 'none'
            exam.innerHTML+= '<button class="btn btn-primary" onclick="submitTest(this)">Submit</button>'
    })
}
function selectOption(name,value) {
    user_select[name] = value   
}
function submitTest(obj) {
obj.disabled = true;
// obj.innerHTML = 'Please wait...'
let total_correct = 0;
let total_wrong = 0;
 for (let i = 0; i< 7; i++) {
    document.querySelector('.question_'+ i + '_correct').classList.add('text-green','fw-bold')
    if(user_select[`question_${i}`] == correct_select[`question_${i}`]) {
        total_correct++
    }
    else {
    total_wrong++
}
}   

setTimeout(() => {
document.querySelector('#btn_modal').click()
},1400)
console.log(total_correct,total_wrong);
document.querySelector('#total_correct').innerHTML = total_correct;
document.querySelector('#total_wrong').innerHTML = total_wrong;
var noti_result = document.querySelector('#noti_result')
if(total_wrong > 0) {
    noti_result.classList.add('bg-danger-light')
    noti_result.innerHTML+= ' decreased, Keep trying!'
}
else {
    noti_result.classList.add('bg-green')
    noti_result.innerHTML+= ' increased, Congratulations!'
}
let default_0_user = {{$user_skill->infor[0]}};
let default_1_user = {{$user_skill->infor[1]}};
let default_2_user = {{$user_skill->infor[2]}};
default_0_user = default_0_user - (total_wrong * 5);
default_1_user = default_0_user - (total_wrong * 10);
default_2_user = default_0_user - (total_wrong * 14);
default_0_user = default_0_user < 0 ? 0 : default_0_user;
default_1_user = default_1_user < 0 ? 0 : default_1_user;
default_2_user = default_2_user < 0 ? 0 : default_2_user;
    console.log(default_0_user,default_1_user,default_2_user);
        const formData = new FormData();
        const data = {
            "{{$user_skill->_id}}" : [default_0_user,default_1_user,default_2_user]
        }
        formData.append('data',JSON.stringify(data));
        fetch('{{route("revision-test-test-update","demo")}}',{
            method:"POST",
            body: formData
        }).then(res => res.json()).then(data => {
            console.log(data);
        })

}

</script>
@endsection