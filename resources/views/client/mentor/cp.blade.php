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
                                <h4>Your CP</h4>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($asm  as $item )
                                        <tr>
                                            <td class="instruct-orders-info">
                                                <p class="text-truncate d-inline-block" style="max-width: 150px">{{$item->description}}</p>
                                            </td>
                                            <td>{{$categories[$item->category_id]}}</td>
                                            <td>{{$level[$item->level_id]}}</td>
                                            <td>{{$item->total_enrollment}}</td>
                                            <td><button class="text-primary bg-white border-0" onclick="location.href='{{route('mentor-cp-detail',$item->id)}}'">More</button></td>
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
@endsection