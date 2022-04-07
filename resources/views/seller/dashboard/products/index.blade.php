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
            {!! $dataTable->table() !!}
        </div>
    </div>

    <!-- Modal-->
    <div class="modal fade" id="rejectReasonModal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
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
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">الغاء</button>
{{--                    <button type="button" class="btn btn-primary font-weight-bold">تم</button>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {!! $dataTable->scripts() !!}

    <script>
        var id;
        $(document).on('click', '#reject_btn', function () {
            reason = $(this).data('reason');
            $('#txt_reason').val(reason);

        });
    </script>
@endsection
