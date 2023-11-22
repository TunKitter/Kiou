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
                                <li class="breadcrumb-item" aria-current="page">
                                    Blog
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="course-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <div class="row">
                        @if(count($blogs))
                            @foreach($blogs as $blog)
                                <div class="col-md-6 col-sm-12 mt-3">
                                    <div class="blog grid-blog">
                                        <div class="blog-grid-box">
                                            <div class="blog-info clearfix">
                                                <div class="post-left">
                                                    <ul>
                                                        <li>
                                                            <img class="img-fluid" src="assets/img/icon/icon-22.svg" alt />{{Carbon\Carbon::parse($blog->created_at)->format('F j, Y')}}
                                                        </li>
                                                        <li>
                                                            <img class="img-fluid" src="assets/img/icon/icon-23.svg"
                                                                alt />{{$blog->category->name}}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <h3 class="blog-title">
                                                <a href="blog-details.html">{{$blog->title}}</a>
                                            </h3>
                                            <div class="blog-content blog-read">
                                                <p>
                                                {{$blog->description}}
                                                </p>
                                                <a href="{{route('blog-detail',['slug' => $blog->slug])}}" class="read-more btn btn-primary">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">There are currently no posts!!!</p>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <ul class="pagination lms-page">
                                {{ $blogs->links() }}
                              
                            </ul>
                        </div>
                    </div>
                </div>
            

                <div class="col-lg-3 col-md-12 sidebar-right theiaStickySidebar">
                    <div class="card category-widget blog-widget">
                        <div class="card-header">
                            <h4 class="card-title">Categories</h4>
                        </div>
                        <div class="card-body">
                            <ul class="categories">
                                @foreach($blog_categories as $category)
                                <li>
                                    <a href="{{route('blog-in-category',$category->slug)}}"><i class="fas fa-angle-right"></i> {{$category->name}}
                                    </a>
                                </li>
                                @endforeach
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
