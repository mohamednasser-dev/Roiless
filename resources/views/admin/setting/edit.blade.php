@extends('admin_temp')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/dropify/dist/css/dropify.min.css') }}">
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">تعديل اعدادات الموقع</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">اعدادات الموقع</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>

        <div class="row">
            <div class="col-sm-12">

                {{ Form::open( ['route'  =>  ['Setting.update',$setting->id],'method'=>'post' , 'class'=>'form','files'=>true] ) }}
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">بيانات الموقع</h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">لوجو الموقع</h4>
                                        <input type="file" name="logo" data-default-file="{{$setting->logo}}"
                                               id="input-file-now" class="dropify"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6">
                                <div class="form-group m-t-40 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label"> اسم الموقع
                                        بالعربيه</label>
                                    <div class="col-md-10">
                                        {{ Form::text('title_ar',$setting->title_ar,["class"=>"form-control" ,"required"]) }}

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6">
                                <div class="form-group m-t-40 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label"> اسم الموقع
                                        بالانجليزيه</label>
                                    <div class="col-md-10">
                                        {{ Form::text('title_en',$setting->title_en,["class"=>"form-control" ,"required"]) }}

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6">
                                <div class="form-group m-t-40 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">الشروط و الاحكام
                                        بالعربيه</label>
                                    <div class="col-md-10">
                                        {{ Form::text('terms_ar',$setting->terms_ar,["class"=>"form-control" ,"required"]) }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6">
                                <div class="form-group m-t-40 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">الشروط و الاحكام
                                        بالانجليزيه</label>
                                    <div class="col-md-10">
                                        {{ Form::text('terms_en',$setting->terms_en,["class"=>"form-control" ,"required"]) }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6">
                                <div class="form-group m-t-40 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">الخصوصيه
                                        بالعربيه</label>
                                    <div class="col-md-10">
                                        {{ Form::text('privacy_ar',$setting->privacy_ar,["class"=>"form-control" ,"required"]) }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6">
                                <div class="form-group m-t-40 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">الخصوصيه
                                        بالانجليزي</label>
                                    <div class="col-md-10">
                                        {{ Form::text('privacy_en',$setting->privacy_en,["class"=>"form-control" ,"required"]) }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6">
                                <div class="form-group m-t-40 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">
                                        عن االتطبيق بالعربيه
                                        </label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('about_us_ar',$setting->about_us_ar,["class"=>"form-control textarea_editor1" , "rows" => "15" ,"required"]) }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6">
                                <div class="form-group m-t-40 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">عن التطبيق
                                        بالانجليزي</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('about_us_en',$setting->about_us_en,["class"=>"form-control textarea_editor2" , "rows" => "15" ,"required"]) }}
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6">
                                <div class="input-group">
                               <span class="input-group-addon" id="basic-addon1">
                                    <i class="icon-social-facebook"></i>
                                </span>
                                    {{ Form::url('facebook',$setting->facebook,["class"=>"form-control"]) }}
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">
                                    <i class="icon-social-youtube"></i>
                                </span>
                                    {{ Form::url('youtube',$setting->youtube,["class"=>"form-control" ]) }}
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6">
                                <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">
                                    <i class=" icon-social-gplus"></i>
                                </span>
                                    {{ Form::url('gmail',$setting->gmail,["class"=>"form-control" ]) }}
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6">
                                <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">
                                    <i class="icon-social-twitter"></i>
                                </span>
                                    {{ Form::url('instagram',$setting->instagram,["class"=>"form-control" ]) }}
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6">
                                <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">
                                    <i class="icon-social-linkedin"></i>
                                </span>
                                    {{ Form::url('linkedin',$setting->linkedin,["class"=>"form-control"]) }}
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6">
                                <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">
                                    <i class="icon-social-instagram"></i>
                                </span>
                                    {{ Form::url('twitter',$setting->twitter,["class"=>"form-control" ]) }}
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-body">
                                    <div class="center">
                                        {{ Form::submit('تحديث' ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
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

