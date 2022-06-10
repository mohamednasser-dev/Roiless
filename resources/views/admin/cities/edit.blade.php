@extends('admin_temp')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/dropify/dist/css/dropify.min.css') }}">
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">تعديل بيانات الدولة</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">تعديل بيانات الدولة</li>
                <li class="breadcrumb-item"><a href="{{route('cities')}}">{{trans('admin.cities')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">

            {{ Form::open( ['route'  =>  ['cities.update',$data->id],'method'=>'post' , 'class'=>'form','files'=>true] ) }}
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">بيانات الدولة</h4>
                    <hr>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.name_ar')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('name_ar',$data->name_ar,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.name_en')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('name_en',$data->name_en,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.country_code')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('country_code',$data->country_code,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="center">
                            {{ Form::submit(trans('admin.edit') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
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

