@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.add_new_detailes')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.add_new_detailes')}}</li>
                <li class="breadcrumb-item"><a href="{{route('services.details',$id)}}">{{trans('admin.detailes_info')}}</a></li>
                <li class="breadcrumb-item"><a href="{{route('services')}}">{{trans('admin.services')}} </a></li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open( ['route'  => ['services.details.store'],'method'=>'post' , 'class'=>'form','files'=>true] ) }}
                    <h4 class="card-title">{{trans('admin.info_detailes_service')}}</h4>
                    <hr>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.address_in_arabic')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('title_ar',null,["class"=>"form-control" ,"required"]) }}
                            {{ Form::hidden('service_id',$id,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.address_in_english')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('title_en',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.content_in_arabic')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('desc_ar',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.content_in_english')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('desc_en',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="center">
                        {{ Form::submit( trans('admin.add') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
@endsection


