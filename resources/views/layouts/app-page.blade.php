<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @yield('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/progressbar_barfiller.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animated-headline.css') }}">
	<link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
	<link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
	<link rel="stylesheet" href="{{ asset('css/slick.css') }}">
	<link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
<div id="app">
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="./img/logo/loder.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader end -->
    <header>
        <!-- Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header ">
                <div class="header-top d-none d-lg-block">
                    <div class="container-fluid">
                        <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left d-flex">
                                    <ul>
                                        <li>Call Us: (+84) 939 512 999</li>
                                        <li>info@office.com </li>
                                    </ul>
                                    <div class="header-social">
                                        <ul>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a  href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                            <li> <a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="header-info-rigth d-flex">
                                    <li class="mr-3"><a class=" text-dark" href="{{ route('pay-report')}}"><i class="fas fa-file mx-3"></i>Reportar Pago</a></li>
                                    <li><a class="h1 text-dark" href="{{ url('administracion/login')}}"><i class="fas fa-users mx-2"></i>Login</a></li>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                <a href="{{ route('index')}}"><img src="./img/logo/logo.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper  d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">
                                                <li><a href="{{route('index')}}">Inicio</a></li>
                                                @if(Route::current()->getName() !='pay-report')
                                                    <li><a href="#about">Nuestra empresa</a></li>
                                                    <li><a href="#services">Servicios</a></li>
                                                @endif

                                            </ul>
                                        </nav>
                                    </div>
                                    <!-- Header-btn -->
                                    @if(Route::current()->getName() !='pay-report')
                                    <div class="header-right-btn d-none d-lg-block ml-30">
                                        <a href="#contact" class="btn header-btn">Obtén tú Servicio</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12 d-lg-none">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!--? Footer Start-->
        <div class="footer-area section-bg" data-background="./img/gallery/footer_bg.png">
            <div class="container">
                 <!-- Brand Area Start -->
                <div class="brand-area pt-25 pb-30">
                    <div class="container">
                        <div class="brand-active brand-border pt-50 pb-40">
                            <div class="single-brand">
                                <img src="./img/gallery/brand1.png" alt="">
                            </div>
                            <div class="single-brand">
                                <img src="./img/gallery/brand2.png" alt="">
                            </div>
                            <div class="single-brand">
                                <img src="./img/gallery/brand3.png" alt="">
                            </div>
                            <div class="single-brand">
                                <img src="./img/gallery/brand4.png" alt="">
                            </div>
                            <div class="single-brand">
                                <img src="./img/gallery/brand2.png" alt="">
                            </div>
                            <div class="single-brand">
                                <img src="./img/gallery/brand3.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Brand Area End -->
                <div class="footer-top footer-padding">
                    <div class="row d-flex justify-content-between">
                        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-8">
                            <div class="single-footer-caption mb-50">
                                <!-- logo -->
                                <div class="footer-logo">
                                    <a href="./"><img src="./img/logo/logo2_footer.png" alt=""></a>
                                </div>
                                <div class="footer-number">
                                    <h4><span>+564 </span>7885 3222</h4>
                                    <p>internet@gmail.com</p>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-xl-2 col-lg-2 col-md-3 col-sm-5">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Our Support</h4>
                                    <ul>
                                        <li><a href="#">Advanced</a></li>
                                        <li><a href="#"> Management</a></li>
                                        <li><a href="#">Corporate</a></li>
                                        <li><a href="#">Customer</a></li>
                                        <li><a href="#">Information</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="col-xl-2 col-lg-2 col-md-3 col-sm-5">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Quick Link</h4>
                                    <ul>
                                        <li><a href="#">New Law</a></li>
                                        <li><a href="#">About</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                        <li><a href="#">Licenses</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-xl-9 col-lg-8">
                            <div class="footer-copy-right">
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy; 2020 All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4">
                            <!-- Footer Social -->
                            <div class="footer-social f-right">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.facebook.com/sai4ull"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fas fa-globe"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>

</div>
    <!-- Scroll Up -->
    <div id="back-top" >
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <script src="{{ asset('js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/animated.headline.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>

    <!-- Date Picker -->
    <script src="{{ asset('js/gijgo.min.js') }}"></script>
    <!-- Nice-select, sticky -->
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>
    <!-- Progress -->
    <script src="{{ asset('js/jquery.barfiller.js') }}"></script>

    <!-- counter , waypoint,Hover Direction -->
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/hover-direction-snake.min.js') }}"></script>

    <!-- contact js -->
    {{-- <script src="{{ asset('js/contact.js') }}"></script> --}}
    <script src="{{ asset('js/jquery.form.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/mail-script.js') }}"></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('scripts')
</body>

</html>
