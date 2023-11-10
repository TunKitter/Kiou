@extends('client.layouts.master')
@section('content')
<h1 class="h1 ms-2">Your CP</h1>
<hr>
<div class="comman-space pb-0">
<div class="settings-tickets-blk course-instruct-blk table-responsive">

<table class="table table-nowrap mb-0">
<thead style="background:#f0f0f0 ">
<tr>
<th>Requirement</th>
<th>Mentor Name</th>
<th>Category</th>
<th>Level</th>
<th>State</th>
</tr>
</thead>
<tbody>
@php
    $index = 0;
@endphp
@foreach ($user_asm as $asm )
@php
    $temp_state = $asm->state;
@endphp
<tr>
<td class="instruct-orders-info">
<p><a href="{{  route('revision-code',$mentor_asm[$index])}}">{{$mentor_asm[$index]->description }}</a></p>
</td>
<td>{{$mentor_info[$mentor_asm[$index]->mentor_id]}}</td>
<td>{{$category_asm[$mentor_asm[$index]->category_id]}}</td>
<td>{{$level_asm[$mentor_asm[$index]->level_id]}}</td>
@php
    $temp_title = '';
    switch ($temp_state) {
        case '-1':
            $temp_title = "Haven't Code";
            break;
        case '0':
            $temp_title = "Pending";
            break;
        case '1':
            $temp_title = "Passed";
            break;
    }

@endphp
<td> <span class="badge badge-{{ ($temp_state == 1) ? 'green' : (($temp_state == 0) ? 'warning' : 'danger')}}">{{$temp_title}}</span></td>
</tr>
@endforeach
</tbody>
</table>

</div>
</div>

@endsection