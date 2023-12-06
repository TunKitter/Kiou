@extends('admin.layout.master')
@section('content')
<style>
    .ck-editor__editable_inline {
        height: 150px;
    }
</style>
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Posts <a href="{{route('admin.post-create')}}" class="btn btn-primary float-end mx-2">Add post</a> </h4>
                    <div class="table-responsive">
                        <table class="table table-centered mb-0 table-nowrap" id="category_table">
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
                                        <td class="project-actions d-flex justify-content-end">
                                            <a href="{{route('admin.post-edit', $post->slug)}}" class="btn btn-info btn-sm mx-1">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <div>
                                                <form action="{{route('admin.post-delete',$post->_id)}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                    data-id="{{ $post->_id }}">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    Delete
                                                     </button>
                                                </form>
                                            </div>
                                            
                                        </td>
    
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
   
    </div>
@endsection

