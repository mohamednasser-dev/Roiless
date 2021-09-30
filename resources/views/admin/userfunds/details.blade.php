@extends('admin_temp')
@section('content')
@section('styles')
    <link href="{{asset('/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{asset('/css/pages/user-card.css')}}" rel="stylesheet">
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #0A0A0A;
            font-family: Helvetica, sans-serif;
        }

        /* The actual timeline (the vertical ruler) */
        .timeline {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* The actual timeline (the vertical ruler) */
        .timeline::after {
            content: '';
            position: absolute;
            width: 6px;
            background-color: white;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
        }

        /* Container around content */
        /*.container {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
        }*/

        /* The circles on the timeline */
        /*.container::after {
            content: '';
            position: absolute;
            width: 25px;
            height: 25px;
            right: -17px;
            background-color: white;
            border: 4px solid #FF9F55;
            top: 15px;
            border-radius: 50%;
            z-index: 1;
        }*/

        /* Place the container to the left */
        .left {
            left: 0;
        }

        /* Place the container to the right */
        .right {
            left: 50%;
        }

        /* Add arrows to the left container (pointing right) */
        .left::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 22px;
            width: 0;
            z-index: 1;
            right: 30px;
            border: medium solid white;
            border-width: 10px 0 10px 10px;
            border-color: transparent transparent transparent white;
        }

        /* Add arrows to the right container (pointing left) */
        .right::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 22px;
            width: 0;
            z-index: 1;
            left: 30px;
            border: medium solid white;
            border-width: 10px 10px 10px 0;
            border-color: transparent white transparent transparent;
        }

        /* Fix the circle for containers on the right side */
        .right::after {
            left: -16px;
        }

        /* The actual content */
        .content {
            padding: 20px 30px;
            background-color: white;
            position: relative;
            border-radius: 6px;
        }
        img {
  vertical-align: middle;
  width: 50% !important;
    display: block;
    margin: auto;
}

/* Position the image container (needed to position the left and right arrows) */
.container {
  position: relative;
}

/* Hide the images by default */
.mySlides {
  display: none;
}

/* Add a pointer when hovering over the thumbnail images */
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  left: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* Container for image text */
.caption-container {
  text-align: center;
  background-color: #222;
  padding: 2px 16px;
  color: white;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Six columns side by side */
.column {
  float: left;
  width: 16.66%;
}

/* Add a transparency effect for thumnbail images */
.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}
        /* Media queries - Responsive timeline on screens less than 600px wide */
        @media screen and (max-width: 600px) {
            /* Place the timelime to the left */
            .timeline::after {
                left: 31px;
            }

            /* Full-width containers */
            .container {
                width: 100%;
            }

            /* Make sure that all arrows are pointing leftwards */
            .container::before {
                left: 60px;
                border: medium solid white;
                border-width: 10px 10px 10px 0;
                border-color: transparent white transparent transparent;
            }

            /* Make sure all circles are at the same spot */
            .left::after, .right::after {
                left: 15px;
            }

            /* Make all right containers behave like the left ones */
            .right {
                left: 0%;
            }
        }

        .time-line {
            margin-right: 47px;
            position: relative
        }

        .time-line label {
            position: absolute;
            top: 0;
            right: -48px;
            text-align: center;
        }

        .timeline-list {
            border-right: 3px solid #ccc;
            position: relative;
            height: auto;
            margin-bottom: 20px;
        }

        .timeline-list:before {
            content: "";
            position: absolute;
            top: 0;
            right: -14px;
            width: 25px;
            height: 25px;
            text-align: center;
            z-index: 11;
            background: rgb(204, 204, 204);
            border-radius: 50%;
        }

        .timeline-all {
            margin-right: 36px;
            position: relative;

            border-radius: 10px 0 10px 10px;
            padding: 25px 25px 0px;
            text-align: right;
        }

        .timeline-all:before {
            content: "";
            border-width: 14px;
            border-style: solid;
            border-color: transparent transparent transparent #ccc;
            position: absolute;
            top: 0px;
            right: -27px;
        }

        .time-line .img img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>

@endsection
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">{{trans('admin.fund_review')}}</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{trans('admin.fund_review')}}
            </li>
            <li class="breadcrumb-item active"><a href="{{route('userfunds')}}">{{trans('admin.funds_need')}}
                </a></li>
            <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
        </ol>
    </div>
</div>


<div class="row row-cols-2">
    {{--Start dataform --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>{{trans('admin.date_preview')}}</h3>

                    @foreach(json_decode($requestreview->dataform, true) as $data)

                        <h3 class="control-label">{{ $data['name'] }}</h3>
                        <input type="text" id="firstName" class="form-control" value="{{ $data['value'] }} " readonly>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{--end dataform --}}


    {{--Start fund history --}}
    <div class="col-md-6">
        <div class="card">

            <div class="card-body">
                <div class="card-title">
                    <h3>{{trans('admin.fund_history')}}</h3>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-9" id="slimtest1" style="height: 450px;">
                        <div>


                            @foreach($histories as $history)
                                <div class="time-line">
                                    <div class="container">
                                        <label>{{$history->created_at->format('d')}}
                                            <br> {{$history->created_at->monthName}}</label>
                                        <div class="timeline-date">
                                            <div class="timeline-list">
                                                <div class="timeline-all
                                                @if($history->status == 'accept') bg-success @endif
                                                @if($history->status == 'reject') bg-danger @endif
                                                @if($history->status == 'pending') bg-info   @endif
                                                @if($history->status == 'return') bg-warning  @endif">


                                                    <h4 class="text-center text-white  ">
                                                        @if($history->status == 'pending') {{trans('admin.start_fund')}} @endif

                                                        @if($history->status == 'reject' & $history->type == 'bank') {{trans('admin.bank_reject')}} {{$history->bank->name_ar}} @endif

                                                        @if($history->status == 'accept' & $history->type == 'emp' )  {{trans('admin.emp_accept')}} {{$history->ُEmployer->name}} @endif

                                                        @if($history->status == 'return') {{trans('admin.emp_return')}} {{$history->ُEmployer->name}} {{trans('admin.to')}} {{$history->ُEmployerReturned->name}}     @endif
                                                    </h4>



                                                    <div class="row">
                                                        <div class="col-3">
                                                            <div class="img">
                                                                @if($history->type == 'bank') <i
                                                                    class="fa fa-bank (alias) fa-3x " style="color: white ;padding-bottom: 20px;"></i>
                                                                @elseif($history->type == 'emp' && $history->status != 'accept') <i
                                                                    class="fa fa-mail-reply-all (alias) fa-2x" style="color: white ;padding-bottom: 20px;"></i>
                                                                @elseif($history->type == 'user') <i
                                                                    class="fa fa-user-circle fa-3x" style="color: white ;padding-bottom: 20px;"></i>
                                                                @elseif($history->status == 'accept' && $history->type == 'emp') <i
                                                                    class="fa fa-check fa-3x" style="color: white ;padding-bottom: 20px;"></i> @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-9">
                                                            <div class="para" style="color: white">
                                                                <p>{{$history->note_ar}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--end fund history --}}
</div>

{{--Start fund photos --}}
<div class="row">
<div class="owl-carousel owl-theme">
    <div class="item"><h4>1</h4></div>
    <div class="item"><h4>2</h4></div>
    <div class="item"><h4>3</h4></div>
    <div class="item"><h4>4</h4></div>
    <div class="item"><h4>5</h4></div>
    <div class="item"><h4>6</h4></div>
</div>
</div>

<div class="container">
  <div class="mySlides">
    <div class="numbertext">1 / 6</div>
    <img src="{{asset('/uploads/category/1632042608.jpg')}}" style="width:100%">
  </div>

  <div class="mySlides">
    <div class="numbertext">2 / 6</div>
    <img src="{{asset('/uploads/category/1632738138.jpeg')}}" style="width:100%">
  </div>

  <div class="mySlides">
    <div class="numbertext">3 / 6</div>
    <img src="{{asset('/uploads/category/1632042608.jpg')}}" style="width:100%">
  </div>
    
  <div class="mySlides">
    <div class="numbertext">4 / 6</div>
    <img src="img_lights_wide.jpg" style="width:100%">
  </div>

  <div class="mySlides">
    <div class="numbertext">5 / 6</div>
    <img src="img_nature_wide.jpg" style="width:100%">
  </div>
    
  <div class="mySlides">
    <div class="numbertext">6 / 6</div>
    <img src="img_snow_wide.jpg" style="width:100%">
  </div>
    
  <a class="prev" onclick="plusSlides(-1)">❮</a>
  <a class="next" onclick="plusSlides(1)">❯</a>

  

  <div class="row">
    <div class="column">
      <img class="demo cursor" src="{{asset('/uploads/category/1632042608.jpg')}}" style="width:100%" onclick="currentSlide(1)" alt="The Woods">
    </div>
    <div class="column">
      <img class="demo cursor" src="{{asset('/uploads/category/1632738138.jpeg')}}" style="width:100%" onclick="currentSlide(2)" alt="Cinque Terre">
    </div>
    <div class="column">
      <img class="demo cursor" src="{{asset('/uploads/category/1632042608.jpg')}}" style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
    </div>
    <div class="column">
      <img class="demo cursor" src="img_lights.jpg" style="width:100%" onclick="currentSlide(4)" alt="Northern Lights">
    </div>
    <div class="column">
      <img class="demo cursor" src="img_nature.jpg" style="width:100%" onclick="currentSlide(5)" alt="Nature and sunrise">
    </div>    
    <div class="column">
      <img class="demo cursor" src="img_snow.jpg" style="width:100%" onclick="currentSlide(6)" alt="Snowy Mountains">
    </div>
  </div>
</div>

<!-- <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h5>{{trans('admin.img_preview')}}</h5>
                </div>

                <div id="image-popups" class="row ">
                    <div class="owl-carousel owl-theme">
                    @foreach($requestreview->Files_img as $file)
                        <div class="item">
                            
                                <a href="{{asset('/uploads/fund_file').'/'.$file->file_name}}"
                                    data-effect="mfp-zoom-in"><img
                                    src="{{asset('/uploads/fund_file').'/'.$file->file_name}}"
                                    class="img-responsive"/>
                                </a>
                            
                        </div>
                    @endforeach
    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
{{--end fund photos --}}







{{--Start fund pdf --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h5>{{trans('admin.pdf_preview')}}</h5>
                </div>

                <div id="image-popups" class="row">

                    @foreach($requestreview->Files_pdf as $file)
                        <div class="col-6">
                            <iframe src="{{asset('/uploads/fund_file').'/'.$file->file_name}}" style="width:600px; height:500px;"></iframe>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end fund pdf --}}


<div class="row">
    <div class="card col-12 ">
        <div class="card-body  center">
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#Empoloyers">
                {{trans('admin.emp_transfer')}}
            </button>

            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#banks">
                {{trans('admin.fund_accept')}}
            </button>

            <button
                type="button" class="btn btn-danger" data-toggle="modal" data-target="#user">
                {{trans('admin.user_transfer')}}
            </button>

        </div>
    </div>
</div>


<div class="row">
    <div class="modal fade" id="Empoloyers" tabindex="-1" role="dialog" aria-labelledby="EmpoloyersLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="EmpoloyersLabel1">اختر الموظف</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form class="form"
                      action="{{route('fund.redirect.emp',$requestreview->id)}}"
                      method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group has-success">

                            <label class="control-label"> ملحوظه بالعربيه </label>
                            <input type="text" class="form-control" name="note_ar" required>
                            <label class="control-label"> ملحوظه بالانجليزيه </label>
                            <input type="text" class="form-control" name="note_en" required>
                            <label class="control-label"> الموظفين </label>

                            <select class="form-control custom-select" name="emp_id" required>
                                @foreach($empolyers as $empolyer )
                                    <option value=""></option>
                                    <option value="{{$empolyer->id}}">{{$empolyer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">اختيار</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="modal fade" id="banks" tabindex="-1" role="dialog" aria-labelledby="banksLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="banksLabel1">اختر الموظف</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form class="form"
                      action="{{route('fund.redirect.bank',$requestreview->id)}}"
                      method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group has-success">
                            <label class="control-label"> ملحوظه بالعربيه </label>
                            <input type="text" class="form-control" name="note_ar" required>
                            <label class="control-label"> ملحوظه بالانجليزيه </label>
                            <input type="text" class="form-control" name="note_en" required>
                            <br>
                            <label class="control-label"> البنوك </label>
                            <select class="form-control custom-select" name="bank_id">
                                @foreach($banks as $bank)
                                    <option value="{{$bank->id}}">{{$bank->name_ar}}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">اختيار</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="modal fade" id="user" tabindex="-1" role="dialog" aria-labelledby="userLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="banksLabel1">مراجعه الورق المطلوب مره اخري</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form class="form"
                      action="{{route('fund.redirect.user',$requestreview->id)}}"
                      method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group has-success">

                            <label class="control-label"> ملحوظه بالعربيه </label>
                            <input type="text" class="form-control" name="note_ar" required>
                            <label class="control-label"> ملحوظه بالانجليزيه </label>
                            <input type="text" class="form-control" name="note_en" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">اختيار</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection
@section('scripts')
    <script src="{{asset('/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>
    <script
        src="{{asset('/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>
    <script type="text/javascript">
        $('#slimtest1, #slimtest2, #slimtest3, #slimtest4').perfectScrollbar();

        
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
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}

        // $(document).ready(function(){
        //     $('.owl-carousel').owlCarousel({
        //         loop:true,
        //         margin:10,
        //         nav:true,
        //         responsive:{
        //         0:{
        //             items:1
        //             },
        //         600:{
        //             items:3
        //             },
        //         1000:{
        //             items:5
        //             }
        //         }
        //     });
        // });
    </script>

    
@endsection
