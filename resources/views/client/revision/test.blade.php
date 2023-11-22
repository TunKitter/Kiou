@extends('client.layouts.master')
@section('content')
<div class="container-fluid">
<div class="ms-2">
 <h2>Select your topic</h2>
<p>Select your topic you want to test</p>   
</div>

<br>
<div class="d-flex align-items-center flex-wrap gap-2">
@php
    $something_ids = [];
    $is_change = false;
@endphp
    @foreach ($user_skills as $skill )
    <div class="d-flex" style="width: 30%" onclick="goTo('{{route('revision-test-test',$categories_slug[$skill->category_id])}}')">
    <div class="card instructor-card w-100">
    <div class="card-body">
    <div class="instructor-inner">
    <h6>{{$categories[$skill->category_id]}}</h6>
    <div class="d-flex gap-2">
        @php
            $aa = (time()*1000) - (strtotime($skill->updated_at)*1000);
            ($bb = $skill->infor[0] - floor(($aa/86400000))) ;
            $demo1 = ( ($aa) >= 86400000) ?   $bb  : $skill->infor[0];
            $demo2 = $bb <= 0 ?($cc = $skill->infor[1] + $bb) :($cc = $skill->infor[1]);
            $demo3 = $cc < 0 ? (( $skill->infor[2]) + $cc) : $skill->infor[2];
        @endphp
     <h4 class="instructor-text-success something" >{{$demo1}}</h4>
     {{-- <h4 class="instructor-text-success" id="total_bookmarks">{{$skill->infor[0]}}</h4> --}}

    <h4 class="text-info something">{{$demo2}}</h4>  
    <h4 style="color: #f7756f" class="something" >{{$demo3}}</h4>       
    </div>
    <p class="badge badge-green text-white">{{$professions[$categories_id[$skill->category_id]]}}</p>
    </div>
    </div>
    </div>
    </div>
    @php
    $something_ids[$skill->id] = [$demo1,$demo2,$demo3];
    if(!$is_change) {
        if($demo1 != $skill->infor[0] || $demo2 != $skill->infor[1] || $demo3 != $skill->infor[2]) {
            $is_change = true;
        }
    }
        $bb = 0;
    @endphp
    @endforeach

    </div>
</div>
<script>
    const somethings = document.querySelectorAll('.something')
    console.log(somethings);
    function goTo(url) {
        window.location.href = url
    }
    document.body.onload = function(){
        if({{$is_change ? 'true': 'false'}}) {
        const formData = new FormData();
        const data = JSON.parse(('{!!json_encode($something_ids)!!}'))
            console.log(data);
        formData.append('data',JSON.stringify(data));
        fetch('{{route("revision-test-test-update","demo")}}',{
            method:"POST",
            body: formData
        }).then(res => res.json()).then(data => {
            console.log(data);
        })
    }
        }
</script>
@endsection