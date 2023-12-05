@extends('client.layouts.master')
@section('content')
    <button class="btn float-end d-block" style="margin-right: 0.5em;border: 1px solid #fc7f50;color: #fc7f50"
        onclick="location.href='{{ route('revision-bookmark-revise') }}'">Revise all</button>
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
            @foreach ($bookmarks as $bookmark)
                @foreach ($bookmark->cards as $item)
                    <tr>
                        <td><a href="view-invoice.html">{{ $item['front_card'] }}</a></td>
                        <td>{{ $item['back_card'] }}</td>
                        <td><span
                                class="badge badge-{{ $aa = floor(microtime(true) * 1000) < $item['repetition']['interval'] ? 'green' : 'warning' }}">{{ $aa == 'green' ? 'Learned' : 'Relearn' }}</span>
                        </td>
                        <td>{{ date('d-m-Y-H:i', $item['repetition']['interval'] / 1000) }}</td>
                        {{-- <td></td> --}}
                        <td><a href="{{ route('course-detail', $bookmark->lesson->course->slug) }}"
                                class="btn btn-primary">{{ $bookmark->lesson->name }}</a></td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
@endsection
