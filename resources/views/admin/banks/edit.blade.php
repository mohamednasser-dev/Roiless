@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">تعديل بيانات البنك</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">تعديل البنك</li>
                <li class="breadcrumb-item"><a href="{{route('banks.index')}}">البنوك</a></li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">الرئسيه</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">بيانات البنك</h4>
                    <hr>
                    {!! Form::model($bank, ['route' => ['banks.update',$bank->id] , 'method'=>'put','files'=> true]) !!}
                    {{ csrf_field() }}
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label"> اسم البنك بالعربيه </label>
                        <div class="col-md-10">
                            {{ Form::text('name_ar',$bank->name_ar,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">اسم البنك بالانجليزي</label>
                        <div class="col-md-10">
                            {{ Form::text('name_en',$bank->name_en,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.email')}}</label>
                        <div class="col-md-10">
                            {{ Form::email('email',$bank->email,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-password-input" class="col-md-2 col-form-label">كلمه المرور</label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" name="password" id="example-password-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-password-input2" class="col-md-2 col-form-label">تاكيد كلمه المرور</label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" name="password_confirmation"
                                   id="example-password-input2">
                        </div>
                    </div>
                    <div class="center">
                        {{ Form::submit( 'تعديل' ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

