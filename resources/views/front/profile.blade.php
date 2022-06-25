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
                                <h1>الملف الشخصي</h1>
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
                            <form action="{{route('front.profile.update')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mt-20">
                                        <label for="form-sub">الاسم</label>
                                        <input type="text" value="{{$data->name}}" id="form-phone" name="name" class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-12 mt-20">
                                        <label for="form-sub">البريد الإلكتروني</label>
                                        <input type="email" value="{{$data->email}}" id="form-phone" name="email" class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-4 mt-20">
                                        <label for="form-sub">الدولة</label>
                                        <select name="city_id" required class="form-control">
                                            @foreach(cities() as $city)
                                                <option value="{{$city->id}}" @if($city->id == $data->city_id) selected @endif > {{$city->name_ar}} &nbsp; ({{$city->country_code}}) </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-8 mt-20">
                                        <label for="form-sub">رقم الهاتف</label>
                                        <input type="text" value="{{$data->user_phone}}" id="form-phone" name="phone" class="form-control"
                                               required>
                                    </div>
                                    <div class="col-12 mt-35">
                                        <button type="submit" class="theme-btn theme-btn-lg w-100">تعديل</button>
                                    </div>
                                    <div class="col-12 mt-35">
                                        <a onclick=" return confirm('سيتم ارسال رمز التحقق الى رقم الهاتف خاصتك')" href="{{route('front.generate.otp_password')}}">تغيير كلمة المرور</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-lg-1 mt-35" style="text-align-last: center;">
                        <button class="theme-btn theme-btn-lg wow fadeInUp" type="submit" style="visibility: visible; animation-name: fadeInUp;">
                            طلباتي / تمويلاتي
                        </button>
                        &nbsp; &nbsp;
                        <button class="theme-btn theme-btn-lg wow fadeInUp" type="submit" style="visibility: visible; animation-name: fadeInUp;">
                            استثماراتي
                        </button>

                    </div>
                </div>
            </div>
        </section>
        <!-- Get In Touch end -->
    </main>
@endsection
