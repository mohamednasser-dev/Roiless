@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.branches_banks')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.banks')}}</li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="title">
        <a href="{{url('banks/create/'.$id)}}"
           class="btn btn-info btn-bg">{{trans('admin.add_branche_bank')}}</a>
    </div>
    <br>
    <div class="row">
        <div class="table-responsive ">
            <table
                   class="table full-color-table full-primary-table"

                <thead class="bg-primary">
                <tr>
                    <th scope="col">{{trans('admin.name')}}</th>
                    <th scope="col">{{trans('admin.image')}}</th>
                    <th scope="col">
                        {{trans('admin.actions')}}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($branches as $branch)
                    <tr>
                        <th scope="row">{{$branch->name_ar}}</th>
                        <td>
                            <img src="{{$branch->image}}" class="img-fluid"
                                 style="width: 100px; height: 100px; border-radius: 15px" alt="">
                        </td>
                        <td>
                            <ul class="list-inline soc-pro m-t-30">
                                <li><a class="btn-circle btn btn-info" title="التمويلات"
                                       href="{{route('funds.of.bank',$branch->id)}}"><i class="fa fa-money"></i></a>
                                </li>
                                <li><a class="btn-circle btn btn-success" title="تعديل"
                                       href="{{url('banks/'.$branch->id.'/edit')}}"><i class="fa fa-edit"></i></a></li>
                                <li><a class="btn-circle btn btn-info" title="التفاصيل"
                                       href="{{route('banks.details',$branch->id)}}"><i class="fa fa-eye"></i></a></li>
                                <li><a class="btn-circle btn btn-danger" title="حذف"
                                       onclick="return confirm('هل انت متاكد من حذف البنك')"
                                       href="{{route('banks.delete',$branch->id)}}"><i class="fa fa-trash"></i></a></li>

                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
  
@endsection
