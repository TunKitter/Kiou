@inject('auth', 'Illuminate\Support\Facades\Auth')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>
        @if(!empty($meta_title))
        {{$meta_title}}
        @else
        Khóa học online - Học mọi thứ theo lịch trình của bạn | KIOU
        @endif
    </title>
    @if(!empty($meta_description))
    <meta name="description" content="{{$meta_description}}">
    @endif
    @if(!empty($meta_keywords))
    <meta name="keywords" content="{{$meta_keywords}}">
    @endif
    <link rel="canoical" href="{{url()->current()}}"/>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.svg') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
</head>

<body>
    <div class="main-wrapper">
        <header class="header header-page">
            <div class="header-fixed">
                <nav class="navbar navbar-expand-lg header-nav scroll-sticky">
                    <div class="container ">
                        <div class="navbar-header">
                            <a id="mobile_btn" href="javascript:void(0);">
                                <span class="bar-icon">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                            </a>
                            <a href="{{ route('home') }}" class="navbar-brand logo">
                                <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" alt="Logo">
                            </a>
                        </div>
                        <div class="main-menu-wrapper">
                            <div class="menu-header">
                                <a href="{{ route('home') }}" class="menu-logo">
                                    <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" alt="Logo">
                                </a>
                                <a id="menu_close" class="menu-close" href="javascript:void(0);">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                            <ul class="main-nav">
                                <li class="has-submenu">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="has-submenu">
                                    <a href="{{ route('course-list') }}">Courses<i class="fas fa-chevron-down"></i></a>
                                    <ul class="submenu">
                                        {{-- <li><a href="{{ route('course-explore') }}">Explore Courses</a></li> --}}
                                        <li class="has-submenu">
                                            <a href="#">Category Courses</a>
                                            <ul class="submenu">
                                                @include('client.section.category')
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('course-list') }}">Find Courses</a></li>
                                        <li><a href="{{ route('roadmap') }}">Roadmap</a></li>
                                    </ul>
                                </li>
                                <li class="has-submenu">
                                    <a href>Enhance <i class="fas fa-chevron-down"></i></a>
                                    <ul class="submenu first-submenu">
                                        {{-- <li class="has-submenu ">
                                            <a href="students-list.html">Student</a>
                                            <ul class="submenu">
                                                <li><a href="students-list.html">List</a></li>
                                                <li><a href="students-grid.html">Grid</a></li>
                                            </ul>
                                        </li> --}}
                                        <li><a href="{{route('revision-bookmark')}}">Revise Bookmarks</a></li>
                                        <li><a href="{{route('revision-test')}}">Test your knowledge</a></li>
                                        <li class="has-submenu"><a href="{{route('revision-code-list')}}">CP</a>
                                            <ul class="submenu">
                                                <li><a href="{{route('revision-code-list')}}">Your CP</a></li>
                                                <li><a href="{{route('revision-code-explore')}}">Explore CP</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('blog')}}">Documentation</a>
                                </li>
                                <li class="login-link">
                                    <a href="login.html">Login / Signup</a>
                                </li>
                            </ul>
                        </div>
                        @auth
                            @inject('carts', 'App\Models\Enrollment')
                            @php
                                $total = 0;
                            @endphp
                            <ul class="nav header-navbar-rht">
                                <li class="nav-item cart-nav">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <img src="{{ asset('assets/img/icon/cart.svg') }}" alt="img">
                                    </a>
                                    <div class="wishes-list dropdown-menu dropdown-menu-right">
                                        <div class="wish-header">
                                            <a href="{{ route('cart') }}">View Cart</a>
                                            {{-- <a href="javascript:void(0)" class="float-end">Checkout</a> --}}
                                            @if ($carts::where('user_id', auth()->id())->get()->count() > 0)
                                                    <form action="{{ route('checkout') }}" method="POST" style="display: contents">
                                                        @csrf
                                                        <input type="hidden" id="inputInsideForm" name="information_cart">
                                                        <button type="submit" class="btn float-end" onclick="chuyenDuLieu()">Checkout</button>
                                                    </form>
                                            @endif
                                        </div>
                                        <div class="wish-content">
                                            <ul>
                                                @if (
                                                    $carts
                                                        ::where('user_id', auth()->id())->get()->count() > 0)
                                                    @foreach ($carts::where('user_id', auth()->id())->where('state','65337ecc289241e845e578d9')->get() as $cart)
                                                        @php
                                                            $tempCart = $cart;
                                                            $tempCart['img'] = $cart->courses->image;
                                                        @endphp
                                                        <input type="hidden" class="inputOutsideForm" id="inputOutsideForm" name="inputOutsideForm" value="{{$tempCart}}">
                                                        <li>
                                                            <div class="media">
                                                                <div class="d-flex media-wide">
                                                                    <div class="avatar">
                                                                        <a
                                                                            href="{{ route('course-detail', $cart->courses->slug) }}">
                                                                            <img alt
                                                                                src="{{ asset('course/thumbnail/'.$cart->courses->image) }}">
                                                                        </a>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <h6><a
                                                                                href="{{ route('course-detail', $cart->courses->slug) }}">{{ $cart->courses->name }}</a>
                                                                        </h6>
                                                                        <p>By {{ $cart->courses->mentor->name }}</p>
                                                                        <h5>$ {{ $cart->courses->price }}
                                                                            <span>$99.00</span>
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                                <div class="remove-btn">
                                                                    <form action="{{ route('delete-cart', $cart->_id) }}"
                                                                        method="POST">
                                                                        @csrf

                                                                        <button type="submit"
                                                                            class="btn">Remove</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @php
                                                            $total += $cart->courses->price;
                                                        @endphp
                                                    @endforeach
                                                @else
                                                    <p class="text-center pt-2"><b>Your shopping cart is empty</b></p>
                                                @endif
                                            </ul>
                                            <div class="total-item">
                                                <h5>Total : $ {{ $total }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item wish-nav">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <img src="{{ asset('assets/img/icon/wish.svg') }}" alt="img">
                                    </a>
                                    <div class="wishes-list dropdown-menu dropdown-menu-right">
                                        <div class="wish-content">
                                            <ul>
                                                <li>
                                                    <div class="media">
                                                        <div class="d-flex media-wide">
                                                            <div class="avatar">
                                                                <a href="course-details.html">
                                                                    <img alt
                                                                        src="{{ asset('assets/img/course/course-04.jpg') }}">
                                                                </a>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6><a href="course-details.html">Learn Angular...</a></h6>
                                                                <p>By Dave Franco</p>
                                                                <h5>$200 <span>$99.00</span></h5>
                                                                <div class="remove-btn">
                                                                    <a href="#" class="btn">Add to cart</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="media">
                                                        <div class="d-flex media-wide">
                                                            <div class="avatar">
                                                                <a href="course-details.html">
                                                                    <img alt
                                                                        src="{{ asset('assets/img/course/course-14.jpg') }}">
                                                                </a>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6><a href="course-details.html">Build Responsive
                                                                        Real...</a></h6>
                                                                <p>Jenis R.</p>
                                                                <h5>$200 <span>$99.00</span></h5>
                                                                <div class="remove-btn">
                                                                    <a href="#" class="btn">Add to cart</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="media">
                                                        <div class="d-flex media-wide">
                                                            <div class="avatar">
                                                                <a href="course-details.html">
                                                                    <img alt
                                                                        src="{{ asset('assets/img/course/course-15.jpg') }}">
                                                                </a>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6><a href="course-details.html">C# Developers Double
                                                                        ...</a></h6>
                                                                <p>Jesse Stevens</p>
                                                                <h5>$200 <span>$99.00</span></h5>
                                                                <div class="remove-btn">
                                                                    <a href="#" class="btn">Remove</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item noti-nav">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <img src="{{ asset('assets/img/icon/notification.svg') }}" alt="img">
                                    </a>
                                    <div class="notifications dropdown-menu dropdown-menu-right">
                                        <div class="topnav-dropdown-header">
                                            <span class="notification-title">Notifications
                                                <select>
                                                    <option>All</option>
                                                    <option>Unread</option>
                                                </select>
                                            </span>
                                            <a href="javascript:void(0)" class="clear-noti">Mark all as read <i
                                                    class="fa-solid fa-circle-check"></i></a>
                                        </div>
                                        <div class="noti-content">
                                            <ul class="notification-list">
                                                <li class="notification-message">
                                                    <div class="media d-flex">
                                                        <div>
                                                            <a href="notifications.html" class="avatar">
                                                                <img class="avatar-img" alt
                                                                    src="{{ asset('assets/img/user/user1.jpg') }}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6><a href="notifications.html">Lex Murphy requested
                                                                    <span>access to</span> UNIX directory tree hierarchy
                                                                </a></h6>
                                                            <button class="btn btn-accept">Accept</button>
                                                            <button class="btn btn-reject">Reject</button>
                                                            <p>Today at 9:42 AM</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="notification-message">
                                                    <div class="media d-flex">
                                                        <div>
                                                            <a href="notifications.html" class="avatar">
                                                                <img class="avatar-img" alt
                                                                    src="{{ asset('assets/img/user/user2.jpg') }}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6><a href="notifications.html">Ray Arnold left 6
                                                                    <span>comments on</span> Isla Nublar SOC2 compliance
                                                                    report</a></h6>
                                                            <p>Yesterday at 11:42 PM</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="notification-message">
                                                    <div class="media d-flex">
                                                        <div>
                                                            <a href="notifications.html" class="avatar">
                                                                <img class="avatar-img" alt
                                                                    src="{{ asset('assets/img/user/user3.jpg') }}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6><a href="notifications.html">Dennis Nedry <span>commented
                                                                        on</span> Isla Nublar SOC2 compliance report</a>
                                                            </h6>
                                                            <p class="noti-details">“Oh, I finished de-bugging the phones,
                                                                but the system's compiling for eighteen minutes, or twenty.
                                                                So, some minor systems may go on and off for a while.”</p>
                                                            <p>Yesterday at 5:42 PM</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="notification-message">
                                                    <div class="media d-flex">
                                                        <div>
                                                            <a href="notifications.html" class="avatar">
                                                                <img class="avatar-img" alt
                                                                    src="{{ asset('assets/img/user/user1.jpg') }}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6><a href="notifications.html">John Hammond
                                                                    <span>created</span> Isla Nublar SOC2 compliance report
                                                                </a></h6>
                                                            <p>Last Wednesday at 11:15 AM</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item user-nav">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <span class="user-img">
                                            <img src="{{ ($image = auth()->user()->image['avatar']) ? (str_starts_with($image, 'http') ? $image : asset('user/avatar/' . $image)) : asset('assets/img/user/avatar.jpg') }}"
                                                style="transform: scale(0.8);">
                                            <span class="status online"></span>
                                        </span>
                                    </a>
                                    <div class="users dropdown-menu dropdown-menu-right"
                                        data-popper-placement="bottom-end">
                                        <div class="user-header">
                                            <div class="avatar avatar-sm">
                                                <img src="{{ $image ? (str_starts_with($image, 'http') ? $image : asset('user/avatar/' . $image)) : asset('assets/img/user/avatar.jpg') }}"
                                                    alt="User Image" class="avatar-img rounded-circle">
                                            </div>
                                            <div class="user-text">
                                                <h6>
                                                    {{ auth()->user()->name }}
                                                </h6>
                                                <p class="text-muted">{{ auth()->user()->username }}</p>
                                            </div>
                                        </div>
                                        <a class="dropdown-item" href="{{ route('profile') }}"><i
                                                class="feather-user me-1"></i>Profile</a>

                                        @if (auth()->user()->mentor)
                                            <a class="dropdown-item" href="{{ route('mentor-profile') }}"><i
                                                    class="feather-user me-1"></i> Mentor Profile <img
                                                    src="{{ asset('assets/mentor.gif') }}" width="50px"></a>
                                        @else
                                            <a class="dropdown-item" href="{{ route('mentor-overview') }}"><i
                                                    class="feather-user me-1"></i>
                                                <div class="d-flex gap-2">
                                                    <span class="d-inline-block">Mentor</span><sup
                                                        class="badge badge-info">Đăng ký</sup>
                                                </div>
                                            </a>
                                        @endif
                                        @php
                                            $test = false;
                                            foreach (auth()->user()->role as $role) {
                                                if ($role == '65531d75139d10c7eb364114') {
                                                    $test = true;
                                                }
                                            }
                                        @endphp

                                        @if ($test)
                                            <a class="dropdown-item" href="{{ route('moderation') }}"><i
                                                    class="feather-clipboard"></i>Moderation</a>
                                        @endif



                                        {{-- <div class="dropdown-item night-mode">
<span><i class="feather-moon me-1"></i> Night Mode </span>
<div class="form-check form-switch check-on m-0">
<input class="form-check-input" type="checkbox" id="night-mode">
</div>
</div> --}}
                                        @if(Auth::user()->role[0] == '6523f9bcad8f1cf003fce14d')
                                        <a class="dropdown-item" href="{{route('admin.dashboard')}}"><i
                                            class="feather-log-in me-1"></i>Go to Admin</a>
                                        @endif
                                        
                                        <a class="dropdown-item" href="{{ route('logout') }}"><i
                                                class="feather-log-out me-1"></i> Logout</a>
                                    </div>
                                </li>
                            </ul>
                        @endauth
                        @guest
                            <ul class="nav header-navbar-rht">
                                <li class="nav-item">
                                    <a class="nav-link header-sign" href="{{ route('login') }}">Signin</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link header-login" href="{{ route('register') }}">Signup</a>
                                </li>
                            </ul>
                        @endguest
                    </div>
                </nav>
            </div>
        </header>
        <script>
            function chuyenDuLieu() {
            // Lấy giá trị từ tất cả các trường ngoài form và phân tách chúng bằng dấu phẩy
            var giaTriNgoaiFormList = document.querySelectorAll('.inputOutsideForm');
            var giaTriChuoi = Array.from(giaTriNgoaiFormList).map(function(element) {
                return element.value;
            }).join(',');

            // Thiết lập giá trị cho trường trong form
            document.getElementById("inputInsideForm").value = giaTriChuoi;
        }
    
        </script>
