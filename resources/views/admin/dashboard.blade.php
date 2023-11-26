@extends('admin.layout.master')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Velonic</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Welcome!</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Welcome!</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-pink">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-eye-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Courses</h6>
                        <h2 class="my-2">{{ $total_course }}</h2>

                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-purple">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-wallet-2-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Revenue</h6>
                        <h2 class="my-2">${{ $total_revenue }}</h2>

                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-info">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-shopping-basket-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Orders</h6>
                        <h2 class="my-2">{{ $total_order }}</h2>

                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-primary">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-group-2-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Users</h6>
                        <h2 class="my-2">{{ $total_user }}</h2>

                    </div>
                </div>
            </div> <!-- end col-->
        </div>

        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Chart of number of mentor courses</h4>
                        <div dir="ltr">
                            <div id="chart" class="apex-charts" data-colors="#4489e4"></div>
                        </div>
                    </div>
                    <!-- end card body-->
                </div>
                <!-- end card -->
            </div> <!-- end col-->
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="card-widgets">
                            <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                            <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button" aria-expanded="false"
                                aria-controls="yearly-sales-collapse"><i class="ri-subtract-line"></i></a>
                            <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                        </div>
                        <h5 class="header-title mb-0">Monthly report</h5>

                        <div id="yearly-sales-collapse" class="collapse py-5 show">
                            <div dir="ltr">
                                <div id="yearly-sales-chart" class="apex-charts" data-colors="#3bc0c3,#1a2942,#d1d7d973">
                                </div>
                            </div>
                        </div>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->


            </div> <!-- end col-->

        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-4">
                <!-- Chat-->
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-3">
                            <div class="card-widgets">
                                <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                                <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button"
                                    aria-expanded="false" aria-controls="yearly-sales-collapse"><i
                                        class="ri-subtract-line"></i></a>
                                <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                            </div>
                            <h5 class="header-title mb-0">Chat</h5>
                        </div>

                        <div id="yearly-sales-collapse" class="collapse show">
                            <div class="chat-conversation mt-2">
                                <div class="card-body py-0 mb-3" data-simplebar style="height: 322px;">
                                    <ul class="conversation-list">
                                        <li class="clearfix">
                                            <div class="chat-avatar">
                                                <img src="assets/images/users/avatar-5.jpg" alt="male">
                                                <i>10:00</i>
                                            </div>
                                            <div class="conversation-text">
                                                <div class="ctext-wrap">
                                                    <i>Geneva</i>
                                                    <p>
                                                        Hello!
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="clearfix odd">
                                            <div class="chat-avatar">
                                                <img src="assets/images/users/avatar-1.jpg" alt="Female">
                                                <i>10:01</i>
                                            </div>
                                            <div class="conversation-text">
                                                <div class="ctext-wrap">
                                                    <i>Thomson</i>
                                                    <p>
                                                        Hi, How are you? What about our next meeting?
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="chat-avatar">
                                                <img src="assets/images/users/avatar-5.jpg" alt="male">
                                                <i>10:01</i>
                                            </div>
                                            <div class="conversation-text">
                                                <div class="ctext-wrap">
                                                    <i>Geneva</i>
                                                    <p>
                                                        Yeah everything is fine
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="clearfix odd">
                                            <div class="chat-avatar">
                                                <img src="assets/images/users/avatar-1.jpg" alt="male">
                                                <i>10:02</i>
                                            </div>
                                            <div class="conversation-text">
                                                <div class="ctext-wrap">
                                                    <i>Thomson</i>
                                                    <p>
                                                        Wow that's great
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body pt-0">
                                    <form class="needs-validation" novalidate name="chat-form" id="chat-form">
                                        <div class="row align-items-start">
                                            <div class="col">
                                                <input type="text" class="form-control chat-input"
                                                    placeholder="Enter your text" required>
                                                <div class="invalid-feedback">
                                                    Please enter your messsage
                                                </div>
                                            </div>
                                            <div class="col-auto d-grid">
                                                <button type="submit"
                                                    class="btn btn-danger chat-send waves-effect waves-light">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div> <!-- end .chat-conversation-->
                        </div>
                    </div>

                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-xl-8">
                <!-- Todo-->
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-3">
                            <div class="card-widgets">
                                <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                                <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button"
                                    aria-expanded="false" aria-controls="yearly-sales-collapse"><i
                                        class="ri-subtract-line"></i></a>
                                <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                            </div>
                            <h5 class="header-title mb-0">Projects</h5>
                        </div>

                        <div id="yearly-sales-collapse" class="collapse show">

                            <div class="table-responsive">
                                <table class="table table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name Mentor</th>
                                            <th>Total Enrollment</th>
                                            <th>Revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($total_enrollment_mentor as $total)
                                        <tr>
                                            <td>#</td>
                                            <td>{{\App\Models\Mentor::find($total->_id)->name}}</td>
                                            <td>{{$total->total_enrollment}}</td> 
                                            <td>$ {{$total->total_revenue}}</td>    
                                        
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div>
    <!-- container -->
@endsection
@push('script')
    <script>
        var options = {
                chart: {
                    height: 380,
                    type: "bar",
                    toolbar: {
                        show: !1
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: !0
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                series: [{
                    name: "Course",
                    data: {!! json_encode($count_course_mentors) !!}
                }],
                xaxis: {
                    categories: {!! json_encode($name_mentors) !!}
                },
                states: {
                    // hover: {
                    //     filter: "none"
                    // }
                },
                grid: {
                    borderColor: "#f1f3fa"
                }
            },
            chart = new ApexCharts(document.querySelector("#chart"), options).render()
    </script>
    <script>
       

       var options = {
                    series: [{
                        name: "Course",
                        data: {!! json_encode($total_month_course) !!}
                    }, {
                        name: "Enrollment",
                        data: {!! json_encode($total_month_enrollment) !!}
                    }],
                    chart: {
                        height: 250,
                        type: "line",
                        toolbar: {
                            show: !1
                        }
                    },
                    stroke: {
                        curve: "smooth",
                        width: [3, 3]
                    },
                    markers: {
                        size: 3
                    },
                    xaxis: {
                        categories: ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    },
                    legend: {
                        show: !1
                    }
                },
                a = new ApexCharts(document.querySelector("#yearly-sales-chart"), options).render();

    </script>
@endpush
