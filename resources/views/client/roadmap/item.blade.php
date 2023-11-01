 @foreach($arr as $course)
@if(gettype($course['type_id']) != 'array' && $course['type'] != 'multiple')
<li>
    @php
    // dd($course);
        $temp_data_roadmap = $course['type']  == 'course' ? $course_name[$course['type_id']]['name'] : ($lesson_name[$course['type_id']]['name']. '<sup style="background:#f66962;color:white;border-radius:12px;padding: 5px;margin-left:-3.5em;line-height:1">Lesson</sup>') 
    @endphp
<p class="play-intro w-50 d-flex align-items-center justify-content-between flex-wrap" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$course['type_description']}}" > {!!$temp_data_roadmap!!}  <img src="https://picsum.photos/200" style="width:75px"></p>
{{-- <img src="{{asset('assets/img/icon/play-icon.svg')}}" alt> --}}
<div class="course-info border-bottom-0 pb-0 d-flex align-items-center ps-3 pe-2 flex-fill" @if($course['type'] == 'lesson') data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $lesson_name[$course['type_id']]['name']}}"  @endif>
    <div class="rating-img d-flex align-items-center">
    <img src="{{asset('assets/img/icon/icon-01.svg')}}" alt>
    <p>{{ ($course['type'] == 'course')? $course_name[$course['type_id']]['total_lesson']:  $lesson_name[$course['type_id']]['total_lesson'] }} Lesson</p>
    </div>
    <div class="course-view d-flex align-items-center">
    <img src="{{asset('assets/img/icon/icon-02.svg')}}" alt>
    <p>{{$a = (($course['type'] == 'course')?  round($course_name[$course['type_id']]['total_time']/60) : round($lesson_name[$course['type_id']]['total_time']/60))}}hr {{($course['type'] == 'course')?  $a%60 : round($lesson_name[$course['type_id']]['total_time']%60)}}min</p>
    </div>
    </div>
</li>
@else
<li>
    @php
        if(!isset($course['type_description'])) dd($course);
    @endphp
    <div class="course-card w-100"> 
        <h6 class="cou-title">
            <a class="collapsed" style="background:white;border-radius:0;text-decoration: none" data-bs-toggle="collapse" href="#course3_{{$loop->index}} " aria-expanded="false">{{$course['type_description']}}</a>
        </h6>
        <div id="course3_{{$loop->index}}" class="card-collapse collapse" style>
<ul class="border-me">
    @include('client.roadmap.item',['arr'=>$course['type_id']])
</ul>
</div>
</div>
@endif
@endforeach