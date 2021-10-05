@extends('admin_temp')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/dropify/dist/css/dropify.min.css') }}">
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.edit_service')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.edit_service')}}</li>
                <li class="breadcrumb-item"><a href="ٌ{{route('services')}}">{{trans('admin.services')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">

            {{ Form::open( ['route'  =>  ['services.update',$Service->id],'method'=>'post' , 'class'=>'form','files'=>true] ) }}
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{trans('admin.service_info')}}</h4>
                    <hr>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.service_address_in_arabic')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('title_ar',$Service->title_ar,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.service_address_in_english')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('title_en',$Service->title_ar,["class"=>"form-control" ,"required"]) }}
                        </div>
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

