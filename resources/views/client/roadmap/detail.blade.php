@extends('client.layouts.master')
@section('content')
    <style>
        #tree {
            display: inline-block;
            padding: 10px;
        }

        #tree * {
            box-sizing: border-box;
        }

        #tree .branch {
            padding: 5px 0 5px 20px;
        }

        #tree .branch:not(:first-child) {
            margin-left: 170px;
        }

        #tree .branch:not(:first-child):after {
            content: "";
            width: 20px;
            border-top: 1px solid #ccc;
            position: absolute;
            left: 150px;
            top: 50%;
            margin-top: 1px;
        }

        .entry {
            position: relative;
            min-height: 77px;
            display: block;
        }

        .entry:before {
            content: "";
            height: 100%;
            border-left: 1px solid #ccc;
            position: absolute;
            left: -20px;
        }

        .entry:first-child:after {
            height: 10px;
            border-radius: 10px 0 0 0;
        }

        .entry:first-child:before {
            width: 10px;
            height: 50%;
            top: 50%;
            margin-top: 1px;
            border-radius: 10px 0 0 0;
        }

        .entry:after {
            content: "";
            width: 20px;
            transition: border 0.5s;
            border-top: 1px solid #ccc;
            position: absolute;
            left: -20px;
            top: 50%;
            margin-top: 1px;
        }

        .entry:last-child:before {
            width: 10px;
            height: 50%;
            border-radius: 0 0 0 10px;
        }

        .entry:last-child:after {
            height: 10px;
            border-top: none;
            transition: border 0.5s;
            border-bottom: 1px solid #ccc;
            border-radius: 0 0 0 10px;
            margin-top: -9px;
        }

        .entry:only-child:after {
            width: 10px;
            height: 0px;
            margin-top: 1px;
            border-radius: 0px;
        }

        .entry:only-child:before {
            display: none;
        }

        .entry span {
            border: 1px solid #ccc;
            display: block;
            min-width: 150px;
            padding: 5px 10px;
            line-height: 20px;
            text-align: center;
            position: absolute;
            left: 0;
            top: 50%;
            margin-top: -15px;
            color: #666;
            font-family: arial, verdana, tahoma;
            font-size: 14px;
            display: inline-block;
            border-radius: 5px;
            transition: all 0.5s;
        }

        #tree .entry span:hover,
        #tree .entry span:hover+.branch .entry span {
            background: #e6e6e6;
            color: #000;
            border-color: #a6a6a6;
        }

        #tree .entry span:hover+.branch .entry::after,
        #tree .entry span:hover+.branch .entry::before,
        #tree .entry span:hover+.branch::before,
        #tree .entry span:hover+.branch .branch::before {
            border-color: #a6a6a6;
        }
    </style>
</head>

<body>
<section class="course-content">
<div class="container">
<div class="row">
<div class="col-lg-9">
    <div id="tree">
        <div class="branch">
            <div class="entry"><span>Tunkit</span>
        <div class="branch">
            <div class="entry"><span>Something</span></div>
            <div class="entry"><span>Something 2</span></div>
        </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3 theiaStickySidebar">
<div class="filter-clear">
<div class="card search-filter categories-filter-blk">
<div class="card-body">
<div class="filter-widget mb-0">
<div class="categories-head d-flex align-items-center">
<h4>Soft by</h4>
</div>
<div>
<label class="custom_check custom_one">
<input type="radio" name="soft_by">
<span class="checkmark"></span> Most Common
</label>
</div>
<div>
<label class="custom_check custom_one">
<input type="radio" name="soft_by">
<span class="checkmark"></span> Buy Most
</label>
</div>
<div>
<label class="custom_check custom_one">
<input type="radio" name="soft_by">
<span class="checkmark"></span> High Rating Most
</label>
</div>
</div>
</div>
</div>
<div class="card search-filter ">
<div class="card-body">
<div class="filter-widget mb-0">
<div class="categories-head d-flex align-items-center">
<h4>Price</h4>
{{-- <i class="fas fa-angle-down"></i> --}}
</div>
<div>
<label class="custom_check custom_one">
<input type="radio" name="select_specialist">
<span class="checkmark"></span> Free
</label>
</div>
<div>
<label class="custom_check custom_one">
<input type="radio" name="select_specialist">
<span class="checkmark"></span> 900$
</label>
</div>
<div>
<label class="custom_check custom_one mb-0">
<input type="radio" name="select_specialist" checked>
<span class="checkmark"></span> Most expensive
</label>
</div>
</div>
</div>
</div>

<div class="card search-filter">
<div class="card-body">
<div class="filter-widget mb-0">
<div class="categories-head d-flex align-items-center">
<h4>Levels</h4>
<i class="fas fa-angle-down"></i>
</div>
@inject('levels','App\Models\Level' )
@foreach($levels::all() as $level)
<div>
<label class="custom_check custom_one">
<input type="radio" name="level"  >
<span class="checkmark"></span> {{$level->name}}
</label>
</div>
@endforeach
</div>
</div>
</div>





<div class="card post-widget ">
<div class="card-body">
<div class="latest-head">
<h4 class="card-title">Latest Courses</h4>
</div>
<ul class="latest-posts">
<li>
<div class="post-thumb">
<a href="course-details.html">
<img class="img-fluid" src="assets/img/blog/blog-01.jpg" alt>
</a>
</div>
<div class="post-info free-color">
<h4>
<a href="course-details.html">Introduction LearnPress – LMS plugin</a>
</h4>
<p>FREE</p>
</div>
</li>
<li>
<div class="post-thumb">
<a href="course-details.html">
<img class="img-fluid" src="assets/img/blog/blog-02.jpg" alt>
</a>
</div>
<div class="post-info">
<h4>
<a href="course-details.html">Become a PHP Master and Make Money</a>
</h4>
<p>$200</p>
</div>
</li>
<li>
<div class="post-thumb">
<a href="#">
<img class="img-fluid" src="assets/img/blog/blog-03.jpg" alt>
</a>
</div>
<div class="post-info free-color">
<h4>
<a href="blog-details.html">Learning jQuery Mobile for Beginners</a>
</h4>
<p>FREE</p>
</div>
</li>
<li>
<div class="post-thumb">
<a href="course-details.html">
<img class="img-fluid" src="assets/img/blog/blog-01.jpg" alt>
</a>
</div>
<div class="post-info">
<h4>
<a href="course-details.html.html">Improve Your CSS Workflow with SASS</a>
</h4>
<p>$200</p>
</div>
</li>
<li>
<div class="post-thumb ">
<a href="course-details.html">
<img class="img-fluid" src="assets/img/blog/blog-02.jpg" alt>
</a>
</div>
<div class="post-info free-color">
<h4>
<a href="course-details.html">HTML5/CSS3 Essentials in 4-Hours</a>
</h4>
<p>FREE</p>
</div>
</li>
</ul>
</div>
</div>

</div>
</div>
</div>
</div>
</section>
@endsection