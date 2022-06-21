<!DOCTYPE HTML>
<html lang="en-US" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Banca - Banking & Business Loan Bootstrap-5 HTML Template</title>
    <link rel="shortcut icon" href="{{url('New')}}/img/favicon.png" type="image/x-icon">

    <!-- CSS here -->
    <link rel="stylesheet" type="text/css" href="{{url('New')}}/css/bootstrap.rtl.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('New')}}/css/elegant-icons.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('New')}}/css/all.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('New')}}/css/animate.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('New')}}/css/slick.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('New')}}/css/slick-theme.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('New')}}/css/nice-select.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('New')}}/css/animate.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('New')}}/css/jquery.fancybox.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('New')}}/css/nouislider.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('New')}}/css/default.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('New')}}/css/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('New')}}/css/responsive.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{url('New')}}/css/rtl.css" media="all" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap');
        body :not(i) {
            font-family: 'Tajawal', sans-serif !important;
        }
    </style>
</head>

<body data-spy="scroll" data-offset="70">
    <!-- Preloader -->
    <div id="preloader">
        <div id="ctn-preloader" class="ctn-preloader">
            <div class="round_spinner">
                <div class="spinner"></div>
                <div class="text">
                    <img src="{{url('New')}}/img/logo/Logo-2.png" alt="">
                </div>
            </div>
            <h2 class="head">Did You Know?</h2>
            <p></p>
        </div>
    </div>
    <!-- Header -->
    <header class="header">
        <div class="header-menu @yield('header')" id="sticky">
            <nav class="navbar navbar-expand-lg ">
                <div class="container">
                    <a class="navbar-brand sticky_logo" href="index.html">
                        <img class="main" src="{{url('New')}}/img/logo/Logo.png" srcset="{{url('New')}}/img/logo/Logo@2x.png 2x" alt="logo">
                        <img class="sticky" src="{{url('New')}}/img/logo/Logo-2.png" srcset="{{url('New')}}/img/logo/Logo-2@2x.png 2x" alt="logo">
                    </a>
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu_toggle">
                            <span class="hamburger">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                            <span class="hamburger-cross">
                                <span></span>
                                <span></span>
                            </span>
                        </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav menu ms-auto">
                            <li class="nav-item">
                                <a href="{{url('/')}}" class="nav-link active" >الصفحة الرئيسية</a>
                            </li>
                            <li class="nav-item dropdown submenu">
                                <a class="nav-link dropdown-toggle" href="{{url('loans')}}">
                                    القروض والتمويلات
                                </a>
                            </li>
                            <li class="nav-item dropdown submenu">
                                <a class="nav-link dropdown-toggle" href="{{url('banco/front/investment')}}">
                                    الإستثمار
                                </a>
                            </li>
                            <li class="nav-item dropdown submenu">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    صفحات هامة
                                </a>
                                <i class="arrow_carrot-down_alt2 mobile_dropdown_icon" aria-hidden="false"
                                    data-bs-toggle="dropdown"></i>
                                <ul class="dropdown-menu ">
                                    <li class="nav-item"><a class="nav-link" href="blog.html">الخدمات</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{route('front.about_us')}}">من نحن</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown submenu">
                                <a class="nav-link dropdown-toggle" href="{{route('front.contact')}}">
                                    الإتصال بنا
                                </a>
                            </li>
                        </ul>
                        @if(auth()->guard('web')->check())
                            <a class="theme-btn theme-btn-rounded-2 theme-btn-alt" href="{{route('front.logout')}}">تسجيل الخروج  ({{ auth()->guard('web')->user()->name }})</a>
                        @else
                        <a class="theme-btn theme-btn-rounded-2 theme-btn-alt" href="{{route('front.login')}}">تسجيل الدخول</a>
                         @endif
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- Header end-->

    @if(Session::has('success'))
        <div class="alert alert-success">
            <p>{{ Session('success') }}</p>
        </div>
    @endif
    @if(Session::has('danger'))
        <div class="alert alert-danger">
            <p>{{ Session('danger') }}</p>
        </div>
    @endif

    @if(Session::has('flash_message'))
        <script>
            swal("Great Job","{{Session::get('flash_message')}}", "success");
        </script>

    @endif

@yield('main')

    <!-- footer -->
    <footer class="footer footer-2 pt-lg-130 pt-110 pb-100 pb-lg-125"
        style="background-image: url(img/footer/footer-bg-2.png);">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3  col-sm-6 text-center text-sm-start">
                        <div class="footer-widget mb-30 wow fadeInLeft">
                            <h4 class="mb-20">We're on a mission.</h4>
                            <div class="footer-text mb-20">
                                <p>At Banca, we're using cutting-edge technology to transform the industry and deliver
                                    financial services that actually work for you.</p>
                            </div>
                            <div class="truspilot mt-40">
                                <img src="{{url('New')}}/img/footer/Trustpilot.png" alt="Trustpilot">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3  col-sm-6 text-center text-sm-start offset-lg-1">
                        <div class="footer-widget mb-30 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="f-widget-title">
                                <h5>Company</h5>
                            </div>
                            <div class="footer-link">
                                <ul>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Recognition</a></li>
                                    <li><a href="#">Executive Team</a></li>
                                    <li><a href="#">Careers</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>



                    <div class="col-lg-3  col-sm-6 text-center text-sm-start">
                        <div class="footer-widget mb-30 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="f-widget-title">
                                <h5>product</h5>
                            </div>
                            <div class="footer-link">
                                <ul>
                                    <li><a href="#"> Business Loans | Main</a></li>
                                    <li><a href="#"> Loan Calculator</a></li>
                                    <li><a href="#"> Refer a Friend</a></li>
                                    <li><a href="#"> Partner Program</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2  col-sm-6 text-center text-sm-start">
                        <div class="footer-widget mb-30 wow fadeInUp" data-wow-delay="0.5s">
                            <div class="f-widget-title">
                                <h5>Help</h5>



                            </div>
                            <div class="footer-link">
                                <ul>
                                    <li><a href="#">Customer Care</a></li>
                                    <li><a href="#"> Contact Us</a></li>
                                    <li><a href="#">Security Center</a></li>
                                    <li><a href="#">Blog</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="copyright pt-45">
            <div class="container">
                <div class="row ">
                    <div class="col-xl-8 offset-xl-4">
                        <div class="row align-items-center gy-lg-0 gy-3 gx-0">
                            <div class="col-md-2  text-md-start text-center">
                                <a href="index.html"><img src="{{url('New')}}/img/logo/Logo.png" alt="logo"></a>
                            </div>
                            <div class="col-md-6">
                                <div class="line"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="social-button text-center">
                                    <a class="ms-0" href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                    <a class="me-0" href="#"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="copyright-text text-md-start text-center">
                                <p>Copyright&copy; Banca 2021.<br class="d-sm-none"> <a class="ms-3"
                                        href="#">Privecy</a> | <a class="ms-0" href="#">Term
                                        of Use</a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->

    <!-- Back to top button -->
    <a id="back-to-top" title="Back to Top"></a>

    <!-- JS here -->
    <script type="text/javascript" src="{{url('New')}}/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{url('New')}}/js/preloader.js"></script>
    <script type="text/javascript" src="{{url('New')}}/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="{{url('New')}}/js/jquery.smoothscroll.min.js"></script>
    <script type="text/javascript" src="{{url('New')}}/js/jquery.nice-select.min.js"></script>
    <script type="text/javascript" src="{{url('New')}}/js/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="{{url('New')}}/js/slick.min.js"></script>
    <script type="text/javascript" src="{{url('New')}}/js/nouislider.min.js"></script>
    <script type="text/javascript" src="{{url('New')}}/js/wNumb.js"></script>
    <script type="text/javascript" src="{{url('New')}}/js/parallax.js"></script>
    <script type="text/javascript" src="{{url('New')}}/js/jquery.parallax-scroll.js"></script>
    <script type="text/javascript" src="{{url('New')}}/js/wow.min.js"></script>

    <script type="text/javascript" src="{{url('New')}}/js/custom.js"></script>
    @yield('scripts')
    @include('sweetalert::alert')
</body>

</html>
