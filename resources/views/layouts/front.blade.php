<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- ===== BOX ICONS ===== -->
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet" />

    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- swiper css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/libraries/swiper.css') }}" />

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/style.css') }}" />
    <link rel="{{ asset('frontend/assets/images/G__5_-removebg-preview.png') }}" href="favicon.ico" type="image/x-icon"
        style="width: 60px;height: 60px;">
    <title>OnlineTeach</title>
    @notifyCss
</head>

<body>
    <x-notify::notify />
    @include('notify::components.notify')

    <header class="header" id="header">
        <div class="nav container">
            <a href="{{ route('home') }}" class="nav-logo">
                <img src="{{ asset('frontend/assets/images/G__5_-removebg-preview.png') }}" alt="" width="120">
            </a>
    
            <div class="nav-menu" id="nav-menu">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="bx bx-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('courses.index') }}" class="nav-link">
                            <i class="bx bx-book"></i> Course
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('catalog') }}" class="nav-link">
                            <i class="bx bx-list-ul"></i> Catalog
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="http://127.0.0.1:8000/chatify" class="nav-link">
                            <i class="bx bx-chat"></i> Discussions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('student.invitations') }}" class="nav-link">
                            <i class="bx bx-file-blank"></i> Formations
                        </a>
                    </li>
    
                    @auth
                        @if (auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a href="{{ route('admin.courses.index') }}" class="nav-link">
                                    <i class="bx bx-cog"></i> Admin
                                </a>
                            </li>
                        @elseif (auth()->user()->isStudent())
                            <li class="nav-item">
                                <a href="{{ route('student.assignments') }}" class="nav-link">
                                    <i class="bx bx-task"></i> Mes Devoirs
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('student.grades') }}" class="nav-link">
                                    <i class="bx bx-star"></i> Mes Notes
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
                @auth
                    <ul class="nav-list nav-account" style="margin-top: 1rem">
                        <li class="nav-item" style="width: 100%; text-align: center">
                            <a href="{{ route('courses.index') }}" class="button nav-link" style="display: block; width: 100%">
                                <i class="bx bx-book-open"></i> My Course
                            </a>
                        </li>
                        <li class="nav-item" style="width: 100%; text-align: center">
                            <a href="#" class="button nav-link" onclick="getElementById('logout').submit()" style="display: block; width: 100%">
                                <i class="bx bx-log-out"></i> Logout
                            </a>
                            <form id="logout" action="{{ route('logout') }}" method="post">
                                @csrf
                            </form>
                        </li>
                    </ul>
                @endauth
    
                @guest
                    <ul class="nav-list nav-account" style="margin-top: 1rem">
                        <li class="nav-item" style="width: 100%; text-align: center">
                            <a href="{{ route('login') }}" class="button nav-link" style="display: block; width: 100%">
                                <i class="bx bx-log-in"></i> Login
                            </a>
                        </li>
                        <li class="nav-item" style="width: 100%; text-align: center">
                            <a href="{{ route('register') }}" class="button nav-link" style="display: block; width: 100%">
                                <i class="bx bx-user-plus"></i> Register
                            </a>
                        </li>
                    </ul>
                @endguest
    
                <div class="nav-close" id="nav-close">
                    <i class="bx bx-x"></i>
                </div>
            </div>
    
            <div class="nav-btns">
                <i class="bx bx-moon change-theme" id="theme-button"></i>
                @guest
                    <div class="btn-account">
                        <a href="{{ route('login') }}" class="btn btn-login">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-register">Register</a>
                    </div>
                @endguest
                @auth
                    <div class="nav-user" id="nav-user">
                        <i class="bx bx-user-circle"></i> <small> {{ auth()->user()->name }} </small>
                        <i class="bx bx-chevron-down"></i>
                    </div>
                @endauth
    
                <div class="nav-toggle" id="nav-toggle">
                    <i class="bx bx-grid-alt"></i>
                </div>
            </div>
        </div>
    </header>
    

    <div class="dropdown" id="dropdown">
        <i class="bx bx-x dropdown-close" id="dropdown-close"></i>

        <a href="{{ route('courses.index') }}">
            <h2 class="dropdown-title-center">My Course</h2>
        </a>
        <a href="#" onclick="getElementById('logout').submit()">
            <h2 class="dropdown-title-center">Logout</h2>
        </a>
        <form id="logout" action="{{ route('logout') }}" method="post">
            @csrf
        </form>
    </div>

    <main class="main container">
        @yield('content')
    </main>

    <footer class="footer section">
        <div class="footer-container container grid">
            <div class="footer-content">
                <h3 class="footer-title">Contact Information</h3>
                <ul class="footer-list">
                    <li><i class="bx bxs-phone"></i> +212 0766395253</li>
                    <li><i class="bx bxs-map"></i> Casa, Omnia School</li>
                    <li><i class="bx bxs-envelope"></i> contact@omniaschool.com</li>
                </ul>
            </div>
    
            <div class="footer-content">
                <h3 class="footer-title">Explore</h3>
                <ul class="footer-links">
                    <li><a href="#" class="footer-link">Home</a></li>
                    <li><a href="#" class="footer-link">Courses</a></li>
                    <li><a href="#" class="footer-link">Categories</a></li>
                    <li><a href="#" class="footer-link">About Us</a></li>
                </ul>
            </div>
    
            <div class="footer-content">
                <h3 class="footer-title">Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="#" class="footer-link">Register</a></li>
                    <li><a href="#" class="footer-link">Login</a></li>
                    <li><a href="#" class="footer-link">FAQ</a></li>
                    <li><a href="#" class="footer-link">Support</a></li>
                </ul>
            </div>
    
            <div class="footer-content">
                <h3 class="footer-title">Connect with Us</h3>
                <ul class="footer-social">
                    <a href="#" class="footer-social-link"><i class="bx bxl-facebook"></i></a>
                    <a href="#" class="footer-social-link"><i class="bx bxl-twitter"></i></a>
                    <a href="#" class="footer-social-link"><i class="bx bxl-instagram"></i></a>
                    <a href="#" class="footer-social-link"><i class="bx bxl-linkedin"></i></a>
                </ul>
            </div>
        </div>
    
        <div class="footer-bottom">
            <span class="footer-copy">&#169; 2024 Omnia School. All Rights Reserved.</span>
            <span class="footer-privacy"><a href="#">Privacy Policy</a></span>
        </div>
    </footer>
    

    <a href="#" class="scroll-up" id="scroll-up">
        <i class="bx bx-up-arrow-alt scroll-up-icon"></i>
    </a>

    <!-- swiper -->
    <script src="{{ asset('frontend/assets/libraries/swiper.js') }}"></script>
    <!--===== MAIN JS =====-->
    <script src="{{ asset('frontend/assets/main.js') }}"></script>

    
    @notifyJs
</body>

</html>
