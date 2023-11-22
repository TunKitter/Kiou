@extends('client.layouts.master')
@section('content')
    <section class="course-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="showing-list">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <div class="show-result">
                                        <h3>Explore Courses</h3>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        @if (count($explore_courses))
                            @foreach ($explore_courses as $exploreUser)
                                <div class="col-lg-4 col-md-6 d-flex">
                                    <div class="course-box course-design d-flex ">
                                        <div class="product">
                                            <div class="product-img">
                                                <a href="course-details.html">
                                                    <img class="img-fluid" alt src="{{ $exploreUser->image }}">
                                                </a>
                                                <div class="price">
                                                    <h3>{{ $exploreUser->price }}<span>$99.00</span></h3>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="course-group d-flex">
                                                    <div class="course-group-img d-flex">
                                                        <a href="instructor-profile.html"><img
                                                                src="{{asset("mentor/avatar/". $exploreUser->mentor->image['avatar'] )}}" alt
                                                                class="img-fluid"></a>
                                                        <div class="course-name">
                                                            <h4><a href=""></a>
                                                            </h4>
                                                            <p>Instructor</p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="course-share d-flex align-items-center justify-content-center">
                                                        <a href="#rate"><i class="fa-regular fa-heart"></i></a>
                                                    </div>
                                                </div>
                                                <h3 class="title"><a
                                                        href="course-details.html">{{ $exploreUser->name }}</a></h3>
                                                <div class="course-info d-flex align-items-center">
                                                    <div class="rating-img d-flex align-items-center">
                                                        <img src="{{asset('assets/img/icon/icon-01.svg')}}" alt>
                                                        <p>{{ $exploreUser->meta['total_lesson'] }} lession</p>
                                                    </div>
                                                    <div class="course-view d-flex align-items-center">
                                                        <img src="{{asset('assets/img/icon/icon-02.svg')}}" alt>
                                                        <p>{{ round($exploreUser->meta['total_time'] / 60) }} hr
                                                            {{ round($exploreUser->meta['total_time'] % 60) }} min</p>
                                                    </div>
                                                </div>
                                                <div class="rating">
                                                    <i class="fas fa-star filled"></i>
                                                    <span
                                                        class="d-inline-block average-rating"><span>{{ $exploreUser->complete_course_rate }}</span></span>
                                                </div>
                                                <div class="all-btn all-category d-flex align-items-center">
                                                    <a href="checkout.html" class="btn btn-primary">BUY NOW</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-md-12 d-flex justify-content-center mb-4">
                        @include('client.section.loading')
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary d-block m-auto border-0" onclick="loadMore(this)">Load more</button>
                    </div>
                </div> --}}
            @else
                <p class="text-muted">Course not found !</p>
                @endif
    </section>
@endsection

