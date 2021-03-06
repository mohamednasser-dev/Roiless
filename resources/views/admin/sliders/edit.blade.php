@extends('admin_temp')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/dropify/dist/css/dropify.min.css') }}">
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.edit_advertisment')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.edit_advertisment')}}</li>
                <li class="breadcrumb-item"><a href="{{route('sliders')}}"> {{trans('admin.sliders')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
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
                                    <label for="emailAddress1">{{trans('admin.image')}} :</label>
                                    <input type="file" name="image" class="form-control" id="emailAddress1"> </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">{{trans('admin.image')}}</h4>
                                        <input type="file" name="image"  data-default-file="{{$Slider->image}}" id="input-file-now" class="dropify"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">{{trans('admin.type')}} </h4>
                                        <select name="type" class="form-control">
                                            <option @if($fund->type == "product") selected @endif value="product">{{trans('admin.product')}}</option>
                                            <option @if($fund->type == "fund") selected @endif value="fund">{{trans('admin.fund')}}</option>
                                            <option @if($fund->type == "investment") selected @endif value="investment">{{trans('admin.investment')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">{{trans('admin.t_id')}} </h4>
                                        <input type="text" name="t_id" placeholder="1" value="{{$Slider->t_ids}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="text-align: center" class="row">
                            <div class="col-md-12" style="text-align:center;">
                                <button type="submit" style=" background-color:#0d3d0b; border:none;" class="btn btn-success">??????????</button>
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
                            default: 'Glissez-d??posez un fichier ici ou cliquez',
                            replace: 'Glissez-d??posez un fichier ou cliquez pour remplacer',
                            remove: 'Supprimer',
                            error: 'D??sol??, le fichier trop volumineux'
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
