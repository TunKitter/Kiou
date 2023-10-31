 @extends('admin.layout.master')
 @section('content')
     <div class="row">
         <div class="col-sm">
             <div class="card ">
                 <div class="card-header">
                     <h3 class="card-title">List Posts</h3>
                 </div>
                 <!-- /.card-header -->
                 <div class="card-body">
                     <div class="container mt-3">
                         <a href="{{route('addPost')}}" class="btn btn-primary">
                             Thêm
                         </a>
                     </div>
                 </div>
                 <table class="table table-striped" id="data-table">
                     <thead>
                         <tr>
                             <th>Title</th>
                             <th>Content_path</th>
                             <th>Created_at</th>
                             <th>Updated_at</th>
                             <th style="width: 200px">Hoạt động</th>
                         </tr>
                     </thead>
                     <tbody id="data">
                         @include('admin.posts.data')
                     </tbody>
                 </table>

                 {{-- <div id="loading-modal" class="modal" style="display: none;">
                      <div id="loading" class="fui-loading-spinner-3">
                          <div></div>
                          <div></div>
                          <div></div>
                          <div></div>
                          <div></div>
                          <div></div>
                          <div></div>
                          <div></div>
                          <div></div>
                          <div></div>
                          <div></div>
                          <div></div>
                      </div>
                  </div> --}}
             </div>
         </div>
     </div>
     </div>
     </div>
 @endsection
 @push('script')
     
 @endpush
