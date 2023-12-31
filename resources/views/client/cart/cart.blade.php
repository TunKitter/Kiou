@extends('client.layouts.master')
@section('content')
    @if ($message = Session::get('success'))
        @include('client.section.message', ['message' => $message, 'type' => 'success'])
    @endif
    @if ($message = Session::get('error'))
        @include('client.section.message', ['message' => $message, 'type' => 'error'])
    @endif
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
                                <li class="breadcrumb-item" aria-current="page">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="course-content cart-widget">
        <div class="container">
            <div class="student-widget">
                <div class="student-widget-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-head d-flex">
                                <div class="form-group ship-check text-center">
                                    <input type="checkbox" id="check-all-checkbox" class="form-check-input">
                                </div>
                                <h4>Your cart ({{ count($carts) }} items)</h4>
                            </div>
                            <div class="cart-group">
                                <div class="row">
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($carts as $cart)
                                        @php
                                            $tempCart = $cart;
                                            $tempCart['img'] = $cart->courses->image;
                                        @endphp
                                        <div class="col-lg-12 col-md-12 d-flex">
                                            <div class="form-group ship-check text-center">
                                                <input type="checkbox" class="form-check-input product-checkbox"
                                                    data-product="{{ $tempCart }}">
                                            </div>
                                            <div class="course-box course-design list-course d-flex">

                                                <div class="product">
                                                    <div class="product-img">
                                                        <a href="{{ route('course-detail', $cart->courses->slug) }}">
                                                            <img class="img-fluid" alt style="width: 200px"
                                                                src="{{ asset('course/thumbnail/'.$cart->courses->image) }}"  />
                                                        </a>
                                                        <div class="price">
                                                            <h3>${{ $cart->courses->price }}</h3>
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <div class="head-course-title">
                                                            <h3 class="title">
                                                                <a
                                                                    href="{{ route('course-detail', $cart->courses->slug) }}">{{ $cart->courses->name }}</a>
                                                            </h3>
                                                        </div>
                                                        <div
                                                            class="course-info d-flex align-items-center border-bottom-0 pb-0">
                                                            <div class="rating-img d-flex align-items-center">
                                                                <img src="assets/img/icon/icon-01.svg" alt />
                                                                <p>{{ $cart->courses->meta['total_lesson'] }} Lesson</p>
                                                            </div>
                                                            <div class="course-view d-flex align-items-center">
                                                                <img src="assets/img/icon/icon-02.svg" alt />
                                                                <p>{{ round($cart->courses->meta['total_time'] / 60) }} hr
                                                                    {{ round($cart->courses->meta['total_time'] % 60) }} min
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="rating">
                                                            <i class="fas fa-star filled"></i>
                                                            <span
                                                                class="d-inline-block average-rating"><span>{{ $cart->courses->complete_course_rate }}</span></span>
                                                        </div>
                                                        <div class="course-group d-flex mb-0">
                                                            <div class="course-group-img d-flex">
                                                                <a href="instructor-profile.html"><img
                                                                        src="assets/img/user/user2.jpg" alt
                                                                        class="img-fluid"></a>
                                                                <div class="course-name">
                                                                    <h4><a
                                                                            href="instructor-profile.html">{{ $cart->courses->mentor->name }}</a>
                                                                    </h4>
                                                                    <p>Instructor</p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="cart-remove">
                                                        <form action="{{ route('delete-cart', $cart->_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary">Remove</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $total += $cart->courses->price;
                                        @endphp
                                    @endforeach
                                </div>
                                <div class="cart-total">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="cart-subtotal">
                                                <p>Total price <span>${{ $total }}</span></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="check-outs">
                                                <form action="{{ route('checkout') }}" method="POST" id="myForm">
                                                    @csrf
                                                    <input hidden id="selected-products" value=""
                                                        name="information_cart">
                                                    <button type="submit" id="checkout-live-button"
                                                        class="btn btn-primary" disabled onclick="validateCheckbox()">Checkout</button>
                                                </form>

                                            </div>

                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="condinue-shop">
                                                <a href="course-list.html" class="btn btn-primary">Continue Shopping</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
@push('script')
    <script>
        const checkAllCheckbox = document.getElementById('check-all-checkbox');
        const checkboxes = document.querySelectorAll('.product-checkbox');
        const selectedProductsInput = document.getElementById('selected-products');
        const submitButton = document.getElementById('checkout-live-button');

        checkAllCheckbox.addEventListener('change', function () {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = checkAllCheckbox.checked;
            });
            updateSelectedProducts();
        });

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                updateSelectedProducts();
                checkSubmitButtonState();
            });
        });

        function updateSelectedProducts() {
            const selectedProducts = [];
            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    selectedProducts.push(checkbox.getAttribute('data-product'));
                }
            });
            selectedProductsInput.value = selectedProducts.join(', ');
            checkSubmitButtonState();
        }

        function checkSubmitButtonState() {
            const atLeastOneCheckboxChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
            submitButton.disabled = !atLeastOneCheckboxChecked;
        }

        function validateCheckbox() {
            const atLeastOneCheckboxChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
            if (!atLeastOneCheckboxChecked) {
                alert('Please select 1 product to pay');
            }
        }
    </script>
@endpush
