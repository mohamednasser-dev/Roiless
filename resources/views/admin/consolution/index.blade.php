@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.funds')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.funds')}}</li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="title">
        <a href="{{route('fund.create')}} "
           class="btn btn-info btn-bg">{{trans('admin.add_fund')}}</a>
    </div>
    <br>
    <div class="row">
        <table class="table full-color-table full-primary-table">
            <thead>
            <tr>
                <th class="text-lg-center">{{trans('admin.consolution_name_user')}}</th>
                <th class="text-lg-center"> {{trans('admin.consolution_email')}}</th>
                <th class="text-lg-center">{{trans('admin.consolution_phone')}}</th>
                <th class="text-lg-center">{{trans('admin.consolution_kind')}}</th>
                <th class="text-lg-center">{{trans('admin.main_Measures')}}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($consolutions as $consolution)
                <tr>
                    <td class="text-lg-center">{{$consolution->full_name}}</td>
                    <td class="text-lg-center">{{$consolution->email}}</td>
                    <td class="text-lg-center">{{$consolution->phone}}</td>
                    <td class="text-lg-center">{{$consolution->consolution_kind->name_ar}}</td>
                    
                   
                    <td class="text-lg-center ">
                        <a class='btn btn-info btn-circle' title="عرض"
                           href="{{route('consolutions.show',$consolution->id)}}"><i class="fa fa-eye"></i></a>

                        <a class='btn btn-danger btn-circle' title="حذف"
                           onclick="return confirm('هل انت متكد من حذف الخدمه')"
                           href="{{route('delete',$consolution->id)}}"><i class="fa fa-trash"></i></a>

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>




@endsection
