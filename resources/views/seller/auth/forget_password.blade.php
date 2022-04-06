@php($title='نسيت كلمة المرور')
@extends('seller.auth.login_app')
@section('title')
    {{$title}}
@endsection
@section('header')

@endsection
@section('content')
    <!--begin::Forgot-->
    <div class="login-form">
        <!--begin::Form-->
        <form method="POST" action="{{route('seller.forget_password.store') }}" class="form" novalidate="novalidate">
            @csrf
            <!--begin::Title-->
            <div class="pb-13 pt-lg-0 pt-5">
                <p class="text-muted font-weight-bold font-size-h4">ادخل بريدك الإلكتروني</p>
            </div>
            <!--end::Title-->
            <!--begin::Form group-->
            <div class="form-group">
                <input required class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="email" placeholder="البريد الإلكتروني" name="email" autocomplete="off" />
            </div>
            <!--end::Form group-->
            <!--begin::Form group-->
            <div class="form-group d-flex flex-wrap pb-lg-0">
                <button type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">المتابعة</button>
                <a href="{{route('seller.login')}}" id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">الغاء</a>
            </div>
            <!--end::Form group-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Forgot-->
@endsection
@section('script')

@endsection
