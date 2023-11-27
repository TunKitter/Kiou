@extends('client.layouts.master')
@section('content')
<section class="course-content">
    <div class="container">
    <div class="row">
    <div class="col-lg-9 col-md-12">
    
    <div class="blog">
    <div class="blog-info clearfix">
    <div class="post-left">
    <ul>
    <li>
    <div class="post-author">
    <a href="instructor-profile.html"><img src="assets/img/user/user.jpg" alt="Post Author"> <span>Ruby Perrin</span></a>
    </div>
    </li>
    <li><img class="img-fluid" src="assets/img/icon/icon-22.svg" alt>April 20, 2022</li>
    <li><img class="img-fluid" src="assets/img/icon/icon-23.svg" alt>Programming, Web Design</li>
    </ul>
    </div>
    </div>
    <h3 class="blog-title"><a href="blog-details.html">{{$post->title}}</a></h3>
    <div class="blog-content">
        {!!$content!!}
    </div>
    </div>
    
    </div>
    
    <div class="col-lg-3 col-md-12 sidebar-right theiaStickySidebar">
    
    <div class="card search-widget blog-search blog-widget">
    <div class="card-body">
    <form class="search-form">
    <div class="input-group">
    <input type="text" placeholder="Search..." class="form-control">
    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
    </div>
    </form>
    </div>
    </div>
    
    
    <div class="card post-widget blog-widget">
    <div class="card-header">
    <h4 class="card-title">Recent Posts</h4>
    </div>
    <div class="card-body">
    <ul class="latest-posts">
    <li>
    <div class="post-thumb">
    <a href="blog-details.html">
    <img class="img-fluid" src="assets/img/blog/blog-01.jpg" alt>
    </a>
    </div>
    <div class="post-info">
    <h4>
    <a href="blog-details.html"></a>
    </h4>
    <p><img class="img-fluid" src="assets/img/icon/icon-22.svg" alt>Jun 14, 2022</p>
    </div>
    </li>
    <li>
    <div class="post-thumb">
    <a href="blog-details.html">
    <img class="img-fluid" src="assets/img/blog/blog-02.jpg" alt>
    </a>
    </div>
    <div class="post-info">
    <h4>
    <a href="#"></a>
    </h4>
    <p><img class="img-fluid" src="assets/img/icon/icon-22.svg" alt> 3 Dec 2019</p>
    </div>
    </li>
    <li>
    <div class="post-thumb">
    <a href="blog-details.html">
    <img class="img-fluid" src="assets/img/blog/blog-03.jpg" alt>
    </a>
    </div>
    <div class="post-info">
    <h4>
    <a href="blog-details.html">Complete PHP Programming Career Guideline</a>
    </h4>
    <p><img class="img-fluid" src="assets/img/icon/icon-22.svg" alt> 3 Dec 2019</p>
    </div>
    </li>
    </ul>
    </div>
    </div>
    
    
    <div class="card category-widget blog-widget">
    <div class="card-header">
    <h4 class="card-title">Categories</h4>
    </div>
    <div class="card-body">
    <ul class="categories">
    <li><a href="javascript:void(0);"><i class="fas fa-angle-right"></i> Business </a></li>
    <li><a href="javascript:void(0);"><i class="fas fa-angle-right"></i> Courses </a></li>
    <li><a href="javascript:void(0);"><i class="fas fa-angle-right"></i> Education </a></li>
    <li><a href="javascript:void(0);"><i class="fas fa-angle-right"></i> Graphics Design </a></li>
    <li><a href="javascript:void(0);"><i class="fas fa-angle-right"></i> Programming </a></li>
    <li><a href="javascript:void(0);"><i class="fas fa-angle-right"></i> Web Design </a></li>
    </ul>
    </div>
    </div>
    
    
    <div class="card category-widget blog-widget">
    <div class="card-header">
    <h4 class="card-title">Archives</h4>
    </div>
    <div class="card-body">
    <ul class="categories">
    <li><a href="javascript:void(0);"><i class="fas fa-angle-right"></i> January 2022 </a></li>
    <li><a href="javascript:void(0);"><i class="fas fa-angle-right"></i> February 2022 </a></li>
    <li><a href="javascript:void(0);"><i class="fas fa-angle-right"></i> April 2022 </a></li>
    </ul>
    </div>
    </div>
    
    
    <div class="card tags-widget blog-widget tags-card">
    <div class="card-header">
    <h4 class="card-title">Latest Tags</h4>
    </div>
    <div class="card-body">
    <ul class="tags">
    <li><a href="javascript:void(0);" class="tag">HTML</a></li>
    <li><a href="javascript:void(0);" class="tag">Java Script</a></li>
    <li><a href="javascript:void(0);" class="tag">Css</a></li>
    <li><a href="javascript:void(0);" class="tag">Jquery</a></li>
    <li><a href="javascript:void(0);" class="tag">Java</a></li>
    <li><a href="javascript:void(0);" class="tag">React</a></li>
    </ul>
    </div>
    </div>
    
    </div>
    
    </div>
    </div>
    </section>

</section>
@endsection
