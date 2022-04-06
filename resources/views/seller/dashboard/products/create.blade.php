@php($title='اضافه المنتج')
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
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{route('seller.products.store')}}" enctype="multipart/form-data">
                @csrf
                @include('seller.dashboard.products.form')
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script !src="">
        var avatar1 = new KTImageInput('kt_image_1');
    </script>
    <script>
        // tagging support
        $('#kt_select2_1_modal').select2({
            placeholder: "اختر القسم الرئيسي",
            tags: true
        });
    </script>
    <script>
        // tagging support
        $('#kt_select2_2_modal').select2({
            placeholder: "اختر القسم الفرعي",
            tags: true
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#kt_select2_1_modal').change(function () {
                var level = $(this).val();
                $.ajax({
                    url: "{{url('/')}}/seller/products/get_sub_sections/" + level,
                    dataType: 'html',
                    type: 'get',
                    success: function (data) {
                        $('#sub_section_cont').show();
                        $('#kt_select2_2_modal').html(data);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('submit', 'form', function () {
                $('button').attr('disabled', 'disabled');
            });
        });
    </script>
@endsection
