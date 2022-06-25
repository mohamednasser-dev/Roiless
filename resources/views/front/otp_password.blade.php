@extends('layouts.web')
@section('header')
    header-menu-4
@endsection
@section('main')
    <main>
        <!-- BreadCrumb start -->
        <section class="breadcrumb-area">
            <div class="breadcrumb-widget  breadcrumb-widget-3 pt-200 pb-200"
                 style="background-image: url(img/breadcrumb/bg-4.jpg);">
                <div class="container" style="height: 0px;">
                    <div class="row">
                        <div class="col-lg-7 mx-auto">
                            <div class="breadcrumb-content pt-100">
                                <h1>التحقق من الكود</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- BreadCrumb end -->
        <!-- Get In Touch start -->
        <section class="pt-50 pb-140 get-touch-area bg_white">
            <div class="container">
                <div class="row gy-4 gy-lg-0" style="place-content: center;">
                    <div class="col-lg-6 offset-lg-1" style="text-align-last: center;">
                        <div class="contact-form-widget">
                            <form action="{{route('front.profile.password.code_verify')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mt-20">
                                        <label for="form-sub">كود التحقق</label>
                                        <input type="number" value="{{$otb}}" id="form-phone" name="otp_code"
                                               class="form-control"
                                               required>
                                    </div>
                                    <div class="col-12 mt-35">
                                        <button type="submit" class="theme-btn theme-btn-lg w-100">تحقق</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Get In Touch end -->
    </main>
@endsection
