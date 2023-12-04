@foreach ($roadmap as $item )
@if($item['type'] != 'multiple')
@php
  $accordion = '_'.uniqid();
@endphp
<div class="curriculum-grid mt-4 chapter_video {{$chapter = '_'.uniqid()}} ">
                        <div class="curriculum-head">
                        <div class="form-group">
                          <label class="add-course-label" contenteditable oninput="changeDescription('.data_{{$accordion}}',this.innerHTML)">{{$item['type_description']}}</label>
                          <select class="form-control" onchange="updateSelect(this.value,'#{{$accordion}}')" style="max-width:max-content  ">
                                <option value="course" {{$item['type'] == 'course' ? 'selected' : ''}}>Course</option>
                                <option value="lesson" {{$item['type'] == 'lesson' ? 'selected' : ''}}>Lesson</option>
                                <option value="multiple">Multiple</option>
                          </select>
<span class="type_id d-none data_{{$accordion}}" type_name="{{$item['type']}}" description_name="{{$item['type_description']}}">{{$item['type'] == 'course' ? $course_name[$item["type_id"]]['id'] : $item["type_id"]}}</span>
                        </div>
                          <a href="javascript:void(0);"><span class="btn d-none" onclick="addLecture('{{$accordion}}')">Add Lecture</span> <button class="btn text-white border-0" style="background:#ff4667" onclick="removeSection('{{$chapter}}')">Remove section</button></a> 
                        </div>
                        <div class="curriculum-info">
                          <div id="{{$accordion}}">
<div class="col-lg-12 col-md-12 d-flex">
<div class="course-box course-design list-course d-flex">
<div class="product">
<div class="product-img">
<a href="#">
<img class="img-fluid" alt src="{{asset('course/thumbnail/'. ($item['type'] == 'course' ?  $course_name[$item["type_id"]]["image"] : $lesson_name[$item["type_id"]]["image"]))}}">
</a>
<div class="price">
<h3>{{$item['type'] == 'course' ? $course_name[$item["type_id"]]['price'] : $lesson_name[$item["type_id"]]['price']}} <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="head-course-title">
<h3 class="title {{$item['type'] == 'lesson' ? 'fw-normal' : ''}}">{{$item['type'] == 'course' ? $course_name[$item["type_id"]]['name'] : $lesson_name[$item["type_id"]]['name']}}</h3>
<div class="all-btn all-category d-flex align-items-center">
  {!!$item['type'] == 'lesson' ? '<span class="badge bg-info">Lesson</span>' :''!!}
</div>
</div>
<div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="{{asset('assets/img/icon/icon-01.svg')}}" alt>
<p>{{$item['type'] == 'course' ? $course_name[$item["type_id"]]['total_lesson'] : $lesson_name[$item["type_id"]]['total_lesson']}} Lesson </p>
</div>
<div class="course-view d-flex align-items-center">
<img src="{{asset('assets/img/icon/icon-02.svg')}}" alt>
<p>{{$item['type'] == 'course' ? round($course_name[$item["type_id"]]['total_time']/60) : round($lesson_name[$item["type_id"]]['total_time']/60)}}hr {{$item['type'] == 'course' ? round($course_name[$item["type_id"]]['total_time'])%60 : round($lesson_name[$item["type_id"]]['total_time']%60)}}min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<span class="d-inline-block average-rating"><span>{{$item['type'] == 'course' ? $course_name[$item["type_id"]]['complete_course_rate'] : $lesson_name[$item["type_id"]]['complete_course_rate']}}</span> <span>( {{$item['type'] == 'course' ? $course_name[$item["type_id"]]['total_enrollment'] : $lesson_name[$item["type_id"]]['total_enrollment']}} enrolled)</span></span>
</div>

<div class="course-group d-flex mb-0">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user2.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">{{$item['type'] == 'course' ? $mentor_name[$course_name[$item["type_id"]]['mentor_id']] : $mentor_name[$lesson_name[$item["type_id"]]['mentor_id']]}}</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center  {{$item['type'] == 'lesson' ? 'fw-bold' : ''}}">
 {{$item['type'] == 'lesson' ? $lesson_name[$item["type_id"]]['name'] : ''}}
</div>
</div>
</div>
</div>
</div>
</div>
                          </div>
                        </div>
                      </div>
@else
@php
  $accordion = '_'.uniqid();
@endphp
<div class="curriculum-grid mt-4 chapter_video {{$chapter = '_'. uniqid()}} ">
    <div class="curriculum-head">
    <div class="form-group">
      <label class="add-course-label" contenteditable oninput="changeDescription('.data_{{$accordion}}',this.innerHTML)">{{$item['type_description']}}</label>
      <select class="form-control" onchange="updateSelect(this.value,'#{{$accordion}}')" style="max-width:max-content  ">
            <option value="course" {{$item['type'] == 'course' ? 'selected' : ''}}>Course</option>
            <option value="lesson" {{$item['type'] == 'lesson' ? 'selected' : ''}}>Lesson</option>
            <option value="multiple" {{$item['type'] == 'multiple' ? 'selected' : ''}}>Multiple</option>
      </select>
<span class="type_id d-none data_{{$accordion}}" type_name="{{$item['type']}}" description_name="{{$item['type_description']}}" id="{{$chapter}}"></span>
    </div>
      <a href="javascript:void(0);"><span class="btn d-none" onclick="addLecture('{{$accordion}}')">Add Lecture</span> <button class="btn text-white border-0" style="background:#ff4667" onclick="removeSection('{{$chapter}}')">Remove section</button></a> 
    </div>
    <div class="curriculum-info">
      <div id="{{$accordion}}">
      @php
        $a = '_' . uniqid();
      @endphp
        <div class="faq-grid">
                              <div class="faq-header">
                                <a
                                  class="collapsed faq-collapse"
                                  data-bs-toggle="collapse"
                                  href="#collapse{{$a}}"
                                >
                                  <i class="fas fa-align-justify"></i>
                                  <span class="lesson_name">Child</span>
                                </a>
                                <div class="faq-right">
                              
                                  <a
                                    href="javascript:void(0);"
                                    class="me-0"
                                  >
                                    <i class="far fa-trash-can" onclick="removeLecture('{{$a}}')"></i>
                                  </a>
<span class="btn btn-outline-info" style="min-width: initial;width: max-content;height: max-content;padding:10px" onclick="addLecture('{{$a}}')">Add Lecture</span>
                                </div>
                              </div>
                              <div
                                id="collapse{{$a}}"
                                class="collapse"
                                data-bs-parent="#accordion-one"
                              >
                                <div class="faq-body" id="{{$a}}">
                                    @include('client.mentor.item_roadmap',['roadmap'=>$item['type_id']])
                                </div>
                              </div>
                            </div>
    </div>
    </div>
  </div>
@endif
@endforeach