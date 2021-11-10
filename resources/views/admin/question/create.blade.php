@extends('admin_temp')
@section('styles')
<link rel="stylesheet" href="{{ asset('/assets/plugins/dropify/dist/css/dropify.min.css') }}">
    <link href="{{ asset('/assets/plugins/summernote/dist/summernote.css') }}" rel="stylesheet" >
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.create_question')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.create_question')}}</li>
                <li class="breadcrumb-item"><a href="{{route('question')}}">الاسئله الشائعه </a></li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    {{ Form::open( ['route'  => ['question.store'],'method'=>'post' , 'class'=>'form','files'=>true] ) }}
                    <h4 class="card-title">{{trans('admin.service_info')}}</h4>
                    <hr>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.question_in_arabic')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('question_ar',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.question_in_englishe')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('question_en',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.answer_in_arabic')}}</label>
                        <div class="col-md-10">
                        {{ Form::textarea('answer_ar',null,["class"=>"form-control summernote" , "rows" => "5" ,"required"]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.answer_in_english')}}</label>
                        <div class="col-md-10">
                        {{ Form::textarea('answer_en',null,["class"=>"form-control summernote" , "rows" => "5" ,"required"]) }}
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
    <script src="{{ asset('/js/custom.min.js')}}"></script>
    <script src="{{ asset('/assets/plugins/summernote/dist/summernote.min.js')}}"></script>
    <script>
        jQuery(document).ready(function() {

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

        window.edit = function() {
            $(".click2edit").summernote()
        },
            window.save = function() {
                $(".click2edit").summernote('destroy');
            }
    </script>

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
@endsection


