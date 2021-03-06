@extends('admin_temp')
@section('content')

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">تحركات الموظف</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"> تحركات الموظف</li>
                <li class="breadcrumb-item"><a href="{{url('employer')}}">{{trans('admin.employers')}}</a></li>
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <br>
    <div class="row">
        <table class="table full-color-table full-primary-table">
            <thead>
            <tr>
                <th scope="col">{{trans('admin.log_name')}}</th>
                <th scope="col">{{trans('admin.description')}}</th>
                <th scope="col">{{trans('admin.created_at')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($activities as $activity)
                <tr>
                    <th scope="row">{{$activity->log_name}}</th>
                    <td>{{$activity->description}}</td>
                    <td>{{$activity->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
