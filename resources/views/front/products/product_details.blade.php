@extends('layouts.web')
@section('header')
    header-menu-3

@endsection
@section('styles')
    <style>
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
@endsection
@section('main')
    <main>
        <section class="banner-area-2 pt-200 pb-95" id="banner_animation"
                 style="background-size: auto; background-position: top left;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="banner-content">
                            <img data-parallax='{"x": 0, "y": 250, "rotateZ":0}' class="shape"
                                 src="{{url('New')}}/img/banner/shape-3.png" alt="shape">
                            <h1 class="wow fadeInUp mb-0">{{$data->name}}</h1>
                            <br>
                            <h3 class="wow fadeInUp mb-0">{{$data->price}} <span
                                    style="font-size: small;">جنية مصري</span></h3>
                            <p class="wow fadeInUp mt-50" data-wow-delay="0.3s">{{$data->body}}</p>
                            @if($data->type == 'direct_installment')

                                <button class="wow fadeInUp theme-btn theme-btn-lg mt-50" id="myBtn">تقسيط</button>
                            @endif
                        </div>
                    </div>
                    <div class=" col-md-6 col-lg-5 offset-lg-1 pt-40">
                        <div class="banner-img">
                            <img class="main-img img-fluid wow fadeInRight" src="{{$data->image_path}}"
                                 alt="banner-img">
                            <div class="shapes">
                                <img data-parallax='{"x": 0, "y": 130, "rotateZ":0}' class="shape-1"
                                     src="{{url('New')}}/img/banner/shape-1.png" alt="shape">
                                <img data-parallax='{"x": 0, "y": -130, "rotateZ":0}' class="shape-2"
                                     src="{{url('New')}}/img/banner/shape-2.png" alt="shape">
                                <img data-parallax='{"x": 250, "y":0, "rotateZ":0}' class="shape-3"
                                     src="{{url('New')}}/img/banner/shape-4.png" alt="shape">
                                <img data-parallax='{"x": -200, "y": 250, "rotateZ":0}' class="shape-4"
                                     src="{{url('New')}}/img/banner/shape-5.png" alt="shape">
                                <img class="shape-5" src="{{url('New')}}/img/banner/shape-6.png" alt="shape">
                                <img class="shape-6" src="{{url('New')}}/img/banner/shape-7.png" alt="shape">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- banner section -->
        <!-- our news section -->
        @if( count($data->Images) > 0)
            <section class="news-area pt-20 pb-10">
                <div class="container ">
                    <div class="section-title pt-30">
                        <h2 class="wow fadeInUp">صور المنتج</h2>
                    </div>
                    <div class="news-slider  pt-30 ">
                        @foreach($data->Images as $row)
                            <div class="blog-widget-1 wow fadeInUp" data-wow-delay="0.1s">
                                <img style="height: 270px;" class="w-sm-auto w-100" src="{{$row->image_path}}"
                                     alt="news image">
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
    @endif

    <!-- need more help start -->
        <section class="pt-30 pb-50 bg_disable">
            <div class="container">
                <div class="row ">
                    <div class="col-md-8 mx-auto">
                        <div class="section-title">
                            <h2 class="wow fadeInUp">معلومات التاجر</h2>
                        </div>
                    </div>
                </div>
                <div class="row mt-60 gy-lg-0 gy-4">
                    <div class="col-lg-12">
                        <div class="feature-card-widget-4 wow fadeInUp" data-wow-delay="0.1s">
                            <img style="width: 150px;" src="{{$data->seller->image_path}}" alt="icon">
                            <h5 class="mt-4 mb-10">{{$data->seller->name}}</h5>
                            <p><span>عدد المنتجات :</span>{{$data->seller->product_count}}</p>
                            <div class="social-button mt-35 mb-10">
                                <a href="https://wa.me/{{$data->seller->phone}}"><i class="fab fa-whatsapp"></i></a>
                                <a href="tel:{{$data->seller->phone}}"><i class="fa fa-phone"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- need more help end -->

        <section class="articles-area pt-125">
            <div class="container">
                <div class="section-title d-flex flex-wrap justify-content-between text-start align-items-center">
                    <h2 class="mb-3 mb-sm-0 wow fadeInRight">منتجات اخرى لهذا التاجر</h2>
                </div>
            </div>
        </section>
        <section class="pt-40 pb-20 testimonial-area bg_disable">
            <div class="container-fluid px-0">
                <div class="testimonial-slider">
                    @foreach($related_products as $row)
                        <div class="single-slider container px-0">
                            <div class="testimonial-widget">
                                <a href="{{route('front.section.product_details',$row->id)}}">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="author-img">
                                                <img src="{{$row->image_path}}" alt="image"
                                                     style="width: 80%;height: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-8 d-flex align-items-center">
                                            <div class="testimonial-content">
                                                <h2>{{$row->name}}</h2>
                                                <p class="pl-lg-60">{{$row->body}}
                                                </p>
                                                <div class="author-info">
                                                    <h4>{{$row->seller->name}}</h4>
                                                    <span>{{$row->price}} L.E</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="articles-area pt-10 pb-20">
            <div class="container">
                <div class="section-title d-flex flex-wrap justify-content-between text-start align-items-center">
                    {{$related_products->links()}}
                </div>
            </div>
        </section>
    </main>
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            @foreach($benefits as $row)
                @if(request()->segment(3) == 'edit')
                    @php
                        $benefit =  \App\Models\ProductBenefit::where('benefit_id',$row->id)->where('product_id',$data->id)->first();
                    @endphp
                @endif
                <div class="form-group  col-3">
                    <label>{{$row->name}} ( % )
                        <span class="text-danger">*</span>
                    </label>
                    <input name="benefits[{{$row->id}}]"
                           @if(request()->segment(3) == 'edit')
                           @if($benefit)
                           value="{{$benefit->ratio}}"
                           @endif
                           @endif

                           class="form-control" type="number" step="any"
                           max="100"/>
                </div>
            @endforeach
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endsection
