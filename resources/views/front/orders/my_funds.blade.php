@extends('layouts.web')
@section('header')
    header-menu-4
@endsection
@section('main')
    <main>
        <!-- BreadCrumb start -->
        <section class="breadcrumb-area">
            <div class="breadcrumb-widget  breadcrumb-widget-3 pt-200 pb-200" style="height: 50px;"
            >
                {{--                style="background-image: url(img/breadcrumb/bg-4.jpg);"--}}
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 mx-auto">
                            <div class="breadcrumb-content pt-100">
                                <h1> طلباتي / تمويلاتي </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- BreadCrumb end -->

        <section class="feature-jobs bg_white pt-125 pb-140">
            <div class="container">
                <div class="row pt-60" style="    justify-content: center;">
                    <div class="col-lg-7">
                        <div class="feature-job-tab">
                            <ul class="feature-job-list">
                                @foreach($result as $row)
                                    <li class="mt-0">
                                        <a href="{{route('front.fund_detail',$row->id)}}">
                                            <div class="@if($row->payment_text == 'مدفوع') bg-info @else bg-primary @endif single-feature-job wow fadeInUp" data-wow-delay="0.1s">
                                                <h6 class="job-title">{{$row->fund_details->name_ar}} </h6>
                                                <h7>{{$row->full_name}}</h7>
                                                <div class="d-flex flex-wrap">
                                                    <div class="job-location me-3"><i class="icon_clock"></i>
                                                        {{$row->created_at->format('Y-m-d g:i a')}}
                                                    </div>
                                                    &nbsp;| &nbsp;
                                                    <div class="job-catagory"><span>{{$row->user_status_text}}</span>
                                                        &nbsp;|&nbsp; {{$row->fund_amount}} EGP
                                                    </div>
                                                    &nbsp;| &nbsp;
                                                    <div class="job-catagory"><span>{{$row->payment_text}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
