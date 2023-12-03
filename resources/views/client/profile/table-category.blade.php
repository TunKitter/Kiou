@extends('client.layouts.master')
@section('content')
    @if ($message = Session::get('success'))
        @include('client.section.message', ['message' => $message, 'type' => 'success'])
    @endif
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/heatmap.js"></script>
    <script src="https://code.highcharts.com/modules/tilemap.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <style>
        .infor_input:focus {
            border: 1px solid #fca483 !important;
        }

        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 360px;
            max-width: 1000px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
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
                                    <a href="deposit-student-dashboard.html" class="btn btn-primary">Go to Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="settings-widget account-settings">
                        <div class="settings-menu">
                            <h3>ACCOUNT SETTINGS</h3>
                            <ul>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="feather-settings"></i> Edit Profile
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('mycourses') }}" class="nav-link">
                                        <i class="feather-book"></i> My Courses
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('userskill') }}" class="nav-link">
                                        <i class="feather-user"></i> User Chart
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="setting-student-notification.html" class="nav-link">
                                        <i class="feather-bell"></i> Notifications
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('profile-password', $user->id) }}" class="nav-link">
                                        <i class="feather-lock"></i> Password
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="feather-trash-2"></i> Delete Profile
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="setting-student-accounts.html" class="nav-link">
                                        <i class="feather-user"></i> Linked Accounts
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="setting-student-referral.html" class="nav-link">
                                        <i class="feather-user-plus"></i> Referrals
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="login.html" class="nav-link">
                                        <i class="feather-power"></i> Sign Out
                                    </a>
                                </li>
                            </ul>
                            <h3>SUBSCRIPTION</h3>
                            <ul>
                                <li class="nav-item">
                                    <a href="setting-student-subscription.html" class="nav-link ">
                                        <i class="feather-calendar"></i> My Subscriptions
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="setting-student-billing.html" class="nav-link">
                                        <i class="feather-credit-card"></i> Billing Info
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="setting-student-payment.html" class="nav-link">
                                        <i class="feather-credit-card"></i> Payment
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="setting-student-invoice.html" class="nav-link">
                                        <i class="feather-clipboard"></i> Invoice
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-md-8">
                    {{-- <button class="btn float-end d-block"
                        style="margin-right: 0.5em;border: 1px solid #fc7f50;color: #fc7f50"
                        onclick="location.href='{{ route('revision-bookmark-revise') }}'">Revise all</button> --}}
                    @if (!empty($categorys))
                        <table class="table table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($professions_categorys as $professions_category)
                                    <tr>
                                        <td>
                                            <a>
                                                @php
                                                    $i++;
                                                    echo $i;
                                                @endphp
                                            </a>
                                        </td>
                                        <td>
                                            {{ $professions_category->name }}
                                        </td>
                                        <td>
                                            <span class="">
                                                <div class="text-success" style="margin: none; padding:none;">
                                                    Complete
                                                </div>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('userskill-category', $professions_category->_id) }}"
                                                class="btn btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    @else
                        <h3 class="text-center">Dử liệu chưa được cập nhật</h3>
                    @endif

                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
