@php($title='انشاء حساب جديد')
@extends('seller.auth.login_app')
@section('title')
    {{$title}}
@endsection
@section('header')

@endsection
@section('content')
    <!--begin::Signup-->
    <div class="login-form">
        <!--begin::Form-->
        <form class="form" action="{{route('seller.change_password.store')}}" method="post">
            @csrf
            @include('layouts.errors')
            @include('layouts.messages')
            <!--begin::Title-->
            <div class="pb-13 pt-lg-0 pt-5">
                <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">انشاء كلمة مرور جديدة</h3>
                <p class="text-muted font-weight-bold font-size-h4">يجب ان تحتوي ارقام وحروف ولا تقل عن 6 احرف</p>
            </div>
            <!--end::Title-->
            <!--begin::Form group-->
            <div class="form-group">
                <input required class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="hidden" placeholder="اسم التاجر" name="email" value="{{$email}}" autocomplete="off" />
            </div>

            <div class="form-group">
                <input required class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="password" placeholder="كلمة المرور" name="password" autocomplete="off" />
            </div>
            <!--end::Form group-->
            <!--begin::Form group-->
            <div class="form-group">
                <input required class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="password" placeholder="تأكيد كلمة المرور" name="password_confirmation" autocomplete="off" />
            </div>

            <div class="form-group d-flex flex-wrap pb-lg-0 pb-3">
                <button type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">حفظ كلمة المرور الجديدة</button>
                <a href="{{route('seller.login')}}" id="kt_login_signup_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">الغاء</a>
            </div>
            <!--end::Form group-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Signup-->
@endsection
@section('script')

@endsection
