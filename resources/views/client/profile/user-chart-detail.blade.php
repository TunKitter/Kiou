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
                                    <a href="{{route('home')}}" class="btn btn-primary">Go to Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('client.section.menuprofile')
                </div>
                <div class="col-xl-9 col-md-8">

                    @php
                        //Lấy ký tự viết tắc
                        function acronyms($str)
                        {
                            $words = explode(' ', $str);
                            $result = '';
                            foreach ($words as $word) {
                                if (!empty($word)) {
                                    $result .= strtoupper($word[0]);
                                }
                            }
                            return $result;
                        }

                        $randomx = 1;
                        $randomy = 1;
                        $array[] = 0;
                        
                        $i = 0;
                        $increase = 1;

                    @endphp
                    @if (count($user_skills) != 0)
                        @foreach ($categorys as $category)
                            @php
                                if (in_array($category->_id, $array_data)) {
                                    if ($user_skills) {
                                        if ($i < $increase) {
                                            $total = array_sum($user_skill_cate[$i][0]->infor);
                                            $count = count($user_skill_cate[$i][0]->infor);
                                            $average = $total / $count;
                                            $value = round($average);
                                            $array[] = ['hc-a2' => acronyms($category->name), 'name' => $category->name, 'region' => 'South', 'x' => $randomy, 'y' => $randomx, 'value' => $value];
                                            $i++;
                                            $increase++;
                                        }
                                    }
                                } else {
                                    $value = 0;
                                    $array[] = ['hc-a2' => acronyms($category->name), 'name' => $category->name, 'region' => 'South', 'x' => $randomy, 'y' => $randomx, 'value' => $value];
                                }
                                $randomx++;
                                if ($randomx % 2 == 0) {
                                    $randomy++;
                                }

                            @endphp
                        @endforeach
                        @php
                            if ($array == 0) {
                                $jsonData = 0;
                            } else {
                                $jsonData = json_encode($array);
                            }
                        @endphp
                    @else
                        <h3 class="text-center">
                            You have not purchased any courses yet. Please purchase and study to see the course progress
                        </h3>
                    @endif

                    <figure class="highcharts-figure">
                        <div id="container"></div>
                        <p class="highcharts-description text-center">
                            The graph shows the average score of each course
                        </p>
                    </figure>
                </div>
            </div>

        </div>
    </div>
    </div>
    <script>
        var phpData = <?php if ($array == 0) {
            $jsonData = 0;
        } else {
            $jsonData = json_encode($array);
        }
        echo $jsonData;
        ?>;
        Highcharts.chart('container', {
            chart: {
                type: 'tilemap',
                inverted: true,
                height: '80%'
            },

            accessibility: {
                description: 'A tile map represents the states of the USA by population in 2016. The hexagonal tiles are positioned to geographically echo the map of the USA. A color-coded legend states the population levels as below 1 million (beige), 1 to 5 million (orange), 5 to 20 million (pink) and above 20 million (hot pink). The chart is interactive, and the individual state data points are displayed upon hovering. Three states have a population of above 20 million: California (39.3 million), Texas (27.9 million) and Florida (20.6 million). The northern US region from Massachusetts in the Northwest to Illinois in the Midwest contains the highest concentration of states with a population of 5 to 20 million people. The southern US region from South Carolina in the Southeast to New Mexico in the Southwest contains the highest concentration of states with a population of 1 to 5 million people. 6 states have a population of less than 1 million people; these include Alaska, Delaware, Wyoming, North Dakota, South Dakota and Vermont. The state with the lowest population is Wyoming in the Northwest with 584,153 people.',
                screenReaderSection: {
                    beforeChartFormat: '<h5>{chartTitle}</h5>' +
                        '<div>{chartSubtitle}</div>' +
                        '<div>{chartLongdesc}</div>' +
                        '<div>{viewTableButton}</div>'
                },
                point: {
                    valueDescriptionFormat: '{index}. {xDescription}, {point.value}.'
                }
            },

            title: {
                text: 'The graph shows the average score of each course',
                style: {
                    fontSize: '1em'
                }
            },

            subtitle: {
                text: 'Source:<a href="https://simple.wikipedia.org/wiki/List_of_U.S._states_by_population">Wikipedia</a>'
            },

            xAxis: {
                visible: false
            },

            yAxis: {
                visible: false
            },

            colorAxis: {
                dataClasses: [{
                    from: 0,
                    to: 0,
                    color: '#e6e6e6',
                    name: 'Block'
                }, {
                    from: 1,
                    to: 50,
                    color: '#FF8F8F',
                    name: '1 - 49'
                }, {
                    from: 50,
                    to: 70,
                    color: '#F3B664',
                    name: '50 - 69'
                }, {
                    from: 70,
                    to: 90,
                    color: '#EEF296',
                    name: '70 - 89'
                }, {
                    from: 90,
                    to: 100,
                    color: '#9ADE7B',
                    name: '90 - 100'
                }]
            },

            tooltip: {
                headerFormat: '',
                pointFormat: '<b> {point.name}</b> is <b>{point.value}</b>'
            },

            plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                        format: '{point.hc-a2}',
                        color: '#000000',
                        style: {
                            textOutline: false
                        }
                    }
                }
            },
            series: [{
                data: phpData.map(function(item) {
                    return {
                        'hc-a2': item['hc-a2'],
                        name: item.name,
                        region: item.region,
                        x: item.x,
                        y: item.y,
                        value: item.value
                    };
                })
            }]
        });

    </script>

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
@endsection
