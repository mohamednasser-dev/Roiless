@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.Required_funds')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.Required_funds')}}</li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="d-flex">
    <a class="btn btn-info ml-auto" href="{{route('export_userfund')}}">تصدير الي اكسيل</a>
   </div>
    <br>
    <div class="row">
        <table class="table full-color-table full-primary-table">
            <thead>
            <tr>
                <th class="text-lg-center">ID</th>
                <th class="text-lg-center">{{trans('admin.date')}}</th>
                <th class="text-lg-center">{{trans('admin.user')}}</th>
                <th class="text-lg-center">{{trans('admin.request')}}</th>
                <th class="text-lg-center">{{trans('admin.status')}}</th>
                <th class="text-lg-center">{{trans('admin.revision')}}</th>
            </tr>
            </thead>
            <tbody>
                @foreach($usefunds as $usefund)
                    <tr>
                        <td class="text-lg-center">{{$usefund->id}}</td>
                        <td class="text-lg-center">{{$usefund->created_at->format('Y-m-d g:i a')}}</td>
                        <td class="text-lg-center">{{$usefund->Users->name}}</td>
                        <td class="text-lg-center">{{$usefund->Fund->name_ar}}</td>
                        <td class="text-lg-center">{{$usefund->payment}}</td>
                        <td class="text-lg-center ">
                            @if(is_null($usefund->emp_id))
                                <a class='btn btn-danger btn-circle' title="المراجعه"
                                href="{{route('employerchosen',$usefund->id)}}"><i class="fa fa-eye"></i></a>
                            @elseif(($usefund->emp_id == auth()->user()->id) && $usefund->bank_id == null)
                            <a class='btn btn-info btn-circle' title="{{trans('admin.follow')}}"
                                href="{{route('review',$usefund->id)}}"><i class="fa fa-pencil-square-o"></i></a>
                                @else
                                {{$usefund->ُEmployer->name}}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $usefunds->links() }}
    </div>
@endsection

