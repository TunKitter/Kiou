@extends('admin.layout.master')
@section('content')
<link rel="stylesheet" href="{{asset('assets/vendor/jquery-toast-plugin/jquery.toast.min.css')}}">
<div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="auth-brand text-center mt-2 mb-4 position-relative top-0">
                                                            <h4>Add User</h4>
                                                        </div>
    
                                                        <form class="ps-3 pe-3" onsubmit="return createUser()" id="addUser">
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Name</label>
                                                                <input class="form-control" id="name" type="text" placeholder="Enter your name" name="name">
                                                            </div>
    
                                                            <div class="mb-3">
                                                                <label for="username" class="form-label">Username</label>
                                                                <input class="form-control" type="text" placeholder="Enter your username" name="username" id="username">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="phone" class="form-label">Phone</label>
                                                                <input class="form-control" id="phone" type="text" placeholder="Enter your phone" name="phone">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="email" class="form-label">Email</label>
                                                                <input class="form-control" id="email" type="text" name="email" id="email" placeholder="Enter your password">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="password" class="form-label">Password</label>
                                                                <input class="form-control" type="password" name="password" id="password" placeholder="Enter your password">
                                                            </div>
    
                                                            <div class="mb-3 text-center">
                                                                <button class="btn btn-primary" type="submit">Create User</button>
                                                            </div>
    
                                                        </form>
    
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
<div class="toast toast-delete position-fixed" style="z-index: 5;right:1em;top:6em" role="alert" aria-live="assertive" aria-atomic="true">
                                        <div class="toast-body">
                                            Are you sure to delete this user?
                                            <div class="mt-2 pt-2 border-top">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="deletedUser(this)">Delete now</button>
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
                                    <h4 class="header-title mb-4">User Database <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#add-modal">Add user</button> </h4>
                                    <div class="table-responsive">
                                        <table class="table table-centered mb-0 table-nowrap" id="inline-editable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    {{-- <th>Role</th> --}}
                                                    <th>Created Date</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user )
                                                <tr>
                                                    <td class="text-white" style="font-size: 0">{{$user->_id}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->phone}}</td>
                                                    <td>{{$user->created_at}}</td>
                                                    <td><button class="btn btn-danger btn-delete" onclick="deleteUser('{{$user->id}}',{{$loop->index}})">Delete</button></td>
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
    var take = 10;
    var skip = 10;
    var is_finish = false
    document.body.onload = function(){
const loading = document.querySelector('#loading');
const observer = new IntersectionObserver((entries) => {
const tbody = document.querySelector('tbody');
const no_more = document.querySelector('#no_more');
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
        if(is_finish){
        no_more.style.display = 'block';
          return
        }
        if(loading.style.display == 'block'){
            return 
        }
      loading.style.display = 'block';
      fetch('{{route("admin.listUser")}}/'+take+'/'+skip,{
        method:'POST',
      }).then(response => response.json()).then(data => {
      if(data.length == 0){
        is_finish = true;
      }
          data.forEach((user,index) => {
            let timestamp = user.created_at;
let date = new Date(timestamp);

// Formatting options
const options = { 
  year: 'numeric', 
  month: '2-digit', 
  day: '2-digit', 
  hour: '2-digit', 
  minute: '2-digit', 
  second: '2-digit',
  hour12: false
};

// Convert to a formatted string
let formattedDate = date.toLocaleString('en-US', options).replace(',', '');
let [datePart, timePart] = formattedDate.split(' ');

// Split date into components
let [month, day, year] = datePart.split('/');

// Rearrange components to the desired format
 formattedDate = `${year}-${month}-${day} ${timePart}`;
            tbody.innerHTML += `
            <tr id="${user._id}">
            <td class="text-white" style="font-size: 0"><span class="tabledit-span tabledit-identifier">${user._id}</span><input class="tabledit-input tabledit-identifier" type="hidden" name="id" value="${user._id}" disabled=""></td>
            <td class="tabledit-view-mode" style="cursor: pointer;"><span class="tabledit-span">${user.name}</span><input class="tabledit-input form-control form-control-sm" type="text" name="name" value="${user.name}" style="display: none;" disabled=""></td>
            <td class="tabledit-view-mode" style="cursor: pointer;"><span class="tabledit-span">${user.email}</span><input class="tabledit-input form-control form-control-sm" type="text" name="email" value="${user.email}" style="display: none;" disabled=""></td>
            <td class="tabledit-view-mode" style="cursor: pointer;"><span class="tabledit-span">${user.phone}</span><input class="tabledit-input form-control form-control-sm" type="text" name="phone" value="${user.phone}" style="display: none;" disabled=""></td>
            <td>${ formattedDate}</td>
            <td><button class="btn btn-danger btn-delete" onclick="deleteUser('${user._id}',${index + skip})">Delete</button></td>
            <td><button class="btn btn-secondary">More</button></td>
            </tr>
            `
          })
          skip += take;
          loading.style.display = 'none';
      })
    }
  });
});
const element = document.querySelector('footer');
observer.observe(element);
}   
var user_id_delete = ''
var user_index_delete = ''
function deleteUser(id,index){
    $('.toast-delete').toast('show');
    user_id_delete = id;
    user_index_delete = index;
}
function deletedUser(obj) {
    obj.disabled = true;
    obj.innerHTML = 'Deleting...'
    let formData = new FormData();
    formData.append('id', user_id_delete)
    fetch('{{route("admin.deleteUser")}}',{
        method:'POST',
        body: formData
    }).then(res => res.json()).then(data => {
        $('.toast-delete').toast('hide');
       let temp_btn = document.querySelectorAll('.btn-delete')[user_index_delete]
        temp_btn.classList.remove('btn-danger')
        temp_btn.style.color = 'white'
        temp_btn.style.background = '#186F65'
        setTimeout(() => {
        document.querySelectorAll('tbody tr')[user_index_delete].classList.add('d-none')
        obj.innerHTML = 'Delete';
        obj.disabled = false;
        }, 1000);
        
    })
    // alert(user_id_delete)
}
function createUser(){
    let formData = new FormData(document.querySelector('#addUser'));
    // console.log(formData);
    fetch('{{route("admin.addUser")}}',{
        method: 'POST',
        body: formData
    }).then(res => res.json()).then(user => {
    user = user.data
        $('tbody').prepend(`<tr id="${user._id}" class="new_tr">
            <td class="text-white" style="font-size: 0"><span class="tabledit-span tabledit-identifier">${user._id}</span><input class="tabledit-input tabledit-identifier" type="hidden" name="id" value="${user._id}" disabled=""></td>
            <td class="tabledit-view-mode" style="cursor: pointer;"><span class="tabledit-span">${user.name}</span><input class="tabledit-input form-control form-control-sm" type="text" name="name" value="${user.name}" style="display: none;" disabled=""></td>
            <td class="tabledit-view-mode" style="cursor: pointer;"><span class="tabledit-span">${user.email}</span><input class="tabledit-input form-control form-control-sm" type="text" name="email" value="${user.email}" style="display: none;" disabled=""></td>
            <td class="tabledit-view-mode" style="cursor: pointer;"><span class="tabledit-span">${user.phone}</span><input class="tabledit-input form-control form-control-sm" type="text" name="phone" value="${user.phone}" style="display: none;" disabled=""></td>
            <td>${ user.created_at}</td>
            <td><button class="btn btn-danger btn-delete" onclick="deleteUser('${user._id}',0)">Delete</button></td>
            <td><button class="btn btn-secondary">More</button></td>
            </tr>`)
            $('#add-modal').modal('hide')
            $('.new_tr td').addClass('text-primary')
            setTimeout(() => {
                $('.new_tr td').removeClass('text-primary')
            },4000)
            // document.querySelector('.new_tr td').classList.add('bg-primary')
    })
    return false
}
</script>
 @endsection     