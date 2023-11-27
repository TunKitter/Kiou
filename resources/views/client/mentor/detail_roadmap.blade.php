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
                      <button class="btn" id="add-section-btn" onclick="addSection(this)">Add Section</button>
                      <script>
                          document.body.onload = function() {
    @foreach ($roadmap->content as $item )
   @if($item['type'] != 'multiple')
    @if($item['type'] == 'course')
    addSection('course',document.querySelector('#add-section-btn'),'{{$item["type"]}}','{{$item["type_description"]}}','{{$course_name[$item["type_id"]]["name"]}}','{{$course_name[$item["type_id"]]["total_lesson"]}}','{{$course_name[$item["type_id"]]["total_time"]}}','{{$course_name[$item["type_id"]]["image"]}}','{{$course_name[$item["type_id"]]["complete_course_rate"]}}','{{$course_name[$item["type_id"]]["total_enrollment"]}}','{{$mentor_name[$course_name[$item["type_id"]]["mentor_id"]]}}');
    @else
    addSection('lesson',document.querySelector('#add-section-btn'),'{{$item["type"]}}','{{$item["type_description"]}}','{{$lesson_name[$item["type_id"]]["name"]}}','{{$lesson_name[$item["type_id"]]["total_lesson"]}}','{{$lesson_name[$item["type_id"]]["total_time"]}}','{{$lesson_name[$item["type_id"]]["image"]}}','{{$lesson_name[$item["type_id"]]["complete_course_rate"]}}','{{$lesson_name[$item["type_id"]]["total_enrollment"]}}','{{$mentor_name[$lesson_name[$item["type_id"]]["mentor_id"]]}}','{{$lesson_name[$item["type_id"]]["course_name"]}}');  
    @endif
      @endif
    @endforeach
}
</script>
                    </div>
                    <div class="add-course-form chapter_videos">
                      
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
  function addSection(type,obj,name,desc,type_name,total_lesson,total_time,image,complete_course_rate,total_enrollment,mentor_name,course_name){
    let is_multiple = ''
    if(name == 'multiple'){
        is_multiple = `<span class="btn" onclick="addLecture('accordion-${index}')">Add Lecture</span>`
    }
    document.querySelector('.chapter_videos').innerHTML += `
    <div class="curriculum-grid mt-4 chapter_video chapter_${index} ">
                        <div class="curriculum-head">
                        <div class="form-group">
                          <label class="add-course-label" contenteditable>${desc}</label>
                          <select class="form-control select" style="max-width:max-content  ">
                                <option value="course" ${name == 'course' ? 'selected' : ''}>Course</option>
                                <option value="lesson" ${name == 'lesson' ? 'selected' : ''}>Lesson</option>
                                <option value="multiple" ${name == 'multiple' ? 'selected' : ''}>Multiple</option>
                          </select>
                        </div>
                          <a href="javascript:void(0);">${is_multiple} <button class="btn text-white border-0" style="background:#ff4667" onclick="removeSection('chapter_${index}')">Remove section</button></a> 
                        </div>
                        <div class="curriculum-info">
                          <div id="accordion-${index}">
                            <div class="col-lg-12 col-md-12 d-flex">
<div class="course-box course-design list-course d-flex">
<div class="product">
<div class="product-img">
<a href="#">
<img class="img-fluid" alt src="{{asset('course/thumbnail')}}/${image}">
</a>
<div class="price">
<h3>99 <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="head-course-title">
<h3 class="title ${type == 'lesson' ? 'fw-normal' : ''}">${type == 'lesson' ? course_name : type_name}</h3>
<div class="all-btn all-category d-flex align-items-center">
  ${type == 'lesson' ? '<span class="badge bg-info">Lesson</span>' :''}
</div>
</div>
<div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="{{asset('assets/img/icon/icon-01.svg')}}" alt>
<p>${total_lesson} Lesson </p>
</div>
<div class="course-view d-flex align-items-center">
<img src="{{asset('assets/img/icon/icon-02.svg')}}" alt>
<p>${parseInt(total_time/60)}hr ${parseInt(total_time%60)}min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<span class="d-inline-block average-rating"><span>${complete_course_rate}</span> <span>( ${total_enrollment} enrolled)</span></span>
</div>

<div class="course-group d-flex mb-0">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user2.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">${mentor_name}</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center ${type == 'lesson' ? 'fw-bold' : ''}">
${type == 'lesson' ? type_name : ''}
</div>
</div>
</div>
</div>
</div>
</div>
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

</script>
@endsection