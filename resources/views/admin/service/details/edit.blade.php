@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">تعديل تفصيله جديده</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">تعديل تفصيله جديده</li>
                <li class="breadcrumb-item"><a href="{{route('services')}}">الخدمات </a></li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.nav_home')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open( ['route'  => ['services.details.update',$service_details->id],'method'=>'post' , 'class'=>'form','files'=>true] ) }}
                    <h4 class="card-title">بيانات تفاصيل الخدمه</h4>
                    <hr>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">عنوان
                            بالعربيه</label>
                        <div class="col-md-10">
                            {{ Form::text('title_ar',$service_details->title_ar,["class"=>"form-control" ,"required"]) }}
                            {{ Form::hidden('service_id',$service_details->service_id,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">عنوان
                            بالانجليزيه</label>
                        <div class="col-md-10">
                            {{ Form::text('title_en',$service_details->title_en,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">محتوي
                            بالعربيه</label>
                        <div class="col-md-10">
                            {{ Form::text('desc_ar',$service_details->desc_ar,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">محتوي
                            بالانجليزيه</label>
                        <div class="col-md-10">
                            {{ Form::text('desc_en',$service_details->desc_en,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="center">
                        {{ Form::submit( 'تعديل' ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
@endsection


