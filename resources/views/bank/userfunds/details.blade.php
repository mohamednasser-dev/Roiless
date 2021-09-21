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

    <button
        type="button" class="btn btn-info"  data-target="#">الموافقه علي الطلب
    </button>
    <button
        type="button" class="btn btn-dark" data-toggle="modal" data-target="#user">مراجعه الطلب
    </button>
    <div class="row">
        <div class="modal fade" id="user" tabindex="-1" role="dialog" aria-labelledby="userLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="banksLabel1">مراجعه الورق المطلوب مره اخري</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <form class="form"
                          action="{{route('request.rejected',$userfund->id)}}"
                          method="POST">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group has-success">

                                <label class="control-label"> ملحوظه بالعربيه </label>
                                <input type="text" class="form-control" name="note_ar" required>
                                <label class="control-label"> ملحوظه بالانجليزيه </label>
                                <input type="text" class="form-control" name="note_en" required>
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

@endsection
