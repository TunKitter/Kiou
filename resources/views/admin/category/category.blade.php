@extends('admin.layout.master')
@section('content')
<link rel="stylesheet" href="{{asset('assets/vendor/jquery-toast-plugin/jquery.toast.min.css')}}">
<link href="{{asset('assets/vendor/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />
<table id="inline-editable"></table>
<div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                                                            <h4>Add Category</h4>
                                                        </div>
    
                                                        <form class="ps-3 pe-3" onsubmit="return createCategory()" id="addCategory">
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Name</label>
                                                                <input class="form-control" id="name" type="text" placeholder="Enter the name" name="name">
                                                            </div>
                                                                <div class="mb-3">
                                                                <label for="name" class="form-label">Profession</label>

                                                                    <select class="select2 form-control select2-multiple" data-toggle="select2"
                                                multiple="multiple" data-placeholder="Choose ..." name="profession" id="profession_select">
                                                                    @foreach ($categories as $category)  
                                                                        <option value="{{$category->_id}}">{{$category->name}}</option>
                                                                    @endforeach
                                            </select>
                                                                </div>
                                                            <div class="mb-3 text-center">
                                                                <button class="btn btn-primary" type="submit">Create Category</button>
                                                            </div>
    
                                                        </form>
    
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
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
                                    <h4 class="header-title mb-4">Category Database <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#add-modal">Add category</button> </h4>
                                    <div class="table-responsive">
                                        <table class="table table-centered mb-0 table-nowrap" id="category_table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Parent Category</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category )
                                                <tr>
                                                    <td class="text-white" style="font-size: 0">{{$category->_id}}</td>
                                                    <td>{{$category->name}}</td>
                                                    @php
                                                        // $temp_ = implode(',',array_map(function ($item) use($categories_name) {return $item;}, $category->parent_profession)) ;
                                                        // $temp_ = $temp_ ? $temp_ : ($categories_name[$category->id] . '<sup class="badge bg-info">Parent</sup>')
                                                    @endphp
                                                    {{-- <td>{!! $temp_!!}</td> --}}
<td>
    <select class="select2 form-control select2-multiple profession_edit" data-toggle="select2"
                                                multiple="multiple" data-placeholder="Choose ..." name="profession" onchange="changeProfession({{$loop->index}},'{{$category->id}}')">
                                                                    @foreach ($categories as $category_child)  
                                                                    @php
                                                                        $temp_is_select = in_array($category_child->_id, $category->parent_profession) ? 'selected' : ''
                                                                    @endphp
                                                                        <option value="{{$category_child->_id}}" {{ $temp_is_select}} >{{$category_child->name}}</option>
                                                                    @endforeach
                                            </select>
</td>
                                                    <td><button class="btn btn-danger btn-delete" onclick="deleteCategory('{{$category->id}}',{{$loop->index}})">Delete</button></td>
                                                    <td><button class="btn btn-secondary">More</button></td>
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

<script src="{{asset('assets/vendor/jquery-tabledit/jquery.tabledit.min.js')}}"></script>
<script src="{{asset('assets/js/pages/tabledit.init.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{assert('assets/vendor/jquery-toast-plugin/jquery.toast.min.js')}}"></script>
<script src="{{asset('assets/js/pages/toastr.init.js')}}"></script>
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
function createCategory(){
    let formData = new FormData(document.querySelector('#addCategory'));
    formData.append('profession', JSON.stringify($('select').val()))
    // console.log(formData);
    fetch('{{route("add-category-admin")}}',{
        method: 'POST',
        body: formData
    }).then(res => res.json()).then(category => {
        console.log(category);
        category = category.data
        $('tbody').prepend(`<tr id="${category._id}" class="new_tr">
            <td class="text-white" style="font-size: 0"><span class="tabledit-span tabledit-identifier">${category._id}</span><input class="tabledit-input tabledit-identifier" type="hidden" name="id" value="${category._id}" disabled=""></td>
            <td class="tabledit-view-mode" style="cursor: pointer;"><span class="tabledit-span">${category.name}</span><input class="tabledit-input form-control form-control-sm" type="text" name="name" value="${category.name}" style="display: none;" disabled=""></td>
            <td class="tabledit-view-mode" style="cursor: pointer;"><span class="tabledit-span">${category.name}</span><input class="tabledit-input form-control form-control-sm" type="text" name="name" value="${category.name}" style="display: none;" disabled=""></td>
            <td><button class="btn btn-danger btn-delete" onclick="deleteCategory('${category._id}',0)">Delete</button></td>
            <td><button class="btn btn-secondary">More</button></td>
            </tr>`)
            $('.new_tr td').addClass('text-primary')
            setTimeout(() => {
                $('.new_tr td').removeClass('text-primary')
            },4000)
            // document.querySelector('.new_tr td').classList.add('bg-primary')
    })
    return false
}
function changeProfession(index,id) {
    let temp_profession = $('.profession_edit:eq(' + index + ')').val() 
    let formData = new FormData();
    formData.append('id', id)
    formData.append('parent_profession', JSON.stringify(temp_profession))
    formData.append('action', 'edit')
    // console.log(formData);
    fetch('{{route("update-category-admin")}}',{
        method: 'POST',
        body: formData
    }).then(res => res.json()).then(category => {
        console.log(category);
    })
}
</script>
<script src="{{asset('assets/js/vendor.min.js')}}"></script>
<script src="{{asset('assets/vendor/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/app.min.js')}}"></script>
 @endsection     