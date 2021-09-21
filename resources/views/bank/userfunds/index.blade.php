@extends('bank.bank_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">التمويلات المطلوبه</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">التمويلات المطلوبه</li>
                <li class="breadcrumb-item active"><a href="{{route('bank.home')}}">الصفحة الرئيسية</a></li>
            </ol>
        </div>
    </div>

    <br>
    <div class="row">
        <table class="table full-color-table full-primary-table">
            <thead>
            <tr>
                <th class="text-lg-center">اسم التمويل</th>
                <th class="text-lg-center">اسم الموظف</th>
                <th class="text-lg-center">المراجعه</th>

            </tr>
            </thead>

            <tbody>

            @foreach($userfunds as $userfund)
                        <tr>
                            <td class="text-lg-center">{{$userfund->Fund->name_ar}}</td>
                            <td class="text-lg-center">{{$userfund->ُEmployer->name}}</td>
                            <td class="text-lg-center ">
                                <a class='btn btn-info btn-circle' title="تفاصيل"
                                   href="{{route('request.review',$userfund->id)}}"><i class="fa fa-eye"></i></a>

                            </td>
                        </tr>

                        @endforeach
            </tbody>
        </table>
    </div>




@endsection

