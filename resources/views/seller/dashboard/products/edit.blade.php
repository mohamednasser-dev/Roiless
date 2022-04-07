@php($title='تعديل المنتج')
@extends('seller.layouts.app')
@section('title')
    {{$title}}
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
            <form method="post" action="{{route('seller.products.update',$data->id)}}" enctype="multipart/form-data">
                @csrf
                @include('seller.dashboard.products.form')
            </form>
        </div>
    </div>
@endsection
@section('script')

@endsection
