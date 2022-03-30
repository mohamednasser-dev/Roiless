@php($title='تفاصيل المنتج')
@extends('seller.layouts.app')
@section('title')
    {{$title}}
@endsection
@section('header')

@endsection
@section('breadcrumb')
    <div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Breadcrumb-->
        <h5 class="text-success font-weight-bold my-1 mr-5">{{$title}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('seller.products')}}"
                   class="text-muted">المنتجات</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('seller.home')}}"
                   class="text-muted">الصفحة الرئيسية</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection
@section('content')

    <!--begin::Page Layout-->
    <div class="d-flex row">
        <!--begin::Aside-->
        <div class="col-md-9">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-body p-0">
                    <!-- begin: Invoice-->
                    <!-- begin: Invoice header-->
                    <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                        <div class="col-md-10">
                            <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                                <h1 class="display-4 font-weight-boldest mb-10">{{$data->name}}</h1>
                                <div class="d-flex flex-column align-items-md-end px-0">
                                    <!--begin::Logo-->
                                {{--                                    <a href="#" class="mb-5">--}}
                                {{--                                        <img src="assets/media/logos/logo-dark.png" alt="" />--}}
                                {{--                                    </a>--}}
                                <!--end::Logo-->
                                    <span class="d-flex flex-column align-items-md-end opacity-70">
																	<span></span>
																	<span></span>
																</span>
                                </div>
                            </div>
                            <div class="border-bottom w-100"></div>
                            <div class="d-flex justify-content-between pt-6">
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">سعر المنتج</span>
                                    <span class="opacity-70">{{$data->price}}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">كمية المنتج</span>
                                    <span class="opacity-70">{{$data->quantity}}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2"></span>
                                    <span class="opacity-70"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice header-->
                    <!-- begin: Invoice body-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-10">
                            <h3 class="card-title align-items-start flex-column mb-5">
                                <span class="card-label font-weight-bolder text-dark mb-1">فوائد التقسيط</span>
                            </h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="pl-0 font-weight-bold text-muted text-uppercase"></th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase"></th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase"></th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase"></th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($benefits as $row)
                                        <tr class="font-weight-boldest">
                                            <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <!--end::Symbol-->
                                                {{$row->Benefit->name}}</td>
                                            <td class="text-primary border-top-0 pr-0 py-4 text-right align-middle"> {{$row->ratio}} %</td>
                                            <td class="text-primary border-top-0 pr-0 py-4 text-right align-middle"></td>
                                            <td class="text-primary border-top-0 pr-0 py-4 text-right align-middle"></td>
                                            <td class="text-primary border-top-0 pr-0 py-4 text-right align-middle"></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <div class="col-md-3 " id="kt_profile_aside">
            <!--begin::List Widget 17-->
            <div class="card card-custom gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">صورة المنتج</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-4">
                    <!--begin::Container-->
                    <div>
                        <!--begin::Item-->
                        <div class="d-flex align-items-center mb-8">
                            <!--begin::Symbol-->
                            <div class="symbol mr-5 pt-1">
                                <div class="symbol-label min-w-65px min-h-100px" style=" width: 250px;
                                    height: 250px; background-image: url({{$data->image_path}})"></div>
                            </div>

                        </div>
                        <!--end::Item-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::List Widget 17-->
            <!--begin::List Widget 21-->
{{--            <div class="card card-custom gutter-b">--}}
{{--                <!--begin::Header-->--}}
{{--                <div class="card-header border-0 pt-5">--}}
{{--                    <h3 class="card-title align-items-start flex-column mb-5">--}}
{{--                        <span class="card-label font-weight-bolder text-dark mb-1">صور اضافية للمنتج</span>--}}
{{--                    </h3>--}}
{{--                </div>--}}
{{--                <!--end::Header-->--}}
{{--                <!--begin::Body-->--}}
{{--                <div class="card-body pt-2">--}}
{{--                    <!--begin::Item-->--}}
{{--                    <div class="d-flex mb-8">--}}
{{--                        <!--begin::Symbol-->--}}
{{--                        <div class="symbol symbol-150 symbol-2by3 flex-shrink-0 mr-4">--}}
{{--                            <div class="d-flex flex-column">--}}
{{--                                <div class="symbol-label mb-3" style="background-image: url('{{url('/')}}/default-image.png')"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!--end::Symbol-->--}}
{{--                    </div>--}}
{{--                    <div class="d-flex mb-8">--}}
{{--                        <!--begin::Symbol-->--}}
{{--                        <div class="symbol symbol-150 symbol-2by3 flex-shrink-0 mr-4">--}}
{{--                            <div class="d-flex flex-column">--}}
{{--                                <div class="symbol-label mb-3" style="background-image: url('{{url('/')}}/default-image.png')"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!--end::Symbol-->--}}
{{--                    </div>--}}
{{--                    <div class="d-flex mb-8">--}}
{{--                        <!--begin::Symbol-->--}}
{{--                        <div class="symbol symbol-150 symbol-2by3 flex-shrink-0 mr-4">--}}
{{--                            <div class="d-flex flex-column">--}}
{{--                                <div class="symbol-label mb-3" style="background-image: url('{{url('/')}}/default-image.png')"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!--end::Symbol-->--}}
{{--                    </div>--}}
{{--                    <div class="d-flex mb-8">--}}
{{--                        <!--begin::Symbol-->--}}
{{--                        <div class="symbol symbol-150 symbol-2by3 flex-shrink-0 mr-4">--}}
{{--                            <div class="d-flex flex-column">--}}
{{--                                <div class="symbol-label mb-3" style="background-image: url('{{url('/')}}/default-image.png')"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!--end::Symbol-->--}}
{{--                    </div>--}}
{{--                    <div class="d-flex mb-8">--}}
{{--                        <!--begin::Symbol-->--}}
{{--                        <div class="symbol symbol-150 symbol-2by3 flex-shrink-0 mr-4">--}}
{{--                            <div class="d-flex flex-column">--}}
{{--                                <div class="symbol-label mb-3" style="background-image: url('{{url('/')}}/default-image.png')"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!--end::Symbol-->--}}
{{--                    </div>--}}
{{--                    <!--end::Item-->--}}
{{--                    <!--begin::Item-->--}}
{{--                    <!--end::Item-->--}}
{{--                </div>--}}
{{--                <!--end::Body-->--}}
{{--            </div>--}}
            <!--end::List Widget 21-->
        </div>
        <!--end::Aside-->
        <!--begin::Layout-->

        <!--end::Layout-->
    </div>
    <!--end::Page Layout-->
@endsection
@section('script')
@endsection
