@extends('admin_temp')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/dropify/dist/css/dropify.min.css') }}">
    <link href="{{ asset('/assets/plugins/summernote/dist/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}"
          rel="stylesheet"/>
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.create_service')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">انشاء دولة جديدة</li>
                <li class="breadcrumb-item"><a href="{{route('cities')}}">{{trans('admin.cities')}} </a></li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    {{ Form::open( ['route'  => ['cities.store'],'method'=>'post' , 'class'=>'form','files'=>true] ) }}
                    <h4 class="card-title">معاومات المدينة</h4>
                    <hr>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.name_ar')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('name_ar',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.name_en')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('name_en',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.country_code')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('country_code',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>
                    <div class="center">
                        {{ Form::submit( trans('admin.add') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

