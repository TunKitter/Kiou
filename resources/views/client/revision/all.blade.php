@extends('client.layouts.master')
@section('content')
<table class="table table-nowrap mb-0">
    <thead>
    <tr> 
    <th>Front Card</th>
    <th>Back Card</th>
    <th>STATUS</th>
    <th>Relearn Time</th>
    {{-- <th>Total Revisison</th> --}}
    <th>Lesson</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($bookmarks as $bookmark ) 
    @foreach ($bookmark->cards as $item )
    <tr>
    <td><a href="view-invoice.html">{{$item['front_card']}}</a></td>
    <td>{{$item['back_card']}}</td>
    <td><span class="badge badge-{{$aa = (floor(microtime(true) * 1000) < $item['repetition']['interval'] ? 'green' : 'warning' )}}">{{$aa == 'green' ? 'Learned' : 'Relearn'}}</span></td>
    <td>{{(date('d-m-Y', $item['repetition']['interval'] / 1000))}}</td>
    {{-- <td></td> --}}
    <td><a href="{{route('course-detail',$bookmark->lesson->course->slug)}}" class="btn btn-primary">{{$bookmark->lesson->name}}</a></td>
    </tr>
    @endforeach   
    @endforeach
    </tbody>
    </table>
@endsection
