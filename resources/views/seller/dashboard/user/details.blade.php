@php($title='التفاصيل')
@extends('adminLayouts.app')
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
            @can('read-users')
                <li class="breadcrumb-item">
                    <a href="{{route('users')}}"
                       class="text-muted">العملاء</a>
                </li>
            @endcan
            <li class="breadcrumb-item">
                <a href="{{route('admin')}}"
                   class="text-muted">الصفحة الرئيسية</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection
@section('content')

        <div class="card">
            <div class="card-body row">
                <div class="form-group  col-4">
                    <label>الاسم<span
                            class="text-danger">*</span></label>
                    <input name="name" placeholder="ادخل الاسم" value="{{  $data->name ?? ''}}" class="form-control "
                           type="text"
                           maxlength="255" disabled/>
                </div>
                <div class="form-group  col-4">
                    <label>البريد الالكتروني<span
                            class="text-danger">*</span></label>
                    <input name="email" placeholder="ادخل البريد الالكتروني" value="{{ $data->email ?? ''}}"
                           class="form-control  " type="email"
                           maxlength="255" disabled/>
                </div>
                <div class="form-group  col-4">
                    <label>رقم الهاتف<span
                            class="text-danger">*</span></label>
                    <input name="phone" placeholder="ادخل رقم الهاتف" value="{{  $data->phone ?? '' }}"
                           class="form-control  " type="tel"
                           maxlength="255" disabled/>
                </div>
                <div class="form-group col-md-6">
                    <label>صوره العميل </label>
                    <div class="col-lg-8">

                        <div class="image-input image-input-outline" id="kt_image_1">
                            <div class="image-input-wrapper"
                                 style="background-image: url({{old('image', $data->image ?? 'default-image.png' )}})"></div>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-warning btn-shadow"
                                  data-action="cancel" data-toggle="tooltip" title="Cancel avatar">

                      <i class="ki ki-bold-close icon-xs text-muted"></i>
                     </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>







@endsection
@section('script')
@endsection
