@extends('layouts.web')
@section('header')
header-menu-3
@endsection
@section('main')
    <main>
        <!-- Persinal Details start -->
        <section class="loan-deatils-area bg_disable pt-130 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="stepper-widget mt-sm-5 px-3 px-sm-0 bg_white">
                            <div class="blog-widget-1 wow fadeInUp" data-wow-delay="0.1s">
                                <img class="w-100" style="height:160px" src="{{$data->image}}" alt="news image">
                                <div class="blog-content pr-10 pl-10">
                                    <h6><a href="#">{{$data->name_ar}}</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="loan-details-widget bg_white">
                            <form action="{{url('loan/create')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="fund_id" value="{{$data->id}}">
                                <div class="row gy-4">
                                    @foreach($fields as $field)
                                        {!! GetField($field) !!}                                  
                                    @endforeach   
                                    <div class="col-md-6"> 
                                        <label class="label" for="company_type">مجال الشركة*</label>
                                        <input type="file" multiple name="file[]">
                                    </div>                                  
                                </div>
                                <div class="row mt-60">
                                    <div class="col-md-12">
                                        <div class="nav-btn d-flex flex-wrap justify-content-between">
                                            <button type="submit"
                                                class=" next-btn theme-btn-primary_alt theme-btn ">next<i
                                                    class="arrow_left"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Persinal Details end -->
    </main>
@endsection