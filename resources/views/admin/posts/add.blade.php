@extends('admin.layout.master')
@section('content')
@section('content')
<div class="container">
    <h2>Create Post</h2>
    <form action="{{ route('storePost') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>
        {{-- <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" id="content" rows="5" required></textarea>
        </div> --}}
        <div class="form-group">
            <label for="images">Html</label>
            <input type="file" class="form-control" name="html" id="html">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
@push('script')
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/inline/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

@endpush
