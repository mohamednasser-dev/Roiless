@extends('layouts.web')
@section('header')
    header-menu-4
@endsection
@section('main')
    <main>
        <!-- BreadCrumb start -->
        <section class="breadcrumb-area">
            <div class="breadcrumb-widget  breadcrumb-widget-3 pt-200 pb-200"
            >
                {{--                style="background-image: url(img/breadcrumb/bg-4.jpg);"--}}
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 mx-auto">
                            <div class="breadcrumb-content pt-100">
                                <h1>تواصل معنا</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- BreadCrumb end -->

        <!-- Get In Touch start -->
        <section class="pt-140 pb-140 get-touch-area bg_white">
            <div class="container">
                <div class="row gy-4 gy-lg-0">
                    <div class="col-lg-5">
                        <div class="section-title text-start">
                            <h2>اتصل بنا</h2>
                            <p>مرحبا , سمكنك التواصل معنا من خلال احدى الطرق الاتية</p>
                        </div>
                        <div class="row mt-55">
                            <h3>العناوين</h3>
                            @foreach($addresses as $row)

                                <div class="col-sm-6">
                                    <a href="{{$row->url}}" target="_blank">
                                        <div class="get-touch-box mt-30">
                                            <div class="icon">
                                                <i class="icon_pin_alt "></i>
                                            </div>
                                            <div>
                                                <p>{{$row->address_ar}}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            <br>
                            <br>
                            <br>
                            <h3>ارقام التليفون</h3>
                            @foreach($phones as $phone)
                                <div class="col-sm-6">
                                    <div class="get-touch-box">
                                        <div class="icon">
                                            <img src="img/contact/call-outline.png" alt="call icon">
                                        </div>
                                        <div>
                                            <p>{{$phone->phone}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6 offset-lg-1">
                        <div class="contact-form-widget">
                            <p>يمكنك ارسال رسالة لنا من النموذج التالي وسيتم الرد عليك خلال 48 ساعة</p>
                            <br>
                            <form action="{{route('front.contact.store')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="f-name">الاسم</label>
                                        <input type="text" id="full_name" name="full_name" class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-6 mt-20 mt-md-0">
                                        <label for="email-address">البريد الإلكتروني</label>
                                        <input type="email" id='email-address' name="email" class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-12 mt-20">
                                        <label for="form-sub">رقم الهاتف</label>
                                        <input type="text" id="form-sub" name="phone" class="form-control"
                                               placeholder="Your subject" required>
                                    </div>
                                    <div class="col-md-12 mt-20">
                                        <label for="form-text">محتوى الرسالة</label>
                                        <textarea cols="30" rows="5" name="content" id="form-text"
                                                  class="form-control pt-15" placeholder="Your message......"
                                                  required></textarea>
                                    </div>

                                    <div class="col-12 mt-35">
                                        <button type="submit" class="theme-btn theme-btn-lg w-100">ارسال الرسالة
                                        </button>
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
