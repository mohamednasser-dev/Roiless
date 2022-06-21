@extends('layouts.web')
@section('header')
header-menu-3
@endsection
@section('main')
<main>
    <!-- Articales start -->
    <section class="articles-area pt-125 pb-140">
        <div class="container">
            <div class="section-title d-flex flex-wrap justify-content-between text-start align-items-center">
                <h2 class="mb-3 mb-sm-0 wow fadeInRight">الخدمات</h2>
            </div>
            <div class="row mt-60 gy-4 gy-lg-0">
                @foreach($data as $fund)
                    <a href="{{route('front.service_details',$fund->id)}}">
                    <div class="col-lg-3 col-md-6 pb-10">
                        <div class="blog-widget-1 wow fadeInUp" data-wow-delay="0.1s">
                            <img class="w-100" style="height:160px" src="{{$fund->image}}" alt="news image">
                            <div class="blog-content pr-10 pl-10">
                                <h6>{{$fund->title_ar}}</h6>
                            </div>
                        </div>
                    </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Articales end -->
</main>
@endsection
