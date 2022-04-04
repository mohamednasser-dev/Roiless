@extends('admin_temp')
@section('title')
    {{trans('admin.product_details')}}
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.product_details')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.product_details')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('/admin/product/requests')}}">{{trans('admin.add_product_requests')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <!--begin::Page Layout-->
    <div class="d-flex row">
        <!--begin::Aside-->
        <div class="col-md-9">
            <!--begin::Card-->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h4 class="card-title"><span class="lstick"></span>بيانات المنتج</h4></div>
                    </div>
                    <div class="d-flex justify-content-between pt-6">
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2">اسم المنتج بالعربية</span>
                            <span class="opacity-70">{{$data->name_ar}}</span>
                        </div>
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2">اسم المنتج بالانجليزية</span>
                            <span class="opacity-70">{{$data->name_en}}</span>
                        </div>
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
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h4 class="card-title"><span class="lstick"></span>فوائد التقسيط</h4></div>
                    </div>
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
            <!--end::Card-->
        </div>
        <div class="col-md-3 " id="kt_profile_aside">
            <!--begin::List Widget 17-->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h4 class="card-title"><span class="lstick"></span>صورة المنتج</h4></div>
                    </div>
                    <div>
                        <!--begin::Item-->
                        <div class="d-flex align-items-center mb-8">
                            <!--begin::Symbol-->
                            <img class="card-img-top img-responsive" src="{{$data->image_path}}" alt="Card image cap">
                        </div>
                        <!--end::Item-->
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h4 class="card-title"><span class="lstick"></span>الموافقه على نشر المنتج ؟</h4></div>
                    </div>
                    <div>
                        <!--begin::Item-->
                       <div class="row">
                           <div class="col-md-6">
                               <a href="{{route('admin.product_requests.change_status',['status'=>'accepted','id'=>$data->id])}}" class="btn btn-success">موافقة
                                   <i class="fa fa-check"> </i>
                               </a>
                           </div>
                           <div class="col-md-6">
                               <a href="{{route('admin.product_requests.change_status',['status'=>'rejected','id'=>$data->id])}}" class="btn btn-danger">
                                   رفض
                                   <i class="fa fa-close"> </i>
                               </a>
                           </div>
                       </div>
                    </div>
                </div>
            </div>

            <!--end::List Widget 17-->
        </div>
        <!--end::Aside-->
        <!--begin::Layout-->

        <!--end::Layout-->
    </div>
    <!--end::Page Layout-->
@endsection
@section('script')
@endsection
