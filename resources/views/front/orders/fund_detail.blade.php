@extends('layouts.web')
@section('header')
    header-menu-4
@endsection
@section('main')
    <main>
        <!-- BreadCrumb start -->
        <section class="breadcrumb-area">
            <div class="breadcrumb-widget  breadcrumb-widget-3 pt-200 pb-200" style="height: 50px;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 mx-auto">
                            <div class="breadcrumb-content pt-100">
                                <h1> تفاصيل التمويل </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="feature-jobs bg_white pt-125 pb-140">
            <div class="container">
                <div class="row pt-60">
                    <div class="col-lg-7">
                        <div class="feature-job-tab">
                            <ul class="feature-job-list">
                                @foreach($history as $row)
                                    <li class="mt-0">
                                        <a href="#">
                                            <div class="single-feature-job wow fadeInUp" data-wow-delay="0.1s">
                                                <h6 class="job-title">{{$row->note_ar}} </h6>
                                                <div class="d-flex flex-wrap">
                                                    <div class="job-location me-3"><i class="icon_clock"></i>
                                                        {{$row->created_at->format('Y-m-d g:i a')}}
                                                    </div>
                                                    &nbsp;| &nbsp;
                                                    <div class="job-catagory"><span>{{$row->status_text}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-5 mt-lg-0 mt-4">
                        <div class="feature-job-description wow fadeInUp" data-wow-delay="0.1s">
                            <h6 class="job-title">{{$data->fund_details->name_ar}}</h6>
                            <div class="d-flex flex-wrap">
                                <div class="job-location me-3"><i
                                        class="icon_clock"></i>{{$data->created_at->format('Y-m-d g:i a')}}
                                </div>
                                <div class="job-catagory"><span>{{$data->user_status_text}}</span>
                                </div>
                                &nbsp;| &nbsp;
                                <div class="job-catagory"><span>{{$data->payment_text}}</span>
                                </div>
                            </div>

                            <p class="mt-35"> <h6 style="color: blue;">مبلغ التمويل</h6>{{$data->cost}}EGP</p>

                            <p class="mt-20"><h6 style="color: blue;">الرسوم</h6>{{$data->fund_amount}}EGP</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
