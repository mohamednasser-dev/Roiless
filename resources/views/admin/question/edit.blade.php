@extends('admin_temp')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/dropify/dist/css/dropify.min.css') }}">
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">تعديل سؤال</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">تعديل سؤال</li>
                <li class="breadcrumb-item"><a href="ٌ{{route('question')}}">الخدمات</a></li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">الرئيسيه</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">

            {{ Form::open( ['route'  =>  ['question.update',$question->id],'method'=>'post' , 'class'=>'form','files'=>true] ) }}
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">بيانات السؤال</h4>
                    <hr>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">عنوان الخدمه بالعربي</label>
                        <div class="col-md-10">
                            {{ Form::text('question_ar',$question->question_ar,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">عنوان الخدمه بالانجليزي</label>
                        <div class="col-md-10">
                            {{ Form::text('question_en',$question->question_en,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">عنوان الخدمه بالانجليزي</label>
                        <div class="col-md-10">
                            {{ Form::text('answer_ar',$question->answer_ar,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">عنوان الخدمه بالانجليزي</label>
                        <div class="col-md-10">
                            {{ Form::text('answer_en',$question->answer_en,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>
                    @isset($question->image)

                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">صورة السؤال</h4>
                                        <input type="file" data-default-file="{{$question->image}}" name="image"
                                               id="input-file-now" class="dropify"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endisset
                    <div class="card">
                        <div class="card-body">
                            <div class="center">
                                {{ Form::submit('تعديل' ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{ Form::close() }}
    </div>
@endsection
@section('scripts')
    <!-- ============================================================== -->
    <!-- Plugins for this page -->
    <!-- ============================================================== -->
    <!-- jQuery file upload -->

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
@endsection

