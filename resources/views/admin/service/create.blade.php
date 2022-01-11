@extends('admin_temp')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/dropify/dist/css/dropify.min.css') }}">
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.create_service')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">انشاء خدمه</li>
                <li class="breadcrumb-item"> <a href="{{route('services')}}">{{trans('admin.services')}} </a></li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    {{ Form::open( ['route'  => ['services.store'],'method'=>'post' , 'class'=>'form','files'=>true] ) }}
                    <h4 class="card-title">{{trans('admin.service_info')}}</h4>
                    <hr>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.service_address_in_arabic')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('title_ar',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.service_address_in_english')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('title_en',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">{{trans('admin.service_image')}}</h4>
                                    <input type="file" name="image" id="input-file-now" class="dropify"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card m-b-20">
                        <div class="card-header" style='text-align:right'><strong> {{trans('admin.service_detailes')}} </strong>
                            <div class="card-body parent" style='text-align:right' id="parent">
                                <button type='button' class="btn btn-success" value='Add Button' id='addButton'>
                                    <i class="fa fa-plus"></i></button>
                                <div class="panel" style='text-align:right'>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="center">
                        {{ Form::submit( trans('admin.add') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        @endsection
        @section('scripts')
            <script src="{{ asset('/assets/plugins/dropify/dist/js/dropify.min.js')}}"></script>
            <script>
                $(document).ready(function () {
                    // Basic
                    $('.dropify').dropify();

                    // Translated
                    $('.dropify-fr').dropify({
                        messages: {
                            default: 'Glissez-déposez un fichier ici ou cliquez',
                            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                            remove: 'Supprimer',
                            error: 'Désolé, le fichier trop volumineux'
                        }
                    });

                    // Used events
                    var drEvent = $('#input-file-events').dropify();

                    drEvent.on('dropify.beforeClear', function (event, element) {
                        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
                    });

                    drEvent.on('dropify.afterClear', function (event, element) {
                        alert('File deleted');
                    });

                    drEvent.on('dropify.errors', function (event, element) {
                        console.log('Has Errors');
                    });

                    var drDestroy = $('#input-file-to-destroy').dropify();
                    drDestroy = drDestroy.data('dropify')
                    $('#toggleDropify').on('click', function (e) {
                        e.preventDefault();
                        if (drDestroy.isDropified()) {
                            drDestroy.destroy();
                        } else {
                            drDestroy.init();
                        }
                    })
                });
            </script>
            <script>
                $(document).ready(function () {
                    var i = 0;

                    $("#addButton").click(function () {
                        var options = '';

                        var html = '';
                        html += ' <div id="" class="form-group row">';
                        html += "<div class='col-sm-6'>" +
                            "<input  name='rows[" + i + "][title_ar]' class='form-control' type='text' step ='0.01'  placeholder='ادخل العنوان بالعربيه'>" +

                            "</div>" +

                            "<div class='col-sm-6'>" +
                            "<input   name='rows[" + i + "][title_en]' class='form-control' type='text' step ='0.01'  placeholder='ادخل التفاصيل بالانجليزي'>" +

                            "</div>" +
                            "</br>" +
                            "</br>" +
                        "<div class='col-sm-6'>" +
                            "<input  name='rows[" + i + "][desc_ar]' class='form-control' type='text' step ='0.01'  placeholder='ادخل العنوان بالعربيه'>" +

                            "</div>" +

                            "<div class='col-sm-6'>" +
                            "<input  name='rows[" + i + "][desc_en]' class='form-control' type='text' step ='0.01'  placeholder='ادخل التفاصيل بالانجليزيه'>" +

                            "</div>" +
                            "</hr>" +

                            "</div>";
                        $('#parent').append(html);

                        i++;
                    });
                });
            </script>

@endsection

