<div class="branch">
@foreach ($arr as $item)
@if($item['type'] == 'course') 
    <div class="entry"><span onclick="changeValue('Course Video Type','{{$course_name[$item['type_id']]['name']}}','{{$item['type_description']}}','{{$course_name[$item['type_id']]['mentor_username']}}','{{$course_name[$item['type_id']]['name']}}','{{$course_name[$item['type_id']]['thumbnail']}}','{{$course_name[$item['type_id']]['price']}}$','{{route('course-detail', $course_name[$item['type_id']]['slug'])}}')"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $item['type_description']}}">{{$course_name[$item['type_id']]['name']}}</span></div>
@elseif($item['type'] == 'lesson')
    <div class="entry"><span onclick="changeValue('Lesson Video Type','{{$lesson_name[$item['type_id']]['name']. ' of <span class=text-primary>' .$lesson_name[$item['type_id']]['course_name']. '</span>'}}','{{$item['type_description']}}','{{$lesson_name[$item['type_id']]['mentor_username']}}','{{$lesson_name[$item['type_id']]['course_name']}}','{{$lesson_name[$item['type_id']]['thumbnail']}}','{{$lesson_name[$item['type_id']]['course_price']}}$','{{route('course-detail', $lesson_name[$item['type_id']]['course_slug'])}}')"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $item['type_description']}}">{{$lesson_name[$item['type_id']]['name']}} <sup class="text-white p-1 rounded" style="background: #f66962">Lesson</sup></span></div>
@else

    <div class="entry"><span class="multiple">{{$item['type_description']}}</span>
    @include('client.roadmap.item_diagram',['arr'=>$item['type_id']])
    </div>
@endif
@endforeach
</div>   
