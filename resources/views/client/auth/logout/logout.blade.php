@extends('client.layouts.auth')
@section('content')
<style>
.product:hover {
    background: white
}
    .product:hover :is(a,button) {
        color: black !important;
    }
</style>
<div class="product">
<div class="product-img">
<a href="course-details.html">
<img class="img-fluid" alt src="assets/img/course/course-11.jpg">
</a>
<div class="price">
</div>
</div>
<div class="product-content">
<div class="head-course-title">
<h3 class="title"><a href="course-details.html">Are you sure to logout?</a></h3>
<div class="all-btn all-category d-flex align-items-center">
    <form method="POST">
        @csrf

<button class="btn btn-primary" id="submitButton">Yes</button>
    </form>
</div>
</div>
<div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
<div class="rating-img d-flex align-items-center">
</div>
<div class="course-view d-flex align-items-center">
</div>
</div>
</div>
</div>
<script>
    const submitButton = document.getElementById('submitButton');
        submitButton.addEventListener('click', function() {
            document.cookie = 'requestCount=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'start_time=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            localStorage.clear();
        });
</script>
@endsection