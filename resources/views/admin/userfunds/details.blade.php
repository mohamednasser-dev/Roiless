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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h5>{{trans('admin.img_preview')}}</h5>
                </div>

                <div id="image-popups" class="row">
                    @foreach($requestreview->Files_img as $file)

                        <div class="col-lg-2 col-md-4">
                            <a href="{{asset('/uploads/fund_file').'/'.$file->file_name}}"
                               data-effect="mfp-zoom-in"><img
                                    src="{{asset('/uploads/fund_file').'/'.$file->file_name}}"
                                    class="img-responsive"/></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
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
    </script>
@endsection
