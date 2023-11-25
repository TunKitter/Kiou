@extends('client.layouts.master')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<section class="page-content course-sec">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-12">
<button class="btn btn-success-dark float-end d-block px-5 mb-2 save-btn" onclick="saveData(this)">Save</button>
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
                            placeholder="Enter description" value="{{$asm->description}}"
                          />
                        </div>
                        <div class="form-group">
                          <label class="add-course-label">Category</label>
                          <select class="form-control select" name="category" id="category">
                              @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{$asm->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                              @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label class="add-course-label">Level</label>
                          <select class="form-control select" name="level" id="level">
                              @foreach ($level as $item)
                                <option value="{{$item->id}}" {{$asm->level_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                              @endforeach
                          </select>
                        </div>
                            <div class="form-group">
                          <label class="add-course-label"
                            >Total enrollment</label>
                          <input
                            type="text"
                            class="form-control"
                            disabled value="{{$asm->total_enrollment}}"
                          />
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
                          <textarea name="base_code" class="form-control" cols="30" rows="10">{!!$code!!}</textarea>
                        </div>
                        <div class="form-group mb-0 mt-2">
                          <label class="add-course-label"
                            >Condition</label>
                          <textarea name="condition_code" class="form-control" cols="30" rows="10">@foreach ($asm->condition_code as $key => $value ){{$key}}: {{$value}}
@endforeach
                          </textarea>
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
                        {{-- something --}}
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
  document.querySelector('.save-btn').disabled = false;
    $('.field-card').css('display', 'none');
    $('.field-card').eq(n).css('display', 'block');
    $('.progress_demo').removeClass('progress-active');
    $('.progress_demo').eq(n).addClass('progress-active');
}
function saveData(obj) {
  obj.disabled = true;
  obj.innerHTML = 'Saving...'
  if(index_tab == 0){
  let formData = new FormData();
  formData.append('id', '{{$asm->_id}}');
  formData.append('category_id', document.querySelector('select[name="category"]').value);
  formData.append('level_id', document.querySelector('select[name="level"]').value);
  formData.append('description', document.querySelector('input[name="description"]').value);
  fetch('{{route("mentor-cp-update",$asm->_id)}}',{
    method: 'POST',
    body: formData
  }).then(res => res.json()).then(data => {
    obj.innerHTML = 'Saved'
  })
}
else if(index_tab ==1) {
  console.log(document.querySelector('textarea[name="base_code"]').value, document.querySelector('textarea[name="condition_code"]').value);
   let formData = new FormData();

  formData.append('name_file', '{{$asm->code_path}}');
  formData.append('asm_id', '{{$asm->_id}}');
  formData.append('base_code', document.querySelector('textarea[name="base_code"]').value);
  formData.append('condition_code',document.querySelector('textarea[name="condition_code"').value.split('\n').join(',').trim().replace(/,*$/, ''));
  fetch('{{route("mentor-cp-update",$asm->_id)}}',{
    method: 'POST',
    body: formData
  }).then(res => res.json()).then(data => {
    obj.innerHTML = 'Saved'
  })

}
}
</script>
@endsection