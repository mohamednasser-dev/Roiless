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
                <li class="breadcrumb-item active"><a
                        href="{{url('/admin/product/requests')}}">{{trans('admin.add_product_requests')}}</a></li>
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
                            <span class="font-weight-bolder mb-2" style="color: black;">اسم المنتج بالعربية</span>
                            <span class="opacity-70">{{$data->name_ar}}</span>
                        </div>
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2" style="color: black;">اسم المنتج بالانجليزية</span>
                            <span class="opacity-70">{{$data->name_en}}</span>
                        </div>
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2" style="color: black;">سعر المنتج</span>
                            <span class="opacity-70">{{$data->price}}</span>
                        </div>
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2" style="color: black;">كمية المنتج</span>
                            <span class="opacity-70">{{$data->quantity}}</span>
                        </div>
                        @if($data->Section)
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2" style="color: black;">القسم الرئيسي</span>
                                <span class="opacity-70">{{$data->Section->title}}</span>
                            </div>
                        @endif
                        @if($data->SubSection)
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2" style="color: black;">القسم الفرعي</span>
                                <span class="opacity-70">{{$data->SubSection->title}}</span>
                            </div>
                        @endif
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2" style="color: black;">نوع التقسيط</span>
                            <span class="opacity-70">@if($data->type == 'direct_installment')   تقسيط مباشر@else   تقسيط
                                غير مباشر @endif </span>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($benefits) > 0 )
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
                                        <td class="text-primary border-top-0 pr-0 py-4 text-right align-middle"> {{$row->ratio}}
                                            %
                                        </td>
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
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title align-items-start flex-column mb-5">
                                <div class="d-flex">
                                    <div>
                                        <h4 class="card-title"><span class="lstick"></span>وصف المنتج بالعربية</h4>
                                    </div>
                                </div>

                            </h3>
                            <div class="table-responsive">
                                {{$data->body_ar}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3 class="card-title align-items-start flex-column mb-5">
                                <div class="d-flex">
                                    <div>
                                        <h4 class="card-title"><span class="lstick"></span>وصف المنتج بالانجليزية</h4>
                                    </div>
                                </div>
                            </h3>
                            <div class="table-responsive">
                                {{$data->body_en}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($data->Images) > 0 )
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h3 class="card-title align-items-start flex-column mb-5">
                                <div class="d-flex">
                                    <div>
                                        <h4 class="card-title"><span class="lstick"></span>صور المنتج</h4></div>
                                </div>
                            </h3>
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="carousel-item active">
                                        <div class="col-12">
                                            @foreach($data->Images as $c)
                                                <img class="p-2" style="height: 150px; width: 150px;"
                                                     src="{{$c->image_path}}">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endif
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
                            @if($data->status == 'rejected' || $data->status == 'pending')
                            <div class="col-md-6">
                                <a
                                    @if($data->type =='direct_installment')
                                        href="{{route('admin.product_requests.change_status',['status'=>'accepted','id'=>$data->id])}}"
                                   @else
                                        href="javascript:void(0);" data-toggle="modal" data-target="#accept_modal"
                                   @endif
                                   class="btn btn-success">موافقة
                                    <i class="fa fa-check"> </i>
                                </a>
                            </div>
                            @endif
                            @if($data->status == 'accepted' || $data->status == 'pending')
                                <div class="col-md-6">
                                    <a  href="javascript:void(0);" data-toggle="modal" data-target="#reject_modal"
                                       class="btn btn-danger">
                                        رفض
                                        <i class="fa fa-close"> </i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--   accept model--}}
    <div class="modal fade" id="accept_modal" tabindex="-1" role="dialog" aria-labelledby="banksLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="banksLabel1">الموافقة على نشر المنتج</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form class="form"
                      action="{{route('admin.product_requests.accept')}}"
                      method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="col-md-12">
                        <div class="form-group has-success">
                            <label class="control-label"> اختر قسم التمويل </label>
                            <select class="select2 m-b-10 select2-multiple" name="fund_id" style="width: 100%"
                                    required data-placeholder="اختر قسم التمويل">
                                @if(count($funds) > 0)
                                    @foreach($funds as $fund)
                                        <option value="{{$fund->id}}"> {{$fund->name_ar}} ( {{$fund->Category->title_ar}} )</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-primary">تأكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reject_modal" tabindex="-1" role="dialog" aria-labelledby="banksLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="banksLabel1">رفض نشر المنتج</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form class="form"
                      action="{{route('admin.product_requests.reject')}}"
                      method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="col-md-12">
                        <div class="form-group has-success">
                            <label class="control-label"> اكتب سبب رفطك لنشر المنتج </label>
                            <textarea class="form-control" name="reject_reason" required rows="10" ></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-primary">تأكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
