@extends('client.layouts.master')
@section('content')
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="breadcrumb-list">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Pages</li>
                                <li class="breadcrumb-item" aria-current="page">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="course-content checkout-widget">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">

                    <div class="student-widget pay-method">
                        <div class="student-widget-group add-course-info">
                            <div class="cart-head">
                                <h4>Payment Method</h4>
                            </div>
                            <div class="checkout-form">
                                <form id="checkoutForm" method="post" onsubmit="return handleCheckout()" action="stripe">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="wallet-method">
                                                <label class="radio-inline custom_radio me-4">
                                                    <input type="radio" name="pay_method" value="stripe" checked>
                                                    <span class="checkmark"></span> Stripe
                                                </label>
                                                <label class="radio-inline custom_radio">
                                                    <input type="radio" name="pay_method" value="{{route("make.payment")}}">
                                                    <span class="checkmark"></span> Paypal
                                                </label>
                                            </div>
                                        </div>
                                        <div class="checkout-form">

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Full name</label>
                                                        <input type="text" class="form-control" name="nane"
                                                            value="{{ auth()->user()->name }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Username</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ auth()->user()->username }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Phone Number</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ auth()->user()->phone }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Email</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ auth()->user()->email }}" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="payment-btn">
                                            <button class="btn btn-primary" type="submit">Make a Payment</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 theiaStickySidebar">
                    <div class="student-widget select-plan-group">
                        <div class="student-widget-group">
                            <div class="plan-header">
                                <h4>Information Products</h4>
                            </div>

                            <div class="benifits-feature">
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($carts as $cart)
                                    <div class="col-lg-12 col-md-12 d-flex">
                                        <div class="course-box course-design list-course d-flex">
                                            <div class="product ">
                                                <div class="product-img product-checkout">
                                                    <a href="{{ route('course-detail', $cart->courses->slug) }}">
                                                        <img class="img-fluid" alt
                                                            src="{{ asset('course/thumbnail/'.$cart->courses->image) }}" />
                                                    </a>
                                                    <div class="price p-1 pt-2">
                                                        <h4 class="fw-bold p-0 text-primary">${{ $cart->courses->price }}</h4>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <div class="head-course-title">
                                                        <h4 class="title name_product_checkout">
                                                            <a href="">{{ $cart->courses->name }}</a>
                                                        </h4>
                                                    </div>

                                                    <div class="rating">
                                                        <i class="fas fa-star filled"></i>
                                                        <span class="d-inline-block average-rating">
                                                            <span>{{ $cart->courses->complete_course_rate }}</span>
                                                        </span>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $total += $cart->courses->price;
                                    @endphp
                                @endforeach
                            </div>
                            <div class="benifits-feature">
                                <div class="col-lg-12 col-md-12">
                                    <div class="cart-subtotal">
                                        <p>Subtotal <span>${{ $total }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function handleCheckout() {
            // Lấy giá trị của input radio được chọn
            var selectedValue = document.querySelector('input[name="pay_method"]:checked').value;
            // Thay đổi giá trị của action theo radio được chọn
            document.getElementById("checkoutForm").action = selectedValue;

            return true; // Cho phép form tiếp tục submit
        }
    </script>
@endsection
