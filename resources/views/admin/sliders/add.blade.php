@extends('admin_temp')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/dropify/dist/css/dropify.min.css') }}">
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">انشاء اعلان</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">انشاء اعلان</li>
                <li class="breadcrumb-item"><a href="{{route('sliders')}}">اعلانات</a></li>
                <li class="breadcrumb-item active"><a href="{{('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body wizard-content">

                <form class="tab-wizard wizard-circle" method="POST" action="{{ route('sliders.store') }}" enctype="multipart/form-data">
                   @csrf
                    <section>


                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"> الصورة</h4>
                                        <input type="file" name="image" id="input-file-now" class="dropify"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="text-align: center" class="row">
                            <div class="col-md-12" style="text-align:center;">
                                <button type="submit" style=" margin:10px"
                                        class="btn btn-info">انشاء
                                </button>
                            </div>
                        </div>
                    </section>


                </form>
            </div>
        </div>
    </div>
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

