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
                                <h1> طلباتي </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- BreadCrumb end -->
        <section class="pt-120 pb-120 bg_disable">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="blog-post-widget">
                            <div class="row gy-4 ">
                                @foreach($result as $row)
                                <div class="col-md-4">
                                    <div class="blog-widget-2 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="blog-img">
                                            <img src="{{$row->Product->image_path}}" style="    height: 250px;" alt="blog-img">
                                            <div class="catagory bg_primary">{{$row->status_name}}</div>
                                        </div>
                                        <div class="blog-content">
                                            <h4><a href="{{route('banco.order.details',$row->id)}}">{{$row->Product->name}}</a>
                                            </h4>
                                            <p>{{$row->Product->body}}</p>
                                            <div class="post-info">
                                                <div class="author">
                                                    <img src="{{$row->Product->Seller->image_path}}" style="width: 40px;height: 40px;" alt="user profile">
                                                    <span>{{$row->Product->Seller->name}}</span>
                                                </div>
                                                <div class="post-date">
                                                    <img src="{{url('New')}}/img/blog/calendar-outline.svg" alt="calendar">
                                                    <span>{{$row->created_at->format('Y-m-d')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="row mt-55">
                                <div class="col-12">
                                    <div class="pagination-widget">
                                        <ul>
                                            {{$result->links()}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
