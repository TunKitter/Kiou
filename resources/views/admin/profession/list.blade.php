@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-sm">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">Profession List</h3>
                    <a href="javascript:void(0);" id="btn-add" class="btn btn-primary float-right" data-toggle="modal"
                        data-target="#professionAdd">
                        Add
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body ">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Profession Parent</th>
                                <th>Created By</th>
                                <th>Created date</th>
                                <th style="width: 200px">Hoạt động</th>
                            </tr>
                        </thead>
                        <tbody id="data">
                            @include('admin.profession.data')
                        </tbody>
                    </table>
                    <div class="loader text-center" style="display: none">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-dark" role="status">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="modal fade" id="professionAdd">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('profession.add') }}" method="POST" id="profession-add">
                                <div class="modal-body">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            value="{{ old('name') }}">
                                        <p></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="post_category">Parent Profession</label><br>

                                        @foreach ($professions as $profession)
                                            <div id="parents">
                                                <input type="checkbox" name="parent_profession[]"
                                                    value="{{ $profession->_id }}"
                                                    profession_name="{{ $profession->name }}">
                                                {{ $profession->name }}
                                                <br>
                                            </div>
                                        @endforeach
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
                <!-- /.modal-dialog -->
                <div class="modal fade" id="professionEdit">
                    <div class="modal-dialog">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="POST" id="profession-edit">
                                @method('PATCH')
                                <div class="modal-body">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" id="name">
                                        <p></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="post_category">Parent Profession</label><br>
                                        <div id="parent">

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary profession-edit">Update</button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('script')
    {{-- Handle Add --}}
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
                        .removeClass('invalid-feedback').html("");
                    $('#profession-add')[0].reset();
                    $('#professionAdd').modal('hide');

                    var html = '<tr>' +
                        '<td>' + response.responseJSON.data._id + '</td>' +
                        '<td>' + response.responseJSON.data.name + '</td>' +
                        '<td>' + response.responseJSON.data2 + '</td>' +
                        '<td>' + response.responseJSON.data.created_at + '</td>' +
                        '<td>' + response.responseJSON.data.created_at + '</td>' +
                        '<td>' +
                        '<a href="javascript:void(0);" data-toggle="modal" data-target="#professionEdit" data-id="' +
                        response.responseJSON.data._id + '" class="btn btn-warning btn-edit">Edit</a>' +
                        ' ' +
                        '<a href="javascript:void(0);" class="btn btn-danger profession-delete" data-id="' +
                        response.responseJSON.data._id + '">Delete</a>' +
                        '</td>' +
                        '</tr>';
                    $('#data').prepend(html);
                    var html2 = '<input type="checkbox" name="parent_profession[]"' +
                        'value="' + response.responseJSON.data._id + '">' + response.responseJSON.data.name +
                        '<br>';
                    $('#parents').prepend(html2);
                    swal("Success!", response.responseJSON.message, "success");

                }
            }
        }
        $('body').on('click', '.profession-save', function(event) {
            // console.log( );
            $(this).parents('form').ajaxForm(optionFeed);
        });
    </script>
    {{-- Handle Edit --}}
    <script type="text/javascript">
        $('body').on('click', '.btn-edit', function(event) {
            var id = $(this).data('id');
            let parentArray = document.querySelectorAll('.parent_name')[$('.btn-edit').index(this)].innerHTML.trim()
                .split(',');
            parentArray = parentArray.map(e => e.trim());
            $.ajax({
                    url: '/professions/edit/' + id,
                    type: 'GET'
                })
                .done(function(response) {
                    $('#parent').html('');
                    $('#profession-edit').find('#name').val(response.data.name);

                    $(response.data2).each(function(index, profession) {
                        var html =
                            '<input type="checkbox" name="parent_profession[]" ' + (parentArray
                                .includes(profession.name.trim()) ? 'checked' : '') +
                            ' class="parent_profession" value="' + profession._id + '">' + profession
                            .name + '<br>';
                        $('#parent').prepend(html);
                    })
                    $('#profession-edit').attr('action', response.url);
                    $('#professionEdit').modal('show');
                })
                .fail(function() {
                    console.log("errors");
                })
                .always(function() {
                    console.log("Complete");
                })
        });
    </script>
    {{-- Handle Delete --}}
    <script type="text/javascript">
        $('body').on('click', '.profession-delete', function(event, index) {
            var deleteid = $(this).data('id');
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it"
                },
                function() {
                    $.ajax({
                            url: '/professions/delete/' + deleteid,
                            type: 'GET',
                        })
                        .done(function(reponse) {
                            location.reload();
                            swal("Deleted!", "Your imaginary file has been deleted.", "success");

                        })
                        .fail(function() {
                            console.log("error");
                        })
                        .always(function() {
                            console.log("Complete");
                        });
                });
        });
    </script>
    {{-- Handle Load more paginate --}}
    <script type="text/javascript">
        var ENDPOINT = "{{ route('profession.list') }}";
        var page = 1;

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
                page++;
                infinteLoadMore(page);
            }
        })

        function infinteLoadMore(page) {
            $.ajax({
                    url: ENDPOINT + "?page=" + page,
                    datatype: "html",
                    type: "GET",
                    beforeSend: function() {
                        $('.loader').show();
                    }
                })
                .done(function(response) {
                    if (response.html == '') {
                        $('.loader').html("");
                        return;
                    }
                    $('.loader').hide();
                    $("#data").append(response.html)
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                })
        }
    </script>
    {{-- Handle Update --}}
    <script type="text/javascript">
  
        var editForm = {
            complete: function(response) {
                
                if (!$.isEmptyObject(response.responseJSON.errors)) {
                    // if (response.responseJSON.errors['name']) {
                    //     $('#nameEdit').addClass('is-invalid')
                    //         .siblings('p')
                    //         .addClass('invalid-feedback').html(response.responseJSON.errors['name']);
                    // }
                } else {

                    $('#profession-edit')[0].reset();
                    $('#professionEdit').modal('hide');

                    $('#profession-' + response.responseJSON.id).html('');

                    var htmlUpdate =
                        '<td>' + response.responseJSON.id + '</td>' +
                        '<td>' + response.responseJSON.data.name + '</td>' +
                        '<td>' + response.responseJSON.data2 + '</td>' +
                        '<td>' + +'</td>' +
                        '<td>' + response.responseJSON.data.created_at + '</td>' +
                        '<td>' +
                        '<a href="javascript:void(0);" data-toggle="modal" data-target="#professionEdit" data-id="' +
                        response.responseJSON.id + '" class="btn btn-warning btn-edit">Edit</a>' +
                        ' ' +
                        '<a href="javascript:void(0);" class="btn btn-danger profession-delete" data-id="' +
                        response.responseJSON.id + '">Delete</a>' +
                        '</td>';
                    $('#profession-' + response.responseJSON.id).html(htmlUpdate);
                   
                    $('#profession-add')[0].reset();
                    swal("Success!", response.responseJSON.message, "success");


                }
            }
        }
        $('body').on('click', '.profession-edit', function(event) {
            $(this).parents('form').ajaxForm(editForm);
        });
    </script>
@endpush
