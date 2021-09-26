@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">انشاء تفاصيل جديده</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">انشاء تفاصيل خدمه</li>
                <li class="breadcrumb-item"><a href="{{route('services.details',$id)}}">تفاصيل الخدمه </a></li>
                <li class="breadcrumb-item"><a href="{{route('services')}}">الخدمات </a></li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open( ['route'  => ['services.details.store'],'method'=>'post' , 'class'=>'form','files'=>true] ) }}
                    <h4 class="card-title">بيانات تفاصيل الخدمه</h4>
                    <hr>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">العنوان
                            بالعربيه</label>
                        <div class="col-md-10">
                            {{ Form::text('title_ar',null,["class"=>"form-control" ,"required"]) }}
                            {{ Form::hidden('service_id',$id,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">العنوان
                            بالانجليزيه</label>
                        <div class="col-md-10">
                            {{ Form::text('title_en',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">المحتوي
                            بالعربيه</label>
                        <div class="col-md-10">
                            {{ Form::text('desc_ar',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">المحتوي
                            بالانجليزيه</label>
                        <div class="col-md-10">
                            {{ Form::text('desc_en',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="center">
                        {{ Form::submit( 'اضافه' ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
@endsection


