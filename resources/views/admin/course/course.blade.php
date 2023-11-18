@extends('admin.layout.master')
@section('content')
{{-- <link rel="stylesheet" href="{{asset('assets/vendor/jquery-toast-plugin/jquery.toast.min.css')}}"> --}}
<link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />
<table id="inline-editable"></table>
<table id="category_table"></table>
<div class="toast toast-delete position-fixed" style="z-index: 5;right:1em;top:6em" role="alert" aria-live="assertive" aria-atomic="true">
                                        <div class="toast-body">
                                            Are you sure to delete this category?
                                            <div class="mt-2 pt-2 border-top">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="deletedCategory(this)">Delete now</button>
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="toast">Close</button>
                                            </div>
                                        </div>
                                    </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title mb-4">Course Database </h4>
                                    <div class="table-responsive">
                                        <table class="table table-centered mb-0 table-nowrap" id="category_table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Mentor name</th>
                                                    <th>Profession</th>
                                                    <th>Metadata Information</th>
                                                    <th>Total Enrollment</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($courses as $course)
                                                <tr>
                                                    <td class="text-white" style="font-size: 0">{{$course->_id}}</td>
                                                    <td>{{$course->name}}</td>
                                                    <td>{{$mentor_name[$course->mentor_id]}}</td>
                                                    <td>{{$category_name[$course->category]}}</td>
                                                    <td>
                                                        <div class="btn-group mb-2">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Meta Information</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Total time: {{round($course->meta['total_time']/60)}} hours {{$course->meta['total_time']%60}} minutes</a>
                                                <a class="dropdown-item" href="#">Total lesson: {{$course->meta['total_lesson']}}</a>
                                                <a class="dropdown-item" href="#">Total chapter: {{$course->meta['total_chapter']}}</a>
                                            </div>
                                        </div>          
                                                    </td>
                                                    <td>{{$course->total_enrollment}}</td>
                                                    <td>{{$course->price}}</td>

                                                    <td><button class="btn text-primary" onclick="location.href='{{route('detail-course-admin', $course->_id)}}'">More Infor</button></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end .table-responsive-->
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->
            @include('client.section.loading')
            <p id="no_more" class="text-muted" style="display: none">There is no more data</p>
<style>
    #loading {
border-color: #3bc0c3;
border-left-color: white;
margin: 0 auto;
    }
</style>

{{-- <script src="{{asset('assets/vendor/jquery-tabledit/jquery.tabledit.min.js')}}"></script> --}}
{{-- <script src="{{asset('assets/js/pages/tabledit.init.js')}}"></script> --}}
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
{{-- <script src="{{asset('assets/js/vendor.min.js')}}"></script> --}}
<script src="{{asset('assets/js/app.min.js')}}"></script>
{{-- <script src="{{assert('assets/vendor/jquery-toast-plugin/jquery.toast.min.js')}}"></script> --}}
{{-- <script src="{{asset('assets/js/pages/toastr.init.js')}}"></script> --}}
<script>
var category_id_delete = ''
var category_index_delete = ''
function deleteCategory(id,index){
    $('.toast-delete').toast('show');
    category_id_delete = id;
    category_index_delete = index;
}
function deletedCategory(obj) {
    obj.disabled = true;
    obj.innerHTML = 'Deleting...'
    let formData = new FormData();
    formData.append('id', category_id_delete)
    fetch('{{route("delete-category-admin")}}',{
        method:'POST',
        body: formData
    }).then(res => res.json()).then(data => {
        $('.toast-delete').toast('hide');
       let temp_btn = document.querySelectorAll('.btn-delete')[category_index_delete]
        temp_btn.classList.remove('btn-danger')
        temp_btn.style.color = 'white'
        temp_btn.style.background = '#186F65'
        setTimeout(() => {
        document.querySelectorAll('tbody tr')[category_index_delete].classList.add('d-none')
        obj.innerHTML = 'Delete';
        obj.disabled = false;
        }, 1000);
        
    })
    // alert(user_id_delete)
}
</script>

 @endsection     