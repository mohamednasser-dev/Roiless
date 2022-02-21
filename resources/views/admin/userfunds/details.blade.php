@extends('admin_temp')
@section('styles')
    <link href="{{asset('/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{asset('/css/pages/user-card.css')}}" rel="stylesheet">
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">

@endsection
@section('content')
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
                        <h3>{{trans('admin.date_user')}}</h3>
                        <div class="row">
                            <div class="col-6">
                                <h3 class="control-label">{{trans('admin.date_user_name')}}</h3>
                                <input type="text" id="firstName" class="form-control" value="{{$user->name}}"
                                       readonly>
                            </div>
                            <div class="col-6">
                                <h3 class="control-label">{{trans('admin.date_user_phone')}}</h3>
                                <input type="text" id="firstName" class="form-control" value="{{$user->phone}}"
                                       readonly>
                            </div>
                            <div class="col-6">
                                <h3 class="control-label">{{trans('admin.date_user_email')}}</h3>
                                @if(!empty($user->emai))
                                    <input type="text" id="firstName" class="form-control" value="{{$user->emai}}"
                                           readonly>
                                @else
                                    <input type="text" id="firstName" class="form-control text-danger"
                                           value="no email yet"
                                           readonly>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>{{trans('admin.date_preview')}}</h3>
                        <div class="row">
                            @foreach(json_decode($requestreview->dataform, true) as $data)
                                @if($data['value'] != "null")
                                    @php $inputnow = \App\Models\Fundinput::where('slug',$data['name'])->first(); @endphp
                                    <div class="col-6">
                                        <h3 class="control-label">{{$inputnow->name}}</h3>
                                        <input type="text" id="firstName" class="form-control"
                                               @if($data['name'] == 'bank_id')
                                               @php $value = json_decode($data['value'], true) ;
                                                 $result = "";
                                               @endphp
                                               @foreach( $value as $row)
                                               @php
                                                   $bank =  \App\Models\Bank::find($row['id']);
                                                    $result = $result .' - '.$bank->name_ar @endphp
                                               @endforeach
                                               value="{{$result}}"
                                               @else
                                               value="{{ $data['value'] }}"
                                               @endif
                                               readonly>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <hr>
                        @if($requestreview->Selected_Bank)
                            <h3>{{trans('admin.bank_data')}}</h3>
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="control-label">اسم البنك</h3>
                                    <input type="text" id="firstName" class="form-control"
                                           value="{{ $requestreview->Selected_Bank->name_ar}} "
                                           readonly>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
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
                                                    @if($history->status == 'accept') bg-success
                                                    @elseif($history->status == 'rejected') bg-danger
                                                    @elseif($history->status == 'finail_rejected') bg-danger
                                                    @elseif($history->status == 'pending') bg-info
                                                    @elseif($history->status == 'return') bg-warning
                                                    @elseif($history->status == 'user_editing') bg-primary  @endif
                                                        ">
                                                        <h4 class="text-center text-white  ">
                                                            @if($history->status == 'pending' & $history->bank_id == null & $history->emp_id == null )   {{trans('admin.start_fund')}} @endif

                                                            @if($history->status == 'pending' & $history->type == 'bank') {{trans('admin.bank_review')}}  {{$history->bank->name_ar}} @endif

                                                            @if($history->status == 'rejected' & $history->type == 'bank') {{trans('admin.bank_reject')}} {{$history->bank->name_ar}} @endif

                                                            @if($history->status == 'rejected' & $history->type == 'user') {{trans('admin.rejected')}} @endif

                                                            @if($history->status == 'finail_rejected' & $history->type == 'user') {{trans('admin.finail_rejected')}} @endif

                                                            @if($history->status == 'accept' & $history->type == 'emp' )  {{trans('admin.emp_accept')}} {{$history->ُEmployer->name}}
                                                            و التحويل الي البنوك @endif

                                                            @if($history->status == 'return') {{trans('admin.emp_return')}} {{$history->ُEmployer->name}} {{trans('admin.to')}} {{$history->ُEmployerReturned->name}}     @endif
                                                        </h4>
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <div class="img">
                                                                    @if($history->type == 'bank') <i
                                                                        class="fa fa-bank (alias) fa-3x "
                                                                        style="color: white ;padding-bottom: 20px;"></i>
                                                                    @elseif($history->type == 'emp' && $history->status != 'accept')
                                                                        <i
                                                                            class="fa fa-mail-reply-all (alias) fa-2x"
                                                                            style="color: white ;padding-bottom: 20px;"></i>
                                                                    @elseif($history->type == 'user') <i
                                                                        class="fa fa-user-circle fa-3x"
                                                                        style="color: white ;padding-bottom: 20px;"></i>
                                                                    @elseif($history->status == 'accept' && $history->type == 'emp')
                                                                        <i
                                                                            class="fa fa-check fa-3x"
                                                                            style="color: white ;padding-bottom: 20px;"></i> @endif
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
    </div>

    {{--Start fund photos --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>{{trans('admin.img_preview')}}</h5>
                    </div>

                <!-- <div id="image-popups" class="row">
                        @foreach($requestreview->Files_img as $key => $file)
                    <div class="col-lg-2 col-md-4">
                        <a href="{{asset('/uploads/fund_file').'/'.$file->file_name}}"
                                   data-effect="mfp-zoom-in"><img
                                        src="{{asset('/uploads/fund_file').'/'.$file->file_name}}"
                                        class="img-responsive"/></a>
                            </div>
                        @endforeach
                    </div> -->
                    @if(count($requestreview->Files_img)>0)
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">

                            </ol>

                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    @foreach($requestreview->Files_img as $key => $file)
                                        @if ($key == 0)
                                            @continue
                                        @endif
                                        <img class="d-block w-100"
                                             src="{{asset('/uploads/fund_file').'/'.$file->file_name}}"
                                             alt="First slide">
                                        @if ($key == 1)
                                            @break
                                        @endif
                                    @endforeach
                                </div>
                                @foreach($requestreview->Files_img as $key => $file)
                                    @if($loop->iteration  <= 1)
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                 src="{{asset('/uploads/fund_file').'/'.$file->file_name}}"
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
    {{--end fund photos --}}
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
                                <iframe src="{{asset('/uploads/fund_file').'/'.$file->file_name}}"
                                        style="width:600px; height:500px;"></iframe>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                <button
                    type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#userReject">
                    {{trans('admin.reject')}}
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
                        <h4 class="modal-title" id="banksLabel1">الموافقة على الطلب</h4>
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
                                <select class="select2 m-b-10 select2-multiple" name="banks[]" style="width: 100%"
                                        required
                                        multiple="multiple" data-placeholder="Choose">
                                    @foreach($main_banks as $main_bank)
                                        <optgroup label="{{$main_bank->name_ar}}" style="color: darkgreen;">
                                            @foreach($main_bank->Branches as $bank)
                                                <option style="color: darkred;" value="{{$bank->id}}">{{$bank->name_ar}}</option>
                                            @endforeach
                                        </optgroup>
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
                          action="{{route('fund.redirect.user',['id'=>$requestreview->id,'type'=>'rejected']) }}"
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
    <div class="row">
        <div class="modal fade" id="userReject" tabindex="-1" role="dialog" aria-labelledby="userLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="banksLabel1">رفض الطلب نهائيا</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <form class="form"
                          action="{{route('fund.redirect.user',['id'=>$requestreview->id,'type'=>'finail_rejected'])}}"
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
    <script>
        $(document).ready(function () {
            console.log('sadoon');
            $('#slid').change(function () {
                console.log('sagfdoon');
            });
        });
    </script>
    <script src="{{asset('/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>
    <script
        src="{{asset('/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>
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
