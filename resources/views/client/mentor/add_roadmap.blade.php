@extends('client.layouts.master')
@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title_modal">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
    <div class="modal-body">
<div class="search-group">
<input type="text" class="form-control" placeholder="Search here" id="search_modal" >
<div class="modal_content"> 
</div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="removeData()">Close</button>
        <button type="button" class="btn btn-primary" onclick="searchCourse(this)">Search</button>
      </div>
    </div>
  </div>
</div>
<div class="page-content">
    <div class="container">
        <div class="row">
            @include('client.mentor.sidebar')
            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card instructor-card">
                            <div class="card-header">
                                <div>
                                 <h4 class="d-flex justify-content-between w-100" contenteditable id="roadmap_name">Enter your roadmap name</h4>                                 
<br>
                                 <p contenteditable id="roadmap_description">Enter your roadmap description</p>
                                </div>
                                <button class="btn btn-outline-dark" onclick="updateThumbnail(this)" id="thumbnail_btn">Thumbnail</button>   
                                <input type="file" name="thumbnail" class="d-none" id="thumbnail" onchange="showImagePreview(this)">
                            </div>
                            <div class="card-body">
                            <div class="add-course-info">
                    <div class="add-course-section">
                      <button class="btn" id="add-section-btn" onclick="addSection()">Add Section</button>
                    </div>
                    <div class="add-course-form chapter_videos">
                    </div>
                  </div>
                            </div>
                        </div>
                    </div>
<button class="btn btn-primary" onclick="updateRoadmap(this)">Update</button>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
     var index = 0 
     var select_type = ''
     var select_id = ''
  function addSection(class_add = '.chapter_videos', allow_scroll = true) {
    let chapter = '_'+ makeid();
    let accordion ='_'+ makeid();
    console.log(class_add);
    document.querySelector(class_add).innerHTML += `
    <div class="curriculum-grid mt-4 chapter_video ${chapter} ">
                        <div class="curriculum-head">
                        <div class="form-group">
                          <label class="add-course-label" contenteditable oninput="changeDescription('.data_${accordion}',this.innerHTML)">Enter the name of the section</label>
                          <select class="form-control" onchange="updateSelect(this.value,'#${accordion}')" style="max-width:max-content  ">
                                <option value="course" selected>Course</option>
                                <option value="lesson">Lesson</option>
                                <option value="multiple">Multiple</option>
                          </select>
                          <span class="type_id d-none data_${accordion}" type_name="course" description_name="Enter the description here">adasd123</span>
                        </div>
                          <a href="javascript:void(0);"><span class="btn" onclick="updateSelect('course','#${accordion}');this.style.display='none';">Add Lecture</span> <button class="btn text-white border-0" style="background:#ff4667" onclick="removeSection('${chapter}')">Remove section</button></a> 
                        </div>
                        <div class="curriculum-info">
                          <div id="${accordion}">
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
  // document.querySelector('#'+ lecture).innerHTML+= 
    addSection('#'+ lecture,false);
  }
  function removeLecture(id){
    $('#'+ id).remove();
  }
function updateSelect(value,class_name) {
  (document.querySelector('.data_'+ (class_name).substr(1)).setAttribute('type_name',value));
  select_type = value
  let random_id = makeid();
  let accordion = makeid();
  if(value == 'multiple'){
    let a = '_'+ makeid()
    document.querySelector(class_name).innerHTML = `
    <div class="faq-grid">
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
<span class="btn btn-outline-info" style="min-width: initial;width: max-content;height: max-content;padding:10px" onclick="addLecture('${a}')">Add Lecture</span>
                                </div>
                              </div>
                              <div
                                id="collapse${a}"
                                class="collapse"
                                data-bs-parent="#accordion-one"
                              >
                                <div class="faq-body" id="${a}">
                                </div>
                              </div>
                            </div>
  `;
  }
  else {
    document.querySelector(class_name).innerHTML = ''
    $('#exampleModal').modal('show')
    $('#title_modal').text('Choosse ' + value)
    select_id = class_name
  }
}
function searchCourse(obj) {
  if(select_type == 'course') {
    searchCourse2(obj)
  }
  else {
  searchLesson(obj)   
  }
}
function searchCourse2(obj) { 
  obj.disabled = true
  obj.innerText = 'Searching...'
  let search_modal = (document.querySelector('#search_modal').value)
  document.querySelector('.modal_content').innerHTML = ''
    let formData = new FormData();
    formData.append('q', search_modal)
    fetch(`{{ route('course-list') }}/0/10`, {
                    method: "POST",
                    body: formData
                }).then(response => response.json()).then(data => {
                  console.log(data);
                  obj.disabled = false
                  obj.innerText = 'Search'
                  data.forEach(element => {
                    let mentor_name = element.mentor_name
                    if(!mentor_name) {
                      let formName = new FormData()
                      formName.append('id',element.mentor_id)
                      fetch('{{route("get-mentor-name")}}',{
                        method: "POST",
                        body: formName
                      }).then(response => response.json()).then(data2 => {
                        mentor_name = data2.name
                        renderData(element,mentor_name)
                                              })
                    }
else {
renderData(element,mentor_name)
}
                  })
                  
                })
  }
  function renderData(element,mentor_name) {
    document.querySelector('.modal_content').innerHTML+= `
  <div class="col-lg-12 col-md-12 d-flex">
<div class="course-box course-design list-course d-flex">
<div class="product">
<div class="product-img">
<a href="#">
<img class="img-fluid" alt src="{{asset('course/thumbnail/${element.image}')}}">
</a>
<div class="price">
<h3>${element.price}<span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="head-course-title">
<h3 class="title">${element.name}</h3>
<div class="all-btn all-category d-flex align-items-center">
<a class="btn btn-primary" onclick="insertCourse('${element._id}','${element.image}','${element.price}','${element.name}','${element.meta['total_lesson']}','${element.meta['total_time']}','${element.complete_course_rate}','${element.total_enrollment}','${mentor_name}')">Choose it</a>
</div>
</div>
<div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="assets/img/icon/icon-01.svg" alt>
<p> ${element.meta['total_lesson']} Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="assets/img/icon/icon-02.svg" alt>
<p>${(element.meta['total_time']/60).toFixed(1)}hr ${element.meta['total_time']%60}min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<span class="d-inline-block average-rating"><span>${element.complete_course_rate}</span> <span>(  ${element.total_enrollment} enrolled)</span></span>
</div>

<div class="course-group d-flex mb-0">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user2.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">${mentor_name}</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
</div>
</div>
</div>
</div>
</div>
</div>
  `    
  }
  function searchLesson(obj) {
  obj.disabled = true
  obj.innerText = 'Searching...'
  let search_modal = (document.querySelector('#search_modal').value)
  document.querySelector('.modal_content').innerHTML = ''
    let formData = new FormData();
    formData.append('name', search_modal)
    fetch(`{{ route('lesson-data') }}`, {
      method: "POST",
      body: formData
    }).then(response => response.json()).then(data => {
      console.log(data);
      data.result.forEach(element => {
        renderData2(element)
      })
      obj.disabled = false
      obj.innerText = 'Search'
    })
  }
function renderData2(element) {
  let formName = new FormData()
  let mentor_name = ''
                      formName.append('id',element.course.mentor_id)
                      fetch('{{route("get-mentor-name")}}',{
                        method: "POST",
                        body: formName
                      }).then(response => response.json()).then(data2 => {
                        mentor_name = data2.name
    document.querySelector('.modal_content').innerHTML+= `
  <div class="col-lg-12 col-md-12 d-flex">
<div class="course-box course-design list-course d-flex">
<div class="product">
<div class="product-img">
<a href="#">
<img class="img-fluid" alt src="{{asset('course/thumbnail')}}/${element.course.image}" onclick="insertLesson('${element.course._id}','${element.course.image}','${element.course.price}','${element.course.name}','${element.course.meta['total_lesson']}','${element.course.meta['total_time']}','${element.course.complete_course_rate}','${element.course.total_enrollment}','${mentor_name}','${element.name}','${element._id}')">
</a>
<div class="price">
<h3>${element.course.price}<span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="head-course-title">
<h3 class="title fw-normal">${element.course.name}</h3>
<div class="all-btn all-category d-flex align-items-center">
<span class="badge bg-info">Lesson</span>
</div>
</div>
<div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="assets/img/icon/icon-01.svg" alt>
<p>${element.course.meta['total_lesson']} Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="assets/img/icon/icon-02.svg" alt>
<p>${(element.course.meta['total_time']/60).toFixed(1)}hr ${element.course.meta['total_time']%60}min</p>
</div>
</div>
<div class="rating">
<i class="fas fa-star filled"></i>
<span class="d-inline-block average-rating"><span>${element.course.complete_course_rate}</span> <span>(  ${element.course.total_enrollment} enrolled)</span></span>
</div>

<div class="course-group d-flex mb-0">
<div class="course-group-img d-flex">
<a href="instructor-profile.html"><img src="assets/img/user/user2.jpg" alt class="img-fluid"></a>
<div class="course-name">
<h4><a href="instructor-profile.html">${mentor_name}</a></h4>
<p>Instructor</p>
</div>
</div>
<div class="course-share d-flex align-items-center justify-content-center">
  ${element.name} 
</div>
</div>
</div>
</div>
</div>
</div>
  `    
})
  }
  function removeData() {
    document.querySelector('.modal_content').innerHTML = ''
    document.querySelector('#search_modal').value = ''
  }
  function insertCourse(id,image,price,name,total_lesson,total_time,complete_course_rate,total_enrollment,mentor_name) {
    removeData()
    document.querySelector('.data_'+ (select_id.substr(1))).innerHTML = id
    $('#exampleModal').modal('hide')
    let accordion ='_'+ makeid();
    document.querySelector(select_id).innerHTML = `
  <div class="col-lg-12 col-md-12 d-flex">
<div class="course-box course-design list-course d-flex">
<div class="product">
<div class="product-img">
<a href="#">
<img class="img-fluid" alt src="{{asset('course/thumbnail')}}/${image}">
</a>
<div class="price">
<h3>${price} <span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="head-course-title">
<h3 class="title">${name}</h3>
<div class="all-btn all-category d-flex align-items-center">
</div>
</div>
<div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="{{asset('assets/img/icon/icon-01.svg')}}" alt>
<p>${total_lesson} Lesson</p>
</div>
<div class="course-view d-flex align-items-center">
<img src="{{asset('assets/img/icon/icon-02.svg')}}" alt>
<p>${Math.floor(total_time/60).toFixed(0)}hr ${total_time%60}min</p>
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
<div class="course-share d-flex align-items-center justify-content-center">
</div>
</div>
</div>
</div>
</div>
</div>
    `
  }
  function insertLesson(id_course,image,price,course_name,total_lesson,total_time,complete_course_rate,total_enrollment,mentor_name,name,id_lesson) {
    removeData()
    $('#exampleModal').modal('hide')
    document.querySelector('.data_'+ (select_id.substr(1))).innerHTML = id_lesson
    document.querySelector(select_id).innerHTML = `
    <div class="col-lg-12 col-md-12 d-flex">
<div class="course-box course-design list-course d-flex">
<div class="product">
<div class="product-img">
<a href="#">
<img class="img-fluid" alt src="{{asset('course/thumbnail')}}/${image}">
</a>
<div class="price">
<h3>${price}<span>$99.00</span></h3>
</div>
</div>
<div class="product-content">
<div class="head-course-title">
<h3 class="title fw-normal">${course_name}</h3>
<div class="all-btn all-category d-flex align-items-center">
  <span class="badge bg-info">Lesson</span>
</div>
</div>
<div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
<img src="{{asset('assets/img/icon/icon-01.svg')}}" alt>
<p>${total_lesson} Lesson </p>
</div>
<div class="course-view d-flex align-items-center">
<img src="{{asset('assets/img/icon/icon-02.svg')}}" alt>
<p>${Math.floor(total_time/60).toFixed(0)}hr ${total_time%60}min</p>
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
<div class="course-share d-flex align-items-center justify-content-center fw-bold">
  ${name}
</div>
</div>
</div>
</div>
</div>
</div>
    `
  }
  var data_update =[];
  function updateRoadmap(obj) {
    obj.disabled = true;
    obj.innerText = 'Updating...';
  [...document.querySelector('.chapter_videos').children].map((e,index) => {
    data_update[index] = {}
 data_update[index] = getChild(e) 
 })
let formData = new FormData()
// formData.append('content',data_send)
formData.append('name',document.querySelector('#roadmap_name').innerHTML)
formData.append('description',document.querySelector('#roadmap_description').innerHTML)
formData.append('thumbnail',document.querySelector('#thumbnail').files[0])
 fetch(`{{ route('mentor-roadmap-add') }}`, {
   method: "POST",
   body: formData,
 }).then(res => res.json()).then(data => {




    let data_send = {
    'data': data_update,
    'id' : data.roadmap_id
  }
 data_send = JSON.stringify(data_send)
 console.log(data_send);
 fetch(`{{ route('update-roadmap') }}`, {
   method: "POST",
   headers: {                              
    "Content-Type": "application/json"  
  } ,
   body: data_send,
 }).then(res => res.json()).then(data2 => {
console.log(data2);



  obj.innerText = 'Created'
  setTimeout(() => {
    location.href = '{{route("mentor-roadmap")}}'
  }, 1000);
 })
 })
}
  // var index_result = 0
  function getChild(parent_class) {
    let result = {}
    if(parent_class.querySelector('.type_id').getAttribute('type_name') != 'multiple') {
    result['type']= parent_class.querySelector('.type_id').getAttribute('type_name')
    result['type_id'] = parent_class.querySelector('.type_id').innerHTML
    result['type_description'] = parent_class.querySelector('.type_id').getAttribute('description_name')
    return result
  }
  else {
  result['type']= parent_class.querySelector('.type_id').getAttribute('type_name')
  result['type_description'] = parent_class.querySelector('.type_id').getAttribute('description_name')
 result['type_id'] = [...(parent_class.querySelector('.faq-body')).children].map(e => {
  return getChild(e)
 })
 return result
  }
}

function changeDescription(obj,text) {
  document.querySelector(obj).setAttribute('description_name',text)
}
function updateThumbnail(obj) {
    document.getElementById('thumbnail').click()

}
function showImagePreview(obj) {
    console.log(obj,obj.files[0]);
    document.querySelector('#thumbnail_btn').innerHTML = '<img src="'+URL.createObjectURL(obj.files[0])+'" width="100px" style="max-height: 100px">'
}
</script>
@endsection