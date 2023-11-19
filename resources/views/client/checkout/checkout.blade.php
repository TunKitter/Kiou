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
                                <form action="cart.html">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="wallet-method">
                                                <label class="radio-inline custom_radio me-4">
                                                    <input type="radio" name="optradio" checked>
                                                    <span class="checkmark"></span> Credit or Debit card
                                                </label>
                                                <label class="radio-inline custom_radio">
                                                    <input type="radio" name="optradio">
                                                    <span class="checkmark"></span> PayPal
                                                </label>
                                            </div>
                                        </div>
                                        <div class="checkout-form">
                                            <form action="#">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Full name</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $user->name }}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Username</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $user->username }}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Phone Number</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $user->phone }}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Email</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $user->email }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>

                                        </div>
                                        {{-- <div class="payment-btn">
                                            <a class="btn btn-primary" href="{{route('make.payment')}}">paypal</a>
                                        </div> --}}
                                        <form action="{{ url('/vnpay_payment')}}" method="POST">
                                            @csrf
                                            <div class="payment-btn">
                                                <button type="submit" name="redirect" class="btn btn-primary">Thanh toán</button>
                                            </div>
                                        </form>
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
                                        <h4>Selected Plan</h4>
                                    </div>
                                    @foreach ($carts as $cart)
                                    <div class="basic-plan">
                                        <h3>{{ $cart->courses->name }}</h3>
                                        <span style="font-weight: 500">by mentor: {{$cart->courses->mentor->name }}</span>
                                        <p>Description: {{ $cart->courses->description}}</p>
                                        <h2><span>$</span>{{ $cart->courses->price }}</h2>
                                        <input type="hidden" name="price" value="">
                                    </div>
                                    <div class="benifits-feature">
                                        <h3>Information</h3>
                                        <ul>
                                            <li><i class="fas fa-circle"></i>Chapter:<span style="font-weight: bold"> {{ $cart->courses->meta['total_chapter'] }}</span></li>
                                            <li><i class="fas fa-circle"></i>Lesson:<span style="font-weight: bold"> {{ $cart->courses->meta['total_lesson'] }}</span></li>
                                            <li><i class="fas fa-circle"></i>Time:<span style="font-weight: bold"> {{ $cart->courses->meta['total_time'] }}</span></li>
                                            <li><i class="fas fa-circle"></i>Level:<span style="color: red">{{ $cart->courses->level->name }}</span></li>
                                        </ul>
                                    </div>
                                    {{-- <div class="benifits-feature">
                                        <h3>Features</h3>
                                        <ul>
                                            <li><i class="fas fa-circle"></i> Search term isolation</li>
                                            <li><i class="fas fa-circle"></i> Total sales analytics</li>
                                            <li><i class="fas fa-circle"></i> Best seller rank</li>
                                            <li><i class="fas fa-circle"></i> Placement optimization</li>
                                        </ul>
                                    </div>                                   --}}
                                    @endforeach
                                    <div class="plan-change">
                                        <a href="pricing-plan.html" class="btn btn-primary">Change the Plan</a>
                                    </div>
                                </div>
                               
                          
                      
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="https://sandbox.vnpayment.vn/paymentv2/vpcpay.html?vnp_Amount=1806000&vnp_Command=pay&vnp_CreateDate=20210801153333&vnp_CurrCode=VND&vnp_IpAddr=127.0.0.1&vnp_Locale=vn&vnp_OrderInfo=Thanh+toan+don+hang+%3A5&vnp_OrderType=other&vnp_ReturnUrl=https%3A%2F%2Fdomainmerchant.vn%2FReturnUrl&vnp_TmnCode=DEMOV210&vnp_TxnRef=5&vnp_Version=2.1.0&vnp_SecureHash=3e0d61a0c0534b2e36680b3f7277743e8784cc4e1d68fa7d276e79c23be7d6318d338b477910a27992f5057bb1582bd44bd82ae8009ffaf6d141219218625c42"></script>
@endpush
