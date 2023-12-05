@extends('client.layouts.master')
@section('content')
<div class="page-content">
    <div class="container">
        <div class="row">
            @include('client.mentor.sidebar')
            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card instructor-card">
                            <div class="card-header">
                                <h4 class="d-flex justify-content-between w-100">Your CP  <button class="btn btn-primary d-block" style="width: 100px" onclick="location.href='{{route('mentor-cp-create')}}'">Add new</button></h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-nowrap mb-0">
                                    <thead style="background:#f0f0f0 ">
                                        <tr>
                                            <th>Requirement</th>
                                            <th>Category</th>
                                            <th>Level</th>
                                            <th>Total enrollment</th>
                                            <th>More</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($asm  as $item )
                                        <tr id="{{$item->id}}">
                                            <td class="instruct-orders-info">
                                                <p class="text-truncate d-inline-block" style="max-width: 150px">{{$item->description}}</p>
                                            </td>
                                            <td>{{$categories[$item->category_id]}}</td>
                                            <td>{{$level[$item->level_id]}}</td>
                                            <td>{{$item->total_enrollment}}</td>
                                            <td><button class="text-primary bg-white border-0" onclick="location.href='{{route('mentor-cp-detail',$item->id)}}'">More</button></td>
                                            <td><button class="text-white border-0 px-2 py-1 rounded-2" style="background: #fc7f50" onclick="deleteCp('{{$item->id}}')">Delete</button></td>
                                        </tr>    
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    function deleteCp(id){
        if(confirm('Are you sure to delete this CP?')){
            let formData = new FormData();
            formData.append('id',id)
            fetch(`{{route('mentor-cp-delete')}}`, {
                method: 'POST',
                body: formData
            }).then(res => res.text()).then(data => {
                $('#'+id).remove();
            })
        }
    }
</script>
@endsection