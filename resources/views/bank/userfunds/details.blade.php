@extends('bank.bank_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">مراجعه التمويلات</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">مراجعه طلب التمويل</li>
                <li class="breadcrumb-item active"><a href="{{route('bank.home')}}">الصفحة الرئيسية</a></li>
            </ol>
        </div>
    </div>


    {{--
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Empoloyers">
        لا يمكنني اتخاذ القرار
    </button>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#banks">
        الموافقه علي الطلب
    </button>

    <div class="row">
        <div class="modal fade" id="Empoloyers" tabindex="-1" role="dialog" aria-labelledby="EmpoloyersLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="EmpoloyersLabel1">اختر الموظف</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <form class="form"
                          action="{{route('fund.redirect.emp',$requestreview->id)}}"
                          method="POST">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group has-success">
                                <label class="control-label"> الموظفين </label>
                                <select class="form-control custom-select" name="emp_id">
                                    @foreach($empolyers as $empolyer )
                                        <option value="{{$empolyer->id}}">{{$empolyer->name}}</option>
                                    @endforeach
                                </select>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">اختيار</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
    <div class="row">
        <div class="modal fade" id="banks" tabindex="-1" role="dialog" aria-labelledby="banksLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="banksLabel1">اختر الموظف</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <form class="form"
                          action="{{route('fund.redirect.bank',$requestreview->id)}}"
                          method="POST">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group has-success">
                                <label class="control-label"> البنوك </label>
                                <select class="form-control custom-select" name="bank_id">
                                    @foreach($banks as $bank)
                                        <option value="{{$bank->id}}">{{$bank->name_ar}}</option>
                                    @endforeach
                                </select>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">اختيار</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
 --}}
@endsection
