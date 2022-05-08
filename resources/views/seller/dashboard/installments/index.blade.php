@if(Request::segment(3)== 'collected')
    @php($title='الاقساط المحصلة')
@else
    @php($title='الاقساط الغير محصلة')
@endif
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
                        <th class="text-lg-center">رقم الطلب</th>
                        <th class="text-lg-center">اسم المنتج</th>
                        <th class="text-lg-center">اسم المستخدم</th>
                        <th class="text-lg-center">المبلغ</th>
                        <th class="text-lg-center">حالة القسط</th>
                        <th class="text-lg-center">تاريخ التحصيل</th>
                        <th class="text-lg-center">التحصيل</th>
{{--                        <th class="text-lg-center">تفاصيل الطلب</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key => $row)
                        <tr>
                            <td class="text-lg-center">{{$row->order_id}}</td>
                            <td class="text-lg-center">{{$row->Order->Product->name}}</td>
                            <td class="text-lg-center">{{$row->Order->User->name}}</td>
                            <td class="text-lg-center">{{$row->amount}}</td>
                            <td class="text-lg-center">{{$row->status_name}}</td>
                            <td class="text-lg-center">{{$row->collection_date}}</td>
                            <td class="text-lg-center">
                                @if($row->status == 'collected')
                                    <a href="{{route('seller.installments.change_status',['status'=> 'pending', 'id'=> $row->id])}}"
                                       title="لم يتم دفع المبلغ" class="btn btn-icon btn-light-danger btn-circle mr-2 ">
                                        <i class="flaticon2-cancel-music"></i>
                                    </a>
                                @else
                                    <a href="{{route('seller.installments.change_status',['status'=> 'collected', 'id'=> $row->id])}}"
                                       title="تم دفع المبلغ"
                                       class="btn btn-icon btn-light-success btn-circle mr-2">
                                        <i class="flaticon2-check-mark"></i>
                                    </a>
                                @endif
                            </td>
{{--                            <td class="text-lg-center">--}}
{{--                                <a href="{{route('seller.products.show',$row->id)}}" title="تفاصيل الطلب"--}}
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
