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
                                <h1>من نحن</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- BreadCrumb end -->

        <section class="bg_white pt-90 pb-160 ">
            <div class="container">
                <div class="description-widget">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="desc-title text-end bg_primary">
                                <h2>عن بانكو</h2>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="desc-text pl-lg-10">
                                <p class="mt-35">{{$data->about_us_ar}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
