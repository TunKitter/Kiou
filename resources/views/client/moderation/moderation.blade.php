@extends('client.layouts.master')
@section('content')
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="breadcrumb-list">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Pages</li>
                                <li class="breadcrumb-item" aria-current="page">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="course-content cart-widget">
        <div class="container">
            <div class="student-widget">
                <div class="student-widget-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-head d-flex">
                                <h4>Moderation</h4>
                            </div>
                            <div class="cart-group">
                                <div class="row">
                                    @if ($course_lists)
                                        @foreach ($course_lists as $course_list)
                                            <div class="col-lg-12 col-md-12 d-flex">

                                                <div class="course-box course-design list-course d-flex">

                                                    <div class="product">
                                                        <div class="product-img">
                                                            <a href="{{ route('course-detail', $course_list->slug) }}">
                                                                <img class="img-fluid" alt
                                                                    src="{{ asset($course_list->image) }}" />
                                                            </a>
                                                            <div class="price">
                                                                <h3>${{ $course_list->price }}</h3>
                                                            </div>
                                                        </div>
                                                        <div class="product-content">
                                                            <div class="head-course-title">
                                                                <h3 class="title">
                                                                    <a
                                                                        href="{{ route('course-detail', $course_list->slug) }}">{{ $course_list->name }}</a>
                                                                </h3>
                                                            </div>
                                                            <div
                                                                class="course-info d-flex align-items-center border-bottom-0 pb-0">
                                                                <div class="rating-img d-flex align-items-center">
                                                                    <img src="assets/img/icon/icon-01.svg" alt />
                                                                    <p>{{ $course_list->meta['total_lesson'] }} Lesson</p>
                                                                </div>
                                                                <div class="course-view d-flex align-items-center">
                                                                    <img src="assets/img/icon/icon-02.svg" alt />
                                                                    <p>{{ round($course_list->meta['total_time'] / 60) }} hr
                                                                        {{ round($course_list->meta['total_time'] % 60) }}
                                                                        min
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="rating">
                                                                <i class="fas fa-star filled"></i>
                                                                <span
                                                                    class="d-inline-block average-rating"><span>{{ $course_list->complete_course_rate }}</span></span>
                                                            </div>
                                                            <div class="course-group d-flex mb-0">
                                                                <div class="course-group-img d-flex">
                                                                    <a href="instructor-profile.html"><img
                                                                            src="assets/img/user/user2.jpg" alt
                                                                            class="img-fluid"></a>
                                                                    <div class="course-name">
                                                                        <h4><a
                                                                                href="instructor-profile.html">{{ $course_list->mentor->name }}</a>
                                                                        </h4>
                                                                        <p>Instructor</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="all-btn all-category d-flex align-items-center">
                                                            <a href="" class="btn btn-primary">VIEW</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <h2>Hiện chưa có dử liệu mới</h2>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
