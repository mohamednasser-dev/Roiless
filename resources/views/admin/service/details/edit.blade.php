@extends('admin_temp')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/dropify/dist/css/dropify.min.css') }}">
    <link href="{{ asset('/assets/plugins/summernote/dist/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}"
          rel="stylesheet"/>
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.edit')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.edit')}}</li>
                <li class="breadcrumb-item"><a href="{{route('services')}}">{{trans('admin.services')}} </a></li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open( ['route'  => ['services.details.update',$service_details->id],'method'=>'post' , 'class'=>'form','files'=>true] ) }}
                    <h4 class="card-title">بيانات تفاصيل الخدمه</h4>
                    <hr>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">عنوان
                            بالعربيه</label>
                        <div class="col-md-10">
                            {{ Form::text('title_ar',$service_details->title_ar,["class"=>"form-control" ,"required"]) }}
                            {{ Form::hidden('service_id',$service_details->service_id,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">عنوان
                            بالانجليزيه</label>
                        <div class="col-md-10">
                            {{ Form::text('title_en',$service_details->title_en,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">محتوي
                            بالعربيه</label>
                        <div class="col-md-10">
                            {{ Form::textarea('desc_ar',$service_details->desc_ar,["class"=>"form-control summernote" , "rows" => "15" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">محتوي
                            بالانجليزيه</label>
                        <div class="col-md-10">
                            {{ Form::textarea('desc_en',$service_details->desc_en,["class"=>"form-control summernote" , "rows" => "15" ,"required"]) }}

                        </div>
                    </div>

                    <div class="center">
                        {{ Form::submit( 'تعديل' ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
@endsection

        @section('scripts')
            <script src="{{ asset('/assets/plugins/select2/dist/js/select2.full.min.js')}}"></script>
            <script src="{{ asset('/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
            <script src="{{ asset('/assets/plugins/dropify/dist/js/dropify.min.js')}}"></script>
            <script src="{{ asset('/assets/plugins/dropify/dist/js/dropify.min.js')}}"></script>
            <script src="{{ asset('/js/custom.min.js')}}"></script>
            <script src="{{ asset('/assets/plugins/summernote/dist/summernote.min.js')}}"></script>
            <script>
                jQuery(document).ready(function () {
                    $('.summernote').summernote({
                        height: 350, // set editor height
                        minHeight: null, // set minimum height of editor
                        maxHeight: null, // set maximum height of editor
                        focus: false // set focus to editable area after initializing summernote
                    });
                    $('.inline-editor').summernote({
                        airMode: true
                    });
                });
                window.edit = function () {
                    $(".click2edit").summernote()
                },
                    window.save = function () {
                        $(".click2edit").summernote('destroy');
                    }
            </script>

            <script>
                $(document).ready(function () {
                    $('.dropify').dropify();
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
                        html += "<div class='col-lg-4'>" +
                            "<input  name='adress[" + i + "][adress_ar]' class='form-control' type='text' step ='0.01'  placeholder='ادخل العنوان بالعربيه'>" +

                            "</div>" +

                            "<div class='col-lg-4'>" +
                            "<input   name='adress[" + i + "][adress_en]' class='form-control' type='text' step ='0.01'  placeholder='ادخل العنوان بالانجليزي'>" +
                            "</div>" +
                            "<div class='col-lg-4'>" +
                            "<input   name='adress[" + i + "][url]' class='form-control' type='url' step ='0.01'  placeholder='ادخل رابط الخريطه'>" +

                            "</div>" +
                            "</br>" +

                            "</div>" +
                            "</hr>" +

                            "</div>";
                        $('#parent').append(html);

                        i++;
                    });
                });
            </script>
@endsection
