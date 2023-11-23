@extends('client.layouts.master')
@section('content')
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
<section class="page-content course-sec">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="add-course-header">
            <h2>Add New Course</h2>
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
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="widget-set">
              <div class="widget-setcount">
                <ul id="progressbar">
                  <li class="progress-active">
                    <p><span></span> Basic Information</p>
                  </li>
                  <li>
                    <p><span></span> Courses Media</p>
                  </li>
                  <li>
                    <p><span></span> Curriculum</p>
                  </li>
                  <li>
                    <p><span></span> Settings</p>
                  </li>
                </ul>
              </div>
              <div class="widget-content multistep-form">
                <fieldset id="first">
                  <div class="add-course-info">
                    <div class="add-course-inner-header">
                      <h4>Basic Information</h4>
                    </div>
                    <div class="add-course-form">
                      <form action="#">
                        <div class="form-group">
                          <label class="add-course-label"
                            >Course Title</label
                          >
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Course Title"
                          />
                        </div>
                        <div class="form-group">
                          <label class="add-course-label"
                            >Courses Category</label
                          >
                          <select class="form-control select">
                              @foreach ($professions as $profession)
                                <option value="{{$profession->id}}}}">{{$profession->name}}</option>
                              @endforeach
                          </select>
                        </div>
<div class="form-group mb-0">
                          <label class="add-course-label">Price</label>
                          <input
                            type="text"
                            class="form-control"
                            placeholder="10.00"
                          />
                        </div>
                        <div class="form-group">
                          <label class="add-course-label"
                            >Courses Level</label
                          >
                          <select class="form-control select">
                            @foreach ($levels as $level )
                              <option value="{{$level->id}}">{{$level->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group mb-0">
                          <label class="add-course-label"
                            >Course Description</label>
                          <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
                        </div>
<br>
                        <div class="form-group mb-0">
                          <label class="add-course-label">Requirements</label>
                          <textarea name="requirements" class="form-control"  cols="30" rows="10"></textarea>
                        </div>
<br>
                        <div class="form-group mb-0">
                          <label class="add-course-label">What students will learn</label>
                          <textarea name="will_learn" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                      </form>
                    </div>
                    <div class="widget-btn">
                      <a class="btn btn-black">Back</a>
                      <a class="btn btn-info-light next_btn">Continue</a>
                    </div>
                  </div>
                </fieldset>
                <fieldset class="field-card">
                  <div class="add-course-info">
                    <div class="add-course-inner-header">
                      <h4>Courses Media</h4>
                    </div>
                    <div class="add-course-form">
                      <form action="#">
                        <div class="form-group">
                          <label class="add-course-label"
                            >Course cover image</label
                          >
                          <div class="relative-form">
                              <input type="file"  class="form-control"/>
                            </label>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="widget-btn">
                      <a class="btn btn-black prev_btn">Previous</a>
                      <a class="btn btn-info-light next_btn">Continue</a>
                    </div>
                  </div>
                </fieldset>
                <fieldset class="field-card">
                  <div class="add-course-info">
                    <div class="add-course-inner-header">
                      <h4>Curriculum</h4>
                    </div>
                    <div class="add-course-section">
                      <button class="btn" onclick="addSection(this)">Add Section</button>
                    </div>
                    <div class="add-course-form chapter_videos">
                      
                    </div>
                    <div class="widget-btn">
                      <a class="btn btn-black prev_btn">Previous</a>
                      <a class="btn btn-info-light next_btn" onclick="getCourseInfo()">Continue</a>
                    </div>
                  </div>
                </fieldset>
                <fieldset class="field-card">
                  <div class="add-course-info">
                    <div class="add-course-inner-header">
                      <h4>Uploading</h4>
                      <p class="text-muted">Please wait while we upload your files</p>
                    </div>
                    <div class="add-course-form">
                      <ul class="list-unstyled courses_ne d-flex flex-column gap-3">
                      </ul>
                    </div>
                    <div class="widget-btn">
                      <a class="btn btn-black prev_btn">Previous</a>
                      <a class="btn btn-info-light next_btn upload-btn" style="display: none">Continue</a>
                    </div>
                  </div>
                </fieldset>
                <fieldset class="field-card">
                  <div class="add-course-info">
                    <div class="add-course-msg">
                      <i class="fas fa-circle-check"></i>
                      <h4>The Course Added Succesfully</h4>
                      <p>Admin will be Approve soon.</p>
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
   var resumable = new Resumable({
        target: '{{route("upload-resumable")}}',
        query:{_token:'{{ csrf_token() }}'} ,// CSRF token
        fileType: ['mp4'],
        fileParameterName: 'file',
        chunkSize: 2*1024*1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
        headers: {
            'Accept' : 'application/json'
        },
        testChunks: false,
        throttleProgressCallbacks: 1,
        chunkRetryInterval: 2000,
    });
var currentProgress = 0;
    resumable.on('fileAdded', function (file) { // trigger when file picked
      // alert('file added')
       resumable.upload() // to actually start uploading.
    });

    resumable.on('fileProgress', function (file) { // trigger when file progress update
      let currentPer = (Math.floor(file.progress() * 100))
      if(document.querySelectorAll('.current_progress_upload')[currentProgress].style.backgroundColor != '#37b24d') {
        document.querySelectorAll('.current_progress_upload')[currentProgress].style.width = currentPer + '%';
      }
      if(currentPer > 99) {
        document.querySelectorAll('.current_progress_upload')[currentProgress].style.backgroundColor = '#37b24d';
      }
    });

    resumable.on('fileSuccess', function (file, response) { 
      if(currentProgress == document.querySelectorAll('.current_progress_upload').length - 1) {
        document.querySelector('.upload-btn').style.display = 'block';
      }
      currentProgress++
    });

    resumable.on('fileError', function (file, response) { // trigger when there is any error
      console.log(response);
      file.retry()  
    });
    
    resumable.on('fileRetry', function () { // trigger when there is any error
            alert('Upload cancelled for internal reasons.');
            // resumable.abort();
            // updateProgress(0);
            // resumable.cancel();
            // location.reload();
    });
  
  var index = 0 
  function addSection(obj){
    document.querySelector('.chapter_videos').innerHTML += `
    <div class="curriculum-grid mt-4 chapter_video chapter_${index} ">
                        <div class="curriculum-head">
                          <p contenteditable>Chapter name</p>
                          <a href="javascript:void(0);"><span class="btn" onclick="addLecture('accordion-${index}')">Add Lecture</span> <button class="btn text-white border-0" style="background:#ff4667" onclick="removeSection('chapter_${index}')">Remove section</button></a> 
                        </div>
                        <div class="curriculum-info">
                          <div id="accordion-${index}">
                            
                          </div>
                        </div>
                      </div>
    `
    var el = document.querySelector('.chapter_video:last-child');
    el.scrollIntoView(true);
    index++;
  }
  function removeSection(index){
    // document.querySelector('.chapter_videos').innerHTML = '';
    $('.' + index).remove();
  }
  function makeid() {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    let counter = 0;
    while (counter < 4) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
      counter += 1;
    }
    return result;
}
  function addLecture(lecture) {
  document.querySelector('#'+ lecture).innerHTML+= `
    <div class="faq-grid" id="${a = lecture + '_' + makeid()}">
                              <div class="faq-header">
                                <a
                                  class="collapsed faq-collapse"
                                  data-bs-toggle="collapse"
                                  href="#collapse${a}"
                                >
                                  <i class="fas fa-align-justify"></i>
                                  <span contenteditable class="lesson_name">Lesson name</span>
                                </a>
                                <div class="faq-right">
                              
                                  <a
                                    href="javascript:void(0);"
                                    class="me-0"
                                  >
                                    <i class="far fa-trash-can" onclick="removeLecture('${a}')"></i>
                                  </a>
                                </div>
                              </div>
                              <div
                                id="collapse${a}"
                                class="collapse"
                                data-bs-parent="#accordion-one"
                              >
                                <div class="faq-body">
                                  <div class="add-article-btns">
                                    <input type="file" class="form-control mb-2"  name="lesson[]" />
                                    <div class="form-group">
                                      <label class="add-course-label">Lesson Description</label>
                                    <input class="me-0 mb-2 form-control" style="width:100%" placeholder="Enter the description">
                                      </div>
                                    <div class="form-group">
                          <label class="add-course-label"
                            >Courses Category</label
                          >
                          <select class="form-control select">
                              @foreach ($professions as $profession)
                                <option value="{{$profession->id}}}}">{{$profession->name}}</option>
                              @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                                      <label class="add-course-label">Subtitle</label>
                                    <input class="me-0 mb-2 form-control" name="subtitle[]" style="width:100%" type="file">
                                      </div>  
                                  </div>
                                </div>
                              </div>
                            </div>
    `
  }
  function removeLecture(id){
    $('#'+ id).remove();
  }
  function getCourseInfo() {
    let lesson_name_file = document.querySelectorAll('.lesson_name');
     [...document.querySelectorAll('input[name="lesson[]"')].map((e,index) => {
      document.querySelector('.courses_ne').innerHTML+= '<li><span style="min-width:200px;display:inline-block;">'+lesson_name_file[index].textContent + `</span><span style="width: 41%;height:10px;background: #392c7d;display:inline-block;border-radius: 12px;position: relative;"><span class="current_progress_upload" style="width:0;background:#ff4667;display: inline-block;height: 10px;position: absolute;border-radius: 12px;"></span></span></li>`
      resumable.addFile(e.files[0]);
     });
    // resumable.assignDrop(a);
    // alert('uplading');
      // demo()
    // console.log(a);
    // [...document.querySelectorAll('input[name="lesson[]"]')].map((e,index) => {
    // document.querySelector('.courses_ne').innerHTML+= '<li><span style="min-width:200px;display:inline-block;">'+document.querySelectorAll('.lesson_name')[index].textContent + `</span><span style="width: 41%;height:10px;background: #392c7d;display:inline-block;border-radius: 12px;position: relative;"><span style="width:43%;background:#ff4667;display: inline-block;height: 10px;position: absolute;border-radius: 12px;"></span></span></li>`
// })
  }
</script>
@endsection