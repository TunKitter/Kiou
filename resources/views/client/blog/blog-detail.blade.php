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
                  Blog Details
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
        <div class="col-lg-12 col-md-12">
          <div class="blog">
            <div class="blog-info clearfix">
              <div class="post-left">
                <ul>
                  <li>
                    <img
                      class="img-fluid"
                      src="assets/img/icon/icon-22.svg"
                      alt
                    />{!!Carbon\Carbon::parse($blog->created_at)->format('F j, Y')!!}
                  </li>
                  <li>
                    <img
                      class="img-fluid"
                      src="assets/img/icon/icon-23.svg"
                      alt
                    />{!!$blog->category->name!!}
                  </li>
                </ul>
              </div>
            </div>
            <h3 class="blog-title">
              <a href="blog-details.html"
                >{!!$blog->title!!}</a
              >
            </h3>
            {!!$blog->description!!}
            <div class="blog-content">
                {!!$content!!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection