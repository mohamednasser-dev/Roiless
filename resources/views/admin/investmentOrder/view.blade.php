@extends('admin_temp')
@section('styles')
    <link href="{{asset('../assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{asset('css/colors/default-dark.css')}}" id="theme" rel="stylesheet">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <link href="{{asset('/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{asset('/css/pages/user-card.css')}}" rel="stylesheet">
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.investments_view')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.investments')}}</li>
                <li class="breadcrumb-item active"><a
                        href="{{route('investments.orders')}}">{{trans('admin.investments_orders')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="title">

    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h3>{{trans('admin.investments_data')}}</h3>
                <div class="row">
                    <div class="col-6">
                        <h3 class="control-label">{{trans('admin.date_user_name')}}</h3>
                        <input type="text" id="firstName" class="form-control" value="{{$data->name}}"
                               readonly>
                    </div>
                    <div class="col-6">
                        <h3 class="control-label">{{trans('admin.date_user_phone')}}</h3>
                        <input type="text" id="firstName" class="form-control" value="{{$data->phone}}"
                               readonly>
                    </div>
                    <div class="col-6">
                        <h3 class="control-label">{{trans('admin.amount')}}</h3>
                        <input type="text" id="firstName" class="form-control" value="{{$data->amount}}"
                               readonly>
                    </div>
                    <div class="col-6">
                        <h3 class="control-label">{{trans('admin.profites')}}</h3>
                        <input type="text" id="firstName" class="form-control" value="{{$data->profites}}"
                               readonly>
                    </div>
                    <div class="col-6">
                        <h3 class="control-label">{{trans('admin.investment_type')}}</h3>
                        <input type="text" id="firstName" class="form-control" value="{{$data->investment_type}}"
                               readonly>
                    </div>

                    <div class="col-6">
                        <h3 class="control-label">{{trans('admin.Investment')}}</h3>
                        <input type="text" id="firstName" class="form-control" value="{{$data->Investments->name_ar}}"
                               readonly>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card col-12 ">
            <div class="card-body  center">
                @if($data->status == 'pinding')
                    <a href="{{route('investment.change_status',['status'=>'accepted','id'=>$data->id])}}" class="btn btn-success">
                        {{trans('admin.fund_accept')}}
                    </a>
                    <a href="{{route('investment.change_status',['status'=>'rejected','id'=>$data->id])}}" class="btn btn-danger">
                        {{trans('admin.user_transfer')}}
                    </a>
                @elseif($data->status == 'accepted')
                    <label class="text-success" >تم المافقه على الطلب</label>
                    <a href="{{route('investment.change_status',['status'=>'rejected','id'=>$data->id])}}" class="btn btn-danger">
                        {{trans('admin.user_transfer')}}
                    </a>
                @elseif($data->status == 'rejected')
                    <a href="{{route('investment.change_status',['status'=>'accepted','id'=>$data->id])}}" class="btn btn-success">
                        {{trans('admin.fund_accept')}}
                    </a>
                    <label class="text-danger" >تم رفض الطلب</label>
                @endif

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>{{trans('admin.invest_images')}}</h5>
                    </div>
                <!-- <div id="image-popups" class="row">
                        @foreach($data->Images as $key => $file)
                    <div class="col-lg-2 col-md-4">
                        <a href="{{asset('/uploads/Investments').'/'.$file->image}}"
                                   data-effect="mfp-zoom-in"><img
                                        src="{{asset('/uploads/Investments').'/'.$file->image}}"
                                        class="img-responsive"/></a>
                            </div>
                        @endforeach
                    </div> -->
                    @if(count($data->Images)>0)
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">

                            </ol>

                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    @foreach($data->Images as $key => $file)
                                        @if ($key == 0)
                                            @continue
                                        @endif
                                        <img class="d-block w-100"
                                             src="{{asset('/uploads/Investments').'/'.$file->image}}"
                                             alt="First slide">
                                        @if ($key == 1)
                                            @break
                                        @endif
                                    @endforeach
                                </div>
                                @foreach($data->Images as $key => $file)
                                    @if($loop->iteration  <= 1)
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                 src="{{asset('/uploads/Investments').'/'.$file->image}}"
                                                 alt="Second slide">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                               data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                               data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('js/custom.min.js')}}"></script>
    <script src="{{asset('/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>
    <script src="{{asset('/assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            console.log('sadoon');
            $('#slid').change(function () {
                console.log('sagfdoon');
            });
        });
    </script>

    <script type="text/javascript">

        $('#slimtest1, #slimtest2, #slimtest3, #slimtest4').perfectScrollbar();

        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            });
        });
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            var captionText = document.getElementById("caption");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            captionText.innerHTML = dots[slideIndex - 1].alt;
        }
    </script>
@endsection
