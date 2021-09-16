@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">التمويلات المطلوبه</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">التمويلات المطلوبه</li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">الصفحة الرئيسية</a></li>
            </ol>
        </div>
    </div>

    <br>
    <div class="row">
        <table class="table full-color-table full-primary-table">
            <thead>
            <tr>
                <th class="text-lg-center">اسم التمويل</th>
                <th class="text-lg-center">المراجعه</th>

            </tr>
            </thead>

            <tbody>

            @foreach($usefunds as $usefund)


                        <tr>

                            <td class="text-lg-center">{{$usefund->userfunds->name_ar}}</td>
                            <td class="text-lg-center ">
                                @if(is_null($usefund->emp_id))
                                <a class='btn btn-danger btn-circle' title="المراجعه"

                                   href="{{route('employerchosen',$usefund->id)}}"><i class="fa fa-eye"></i></a>
                                @endif

                                @if(($usefund->emp_id == auth()->user()->id))
                                <a class='btn btn-info btn-circle' title="متابعه"

                                   href="{{route('review',$usefund->id)}}"><i class="fa fa-pencil-square-o"></i></a>
                                @endif

                            </td>
                        </tr>

                        @endforeach
            </tbody>
        </table>
    </div>




@endsection

