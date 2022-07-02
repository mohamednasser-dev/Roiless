@extends('layouts.web')
@section('header')
    header-menu-3
@endsection
@section('main')
    <main>
        <section class="articles-area pt-125">
            <div class="container">
                <div class="section-title d-flex flex-wrap justify-content-between text-start align-items-center">
                    <h2 class="mb-3 mb-sm-0 wow fadeInRight">المنتجات</h2>
                </div>
            </div>
        </section>
        <section class="pt-40 pb-20 testimonial-area bg_disable">
            <div class="container-fluid px-0">
                <div class="testimonial-slider">
                    @foreach($data as $row)
                        <div class="single-slider container px-0">
                            <div class="testimonial-widget">
                                <a href="{{route('front.section.product_details',$row->id)}}">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="author-img">
                                                <img src="{{$row->image_path}}" alt="image"
                                                     style="width: 80%;height: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-8 d-flex align-items-center">
                                            <div class="testimonial-content">
                                                <h2>{{$row->name}}</h2>
                                                <p class="pl-lg-60">{{$row->body}}
                                                </p>
                                                <div class="author-info">
                                                    <h4>{{$row->seller->name}}</h4>
                                                    <span>{{$row->price}} L.E</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="articles-area pt-10 pb-20">
            <div class="container">
                <div class="section-title d-flex flex-wrap justify-content-between text-start align-items-center">
                    {{$data->links()}}
                </div>
            </div>
        </section>
    </main>
@endsection
