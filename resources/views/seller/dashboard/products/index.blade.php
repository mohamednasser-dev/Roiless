@php($title='المنتجات')
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
        <div class="card-header">
            <a href="{{route('seller.products.create')}}"
               class="btn btn-sm btn-light-success font-weight-bolder mr-2">
                <i class="fa fa-plus"></i>اضـافـه</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                    <thead>
                    <tr>
                        <th class="text-lg-center">الصورة</th>
                        <th class="text-lg-center">الاسم</th>
                        <th class="text-lg-center">القسم الرئيسي</th>
                        <th class="text-lg-center">القسم الفرعي</th>
                        <th class="text-lg-center">السعر</th>
                        <th class="text-lg-center">الكمية</th>
                        <th class="text-lg-center">حالة طلب نشر المنتج</th>
                        <th class="text-lg-center">الاجرائات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key => $row)
                        <tr>
                            <td class="text-lg-center"><img style="width: 100px;" src="{{$row->image_path}}"></td>
                            <td class="text-lg-center">{{$row->name}}</td>
                            <td class="text-lg-center">{{($row->Section)?$row->Section->title: ''}}</td>
                            <td class="text-lg-center">{{($row->SubSection)?$row->SubSection->title: ''}}</td>
                            <td class="text-lg-center">{{$row->price}}</td>
                            <td class="text-lg-center">{{$row->quantity}}</td>
                            <td class="text-lg-center">
                                @if($row->status == 'accepted')
                                    <span style="width: 100px;" class="label label-success label-rounded">تم الموافقة</span>
                                @elseif($row->status  == 'rejected')
                                <!-- Button trigger modal-->
                                    <button type="button" title="اضغط هنا لمعرفة سبب الرفض" id="reject_btn" class="btn btn-danger" data-toggle="modal" data-target="#rejectReasonModal" data-reason="{{$row->reject_reason}}">
                                        تم الرفض
                                    </button>
                                @elseif($row->status  == 'pending')
                                    <span style="width: 100px;" class="label label-warning label-rounded">في انتظار الموافقة</span>
                                @endif

                            </td>
                            <td class="text-lg-center">
                                <a href="{{route('seller.products.show',$row->id)}}" title="التفاصيل"
                                   class="btn btn-icon btn-light-success btn-circle mr-2">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{route('seller.products.edit',$row->id)}}" title="تعديل" class="btn btn-icon btn-light-primary btn-circle mr-2">
                                    <i class="flaticon-edit"></i>
                                </a>
                                <a href="{{route('seller.products.delete',$row->id)}}" title="حذف" onclick=" return confirm('هل متاكد من الحذف ؟ ')"
                                   class="btn btn-icon btn-light-danger btn-circle mr-2 ">
                                    <i class="flaticon2-rubbish-bin-delete-button "></i>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
{{--                {!! $dataTable->table() !!}--}}
            </div>
        </div>
    </div>

    <!-- Modal-->
    <div class="modal fade" id="rejectReasonModal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">سبب رفض نشر المنتج</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body" style="height: 300px;">
                    <textarea type="text" class="form-control" id="txt_reason" name="reason" rows="10"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">الغاء
                    </button>
                    {{--                    <button type="button" class="btn btn-primary font-weight-bold">تم</button>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
{{--    {!! $dataTable->scripts() !!}--}}

    <script>
        var id;
        $(document).on('click', '#reject_btn', function () {
            reason = $(this).data('reason');
            $('#txt_reason').val(reason);

        });
    </script>
@endsection
