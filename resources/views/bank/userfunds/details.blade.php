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


    <div class="row row-cols-2">
        {{--Start dataform --}}
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>{{trans('admin.date_preview')}}</h3>

                        @foreach(json_decode($userfund->dataform, true) as $data)

                            <h3 class="control-label">{{ $data['name'] }}</h3>
                            <input type="text" id="firstName" class="form-control" value="{{ $data['value'] }} " readonly>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        {{--end dataform --}}



    </div>

    {{--Start fund photos --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>{{trans('admin.img_preview')}}</h5>
                    </div>

                    <div id="image-popups" class="row">
                        @foreach($userfund->Files_img as $file)

                            <div class="col-lg-2 col-md-4">
                                <a href="{{asset('/uploads/fund_file').'/'.$file->file_name}}"
                                   data-effect="mfp-zoom-in"><img
                                        src="{{asset('/uploads/fund_file').'/'.$file->file_name}}"
                                        class="img-responsive"/></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--end fund photos --}}

    {{--Start fund pdf --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>{{trans('admin.pdf_preview')}}</h5>
                    </div>

                    <div id="image-popups" class="row">

                        @foreach($userfund->Files_pdf as $file)
                            <div class="col-6">
                                <iframe src="{{asset('/uploads/fund_file').'/'.$file->file_name}}" style="width:600px; height:500px;"></iframe>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end fund pdf --}}

    <div class="row">
        <div class="card col-12 ">
            <div class="card-body  center">

                <button
                    type="button" class="btn btn-info" data-target="#">الموافقه علي الطلب
                </button>
                <button
                    type="button" class="btn btn-dark" data-toggle="modal" data-target="#user">مراجعه الطلب
                </button>
            </div>
        </div>
    </div>


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
