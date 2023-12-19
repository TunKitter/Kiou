@inject('auth', 'Illuminate\Support\Facades\Auth')
@php
     $user_id = auth()->id();
    //  request()->session()->forget(auth()->id());
     $user_header = session($user_id) ? true : false;
     if (!$user_header) {
         session([$user_id => true]);
     }
     $is_login = auth()->check();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Dreams LMS</title>

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
            @if(!$user_header || !($is_login))
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
                        @inject('auth', 'Illuminate\Support\Facades\Auth')
                        @inject('carts', 'App\Models\Enrollment')
                        @inject('_courses', 'App\Models\Course')
                        @inject('_mentors', 'App\Models\Mentor')
                        @php
                            $user = auth()->user();
                            $user_cart = $carts::where([['user_id', $user->_id],['state', '65337ecc289241e845e578d9']])->get();
                            $course_infor = $_courses::whereIn('_id', $user_cart->pluck('course_id'))->get();
                            $mentor_name2 = $_mentors::select(['name', '_id'])->whereIn('_id', $course_infor->pluck('mentor_id'))->get()->pluck('name', '_id');
                            $course_infor = $course_infor->toArray();
                            $user_cart_length = $user_cart->count();
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
                                            @if ( $user_cart_length > 0)
                                                <form action="{{ route('checkout') }}" method="POST"
                                                    style="display: contents">
                                                    @csrf
                                                    <input type="hidden" id="inputInsideForm" name="information_cart">
                                                    <button type="submit" class="btn float-end btn-primary"
                                                        onclick="chuyenDuLieu()">Checkout</button>
                                                </form>
                                            @endif
                                        </div>
                                        <div class="wish-content">
                                            <ul>
                                                @php
                                                    $total = 0;
                                                @endphp
                                                @if ( $user_cart_length > 0)
                                                    @foreach ($user_cart as $cart)
                                                        @php
                                                            $temp_course = current(array_filter($course_infor, function ($value) use($cart) {
                                                            return $value['_id'] == $cart->course_id;
                                                        }));
                                                        @endphp
                                                        <input type="hidden" class="inputOutsideForm"
                                                            id="inputOutsideForm" name="inputOutsideForm">
                                                        <li class="{{$a = '_'.uniqid()}}">
                                                            <div class="media">
                                                                <div class="d-flex media-wide">
                                                                    <div class="avatar">
                                                                        <a
                                                                            href="{{ route('course-detail', $temp_course['slug']) }}">
                                                                            <img alt
                                                                                src="{{ asset('course/thumbnail/' .  $temp_course['image']) }}">
                                                                        </a>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <h6><a
                                                                                href="{{ route('course-detail', $temp_course['slug']) }}">{{ $temp_course['name'] }}</a>
                                                                        </h6>
                                                                        <p>By {{ $mentor_name2[$temp_course['mentor_id']] }}</p>
                                                                        <h5>$ {{ $temp_course['price'] }}
                                                                            <span>$99.00</span>
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                                <div class="remove-btn">
                                                                        <button class="btn" onclick="removeCart('{{ route('delete-cart', $cart->_id) }}','{{ $a }}')">Remove</button>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @php
                                                            $total += $temp_course['price'];
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
                                                @if (isset($notications ))
                                                @foreach($notications as $notication)
                                                <li class="notification-message">
                                                    <div class="media d-flex">
                                                        <div>
                                                            <a href="notifications.html" class="avatar">
                                                                <img class="avatar-img" alt=""
                                                                    src="assets/img/user/user3.jpg">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6>
                                                                {{$notication->title}}
                                                            </h6>
                                                            <p class="noti-details">“{{$notication->content}}”</p>
                                                            <p>{{$notication->created_at}}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                                @else
                                                <p class="text-center pt-5">There are no announcements</p>
                                                @endif

                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item user-nav">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <span class="user-img">
                                            <img src="{{ ($image = $user->image['avatar']) ? (str_starts_with($image, 'http') ? $image : asset('user/avatar/' . $image)) : asset('assets/img/user/avatar.jpg') }}"
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
                                                    {{ $user->name }}
                                                </h6>
                                                <p class="text-muted">{{ $user->username }}</p>
                                            </div>
                                        </div>
                                        <a class="dropdown-item" href="{{ route('profile') }}"><i
                                                class="feather-user me-1"></i>Profile</a>
                                        @if ($user->mentor)
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
                                        @if (in_array('65531d75139d10c7eb364114',$user->role))
                                            <a class="dropdown-item" href="{{ route('moderation') }}"><i
                                                    class="feather-clipboard"></i>Moderation</a>
                                        @endif

                                        @if(in_array('6523f9bcad8f1cf003fce14d', $user->role))
                                            <a class="dropdown-item" href="{{route('admin.dashboard')}}"><i class="feather-log-in me-1"></i>Go to Admin</a>
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
@endif
        </header>
        @if(!$is_login)
        <script>
            if(!localStorage.getItem('header_page'))
            {
                localStorage.setItem('header_page', document.querySelector('header.header-page').innerHTML);
                location.reload();
            }
        </script>
        @endif
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
   @if($user_header)
document.querySelector('header.header-page').innerHTML = localStorage.getItem('header_page')
@else 
localStorage.setItem('header_page', document.querySelector('header.header-page').innerHTML)
@endif
 
function removeCart(_id,_class) {
    fetch(_id,{
        method: 'POST',
    }).then(res => res.text()).then(res => {
        $('.'+_class).remove();
    })
}
        </script>
