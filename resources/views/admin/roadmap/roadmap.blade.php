@extends('admin.layout.master')
@section('content')
<link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />
<table id="inline-editable"></table>
<table id="category_table"></table>
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
                                                    <th>Like</th>
                                                    <th>Dislike</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($roadmap as $item)
                                                <tr>
                                                    <td class="text-white" style="font-size: 0">{{$item->_id}}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$mentor_name[$item->mentor_id]}}</td>
                                                    <td>{{$item->interaction['like']}}</td>
                                                    <td>{{$item->interaction['dislike']}}</td>
                                                    <td><button class="btn text-primary" onclick="detailRoadmap('{{$item->slug}}')">More Infor</button></td>
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
    fetch('{{route("admin.delete-category-admin")}}',{
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
function detailRoadmap(id) {
    location.href = '{{route("admin.list-roadmap-admin")}}/'+id
    // $('#detail-roadmap').modal('show')
}
</script>

 @endsection     