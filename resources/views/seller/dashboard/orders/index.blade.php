@php($title='الطلبات')
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
                <a href="{{route('seller.home')}}"
                   class="text-muted">الصفحة الرئيسية</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                    <thead>
                    <tr>
                        <th class="text-lg-center">صورة المنتج</th>
                        <th class="text-lg-center">اسم المنتج</th>
                        <th class="text-lg-center">اسم المستخدم</th>
                        <th class="text-lg-center">نوع التقسيط</th>
                        <th class="text-lg-center">سعر المنتج بدون اقساط</th>
                        <th class="text-lg-center">سعر المنتج بالاقساط</th>
                        <th class="text-lg-center">تاريخ الطلب</th>
                        <th class="text-lg-center">حالة الطلب</th>
                        <th class="text-lg-center">الموافقة</th>
{{--                        <th class="text-lg-center">تفاصيل الطلب</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key => $row)
                        <tr>
                            <td class="text-lg-center"><img style="width: 100px;height: 100px;" src="{{$row->Product->image_path}}"></td>
                            <td class="text-lg-center">{{$row->Product->name}}</td>
                            <td class="text-lg-center">{{$row->User->name}}</td>
                            <td class="text-lg-center">{{$row->type_name}}</td>
                            <td class="text-lg-center">{{$row->price}}</td>
                            <td class="text-lg-center">{{$row->total}}</td>
                            <td class="text-lg-center">{{$row->created_at->format('Y-m-d g:i a')}}</td>
                            <td class="text-lg-center">
                                {{$row->status_name}}
                            </td>
                            <td class="text-lg-center">
                                @if($row->status == 'pending')
                                    <a href="{{route('seller.orders.change_status',['status'=> 'accepted', 'id'=> $row->id])}}"
                                       title="موافقة"
                                       class="btn btn-icon btn-light-success btn-circle mr-2">
                                        <i class="flaticon2-check-mark"></i>
                                    </a>
                                    <a href="{{route('seller.orders.change_status',['status'=> 'rejected', 'id'=> $row->id])}}"
                                       title="رفض" class="btn btn-icon btn-light-danger btn-circle mr-2 ">
                                        <i class="flaticon2-cancel-music"></i>
                                    </a>
                                @elseif($row->status == 'accepted')
                                    <a href="{{route('seller.orders.change_status',['status'=> 'rejected', 'id'=> $row->id])}}"
                                       title="رفض" class="btn btn-icon btn-light-danger btn-circle mr-2 ">
                                        <i class="flaticon2-cancel-music"></i>
                                    </a>
                                @elseif($row->status == 'rejected')
                                    <a href="{{route('seller.orders.change_status',['status'=> 'accepted', 'id'=> $row->id])}}"
                                       title="موافقة"
                                       class="btn btn-icon btn-light-success btn-circle mr-2">
                                        <i class="flaticon2-check-mark"></i>
                                    </a>
                                @endif
                            </td>
{{--                            <td class="text-lg-center">--}}
{{--                                <a href="{{route('seller.products.show',$row->id)}}" title="التفاصيل"--}}
{{--                                   class="btn btn-icon btn-light-primary btn-circle mr-2">--}}
{{--                                    <i class="fas fa-eye"></i>--}}
{{--                                </a>--}}
{{--                            </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection
@section('script')
{{--    {!! $dataTable->scripts() !!}--}}
@endsection
