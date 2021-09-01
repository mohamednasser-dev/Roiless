@extends('admin_temp')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/dropify/dist/css/dropify.min.css') }}">
@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body wizard-content">
               
                <form class="tab-wizard wizard-circle" method="POST" action="{{ route('sliders.update' ,$Slider->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                   @csrf
                    <section>
                  
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailAddress1">Image :</label>
                                    <input type="file" name="image" class="form-control" id="emailAddress1"> </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">الصورة</h4>
                                        <input type="file" name="image" id="input-file-now" class="dropify"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div style="text-align: center" class="row">
                            <div class="col-md-12" style="text-align:center;">
                                <button type="submit" style=" background-color:#0d3d0b; border:none;" class="btn btn-success">تعديل</button>
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
