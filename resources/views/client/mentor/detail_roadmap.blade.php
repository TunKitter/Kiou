@extends('client.layouts.master')
@section('content')
<div class="page-content">
    <div class="container">
        <div class="row">
            @include('client.mentor.sidebar')
            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card instructor-card">
                            <div class="card-header">
                                <h4 class="d-flex justify-content-between w-100">{{$roadmap->name}}</h4>
                            </div>
                            <div class="card-body">
                            <div class="add-course-info">
                    <div class="add-course-section">
                      <button class="btn" id="add-section-btn" onclick="addSection()">Add Section</button>
                    </div>
                    <div class="add-course-form chapter_videos">
                      @include('client.mentor.item_roadmap',['roadmap'=>$roadmap->content])
                    </div>
                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
     var index = 0 
  function addSection(class_add = '.chapter_videos', allow_scroll = true) {
    let chapter = '_'+ makeid();
    let accordion ='_'+ makeid();
    console.log(class_add);
    document.querySelector(class_add).innerHTML += `
    <div class="curriculum-grid mt-4 chapter_video ${chapter} ">
                        <div class="curriculum-head">
                        <div class="form-group">
                          <label class="add-course-label" contenteditable>Enter the name of the section</label>
                          <select class="form-control" onchange="updateSelect(this.value)" style="max-width:max-content  ">
                                <option value="course" selected>Course</option>
                                <option value="lesson">Lesson</option>
                                <option value="multiple">Multiple</option>
                          </select>
                        </div>
                          <a href="javascript:void(0);"><span class="btn" onclick="addLecture('${accordion}')">Add Lecture</span> <button class="btn text-white border-0" style="background:#ff4667" onclick="removeSection('${chapter}')">Remove section</button></a> 
                        </div>
                        <div class="curriculum-info">
                          <div id="${accordion}">
                            <div class="col-lg-12 col-md-12 d-flex">  
z</div>
                          </div>
                        </div>
                      </div>
    `
    if(allow_scroll){
        var el = document.querySelector('.'+ chapter);
      window.scrollTo(0, el.offsetTop - document.querySelector('header').offsetHeight);     
    }

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
  let lecture_id = '_'+ makeid();
  document.querySelector('#'+ lecture).innerHTML+= `
    <div class="faq-grid" id="${a = lecture + '_' + makeid()}">
                              <div class="faq-header">
                                <a
                                  class="collapsed faq-collapse"
                                  data-bs-toggle="collapse"
                                  href="#collapse${a}"
                                >
                                  <i class="fas fa-align-justify"></i>
                                  <span class="lesson_name">Child</span>
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
                                <div class="faq-body" id="${lecture_id}">
                                </div>
                              </div>
                            </div>
    `
    addSection('#'+ lecture_id,false);
  }
  function removeLecture(id){
    $('#'+ id).remove();
  }
function updateSelect(value) {
  alert(value);
}
</script>
@endsection