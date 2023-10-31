<style>
  .fui-loading-spinner-3 {
  color: official;
  display: inline-block;
  position: absolute;
  width: 80px;
  height: 80px;
  margin: 650px 0 0 800px;
}
.fui-loading-spinner-3 div {
  animation: rj9Ft 1.2s linear infinite;
}
.fui-loading-spinner-3 div:after {
  content: " ";
  display: block;
  position: absolute;
  top: 3px;
  left: 37px;
  width: 6px;
  height: 18px;
  border-radius: 20%;
  background: gray;
}
.fui-loading-spinner-3 div:nth-child(1) {
  transform: rotate(0deg);
  animation-delay: -1.1s;
}
.fui-loading-spinner-3 div:nth-child(2) {
  transform: rotate(30deg);
  animation-delay: -1s;
}
.fui-loading-spinner-3 div:nth-child(3) {
  transform: rotate(60deg);
  animation-delay: -0.9s;
}
.fui-loading-spinner-3 div:nth-child(4) {
  transform: rotate(90deg);
  animation-delay: -0.8s;
}
.fui-loading-spinner-3 div:nth-child(5) {
  transform: rotate(120deg);
  animation-delay: -0.7s;
}
.fui-loading-spinner-3 div:nth-child(6) {
  transform: rotate(150deg);
  animation-delay: -0.6s;
}
.fui-loading-spinner-3 div:nth-child(7) {
  transform: rotate(180deg);
  animation-delay: -0.5s;
}
.fui-loading-spinner-3 div:nth-child(8) {
  transform: rotate(210deg);
  animation-delay: -0.4s;
}
.fui-loading-spinner-3 div:nth-child(9) {
  transform: rotate(240deg);
  animation-delay: -0.3s;
}
.fui-loading-spinner-3 div:nth-child(10) {
  transform: rotate(270deg);
  animation-delay: -0.2s;
}
.fui-loading-spinner-3 div:nth-child(11) {
  transform: rotate(300deg);
  animation-delay: -0.1s;
}
.fui-loading-spinner-3 div:nth-child(12) {
  transform: rotate(330deg);
  animation-delay: 0s;
}
@keyframes rj9Ft {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}
</style>
@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-sm">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">List User</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="container mt-3">
                        <a href="javacsript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-fill-add" viewBox="0 0 16 16">
                                <path
                                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path
                                    d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z" />
                            </svg>
                        </a>

                    </div>

                    <!-- The Modal -->
                    <div class="modal" id="addUser">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add User</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form id="add-User" action="{{ route('addUser') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-control-label">Full name</label>
                                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                                class="form-control">
                                                <p></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Username</label>
                                            <input type="text" id="username" name="username" value="{{ old('name') }}"
                                                class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Number Phone</label>
                                            <input type="text" id="phone" pattern="[0-9]{10}" name="phone"
                                                value="{{ old('phone') }}" class="form-control"
                                               >
                                            <p></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Email</label>
                                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                                class="form-control" 
                                            >
                                            <p></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Password</label>
                                            <div class="pass-group" id="passwordInput">
                                                <input type="password" name="password" id="password" class="form-control pass-input"
                                                    placeholder="Enter your password">
                                                <span class="toggle-password feather-eye"></span>
                                                <span class="pass-checked"><i class="feather-check"></i></span>
                                                <p></p>
                                            </div>
                                            <div class="password-strength" id="passwordStrength">
                                                <span id="poor"></span>
                                                <span id="weak"></span>
                                                <span id="strong"></span>
                                                <span id="heavy"></span>
                                            </div>
                                            <div id="passwordInfo"></div>
                                            <p></p>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <button class="btn btn-primary user-save"
                                                        type="submit">Register</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editUser">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Updated User</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form id="edit-User" action="" method="POST" onsubmit="return false">
                                    @csrf
                
                                    <div class="form-group">
                                        <label class="form-control-label">Full name</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Username</label>
                                        <input type="text" name="username" id="username" class="form-control">
                                        <div class="error_message">
                                            @error('name')
                                                <span style="color: red;font-weight:lighter"></span>
                                                <br>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Number Phone</label>
                                        <input type="text" pattern="[0-9]{10}" id="phone" name="phone"
                                            class="form-control">
                                        <div class="error_message">
                                            @error('phone')
                                                <span style="color: red;font-weight:lighter"></span>
                                                <br>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                        <div class="error_message">
                                            @error('email')
                                                <span style="color: red;font-weight:lighter"></span>
                                                <br>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <button class="btn btn-primary user-edit" type="submit">Updated</button>
                                            </div>
                                           
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-striped" id="data-table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th style="width: 200px">Activate</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                        @include('admin.users.data')
                    </tbody>
                </table>
                
                <div id="loading-modal" class="modal" style="display: none;">
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
                </div>
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
                   if (response.responseJSON.errors['name']){
                    $('#name').addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html(response.responseJSON.errors['name']);
                   }
                   
                   if (response.responseJSON.errors['username']){
                    $('#username').addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html(response.responseJSON.errors['username']);
                   }
                   if (response.responseJSON.errors['email']){
                    $('#email').addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html(response.responseJSON.errors['email']);
                   }
                   if (response.responseJSON.errors['phone']){
                    $('#phone').addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html(response.responseJSON.errors['phone']);
                   }
                   if (response.responseJSON.errors['password']){
                    $('#password').addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html(response.responseJSON.errors['password']);
                   }
                } else {
                    $('#name','#username','#email','#phone','#password').removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html('');
                    $('#add-User')[0].reset();
                    $('#addUser').modal('hide');
                    var html = '<tr id="user-' + response.responseJSON.data._id +'">'+ 
                        '<td class="user_tr_0">' + response.responseJSON.data.username + '</td>' +
                        '<td class="user_tr_1">' + response.responseJSON.data.name + '</td>' +
                        '<td class="user_tr_2">' + response.responseJSON.data.email + '</td>' +
                        '<td class="user_tr_3">' + response.responseJSON.data.phone + '</td>' +

                        '<td>' +
                        '<a href="javascript::void(0);" class="btn btn-warning edit-button" data-bs-toggle="modal"data-bs-target="#editUser"'+ 
                        'data-id="'+ response.responseJSON.data._id +'">Sửa</a>' +
                        ' '+
                        '<a href="javascript::void(0);" class="btn btn-danger user-delete" data-id="'+ response.responseJSON.data._id +'">Xóa</a>' +
                        '</td>' +
                        '</tr>';
                    $('#data-table').prepend(html);
                    swal("success", response.responseJSON.message, "success");
                }
            }
        }

        $('body').on('click', '.user-save', function(event) {
            $(this).parents('form').ajaxForm(optionFeed);
        });
    </script>
    <script type="text/javascript">
      var idUpdate = ""
      var index_update= 0
        $('body').on('click', '.edit-button', function(event) {
            var id = $(this).data('id');
            index_update = ($('.edit-button').index(this))
            $.ajax({
                    url: '/admin/users/edit/' + id,
                    type: 'GET',
                })
                .done(function(response) {
                    idUpdate = response.data._id;
                    $('#edit-User').find('#name').val(response.data.name);
                    $('#edit-User').find('#username').val(response.data.username);
                    $('#edit-User').find('#email').val(response.data.email);
                    $('#edit-User').find('#phone').val(response.data.phone);
                    $('#edit-User').attr('action', response.url);

                    $('#editUser').modal('show');
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete")
                })
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
                    $('#edit-User')[0].reset();
                    $('#editUser').modal('hide');
                    $('#user-' + response.responseJSON.id).html('');
                   
                    var htmlAppe =
                        '<td>' + response.responseJSON.data.name + '</td>' +
                        '<td>' + response.responseJSON.data.username + '</td>' +
                        '<td>' + response.responseJSON.data.email + '</td>' +
                        '<td>' + response.responseJSON.data.phone + '</td>' +
                        '<td>' +
                        '<a class="btn btn-warning edit-button" data-id="' + response.responseJSON.id +
                        '" href="">Sửa</a>' +
                        '<a class="btn btn-danger user-delete" data-id="'+ response.responseJSON.id+'" href="">Xóa</a>' +
                        '</td>';
                    $('#user-' + response.responseJSON.id).html(htmlAppe);
                    swal("success", response.responseJSON.message, "success");
                }
            }
        }

                                    
        $('body').on('click', '.user-edit', function(event) {
            let formData = new FormData()
            let formEdit  = $('#edit-User')
            formData.append('name', formEdit.find('#name').val())
            formData.append('username', formEdit.find('#username').val())
            formData.append('email', formEdit.find('#email').val())
            formData.append('phone', formEdit.find('#phone').val())
            
            fetch("/admin/users/update/"+idUpdate,{method:"POST",
            body: formData
        }).then(response => response.json()).then(data =>  {
            // if(data['status']) {
                // console.log(document.getElementsByClassName('user_tr')[index_update]);
                
                document.getElementsByClassName('user_tr_1')[index_update].innerHTML = formEdit.find('#name').val()
                document.getElementsByClassName('user_tr_2')[index_update].innerHTML = formEdit.find('#email').val()
                document.getElementsByClassName('user_tr_3')[index_update].innerHTML = formEdit.find('#phone').val()
                document.querySelector('#close_modal').click()
                swal("success",'Cập nhật tài khoản thành công', "success");
        //    }
        }).catch(err => console.log(err))
        });
       
    </script>
    <script type="text/javascript">
        $('body').on('click', '.user-delete', function(event) {
            var deleteid = $(this).data('id'); // Use $(this) instead of $($this)
            swal({
                title: "Bạn có chắc chắn?",
                text: "Sau khi xóa, bạn sẽ không thể khôi phục lại tài khoản này!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => { // Use the 'then' method for promises
                if (willDelete) {
                    $.ajax({
                            url: '/admin/users/delete/' + deleteid, // Add a comma here
                            type: 'GET',
                        })
                        .done(function(response) {
                            $('#user-' + deleteid).remove();
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
<script type="text/javascript">
    var ENDPOINT = "{{ route('listUser') }}";
    var page = 1;
    var loading = false; // Biến để theo dõi trạng thái tải dữ liệu
    var noMoreData = false; // Biến để kiểm tra xem đã sổ hết dữ liệu mới chưa
    var dataLoaded = 0; // Số lượng dữ liệu đã tải
    var scrollTriggered = false; // Biến để kiểm tra trạng thái kéo và tải dữ liệu

    function hideLoadingModal() {
        $("#loading-modal").hide(); // Ẩn thông báo loading modal
    }

    // Hiển thị thông báo loading modal khi bạn kéo xuống
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20) && !loading && !noMoreData && !scrollTriggered) {
            scrollTriggered = true; // Đánh dấu trạng thái kéo và tải dữ liệu
            loading = true; // Đánh dấu trạng thái tải dữ liệu
            page++;
            $("#loading-modal").show(); // Hiển thị thông báo loading modal

            // Ẩn thông báo loading modal sau 3 giây
            setTimeout(hideLoadingModal, 1000);

            infinteLoadMore(page);
        }
    })

    function infinteLoadMore(page) {
        $.ajax({
            url: ENDPOINT + "?page=" + page,
            datatype: "html",
            type: "GET",
        })
        .done(function(response) {
            if (response.html == '') {
                noMoreData = true; // Đánh dấu đã sổ hết dữ liệu mới
                if (dataLoaded === 0) {
                    // Giai đoạn 1: Hiển thị nút "Load More" sau khi tải xong lần đầu
                    $("#load-more").show();
                }
            } else {
                dataLoaded += 10; // Cộng thêm 10 dữ liệu đã tải
                $("#data").append(response.html);
                scrollTriggered = false; // Đánh dấu trạng thái kéo và tải dữ liệu đã hoàn thành
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            loading = false; // Đánh dấu tải dữ liệu đã hoàn thành
        })
    }

    // Xử lý nút "Load More"
    $("#load-more").click(function() {
        page++;
        $("#loading-modal").show(); // Hiển thị thông báo loading modal
        $("#load-more").hide(); // Ẩn nút "Load More"
        infinteLoadMore(page);
    });
</script>
@endpush
