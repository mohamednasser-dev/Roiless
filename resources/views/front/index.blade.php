@extends('layouts.web')
@section('header')
    header-menu-4
@endsection
@section('main')
    <main>

        <!-- banner section -->
        <section class="banner-area-3 pt-90" id="banner_animation2">
            <div class="bg-slides">
                <div class="slide" data-parallax='{"x": 220, "y": 0, "rotateZ":0}'>
                    <img class="wow slideInRight" data-wow-delay='0.2s'
                         src="{{url('New')}}/img/banner/slide-shape-1.png" alt="img">
                </div>
                <div class="slide" data-parallax='{"x": 270, "y": 0, "rotateZ":0}'>

                    <img class="wow slideInRight" data-wow-delay='0.6s'
                         src="{{url('New')}}/img/banner/slide-shape-2.png" alt="img">
                </div>
                <div class="slide" data-parallax='{"x": 330, "y": 0, "rotateZ":0}'>

                    <img class="wow slideInRight" data-wow-delay='1.3s'
                         src="{{url('New')}}/img/banner/slide-shape-3.png" alt="img">
                </div>
            </div>
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-lg-7 pt-100 pt-lg-200 pb-lg-200 pb-100">
                        <div class="banner-content pb-20 pt-20">

                            <h1 class="wow fadeInUp" data-wow-delay="0.1s">{{ __('front.Compair') }}</h1>

                            <a href="loan.html"
                               class="wow fadeInUp mt-50 theme-btn theme-btn-rounded-2 theme-btn-lg theme-btn-alt"
                               data-wow-delay="0.3s">{{ __('front.downloadapp') }}
                                <i class="arrow_left"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-5 d-none d-lg-block position-relative">
                        <img class="person-img " width="75%" src="{{url('New')}}/img/banner/person-2.png" alt="">
                    </div>
                </div>
            </div>
        </section>
        <!-- banner section end-->

        <!-- Feature and Calculator start -->
        <section class="feature-calculator pt-120 bg_white">
            <div class="container">
                <!-- Feature -->
                <div class="feature">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="feature-slider">
                                <div class="feature-card-widget-3 wow fadeInLeft  card-1" data-wow-delay="0.1s">
                                    <div class="shapes">
                                        <img src="{{url('New')}}/img/feature/shape-17.png" alt="shape">
                                        <img src="{{url('New')}}/img/feature/shape-18.png" alt="shape">
                                        <img src="{{url('New')}}/img/feature/shape-19.png" alt="shape">
                                        <img src="{{url('New')}}/img/feature/shape-20.png" alt="shape">
                                    </div>
                                    <img src="{{url('New')}}/img/feature/1.svg" width="90px" alt="icon">
                                    <span class="title">تمويل المشتريات</span>
                                    <h5>عن طريق تمويل المشتريات هتقسّط كل المنتجات اللي تحتاجها بحد ائتماني يوصل لـ 200
                                        ألف ج.م.</h5>
                                </div>
                                <div class="feature-card-widget-3 wow fadeInLeft  card-2" data-wow-delay="0.3s">
                                    <div class="shapes">
                                        <img src="{{url('New')}}/img/feature/shape-21.png" alt="shape">
                                        <img src="{{url('New')}}/img/feature/shape-22.png" alt="shape">
                                        <img src="{{url('New')}}/img/feature/shape-23.png" alt="shape">
                                        <img src="{{url('New')}}/img/feature/shape-24.png" alt="shape">
                                    </div>
                                    <img src="{{url('New')}}/img/feature/2.svg" width="90px" alt="icon">
                                    <span class="title">تمويل المشروعات</span>
                                    <h5>قدم على تمويل يبدأ من 5000 ج.م ويوصل لـ 200 ألف ج.م للشركات والمشروعات
                                        الصغيرة.</h5>
                                </div>
                                <div class="feature-card-widget-3 wow fadeInLeft  card-3" data-wow-delay="0.5s">
                                    <div class="shapes">
                                        <img src="{{url('New')}}/img/feature/shape-25.png" alt="shape">
                                        <img src="{{url('New')}}/img/feature/shape-26.png" alt="shape">
                                        <img src="{{url('New')}}/img/feature/shape-27.png" alt="shape">
                                        <img src="{{url('New')}}/img/feature/shape-28.png" alt="shape">
                                        <img src="{{url('New')}}/img/feature/shape-28.png" alt="shape">
                                        <img src="{{url('New')}}/img/feature/shape-29.png" alt="shape">
                                        <img src="{{url('New')}}/img/feature/shape-29.png" alt="shape">
                                    </div>
                                    <img src="{{url('New')}}/img/feature/3.svg" width="90px" alt="icon">
                                    <span class="title">الإستثمار المباشر</span>
                                    <h5>إستثمر الأن فى بانكو وأحصل على أعلى عائد نزود الوصف هنا شويه علشان يبقى المربعات
                                        كلها قد بعض</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Feature and Calculator end -->

        <!-- Help Advertisement start -->
        <section class="help-ad-area pt-90 pb-115 overflow-hidden">
            <div class="container">
                <div class="section-title">
                    <h2>نساعد أكثر من 10.000 شخص على مستوى الوطن العربى</h2>
                </div>

                <div class="row pt-40">
                    <div class="col-lg-10 mx-auto">
                        <div class="row">
                            <div class="col-12">
                                <img class="main-img img-fluid" src="{{url('New')}}/img/help-ad/img-1.png" alt="img">
                            </div>
                            <div class="col-lg-5">
                                <div class="offers">
                                    <ul>
                                        <li><span><i class="icon_check"></i></span>أختار البنك اللى تحبه</li>
                                        <li><span><i class="icon_check"></i></span> مبناخدش منك عمولة</li>
                                        <li><span><i class="icon_check"></i></span> بنوفر عليك وقت</li>
                                        <li><span><i class="icon_check"></i></span>أسرع إجراءات</li>
                                    </ul>
                                    <div class="shape"><img src="{{url('New')}}/img/help-ad/shape.png" alt="shape">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <p class="pt-lg-60">وفرنا عليك وقت ومجهود كبير فى أنك تقارن بين البنوك وتدور على أقل
                                    نسبة فوائد على قرضك دلوقتى هنساعدك تختار افضل بنك تحبه </p>
                                <p class="py-4">بظبط 3 ايام وهتكون خلصت كل إجراءاتك فى مكان واحد ومتابعة فورية لحالة
                                    طلبك بدون عناء السفر والمشاوير للبنك </p>
                                <p> مش بس وفرنا عليك وقت كبير كان ممكن يضيع احنا كمان وفرنا عليك إجراءات كتير مرهقة
                                    مكنتش هتقدر تخلصها لوحدك .</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Help Advertisement end -->

        <!-- Banca Corporate Companys start -->
        <section class="banca-corporate bg_white pt-125 pb-110">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="section-title">
                            <h2 class="wow fadeInUp">بنوك وشركات تتعاون معنا لتقديم افضل خدمة </h2>
                            <p class="wow fadeInUp" data-wow-delay="0.3s"><span>أكثر من 100+ بنك وشركة</span> يثقون فى
                                بانكو لتسهيل إجراءات الحصول على <span> القروض والتمويلات</span></p>
                        </div>
                    </div>
                </div>
                @php
                    $data = \App\Models\Bank::select('id','name_ar as name', 'image')->get();
                @endphp
                <div class="row justify-content-between mt-35 gy-sm-0 gy-4  text-center text-lg-start">
                    @foreach($data as $bank)
                        <div class="col-lg-2 col-6">
                            <a href="#" class="single-brand wow fadeInRight" data-wow-delay="0.1s">
                                <img class="img-fluid" src="{{$bank->image}}" alt="logo">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Banca Corporate Companys end -->

        <!-- Articales start -->
        <section class="articles-area pt-125 pb-140">
            <div class="container">
                <div class="section-title d-flex flex-wrap justify-content-between text-start align-items-center">
                    <h2 class="mb-3 mb-sm-0 wow fadeInRight">أفضل أنظمة التمويل والقروض</h2>
                    <a class="wow fadeInLeft" href="{{url('loans')}}">عرض الكل <i class="arrow_left"></i></a>
                </div>
                @php
                    $funds = \App\Models\Fund::select('id','name_'.app()->getLocale().' as name','image')->where('featured','1')->where('deleted','0')->get();
                @endphp
                <div class="row mt-60 gy-4 gy-lg-0">
                    @foreach($funds as $fund)
                        <div class="col-lg-3 col-md-6">
                            <a href="{{url('loan/'.$fund->id)}}">
                                <div class="blog-widget-1 wow fadeInUp" data-wow-delay="0.1s">
                                    <img class="w-100" src="{{$fund->image}}" alt="news image">
                                    <div class="blog-content pr-10 pl-10">
                                        <h6><a href="{{url('loan/'.$fund->id)}}">{{$fund->name}}</a></h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Articales end -->

        <!-- Articales start -->
        <section class="articles-area pt-125 pb-140">
            <div class="container">
                <div class="section-title d-flex flex-wrap justify-content-between text-start align-items-center">
                    <h2 class="mb-3 mb-sm-0 wow fadeInRight">اقسام المنتجات</h2>
                    {{--                    <a class="wow fadeInLeft" href="{{url('loans')}}">عرض الكل <i class="arrow_left"></i></a>--}}
                </div>
                @php
                    $sections = \App\Models\Section::where('parent_id',null)->get();
                @endphp
                <div class="row mt-60 gy-4 gy-lg-0">
                    @foreach($sections as $section)
                        <div class="col-lg-3 col-md-6">
                            <div class="blog-widget-1 wow fadeInUp" data-wow-delay="0.1s">
                                <img class="w-100" src="{{$section->image}}" style="height: 190px;" alt="news image">
                                <div class="blog-content pr-10 pl-10">
                                    <h6><a href="{{route('front.section.child',$section->id)}}">{{$section->title}}</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Articales end -->

        <!-- Articales start -->
        <section class="articles-area pb-140">
            <div class="container">
                <div class="section-title d-flex flex-wrap justify-content-between text-start align-items-center">
                    <h2 class="mb-3 mb-sm-0 wow fadeInRight">أفضل أنظمة الإستثمار</h2>
                    <a class="wow fadeInLeft" href="{{url('banco/front/investment')}}">عرض الكل <i
                            class="arrow_left"></i></a>
                </div>
                @php
                    $funds = \App\Models\Investment::select('id','name_'.app()->getLocale().' as name','image')->limit(10)->get();
                @endphp
                <div class="row mt-60 gy-4 gy-lg-0">
                    @foreach($funds as $fund)
                        <div class="col-lg-3 col-md-6">
                            <a href="{{route('front.investment.details',$fund->id)}}">
                                <div class="blog-widget-1 wow fadeInUp" data-wow-delay="0.1s">
                                    <img class="w-100" style="height: 150px !important;" src="{{$fund->image}}"
                                         alt="news image">
                                    <div class="blog-content pr-10 pl-10">
                                        <h6>
                                            <a href="{{route('front.investment.details',$fund->id)}}">{{$fund->name}}</a>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Articales end -->
        <!-- Articales start -->
        <section class="articles-area pb-140">
            <div class="container">
                <div class="section-title d-flex flex-wrap justify-content-between text-start align-items-center">
                    <h2 class="mb-3 mb-sm-0 wow fadeInRight">المنتجات</h2>
                    <a class="wow fadeInLeft" href="{{url('banco/front/products')}}">عرض الكل <i class="arrow_left"></i></a>
                </div>
                @php
                    $products = \App\Models\Product::select('id','name_ar','image','price')->where('status','accepted')->limit(10)->get();
                @endphp
                <div class="row mt-60 gy-4 gy-lg-0">
                    @foreach($products as $product)
                        <div class="col-lg-3 col-md-6">
                            <a href="{{route('front.investment.details',$product->id)}}">
                                <div class="blog-widget-1 wow fadeInUp" data-wow-delay="0.1s">
                                    <img class="w-100" style="height: 150px !important;" src="{{$product->image}}"
                                         alt="news image">
                                    <div class="blog-content pr-10 pl-10">
                                        <h6>
                                            <a href="{{route('front.investment.details',$product->id)}}">{{$product->name_ar}}</a>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Articales end -->


        <!-- Advisor start -->
        <section class="advisor-area  pb-140 overflow-hidden" id="MouseMoveAnimation">
            <div class="container">
                <div class="row gy-4 gy-lg-0">
                    <div class="col-lg-6 pl-lg-75">
                        <div class="section-title text-start">
                            <h2 class="mb-0 wow fadeInUp">خبراء بانكو على أستعداد دائم لمساعدتك</h2>
                        </div>

                        <div class="advisor-img mt-45 wow fadeInUp" data-wow-delay="0.2s">

                            <div class="shape ">
                                <div class="box">
                                    <img class="layer layer2" data-depth="0.5" src="{{url('New')}}/img/faq/Shape.png"
                                         alt="shape">
                                </div>
                                <div class="circle-shape"></div>
                            </div>
                            <img class="main-img" src="{{url('New')}}/img/1.png" alt="advisor">

                            <div class="work-time">
                                <div class="circle-shape"></div>
                                ماعدا الجمعة والسبت <span> 10.00 - 06.00</span>
                            </div>
                        </div>

                        <div class="row mt-4 gy-md-0 gy-3 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="col-md-6">
                                <a href="tel:01234567890"
                                   class="theme-btn theme-btn-primary_alt theme-btn-rounded d-flex align-items-center justify-content-center">
                                    <i class="icon_phone"></i> 01234-567890</a>
                            </div>
                            <div class="col-md-6">
                                <a href="mailto:bancainfo@email.com"
                                   class="theme-btn theme-btn-primary_alt theme-btn-rounded d-flex align-items-center justify-content-center">
                                    <i class="icon_mail_alt "></i> info@banca.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="faq-widget-2">
                            <div class="accordion" id="accordionExample">
                                <div class="single-widget-one wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="faq-header" id="headingOne">
                                        <h6 class="mb-0 collapsed" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            How much can I borrow?<i class="icon_plus"></i><i class="icon_close"></i>
                                        </h6>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                         data-bs-parent="#accordionExample">
                                        <div class="faq-body">
                                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                dolor brunch.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-widget-one wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="faq-header" id="headingTwo">
                                        <h6 class="mb-0" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="true" aria-controls="collapseTwo">
                                            What are the requirements to get a loan offer?<i class="icon_plus"></i><i
                                                class="icon_close"></i>
                                        </h6>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                                         data-bs-parent="#accordionExample">
                                        <div class="faq-body">
                                            <p>- You must be at least 18 years old <br>
                                                - You must have permanent residence in United States <br>
                                                - You are not registered in the RKI / Debtor Register (DBR) <br>
                                                <br>
                                                The offers you receive are preliminary offers, which are provided that
                                                the information you have entered, are correct.<br><br>

                                                At the same time, you must sign the loan offer with NemID before the
                                                bank can pay out your loan.
                                            </p>

                                        </div>
                                    </div>
                                </div>

                                <div class="single-widget-one wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="faq-header" id="headingThree">
                                        <h6 class="mb-0 collapsed" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="true"
                                            aria-controls="collapseThree">
                                            How can I borrow money ASAP?<i class="icon_plus"></i><i
                                                class="icon_close"></i>
                                        </h6>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                         data-bs-parent="#accordionExample">
                                        <div class="faq-body">
                                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                dolor brunch.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-widget-one wow fadeInUp" data-wow-delay="0.7s">
                                    <div class="faq-header" id="headingFour">
                                        <h6 class="mb-0 collapsed" data-bs-toggle="collapse"
                                            data-bs-target="#collapseFour" aria-expanded="true"
                                            aria-controls="collapseFour">
                                            How can you reduce the cost of my loans?<i class="icon_plus"></i><i
                                                class="icon_close"></i>
                                        </h6>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                         data-bs-parent="#accordionExample">
                                        <div class="faq-body">
                                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                dolor brunch.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-widget-one wow fadeInUp" data-wow-delay="0.9s">
                                    <div class="faq-header" id="headingFive">
                                        <h6 class="mb-0 collapsed" data-bs-toggle="collapse"
                                            data-bs-target="#collapseFive" aria-expanded="true"
                                            aria-controls="collapseFive">
                                            What does it cost to use Banca?<i class="icon_plus"></i><i
                                                class="icon_close"></i>
                                        </h6>
                                    </div>
                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                                         data-bs-parent="#accordionExample">
                                        <div class="faq-body">
                                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                dolor brunch.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-widget-one wow fadeInUp" data-wow-delay="1.1s">
                                    <div class="faq-header" id="headingSix">
                                        <h6 class="mb-0 collapsed" data-bs-toggle="collapse"
                                            data-bs-target="#collapseSix" aria-expanded="true"
                                            aria-controls="collapseSix">
                                            When is the loan paid out?<i class="icon_plus"></i><i
                                                class="icon_close"></i>
                                        </h6>
                                    </div>
                                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                                         data-bs-parent="#accordionExample">
                                        <div class="faq-body">
                                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                dolor brunch.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-widget-one wow fadeInUp" data-wow-delay="1.3s">
                                    <div class="faq-header" id="headingSeven">
                                        <h6 class="mb-0 collapsed" data-bs-toggle="collapse"
                                            data-bs-target="#collapseSeven" aria-expanded="true"
                                            aria-controls="collapseSeven">
                                            How long is the repayment period?<i class="icon_plus"></i><i
                                                class="icon_close"></i>
                                        </h6>
                                    </div>
                                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven"
                                         data-bs-parent="#accordionExample">
                                        <div class="faq-body">
                                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                dolor brunch.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-widget-one wow fadeInUp" data-wow-delay="1.5s">
                                    <div class="faq-header" id="headingEight">
                                        <h6 class="mb-0 collapsed" data-bs-toggle="collapse"
                                            data-bs-target="#collapseEight" aria-expanded="true"
                                            aria-controls="collapseEight">
                                            Can I redeem the loan ahead of time?<i class="icon_plus"></i><i
                                                class="icon_close"></i>
                                        </h6>
                                    </div>
                                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight"
                                         data-bs-parent="#accordionExample">
                                        <div class="faq-body">
                                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                dolor brunch.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-widget-one wow fadeInUp" data-wow-delay="1.7s">
                                    <div class="faq-header" id="headingNine">
                                        <h6 class="mb-0 collapsed" data-bs-toggle="collapse"
                                            data-bs-target="#collapseNine" aria-expanded="true"
                                            aria-controls="collapseNine">
                                            Can I change my application after submitting it?<i class="icon_plus"></i><i
                                                class="icon_close"></i>
                                        </h6>
                                    </div>
                                    <div id="collapseNine" class="collapse" aria-labelledby="headingNine"
                                         data-bs-parent="#accordionExample">
                                        <div class="faq-body">
                                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                dolor brunch.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Advisor end -->

        <!-- Call To Action start -->
        <section class=" pt-75 pb-90">
            <div class="container">
                <div class="row pt-110">
                    <div class="col-md-12 position-relative">
                        <div class="cta cta-2" style="background-image: url(img/client/cta-bg.png);">
                            <div class="bubbles">
                                <div class="bubble-1"></div>
                                <div class="bubble-2"></div>
                                <div class="bubble-3"></div>
                                <div class="bubble-4"></div>
                                <div class="bubble-5"></div>
                                <div class="bubble-6"></div>
                                <div class="bubble-7"></div>
                                <div class="bubble-8"></div>
                            </div>
                            <div class="row gy-xl-0 gy-4">
                                <div class="col-xl-5">
                                    <div class="cta-content wow fadeInLeft text-center text-xl-start"
                                         style="visibility: visible; animation-name: fadeInLeft;">
                                        <h2>حمل تطبيق بانكو الأن</h2>
                                    </div>
                                </div>
                                <div
                                    class="col-xl-7 d-flex align-items-center flex-wrap justify-content-xl-end justify-content-center">
                                    <a href="#">
                                        <div class="app-btn mt-3 mt-sm-0 wow fadeInRight" data-wow-delay="0.1s"
                                             style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInRight;">
                                            <i class="fab fa-google-play"></i>
                                            <div class="btn-text">
                                                <span>GET IT ON</span>
                                                <p>Google Play</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="app-btn mt-3 mt-sm-0 wow fadeInRight" data-wow-delay="0.2s"
                                             style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInRight;">
                                            <i class="fab fa-apple"></i>
                                            <div class="btn-text">
                                                <span>Downloan on the</span>
                                                <p>Apple Store</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Call To Action end -->
    </main>
@endsection
