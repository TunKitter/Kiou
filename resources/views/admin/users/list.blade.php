@extends('admin.layout.master')
@section('content')
<div class="row">
    <div class="col-sm">
        <div class="card ">
            <div class="card-header">
              <h3 class="card-title">Danh sách khách hàng</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body ">
              <table class="table table-striped">
                <thead >
                  <tr>
                    <th style="width: 30px">ID</th>
                    <th>Họ và tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Thời gian cập nhật</th>
                    <th style="width: 200px">Hoạt động</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $user)
                      <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone_number}}</td>
                        <td>{{$user->address}}</td>
                        <td>{{$user->updated_at}}</td>
                        <td>
                            <a href="{{route('admin.productcategories.edit',['id' =>$user->id])}}" class="btn btn-warning">Sửa</a>
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa ?')" href="" class="btn btn-danger">Xóa</a>
                        </td>
                      </tr>
                    @endforeach
                  
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
    </div>
</div>
@endsection