@extends('client.layouts.master')
@section('content')
    <div class="page-content">
        <div class="container">
            <div class="row">

                <div class="col-xl-3 col-md-4 theiaStickySidebar">
                    <div class="settings-widget dash-profile mb-3">
                        <div class="settings-menu p-0">
                            <div class="profile-bg">
                                <h5>Beginner</h5>
                                <img src="{{ asset('assets/img/profile-bg.jpg') }}" alt>
                                <div class="profile-img">
                                    @if ($user->image['avatar'] == null)
                                        <a href="student-profile.html"><img src="{{ asset('assets/img/user/avatar.jpg') }}"
                                                alt></a>
                                    @else
                                        <a href="student-profile.html"><img
                                                src="{{ ($image = auth()->user()->image['avatar']) ? (str_starts_with($image, 'http') ? $image : asset('user/avatar/' . $image)) : asset('assets/img/user/avatar.jpg') }}"
                                                alt></a>
                                    @endif
                                </div>
                            </div>
                            <div class="profile-group">
                                <div class="profile-name text-center">
                                    <h4><a href="student-profile.html">{{ $user->name }}</a></h4>
                                    <p>Student</p>
                                </div>
                                <div class="go-dashboard text-center">
                                    <a href="{{ route('home') }}" class="btn btn-primary">Go to Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('client.section.menuprofile')
                </div>

                <!-- Instructor Dashboard -->
                <div class="col-xl-9 col-lg-8 col-md-12">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="settings-widget">
                                <div class="settings-inner-blk p-0">
                                    <div class="sell-course-head comman-space">
                                        <h3>Courses</h3>
                                        <p>Manage your courses and its update like live, draft and insight.</p>
                                    </div>
                                    <div class="comman-space pb-0">
                                        <div class="instruct-search-blk">
                                            <div class="show-filter choose-search-blk">
                                                <form action="#">
                                                    <div class="row gx-2 align-items-center">
                                                        <div class="col-md-6 col-item">
                                                            <div class=" search-group">
                                                                <i class="feather-search"></i>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Search our courses">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-6 col-item">
                                                            <div class="form-group select-form mb-0">
                                                                <select class="form-select select" name="sellist1">
                                                                    <option>Choose</option>
                                                                    <option>Angular</option>
                                                                    <option>React</option>
                                                                    <option>Node</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="settings-tickets-blk course-instruct-blk table-responsive">

                                            <!-- Referred Users-->
                                            <table class="table table-nowrap mb-2">
                                                <thead>
                                                    <tr>
                                                        <th>COURSES</th>
                                                        <th>STATUS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($Courses)
                                                        @foreach ($Courses as $item)
                                                            <tr>
                                                                <td>
                                                                    <div class="sell-table-group d-flex align-items-center">
                                                                        <div class="sell-group-img">
                                                                            <a
                                                                                href="{{ route('lesson-learn', [$item->slug, $lessons[$item->id]]) }}">
                                                                                <img src="{{ asset('course/thumbnail/' . $item->image) }}"
                                                                                    class="img-fluid " alt=""
                                                                                    width="120" height="120">
                                                                            </a>
                                                                        </div>
                                                                        <div class="sell-tabel-info">
                                                                            <p><a
                                                                                    href="{{ route('lesson-learn', [$item->slug, $lessons[$item->id]]) }}">{{ $item->name }}</a>
                                                                            </p>
                                                                            <div
                                                                                class="course-info d-flex align-items-center border-bottom-0 pb-0">
                                                                                <div
                                                                                    class="rating-img d-flex align-items-center">
                                                                                    <img src="{{ asset('assets/img/icon/icon-01.svg') }}"
                                                                                        alt>
                                                                                    <p>{{ $item->meta['total_lesson'] }}
                                                                                        lession</p>
                                                                                </div>
                                                                                <div
                                                                                    class="course-view d-flex align-items-center">
                                                                                    <img src="{{ asset('assets/img/icon/icon-02.svg') }}"
                                                                                        alt>
                                                                                    <p>{{ round($item->meta['total_time'] / 60) }}
                                                                                        hr
                                                                                        {{ round($item->meta['total_time'] % 60) }}
                                                                                        min</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><span class="badge info-low">Live</span></td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td>There are no courses</td>
                                                        </tr>
                                                    @endif


                                                </tbody>


                                            </table>

                                            <!-- /Referred Users-->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /Instructor Dashboard -->

            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
