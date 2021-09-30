@extends('admin_temp')
@section('content')

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">تحركات الموظفين</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"> تحركات الموظفين</li>
                <li class="breadcrumb-item"><a href="{{url('employer')}}">{{trans('admin.employers')}}</a></li>
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <br>
    <div class="row">
            <div class="table-responsive m-t-40">
                <table id="example23" class="display full-color-table full-primary-table  nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead class="bg-primary">
                    <tr>
                        <th scope="col">{{trans('admin.log_name')}}</th>
                        <th scope="col">{{trans('admin.description')}}</th>
                        <th scope="col">{{trans('admin.name_employee')}}</th>
                        <th scope="col">{{trans('admin.created_at')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($activities as $activity)
                        <tr>
                            <th scope="row">{{$activity->log_name}}</th>
                            <td>{{$activity->description}}</td>
                            <td>
                                @if ($activity->employees !== null)
                                    {{$activity->employees->name}}
                                @endif
                            </td>
                            <td>{{$activity->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>
@endsection
