@extends('admin.layout.master')

@section('content')
<style>
    .ck-editor__editable_inline {
        height: 150px;
    }
</style>
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Projects</h3>

                    <div class="card-tools">
                        <a href="javascript:void(0);" id="btn-add" class="btn btn-primary float-right" data-toggle="modal"
                        data-target="#professionAdd">
                        Add
                    </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="width: 49%">
                                    Title 
                                </th>
                                <th style="width: 20%">
                                    Post Categories
                                </th>
                                <th style="width: 20%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                         
                            @foreach ($posts as $post)
                                <tr>
                                    <td>#</td>
                                    <td >{{ $post->title }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="#">
                                            <i class="fas fa-folder">
                                            </i>
                                            View
                                        </a>
                                        <a href="javascript::void(0);" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editUser" data-id="{{ $post->_id }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <a href="javascript::void(0);" class="btn btn-danger btn-sm"
                                            data-id="{{ $post->_id }}">
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

            </div>
            <div class="modal fade" id="professionAdd">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('post.create')}}" method="POST" id="profession-add">
                            <div class="modal-body row">
                                @csrf
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Categories</label>
                                        <select id="post_category" class="form-control" name="category_id">
                                            @foreach($postCategories as $category)
                                           
                                                <option value="{{$category->_id}}">{{$category->name}}</option>
                                             @endforeach
                                        </select>
                                    </div>
                                    <p></p>
                                </div>
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" cols="10" rows="3" class="form-control"></textarea>
                                    <p></p>
                                </div>
                                <div class="mb-3">
                                    <label>Content</label>
                                    <textarea name="content" id="editor" cols="30" rows="50" class="form-control"></textarea>
                                    <p></p>
                                </div>
                               
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary profession-save">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
    </div>
    </div>
@endsection
@push('script')

<script>
	ClassicEditor
		.create( document.querySelector( '#editor' ),
        {
            ckfinder:{
                uploadUrl:"{{route('ckeditor.upload',['_token' => csrf_token()])}}"
            }
        }
         )
		.catch( error => {
			console.error( error );
		} );
</script>
@endpush
