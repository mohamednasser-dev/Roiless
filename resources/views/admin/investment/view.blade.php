@extends('admin_temp')
@section('styles')
    <link href="{{asset('../assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{asset('css/colors/default-dark.css')}}" id="theme" rel="stylesheet">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.investments_view')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.investments')}}</li>
                <li class="breadcrumb-item active"><a href="{{route('investments')}}">{{trans('admin.investments_orders')}}</a></li>
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>{{trans('admin.pdf_preview')}}</h3>
                    </div>
                    <div id="image-popups" class="row">
                        @foreach($data->Images as $file)
                            <div class="col-12">
                                <img class="center" src="{{asset('/uploads/Investments').'/'.$file->image}}"
                                     style=" height:500px;">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
 <script   src="{{asset('js/custom.min.js')}}"></script>
 <script   src="{{asset('/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>
 <script   src="{{asset('/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>
 <script   src="{{asset('/assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
 <script   src="{{asset('/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>

@endsection
