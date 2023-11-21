@extends('admin.layout.master')
@section('content')
<style>
    .ck-editor__editable_inline {
        height: 350px;
    }
</style>
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Create Post</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('post-store')}}" method="POST">
                        @csrf
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Title" name="title">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="inputState" class="form-label">Post Categories</label>
                                <select id="inputState" name="category_id" class="form-select">
                                  
                                    @foreach($postCategories as $category)
                                    <option value="{{$category->_id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="inputAddress" class="form-label">Description</label>
                            <textarea name="description" cols="10" rows="3" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="inputAddress2" class="form-label">Content</label>
                            <textarea name="content" id="editor" cols="10" rows="10" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
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
