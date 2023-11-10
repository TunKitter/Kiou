@extends('client.layouts.master')
@section('content')
<style>
    #editor {
        width: 70%;
        height: 300px;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 5px;
        box-sizing: border-box;
        font-size: 1.2em;
        font-family: monospace;
        word-break: break-all;
    }
#output {
    word-break: break-all;
    border: 1px solid #ccc;
    width: 30%;
    padding: 10px;
    box-sizing: border-box;
    font-size: 1.2em;
}
#success {
    /* width: 100vw; */
    /* height: 100vh;    */
    position: absolute;
    z-index: 99;
}
</style>
{{-- <img src="https://cdn.dribbble.com/users/206390/screenshots/3539982/exploration_06_dribbble.gif" id="success"> --}}
{{-- <img src="https://i.pinimg.com/originals/5b/83/ef/5b83ef5ba73ca499f556bce1859dd9ab.gif" id="so_hard" class="float-end" style="width: 200px"> --}}
<div class="ms-2">
    <h1>Requirement</h1>
<p>{{$mentor_assignment->description}}</p>
<div class="d-flex justify-content-between">
 <p class="text-muted">Assignment by <span class="text-primary">{{$mentor_name}}</span> <button class="btn btn-primary" onclick="saveCode(this)">Save</button></p>
<p class="text-green" style="display: none" id="correct"><i class="fas fa-check"></i> Congratulations! You're done <button class="btn" id="finish" onclick="location.href = '{{route('revision-code-list')}}'" style="background:#0dd3a3;color:white;margin-left:1em">Finish</button></p>   
</div>
</div>
<div style="clear: right"></div>
<div class="d-flex">
<div id="editor"></div>
<div id="output"></div>
</div>
<br>
<button class="btn btn-primary ms-2" onclick="runCode()">Run</button>
<button class="btn btn-primary ms-2" onclick="clearOutput()">Clear Output</button>
<script src="{{asset('lib/ace.js')}}"></script>
<script src="{{asset('lib/theme-xcode.js')}}" type="text/javascript" charset="utf-8"></script>
<script>
    var editor = null
    document.body.onload = function() {
         editor = ace.edit("editor");
        editor.setValue(`{!!$mentor_assignment_code!!}`);
        editor.setTheme("ace/theme/lib/xcode");
        editor.session.setMode("ace/mode/javascript");
        editor.setShowPrintMargin(false);
        editor.setWrapMode("off");
    }
    console.stdlog = console.log.bind(console);
console.logs = [];
console.log = function(){
    console.logs.push(Array.from(arguments));
    console.stdlog.apply(console, arguments);
}
const output = document.getElementById('output')
var is_nothing = false
    function runCode() {
        let code = editor.getValue();      
        try {
            
     eval(code);
        } catch (error) {
            output.innerHTML = '<span style="color:red">'+ error +'</span>'
        }
        // if(!aa) alert(99)
if(is_nothing) {
    clearOutput()
    is_nothing = false
}
let check_result = checkCondition(code) 
     if(console.logs.length > 0 || check_result) {
        console.log(check_result);
        if(check_result) {
            output.innerHTML = '<span style="color:red">'+ check_result +'</span>'
            is_nothing = true
            console.logs = []
        }
        else {
            output.innerHTML= console.logs.map(log => {
            if(log == '{{$mentor_assignment->condition_code["output"]}}') {
                fetch('{{route("revision-code",request()->id)}}',{
                    method: 'POST',
                }).then(res => res.json()).then(data => console.log(data))
                document.getElementById('correct').style.display = 'block'
                window.scrollTo({ top: 0, behavior: "smooth" });
                document.querySelectorAll('button:not(#finish)').forEach(btn => btn.disabled = true)
                editor.setReadOnly(true);
                return '<span class="text-green">'+ log +'</span>'
            }
                return log.join(' ')
            }).join('<br>')

            is_nothing = false
        }
     }
     else {
         if(is_nothing) {
      output.innerHTML = '<span style="color:red">There are nothing to display</span>'
          is_nothing = true
        }
     }
    }
    function clearOutput() {
        is_nothing = true
        console.logs = []
        output.innerHTML = ''
    }
</script>
<script>
var conditions = {!!$conditions!!}
function checkCondition(myCode) {
    for(let key in conditions) {
        switch (key) {
            case 'not_if':
                {
                if(myCode.includes('if')) {
                    return 'You cannot use if statement'
                }
                break;
                }
            case 'max_char': {
                if(myCode.length > conditions[key]) {
                    return 'Your character code is exceed ' + conditions[key]
                }
                break;
            }
            case 'max_line': {
                if(myCode.split('\n').length > conditions[key]) {
                    return 'Your line code is exceed ' + conditions[key]
                }
                break;
            }
        }
    }
}
function saveCode(obj) {
    obj.disabled = true;
    obj.innerHTML = 'Saving...'
    let formData = new FormData();
    formData.append('code',new Blob([editor.getValue()], {type: 'text/plain'}));
    formData.append('code_name','{{$user_asm->code_path}}');
    fetch('{{route("revision-code-save-code",request()->id)}}',{
    method: 'POST',
    body: formData
}).then(res => res.json()).then(data => {
    obj.disabled = false;
    obj.innerHTML = 'Save'
})   
}
setInterval(() => {
   saveCode()
}, 60000);

</script>
@endsection