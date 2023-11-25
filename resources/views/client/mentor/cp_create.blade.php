@extends('client.layouts.master')
@section('content')
<style>
    .editor {
        width: 100%;
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<section class="page-content course-sec">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-12">
<button class="btn btn-success-dark float-end d-block px-5 mb-2 save-btn" disabled onclick="saveData(this)">Save</button>
          {{-- <div class="add-course-header">
            <h2>Detail</h2>
            <div class="add-course-btns">
              <ul class="nav">
                <li>
                  <a href="dashboard-instructor.html" class="btn btn-black"
                    >Back to Course</a
                  >
                </li>
                <li>
                  <a href="javascript:void(0);" class="btn btn-success-dark"
                    >Save</a
                  >
                </li>
              </ul>
            </div>
          </div> --}}
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="widget-set">
              <div class="widget-setcount">
                <ul id="progressbar">
                  <li class="progress_demo progress-active">
                    <p onclick="showScreen(0)"><span></span> Basic Information</p>
                  </li>
                  <li class="progress_demo">
                    <p onclick="showScreen(1)"><span></span>Detail & Condition</p> </li>
                  <li class="progress_demo">
                    <p onclick="showScreen(2)"><span></span>Test</p>
                  </li>
                </ul>
              </div>
              <div class="widget-content multistep-form">
                <fieldset id="first" class="field-card">
                  <div class="add-course-info">
                    <div class="add-course-inner-header">
                      <h4>Basic Information</h4>
                    </div>
                    <div class="add-course-form">
                        <form action="#">
                        <div class="form-group">
                          <label class="add-course-label"
                            >Description</label>
                          <input
                            type="text" name="description"
                            class="form-control"
                            placeholder="Enter description" 
                          />
                        </div>
                        <div class="form-group">
                          <label class="add-course-label">Category</label>
                          <select class="form-control select" name="category" id="category">
                              @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label class="add-course-label">Level</label>
                          <select class="form-control select" name="level" id="level">
                              @foreach ($level as $item)
                                <option value="{{$item->id}}" >{{$item->name}}</option>
                              @endforeach
                          </select>
                        </div> 
                      </form>
                  </div>
                </fieldset>
                <fieldset class="field-card">
                  <div class="add-course-info">
                    <div class="add-course-inner-header">
                      <h4>Detail & Condiditon</h4>
                    </div>
                    <div class="add-course-form">
                      <div class="form-group mb-0">
                          <label class="add-course-label"
                            >Base Code</label>
                          <div name="base_code" id="base_code" class="editor" class="form-control" ></div>
                        </div>
                        <div class="form-group mb-0 mt-2">
                          <label class="add-course-label"
                            >Condition</label>
                          <div name="condition_code" class="editor" id="condition_code" class="form-control"></div>
                        </div>
                    </div>
                    
                  </div>
                </fieldset>
                <fieldset class="field-card">
                  <div class="add-course-info">
                    <div class="add-course-inner-header">
                      <h4>Test</h4>
                    </div>
                    <div class="add-course-section">
<p class="text-green" style="display: none" id="correct"><i class="fas fa-check"></i> Passed</p>   
                      <div class="d-flex">
                        <div class="editor" id="test_code"></div>
                        <div id="output"></div>
                        </div>
<br>
                        <button class="btn btn-primary ms-2" onclick="runCode()">Run</button>
                        <button class="btn btn-primary ms-2" onclick="clearOutput()">Clear Output</button>
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<script>
  var index_tab = 0;
function showScreen(n) {
  index_tab = n;
  document.querySelector('.save-btn').disabled = true;
  if(n == 2) {
  document.querySelector('.save-btn').disabled = false;
  test_code.setValue(base_code.getValue());
  }
    $('.field-card').css('display', 'none');
    $('.field-card').eq(n).css('display', 'block');
    $('.progress_demo').removeClass('progress-active');
    $('.progress_demo').eq(n).addClass('progress-active');
}
function saveData(obj) {
  obj.disabled = true;
  obj.innerHTML = 'Saving...'
  let formData = new FormData();
  formData.append('category_id', document.querySelector('select[name="category"]').value);
  formData.append('level_id', document.querySelector('select[name="level"]').value);
  formData.append('description', document.querySelector('input[name="description"]').value);
  formData.append('base_code', base_code.getValue());
  formData.append('condition_code',condition_code.getValue().split('\n').join(',').trim().replace(/,*$/, '').replaceAll('"',""));
  fetch('{{route("mentor-cp-create")}}',{
    method: 'POST',
    body: formData
  }).then(res => res.text()).then(data => {
    console.log(data);
    obj.innerHTML = 'Saved'
      setTimeout(() => {
      location.href = '{{route("mentor-cp")}}'
      }, 2000);
  })
}
</script>
<script src="{{asset('lib/ace.js')}}"></script>
<script src="{{asset('lib/theme-xcode.js')}}" type="text/javascript" charset="utf-8"></script>
<script>
    var base_code = null
    var condition_code = null
    var test_code = null
    var conditions = {}
    document.body.onload = function() {
         base_code= ace.edit("base_code");
        base_code.setTheme("ace/theme/lib/xcode");
        base_code.session.setMode("ace/mode/javascript");
        base_code.setShowPrintMargin(false);
      condition_code = ace.edit("condition_code");
        condition_code.setTheme("ace/theme/lib/xcode");
        condition_code.session.setMode("ace/mode/json");
        condition_code.setShowPrintMargin(false);
        condition_code.getSession().setUseWorker(false);
        test_code = ace.edit("test_code");
        test_code.setTheme("ace/theme/lib/xcode");
        test_code.session.setMode("ace/mode/javascript");
        test_code.setShowPrintMargin(false);
        test_code.setValue(base_code.getValue());
condition_code.getValue().replaceAll('"','').trim().split('\n').map((key) => {
    conditions[key.split(':')[0]] =  key.split(':')[1].trim()
})
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
      conditions = {}
condition_code.getValue().replaceAll('"','').trim().split('\n').map((key) => {
    conditions[key.split(':')[0]] =  key.split(':')[1].trim()
})
        let code = test_code.getValue();      
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
            if(log == conditions['output']) {
                document.getElementById('correct').style.display = 'block'
                  setTimeout(() => {
                    document.getElementById('correct').style.display = 'none'
                  }, 4000);
                window.scrollTo({ top: 0, behavior: "smooth" });
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
</script>
@endsection