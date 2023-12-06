@extends('client.layouts.master')
@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
    <div class="recover"
        style="background: #de416b;display: flex;justify-content: space-around;align-items:center;color:white;height:50px;display: none">
        <span>Maybe you've been uploading before . Do you want to recover it ?</span>
        <div>
            <button class="btn border border-white text-white" onclick="recover()">Recover</button>
            <button class="btn border border-white text-white" onclick="no_recover()">No</button>
        </div>

    </div>
    <section class="page-content course-sec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="add-course-header">
                        <h2>Add New Course</h2>
                        <div class="add-course-btns">
                            <ul class="nav">
                                <li>
                                    <a href="dashboard-instructor.html" class="btn btn-black">Back to Course</a>
                                </li>
                                <li>
                                    <a href="" class="btn btn-success-dark">Save</a>
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
                                                <div class="form-group ">
                                                    <label class="add-course-label">Course Title</label>
                                                    <input type="text" name="title_course" class="form-control is-invalid" id ="title_course"
                                                        placeholder="Course Title" />
                                                        <small id="title_error" style="color:red"></small>
                                                </div>
                                                <div class="form-group">
                                                    <label class="add-course-label">Course Description</label>
                                                    <input type="text" name="description_course" class="form-control" id="des_course" placeholder="Course description" />
                                                    <small id="des_error" style="color:red"></small>
                                                   
                                                </div>
                                                <div class="form-group">
                                                    <label class="add-course-label">Courses Category</label>
                                                    <select class="form-control select" name="category_course"  
                                                        id="category">
                                                        @foreach ($professions as $profession)
                                                        
                                                      
                                                            <option value="{{ $profession->id }}">{{ $profession->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <small id="category_error" style="color:red"></small>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label class="add-course-label">Price</label>
                                                    <input type="text" class="form-control" placeholder="10.00" id ="price_course"
                                                        name="price_course" />
                                                        <small id="price_error" style="color:red"></small>
                                                </div>
                                                <div class="form-group">
                                                    <label class="add-course-label">Courses Level</label>
                                                    <select class="form-control select" name="level_course" id="level">
                                                        @foreach ($levels as $level)
                                                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <small id="level_error" style="color:red"></small>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label class="add-course-label">Course Content</label>
                                                    <textarea name="course_content" class="form-control" id="content_course" cols="30" rows="10"></textarea>
                                                    <small id="content_error" style="color:red"></small>
                                                </div>
                                                <br>
                                                <div class="form-group mb-0">
                                                    <label class="add-course-label">Requirements</label>
                                                    <textarea name="course_requirement" class="form-control" id="requirement"cols="30" rows="10"></textarea>
                                                    <small id="requirement_error" style="color:red"></small>
                                                </div>
                                                <br>
                                                <div class="form-group mb-0">
                                                    <label class="add-course-label">What students will learn</label>
                                                    <textarea name="course_will_learn" class="form-control" id="learn" cols="30" rows="10"></textarea>
                                                    <small id="learn_error" style="color:red"></small>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="widget-btn">
                                            <a class="btn btn-black">Back</a>
                                            <a class="btn btn-info-light next_btn" onclick="saveTemp()">Continue</a>
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
                                                    <label class="add-course-label">Course cover image</label>
                                                    <div class="relative-form">
                                                        <input type="file" name="image" class="form-control" />
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
                                            <a class="btn btn-info-light next_btn upload-btn" style="display: none"
                                                onclick="saveCourse()">Continue</a>
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
        var total_time = 0;
        var resumable = new Resumable({
            target: '{{ route('upload-resumable') }}',
            query: {
                _token: '{{ csrf_token() }}'
            }, // CSRF token
            fileType: ['mp4'],
            fileParameterName: 'file',
            chunkSize: 2 * 1024 *
            1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
            chunkRetryInterval: 2000,
        });
        var currentProgress = 0;
        resumable.on('fileAdded', function(file) { // trigger when file picked
            // alert('file added')
            resumable.upload() // to actually start uploading.
        });

        resumable.on('fileProgress', function(file) { // trigger when file progress update
            let currentPer = (Math.floor(file.progress() * 100))
            if (document.querySelectorAll('.current_progress_upload')[currentProgress].style.backgroundColor !=
                '#37b24d') {
                document.querySelectorAll('.current_progress_upload')[currentProgress].style.width = currentPer +
                    '%';
            }
            if (currentPer > 99) {
                document.querySelectorAll('.current_progress_upload')[currentProgress].style.backgroundColor =
                    '#37b24d';
            }
        });
var filenames = []
        resumable.on('fileSuccess', function(file, response) {
            filenames[filenames.length] = (JSON.parse(response)).filename;
            if (currentProgress == document.querySelectorAll('.current_progress_upload').length - 1) {
                document.querySelector('.upload-btn').style.display = 'block';
                localStorage.clear();   
            }
            currentProgress++
        });

        resumable.on('fileError', function(file, response) { // trigger when there is any error
            console.log(response);
            file.retry()
        });

        resumable.on('fileRetry', function() { // trigger when there is any error
            alert('Upload cancelled for internal reasons.');
            // resumable.abort();
            // updateProgress(0);
            // resumable.cancel();
            // location.reload();
        });

        var index = 0

        function addSection(obj) {
            document.querySelector('.chapter_videos').innerHTML += `
    <div class="curriculum-grid mt-4 chapter_video chapter_${index} ">
                        <div class="curriculum-head">
                          <p class="chapter_name" contenteditable>Chapter name</p>
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

        function removeSection(index) {
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
            document.querySelector('#' + lecture).innerHTML += `
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
                                    <input class="me-0 mb-2 form-control lesson_description" style="width:100%" placeholder="Enter the description">
                                      </div>
                                    <div class="form-group">
                          <label class="add-course-label"
                            >Courses Category</label
                          >
                          <select class="form-control select lesson_category">
                              @foreach ($professions as $profession)
                                <option value="{{ $profession->id }}}}">{{ $profession->name }}</option>
                              @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                                      <label class="add-course-label">Subtitle</label>
                                    <input class="me-0 mb-2 form-control lesson_subtitle" name="subtitle[]" style="width:100%" type="file">
                                      </div>  
                                  </div>
                                </div>
                              </div>
                            </div>
    `
        }

        function removeLecture(id) {
            $('#' + id).remove();
        }

        function getCourseInfo() {
            let lesson_name_file = document.querySelectorAll('.lesson_name');
            let video = '';
            [...document.querySelectorAll('input[name="lesson[]"')].map((e, index) => {
                video = document.createElement('video');
                video.src = URL.createObjectURL(e.files[0]);
                video.addEventListener('loadedmetadata', () => {
                    // const duration = video.duration;
                    // console.log('Video duration:', duration);
                    total_time += parseInt(video.duration);
                });
                document.querySelector('.courses_ne').innerHTML +=
                    '<li><span style="min-width:200px;display:inline-block;">' + lesson_name_file[index]
                    .textContent +
                    `</span><span style="width: 41%;height:10px;background: #392c7d;display:inline-block;border-radius: 12px;position: relative;"><span class="current_progress_upload" style="width:0;background:#ff4667;display: inline-block;height: 10px;position: absolute;border-radius: 12px;"></span></span></li>`
                resumable.addFile(e.files[0]);
            });
        }
      
        function saveTemp() {
            const title_course = document.getElementById('title_course');
            const des_course = document.getElementById('des_course');
            const price_course = document.getElementById('price_course');
            const category_course = document.getElementById('category_course');
            const level_course = document.getElementById('level_course');
            const content_course = document.getElementById('content_course');
            const requirement = document.getElementById('requirement');
            const learn = document.getElementById('learn');
          
            const title_error = document.getElementById('title_error');
            const des_error = document.getElementById('des_error');
            const price_error = document.getElementById('price_error');
            const category_error = document.getElementById('category_error');
            const level_error = document.getElementById('level_error');
            const content_error = document.getElementById('content_error');
            const requirement_error = document.getElementById('requirement_error');
            const learn_error = document.getElementById('learn_error');
          
           
            const isRequired = value => value === '' ? false : true;
            if (!isRequired(title_course.value.trim())) {
                title_error.innerHTML = "Please enter your title course.";
            }
            if (!isRequired(des_course.value.trim())) {
                des_error.innerHTML = "Please enter your description course.";
                
            }
            if (!isRequired(price_course.value.trim())) {
                price_error.innerHTML = "Please enter your price course.";
               
            }
            // if (!isRequired(category_course.value.trim())) {
            //     category_error.innerHTML = "Please enter your category course.";
               
            // }
            // if (!isRequired(level_course.value.trim())) {
            //     level_error.innerHTML = "Please enter your level course.";
                
            // }
            if (!isRequired(content_course.value.trim())) {
                content_error.innerHTML = "Please enter your content course.";
               
            }
            if (!isRequired(requirement.value.trim())) {
                requirement_error.innerHTML = "Please enter your requirement.";
               
            }
            if (!isRequired(learn.value.trim())) {
                learn_error.innerHTML = "Please enter your learn.";
               
            }
            localStorage.setItem('title', document.querySelector('input[name="title_course"]').value);
            localStorage.setItem('description', document.querySelector('input[name="description_course"]').value);
            localStorage.setItem('category', $('#category').select2('data')[0].id);
            localStorage.setItem('price', document.querySelector('input[name="price_course"]').value);
            localStorage.setItem('level', $('#level').select2('data')[0].id);
            localStorage.setItem('content', document.querySelector('textarea[name="course_content"]').value);
            localStorage.setItem('requirement', document.querySelector('textarea[name="course_requirement"]').value);
            localStorage.setItem('will_learn', document.querySelector('textarea[name="course_will_learn"]').value);
            document.querySelector('.recover').style.display = 'none';

        }
    </script>
    <script>
        if (localStorage.getItem('title')) {
            document.querySelector('.recover').style.display = 'flex';
        }

        function recover() {
            document.querySelector('.recover').style.display = 'none';
            document.querySelector('input[name="title_course"]').value = localStorage.getItem('title');
            document.querySelector('input[name="description_course"]').value = localStorage.getItem('description');
            document.querySelector('input[name="price_course"]').value = localStorage.getItem('price');
            document.querySelector('textarea[name="course_content"]').value = localStorage.getItem('content');
            document.querySelector('textarea[name="course_requirement"]').value = localStorage.getItem('requirement');
            document.querySelector('textarea[name="course_will_learn"]').value = localStorage.getItem('will_learn');
            $('#category').val(localStorage.getItem('category')).trigger('change');
            $('#level').val(localStorage.getItem('level')).trigger('change');
        }

        function no_recover() {
            document.querySelector('.recover').style.display = 'none';
            localStorage.clear()
        }
        var lessons_name = {};
        var lesson_index = 0;
        function saveCourse() {
            let formData = new FormData();
            formData.append('name', document.querySelector('input[name="title_course"]').value);
            formData.append('description', document.querySelector('input[name="description_course"]').value);
            formData.append('price', document.querySelector('input[name="price_course"]').value);
            formData.append('image', document.querySelector('input[name="image"]').files[0]);
            formData.append('category', $('#category').select2('data')[0].id);
            formData.append('level', $('#level').select2('data')[0].id);
            formData.append('total_chapter', document.querySelectorAll('.chapter_video').length);
            formData.append('chapters', ([...document.querySelectorAll('.chapter_name')].map(e => e.innerText)).join(
            '_$_'));
            formData.append('total_lesson', document.querySelectorAll('.lesson_name').length);
            formData.append('total_time', total_time);
            formData.append('content', document.querySelector('textarea[name="course_content"]').value);
            formData.append('requirement', document.querySelector('textarea[name="course_requirement"]').value.split('\n')
                .join('_$_'));
            formData.append('will_learn', document.querySelector('textarea[name="course_will_learn"]').value.split('\n')
                .join('_$_'));
            fetch('{{ route('handle-upload') }}', {
                method: 'POST',
                body: formData
            }).then(response => response.json()).then(data2 => {
                console.log(data2);
              
                [...document.querySelectorAll('.chapter_video')].map(e => {
                    let lesson_index2 = 0;
                    lessons_name['chapter_'+lesson_index] = [];
                   [...e.querySelectorAll('.faq-header')].map(y => {

                    lessons_name['chapter_'+lesson_index][lesson_index2] = y.querySelector('.lesson_name').innerHTML;
                    lesson_index2++;
                   })
                   lesson_index++;
                })
                // đã có sẵn id chapter, kiểm tra lesson thuộc chapter nào sau đó fetch lên để cập nhật lesson đó
                let formData2 = new FormData();
                formData2.append('filenames', filenames.join(';'));
                formData2.append('course_id', data2.message['course_id']);
                fetch('{{route("create-lesson")}}',{
                    method: "POST",
                    body: formData2
                }).then(response => response.json()).then(data => {
                    console.log(data);
                })
                console.log(data);
            })
        }
    </script>
@endsection
