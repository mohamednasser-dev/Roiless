@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.consolutions')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.consolution.kind')}}</li>
                <li class="breadcrumb-item active"><a href="{{route('consolutions')}}">{{trans('admin.consolutions')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="title">
        <a href="{{route('consolutionKind.create')}} "
           class="btn btn-info btn-bg">{{trans('admin.add.new.consolution.kind')}}</a>
    </div>
    <br>
    <div class="row">
        <table class="table full-color-table full-primary-table">
            <thead>
            <tr>
                <th class="text-lg-center">{{trans('admin.name_in_arabic')}}</th>
                <th class="text-lg-center"> {{trans('admin.name_in_english')}}</th>
                <th class="text-lg-center">{{trans('admin.Measures')}}</th>

            </tr>
            </thead>
            <tbody>
            @foreach($kinds as $kind)
                <tr>
            <td class="text-lg-center">{{$kind->name_ar}}</td>
            <td class="text-lg-center">{{$kind->name_en}}</td>
                    <td class="text-lg-center ">

                        <a class='btn btn-info btn-circle' title="تعديل"
                           href="{{route('consolutionKind.edit',$kind->id)}}"><i class="fa fa-edit"></i></a>

                        <a class='btn btn-danger btn-circle' title="حذف" onclick="return confirm('هل انت متكد من حذف السؤال')"
                           href="{{route('consolutionKind.delete',$kind->id)}}"><i class="fa fa-trash"></i></a>

                    </td>
            @endforeach
                </tr>
            </tbody>
        </table>
        {{ $kinds->links() }}
    </div>
@endsection
