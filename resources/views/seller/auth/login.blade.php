@php($title='تسجيل دخول التاجر')
@extends('seller.auth.login_app')
@section('title')
    {{$title}}
@endsection
@section('header')

@endsection
@section('content')
    <!--begin::Signin-->
    <div class="login-form login-signin">
        <!--begin::Form-->
        <form method="POST" action="{{route('seller.login.store') }}" class="form">
        @csrf
        @include('layouts.errors')
        @include('layouts.messages')
        <!--begin::Title-->
            <div class="pb-13 pt-lg-0 pt-5">
                <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">اهلا بك !</h3>
                {{--                            <span class="text-muted font-weight-bold font-size-h4">New Here?--}}
                {{--									<a href="javascript:;" id="kt_login_signup" class="text-primary font-weight-bolder">Create an Account</a></span>--}}
            </div>
            <!--begin::Title-->
            <!--begin::Form group-->
            <div class="form-group">
                <label class="font-size-h6 font-weight-bolder text-dark">البريد الإلكتروني</label>
                <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" type="email" required
                       name="email" autocomplete="off"/>
            </div>
            <!--end::Form group-->
            <!--begin::Form group-->
            <div class="form-group">
                <div class="d-flex justify-content-between mt-n5">
                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">كلمة المرور</label>
                    <a href="{{route('seller.forget_password')}}"
                       class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5"
                       id="kt_login_forgot">نسيت كلمة المرور ؟</a>
                </div>
                <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" type="password" required
                       name="password" autocomplete="off"/>
            </div>
            <!--end::Form group-->
            <!--begin::Action-->
            <div class="pb-lg-0 pb-5" style="text-align: center;">
                <button type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">تسجيل
                    الدخول
                </button>
                <a href="{{route('seller.sign_up')}}" class="btn btn-light-primary font-weight-bolder px-8 py-4 my-3 font-size-lg">
                    انشاء حساب جديد
                </a>
            </div>
            <!--end::Action-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Signin-->
@endsection
@section('script')

@endsection
