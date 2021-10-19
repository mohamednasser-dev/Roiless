@extends('admin_temp')
@section('content')

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"> تحركات الموظفين </h3>
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
            <table class="table full-color-table full-primary-table">
                    <thead class="bg-primary">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">{{trans('admin.moves')}}</th>
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
                                
                               {{$activity->Admin->name}}
                            </td>
                            <td>{{$activity->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    <div class="d-flex justify-content-center">
                    {{ $activities->links() }}
                    </div>
            </div>
    </div>
@endsection
