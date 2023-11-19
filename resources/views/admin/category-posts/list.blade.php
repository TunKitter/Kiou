@extends('admin.layout.master')
@section('content')
    <!-- The Modal -->
    <div class="modal" id="addCategory">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="add-category" action="{{ route('storeCategory') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label">Name category</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="form-control">
                            <p></p>
                        </div>

                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary category-save" type="submit">Add Category</button>
                                </div>

                            </div>
                        </div>
                </div>
                </form>
            </div>

        </div>
    </div>
    <div class="modal" id="editCategory">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Updated Category</h4>
                    <button type="button" id="close_modal" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="edit-category" action="" method="POST" onsubmit="return false">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label">Name category</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="form-control">
                            <p></p>
                        </div>

                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary category-edit" type="submit">Update Category</button>
                                </div>

                            </div>
                        </div>
                </div>
                </form>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">List Category Posts</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="container mt-3">
                        <a data-bs-toggle="modal" data-bs-target="#addCategory" class="btn btn-primary">
                            Thêm
                        </a>
                    </div>
                </div>
                <table class="table table-striped" id="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th style="width: 200px">Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                        @include('admin.category-posts.data')
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
    <script type="text/javascript">
        var optionFeed = {
            complete: function(response) {
                if (!$.isEmptyObject(response.responseJSON.errors)) {
                    if (response.responseJSON.errors['name']) {
                        $('#name').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(response.responseJSON.errors['name']);
                    }
                } else {
                    $('#name').removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html('');
                    $('#add-category')[0].reset();
                    $('#addCategory').modal('hide');
                    var html = '<tr id="category-' + response.responseJSON.data._id + '" class="category_tr">' +
                        '<td class="category_tr_0">' + response.responseJSON.data.name + '</td>' +
                        '<td class="category_tr_1">' + response.responseJSON.data.slug + '</td>' +
                        '<td class="category_tr_2">' + response.responseJSON.data.created_at + '</td>' +
                        '<td class="category_tr_3">' + response.responseJSON.data.updated_at + '</td>' +
                        '<td>' +
                        '<a href="javascript:void(0);" class="btn btn-warning edit-button" data-bs-toggle="modal" data-bs-target="#editCategory"' +
                        'data-id="' + response.responseJSON.data._id + '">Edit</a>' +
                        ' ' +
                        '<a href="javascript:void(0);" class="btn btn-danger category-delete" data-id="' + response
                        .responseJSON.data._id + '">Delete</a>' +
                        '</td>' +
                        '</tr>';
                    $('#data').prepend(html);
                    swal("success", response.responseJSON.message, "success");
                }
            }
        }

        $('body').on('click', '.category-save', function(event) {
            event.preventDefault();
            var form = $(this).closest('form');
            var formData = new FormData(form[0]);

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    optionFeed.complete({
                        responseJSON: response
                    });
                },
                error: function(response) {
                    // Xử lý lỗi (nếu cần)
                    console.log("Error");
                }
            });
        });
    </script>

    <script type="text/javascript">
        var idUpdate = "";
        var indexUpdate = 0;

        $('body').on('click', '.edit-button', function(event) {
            var id = $(this).data('id');
          
            indexUpdate = $('.edit-button').index(this);

            $.ajax({
                url: '/admin/category-posts/edit/' + id,
                type: 'GET',
                success: function(response) {
                    idUpdate = response.data._id;
                    $('#edit-category #name').val(response.data.name);
                    $('#edit-category').attr('action', response.url);

                    $('#editCategory').modal('show');
                },
                error: function() {
                    console.log("Error");
                }
            });
        });
    </script>

    <script type="text/javascript">
        var editForm = {
            complete: function(response) {
                $('#edit-errors').hide();
                if (!$.isEmptyObject(response.responseJSON.errors)) {
                    $('#errors').show();

                    $.each(response.responseJSON.errors, function(index, val) {
                        $('#edit-errors').find('ul').html('');
                    });
                } else {
                    $('#edit-category')[0].reset();
                    $('#editCategory').modal('hide');
                    $('#category-' + response.responseJSON.id).html('');

                    var htmlAppe =
                        '<td>' + response.responseJSON.data.name + '</td>' +
                        '<td>' +
                        '<a class="btn btn-warning edit-button" data-id="' + response.responseJSON.id +
                        '" href="">Sửa</a>' +
                        '<a class="btn btn-danger category-delete" data-id="' + response.responseJSON.id +
                        '" href="">Xóa</a>' +
                        '</td>';
                    $('#category-' + response.responseJSON.id).html(htmlAppe);
                    swal("success", response.responseJSON.message, "success");
                }
            }
        }

        $('body').on('click', '.category-edit', function(event) {
            let formEdit = $('#edit-category');
            let formData = new FormData(formEdit[0]);
            let slug = createSlug(formEdit.find('#name').val())
            formData.append('slug',slug);

            fetch("/admin/category-posts/update/" + idUpdate, {
                method: "POST",
                body: formData
            }).then(response => response.json()).then(data => {
                    document.querySelector('#close_modal').click();
                    swal("success", 'Cập nhật danh mục thành công', "success");
                    document.querySelectorAll(".category_tr_0")[indexUpdate].innerHTML= formEdit.find('#name').val()
                    document.querySelectorAll(".category_tr_1")[indexUpdate].innerHTML= slug
            }).catch(err => console.log(err));
        });

        function createSlug(str) {
            // Chuyển chuỗi thành slug bằng cách loại bỏ ký tự không hợp lệ và thay thế khoảng trắng bằng dấu gạch ngang
            return str.toLowerCase().replace(/[^a-zA-Z0-9-]+/g, '-').replace(/^-+|-+$/g, '');
        }
    </script>

    <script type="text/javascript">
        $('body').on('click', '.category-delete', function(event) {
            var deleteid = $(this).data('id'); // Use $(this) instead of $($this)
            swal({
                title: "Bạn có chắc chắn?",
                text: "Sau khi xóa, bạn sẽ không thể khôi phục lại danh mục này!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => { // Use the 'then' method for promises
                if (willDelete) {
                    $.ajax({
                            url: '/admin/category-posts/delete/' + deleteid, // Add a comma here
                            type: 'GET',
                        })
                        .done(function(response) {
                            $('#category-' + deleteid).remove();
                            swal("Deleted", response.message,
                                "success"); // Corrected the spelling of "Deleted"
                        })
                        .fail(function() {
                            console.log("error");
                        })
                        .always(function() {
                            console.log("complete");
                        });
                }
            });
        });
    </script>
@endpush
