@extends('admin_temp')
@section('content')

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">التمويلات المقدمه للبنك</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">التمويلات المقدمه للبنك</li>
                <li class="breadcrumb-item active"><a href="{{route('banks.index')}}">{{trans('admin.banks')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <br>
    <div class="row">
        <table class="table full-color-table full-primary-table">
            <thead>
            <tr>
                <th class="text-lg-center"> اسم التمويل</th>
                <th class="text-lg-center">اسم الموظف</th>
{{--                <th class="text-lg-center">مراجعه</th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($BankFunds as $BankFund )
                <tr>
                    <td class="text-lg-center">{{$BankFund->Fund->name_ar}}</td>
                    <td class="text-lg-center ">
                        {{$BankFund->ُEmployer->name}}                    </td>
{{--                    <td class="text-lg-center ">--}}
{{--                        @if($BankFund->emp_id == auth()->user()->id)--}}
{{--                            <a class='btn btn-danger btn-circle' title="المراجعه"--}}
{{--                            ><i class="fa fa-eye"></i></a>--}}
{{--                        @endif--}}
{{--                    </td>--}}
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>


@endsection
