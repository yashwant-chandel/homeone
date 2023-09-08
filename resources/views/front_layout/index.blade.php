<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/font/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/custom.css') }}">
    <!-- Toaster -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css">
        <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
    <!-- end toaster -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
   

    <title> HomeOne </title>
</head>

<body>

    <header class="site-header custom_header {{ request()->is('store-details/*') ? 'custom_header' : '' }}">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand d-lg-none" href="#"><img src="img/site-logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="bar bar1"></span>
                    <span class="bar bar2"></span>
                    <span class="bar bar3"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="col-lg-5 col-md-12">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('exteriors') }}">Exteriors</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('gallery') }}">Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('lawn') }}">Lawn</a>
                            </li>
                            @if(Auth::user())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('store') }}">Store</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-md-2  d-none d-lg-block d-md-none">
                        <a class=" navbar-brand mx-auto" href="{{ url('') }}"><img src="{{ asset('front/img/site-logo.png') }}" alt=""></a>
                    </div>
                    <div class="col-lg-5 col-md-12 d-flex align-items-center justify-content-end">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('contact') }}">Contact</a>
                            </li>
                        </ul>
                        <div class="log-btn ">
                            @if(auth()->check())
                                <a href="{{ url('/logout') }}" class="cta">Logout
                            </a>  
                            @else
                            <a href="{{ url('/login') }}" class="cta">Login
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="log-btn d-lg-none">
                    <a href="#" class="cta">Login
                        <i class="fa-solid fa-user"></i>
                    </a>
                </div>
            </nav>
        </div>
    </header>

    @yield('layout')

    <footer class="site-footer light">
        <div class="top-footer p-130">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="foot-text">
                            <div class="footer-logo">
                                <img src="img/footer-logo.png" alt="">
                            </div>
                            <p>We custom manufacture the track for every job. This ensures the best colours and depths
                                for
                                each
                                system.</p>
                            <div class="footer-links">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center">
                        <div class="quick-links">
                            <h4>Quick Links</h4>
                            <ul>
                                <li>
                                    <a href="{{ url('exteriors') }}">Exteriors</a>
                                </li>
                                <li>
                                    <a href="{{ url('gallery') }}">Gallery</a>
                                </li>
                                <li>
                                    <a href="{{ url('lawn') }}">Lawn</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h4>Contact Info</h4>
                        <p><strong>Phone:</strong><br>
                            866 233 7351 <br><br>
                            <strong>Email:</strong><br>
                            info@myhomeone.ca
                        </p>
                    </div>
                    <div class="col-md-3">
                        <h4>Locations</h4>
                        <p><strong>Address 1:</strong> <br>
                            15 - 1339 40th Ave Ne, Calgary, <br> Alberta. T2E 8N6
                            <br>
                            <br>
                            <strong>Address 2:</strong> <br>
                            1602 3rd Ave S, Lethbridge, Alberta. T1J 0L2
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-write">
            <div class="container">
                <div class="copy-write_wrapper">
                    <p>© Copyright 2023 Home One Inc. All Rights Reserved.</p>
                    <p>Privacy Policy | Terms of Service</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/mhayes-twentytwenty/1.0.0/js/jquery.twentytwenty.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ asset('front/js/script.js') }}"></script>

    @if(Session::get('error'))
    <script>
        iziToast.error({
            message: '{{ Session::get("error") }}',
            position: 'topRight' 
        });
    </script>
    @endif
    @if(Session::get('success'))
    <script>
        iziToast.success({
            message: '{{ Session::get("success") }}',
            position: 'topRight' 
        });
    </script>
    @endif
    


</body>