@extends('client.layouts.master')
@section('content')
    @if (Session::has('success'))
        @include('client.section.message', ['type' => 'success', 'message' => Session::get('success')])
    @endif
    @if (Session::has('already_username'))
        @include('client.section.message', [
            'type' => 'fail',
            'message' => Session::get('already_username'),
        ])
    @endif
    <style>
        .infor-input:focus {
            border: 1px solid #fca483 !important;
        }

        fieldset input:first-of-type {
            border: none !important
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <div class="page-content">
        <div class="container">
            <div class="row">
             @include('client.mentor.sidebar')
             <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 d-flex">
                        <div class="card instructor-card w-100">
                            <div class="card-body">
                                <div class="instructor-inner">
                                    <h6>REVENUE</h6>
                                    <h4 class="instructor-text-success">${{$instructorRevenue}}</h4>
                                    <p>Earning this month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="card instructor-card w-100">
                            <div class="card-body">
                                <div class="instructor-inner">
                                    <h6>STUDENTS ENROLLMENTS</h6>
                                    <h4 class="instructor-text-info">{{count($studentsEnrollment)}}</h4>
                                    <p>Student this month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="card instructor-card w-100">
                            <div class="card-body">
                                <div class="instructor-inner">
                                    <h6>COURSES RATING</h6>
                                    <h4 class="instructor-text-warning">{{$courses_ratting}}</h4>
                                    <p>Rating </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card instructor-card">
                            <div class="card-header">
                                <h4>Earnings</h4>
                            </div>
                            <div class="card-body">
                                <div id="instructor_chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card instructor-card">
                            <div class="card-header">
                                <h4>Best Selling Courses</h4>
                            </div>
                            <div class="card-body">
                                <div id="order_chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

    </div>
    </div>
    </div>
    <script>
        function un_disabled_input(id) {
            let temp_input = document.getElementById(id)
            temp_input.disabled = false
            temp_input.focus()
            enable_btn()
        }

        function enable_btn() {
            document.getElementById('btn-submit').disabled = false
        }

        function delete_avatar() {
            if (confirm('Are you sure to delete your avatar?')) {
                fetch(location.href, {
                    method: 'DELETE',
                }).then(data => data.text()).then(data => {
                    if (data == 1) {
                        alert('Avatar deleted successfully')
                        setTimeout(() => {
                            location.reload()
                        }, 1000);
                    }

                })
            }
        }
    </script>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{asset('assets/plugins/apexchart/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/plugins/apexchart/chart-data.js')}}"></script>
    <script>
        var is_change = false
        var professions = {}
        @foreach ($professions as $profession)
            professions[`{{ $profession->name }}`] = "{{ $profession->_id }}";
        @endforeach
        function selectProfession(obj) {
            is_change = true
            document.querySelector('fieldset input').value += document.querySelector(`option[value="${obj.value}"]`)
                .innerHTML
            // professions[document.querySelector(`option[value="${obj.value}"]`).innerHTML] =  obj.value
            document.querySelector('fieldset input').click()
            console.log(professions);
            document.getElementById('btn-submit').disabled = false
            check_profession()
        }

        function getProfession() {
            let ids = (document.querySelector('#profession_input').value.split(',').map(profession => {
                return professions[profession]
            }));
            document.querySelector('input[name=profession]').value = ids.join(',')
            //  alert(document.querySelector('input[name=profession]').value)
            // return false
            document.forms[0].submit()
        }

        function check_profession() {
            if (is_change) {

                // console.log(document.querySelector('#profession_input').value, '++', document.querySelector('fieldset input').value);
                if (document.querySelector('#profession_input').value.length == 0) {
                    document.getElementById('btn-submit').disabled = true
                } else {
                    document.getElementById('btn-submit').disabled = false
                }
            }
        }
    </script>
    <script>
        var ctx = document.getElementById('instructor_chart');
        if($('#instructor_chart').length > 0) {
	var options = {
			series: [{
				name: "Current month",
				data: [{!!$earnings!!}]
			},
		],
		colors: ['#FF9364'],
          chart: {
          height: 300,
          type: 'area',
		  toolbar: {
				show: false
			},
          zoom: {
            enabled: false
          }
        },
		markers: {
			size: 3,
		},
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth',
		  width: 3,
        },
		legend: {
			position: 'top',
			horizontalAlign: 'right',
		 },
        grid: {
          show: false,
        },
		yaxis: {
			axisBorder: {
				show: true,
			},
		},
        xaxis: {
          categories: ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			}
    };
        var chart = new ApexCharts(ctx, options);
        chart.render();

}
// Simple Column
if($('#order_chart').length > 0) {
	var sCol = {
		chart: {
			height: 350,
			type: 'bar',
			toolbar: {
			  show: false,
			}
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '20%',
				endingShape: 'rounded', 
				startingShape: 'rounded'  
			},
		},
		 colors: ['#1D9CFD'],
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 2,
			colors: ['transparent']
		},
		series: [{
			name: 'Course',
			data: [{!!$best_courses!!}]
		}],
		xaxis: {
			categories: {!! json_encode($courses_name)!!},
		},
		fill: {
			opacity: 1

		},
		// tooltip: {
		// 	y: {
		// 		formatter: function (val) {
		// 			return "$ " + val + " thousands"
		// 		}
		// 	}
		// }
	}

	var chart = new ApexCharts(
		document.querySelector("#order_chart"),
		sCol
	);

	chart.render();
	}
    </script>
@endsection
