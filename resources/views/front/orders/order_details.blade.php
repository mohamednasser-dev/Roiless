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
                                <h1> تفاصيل الطلب </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- BreadCrumb end -->
        <section class="pt-120 pb-120 bg_disable">
            <div class="container">
                <div class="row gy-lg-0 gy-4">
                    <div class="col-lg-1 position-relative">
                        <div class="blog-share-widget d-flex d-lg-block align-items-center">
                            <p>{{$row->Product->Seller->name}}</p>
                            <div class="social-link">
                                <a href="https://wa.me/{{$row->Product->seller->phone}}"><i class="fab fa-whatsapp"></i></a>
                                <a href="tel:{{$row->Product->seller->phone}}"><i class="fa fa-phone"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="post-details-widget pb-70 border-bottom position-relative">
                            <img class="post-img w-100" src="{{$row->Product->image_path}}" style="height: 500px;"
                                 alt="post image">
                            <h3 class="pt-2">{{$row->Product->name}}</h3>
                            <p class="post-text mt-35">{{$row->Product->body}}</p>
                            <div class="widget-social mt-40">
                                <div class="row text-center gx-3 gy-3 gy-md-0">
                                    <div class="col-md-3">
                                        <a href="#">
                                            <h6 style="font-weight: 800;">السعر الاساسي</h6>
                                            <span>{{$row->price}}</span>
                                        </a>
                                    </div>
                                    @if($row->installment_type == 'direct_installment')
                                        <div class="col-md-3">
                                            <a href="#">
                                                <h6 style="font-weight: 800;">عدد الشهور</h6>
                                                <span>{{$row->months_count}}</span>
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="#">
                                                <h6 style="font-weight: 800;">السعر الاجمالي</h6>
                                                <span>{{$row->total}}</span>
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="#">
                                                <h6 style="font-weight: 800;">السعر الشهري</h6>
                                                <span>{{$row->monthly_amount}}</span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            @if(count($row->Installments) > 0)
                                <h5>الاقساط بالتفصيل</h5>
                                <ul class="feature-list">
                                    @foreach($row->Installments as $installment)
                                        <li>{{$installment->amount}} جنية مصري
                                            &nbsp;&nbsp;&nbsp;{{$installment->collection_date}}
                                            &nbsp;&nbsp;&nbsp;
                                            <span
                                                @if($installment->status == 'collected') style="font-weight: 700;color: darkgreen;"
                                                @else style="font-weight: 700;color: blue;" @endif >{{$installment->user_status_name}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <h3 class="pt-2">بياانت التاجر</h3>
                        <div class="author-media-widget mt-20 mb-50">
                            <div class="author-img">
                                <img class="rounded-circle" src="{{$row->Product->Seller->image_path}}"
                                     style="width: 70px;height: 70px;" alt="author">
                            </div>
                            <div class="author-info">
                                <h6>{{$row->Product->Seller->name}}</h6>
                                <p>{{$row->Product->Seller->phone}}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
