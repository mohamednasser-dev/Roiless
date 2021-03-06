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
            <h3 class="text-themecolor">{{trans('admin.edit_setting_of_website')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.website_setting')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            {{ Form::open( ['route'  =>  ['Setting.update',$setting->id],'method'=>'post' , 'class'=>'form','files'=>true] ) }}
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{trans('admin.website_info')}}</h4>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">{{trans('admin.website_logo')}}</h4>
                                    <input type="file" name="logo" data-default-file="{{$setting->logo}}"
                                           id="input-file-now" class="dropify"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">{{trans('admin.basic_all_cat_image')}}</h4>
                                    <input type="file" name="all_category_image" data-default-file="{{$setting->all_category_image}}"
                                           id="input-file-now" class="dropify"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">{{trans('admin.basic_investment_image')}}</h4>
                                    <input type="file" name="invest_image" data-default-file="{{$setting->invest_image}}"
                                           id="input-file-now" class="dropify"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-6">
                            <div class="form-group m-t-40 row">
                                <label for="example-text-input"
                                       class="col-md-2 col-form-label">{{trans('admin.website_name_in_arabic')}}</label>
                                <div class="col-md-10">
                                    {{ Form::text('title_ar',$setting->title_ar,["class"=>"form-control" ,"required"]) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <div class="form-group m-t-40 row">
                                <label for="example-text-input"
                                       class="col-md-2 col-form-label"> {{trans('admin.website_name_in_english')}}</label>
                                <div class="col-md-10">
                                    {{ Form::text('title_en',$setting->title_en,["class"=>"form-control" ,"required"]) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <div class="form-group m-t-40 row">
                                <label for="example-text-input"
                                       class="col-md-2 col-form-label"> {{trans('admin.phone')}}</label>

                                <select multiple name="phones[]" class="col-md-10 col-form-label" data-role="tagsinput"
                                        style="padding: 0 150px;">
                                    @foreach($setting->Phones as $phone)
                                        <option value="{{$phone->phone}}">{{$phone->phone}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">

                            <div class="form-group m-t-40 row">
                                <label for="example-text-input"
                                       class="col-md-2 col-form-label"> {{trans('admin.adress')}}</label>
                                <div class="card-body parent " style='text-align:right' id="parent">
                                    <button type='button' class="btn btn-success" value='Add Button' id='addButton'>
                                        <i class="fa fa-plus"></i></button>
                                    <div class="panel" style='text-align:right'>
                                        @foreach($setting->address as $addres)
                                            <div class="form-group row">
                                                <div class='col-lg-4'>
                                                    <input class="form-control" value="{{$addres->address_ar}}"
                                                           type="text"
                                                           step="0.01"
                                                           placeholder='???????? ?????????????? ????????????????????'>
                                                </div>
                                                <div class='col-lg-4'>
                                                    <input class="form-control" value="{{$addres->address_en}}"
                                                           type="text"
                                                           step="0.01"
                                                           placeholder='???????? ?????????????? ????????????????????'>
                                                </div>
                                                <div class='col-lg-3'>
                                                    <input class="form-control" value="{{$addres->url}}" type="url"
                                                           step="0.01"
                                                           placeholder='???????? ?????????????? ????????????????????'>
                                                </div>
                                                <div class='col-lg-1'>
                                                    <a class="btn-circle btn btn-danger" title="??????"
                                                       onclick="return confirm('admin.are_y_sure_delete')"
                                                       href="{{route('Setting.delete.adress',$addres->id)}}"><i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group m-t-40 row">
                                    <label for="example-text-input"
                                           class="col-md-2 col-form-label"> {{trans('admin.show_otp')}}</label>
                                    <div class="col-md-10">
                                        <div class="switch">
                                            <label>
                                                <input type="checkbox" name="show_otp" value="1"
                                                       @if($setting->show_otp == 1) checked @endif>
                                                <span class="lever switch-col-green"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group m-t-40 row">
                                    <label for="example-text-input"
                                           class="col-md-2 col-form-label">{{trans('admin.Terms_and_Conditions_in_arabic')}}</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('terms_ar',$setting->terms_ar,["class"=>"form-control summernote" , "rows" => "15" ,"required"]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group m-t-40 row">
                                    <label for="example-text-input"
                                           class="col-md-2 col-form-label">{{trans('admin.Terms_and_Conditions_in_english')}}</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('terms_en',$setting->terms_en,["class"=>"form-control summernote" , "rows" => "15" ,"required"]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group m-t-40 row">
                                    <label for="example-text-input"
                                           class="col-md-2 col-form-label">{{trans('admin.privacey_in_arabic')}}</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('privacy_ar',$setting->privacy_ar,["class"=>"form-control summernote" , "rows" => "15" ,"required"]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group m-t-40 row">
                                    <label for="example-text-input"
                                           class="col-md-2 col-form-label">{{trans('admin.privacey_in_english')}}</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('privacy_en',$setting->privacy_en,["class"=>"form-control summernote" , "rows" => "15" ,"required"]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group m-t-40 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">
                                        {{trans('admin.about_application_in_arabic')}}
                                    </label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('about_us_ar',$setting->about_us_ar,["class"=>"form-control summernote" , "rows" => "15" ,"required"]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group m-t-40 row">
                                    <label for="example-text-input"
                                           class="col-md-2 col-form-label">{{trans('admin.about_application_in_english')}}</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('about_us_en',$setting->about_us_en,["class"=>"form-control summernote" , "rows" => "15" ,"required"]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                                    <i class="icon-social-instagram"></i>
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
                                    <i class="icon-social-twitter"></i>
                                </span>
                                        {{ Form::url('twitter',$setting->twitter,["class"=>"form-control" ]) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="card-footer">
                    <div class="center">
                        {{ Form::submit('??????????' ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
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
    <script>
        $(document).ready(function () {
            var i = 0;

            $("#addButton").click(function () {
                var options = '';

                var html = '';
                html += ' <div id="" class="form-group row">';
                html += "<div class='col-lg-4'>" +
                    "<input  name='adress[" + i + "][adress_ar]' class='form-control' type='text' step ='0.01'  placeholder='???????? ?????????????? ????????????????'>" +

                    "</div>" +

                    "<div class='col-lg-4'>" +
                    "<input   name='adress[" + i + "][adress_en]' class='form-control' type='text' step ='0.01'  placeholder='???????? ?????????????? ????????????????????'>" +
                    "</div>" +
                    "<div class='col-lg-4'>" +
                    "<input   name='adress[" + i + "][url]' class='form-control' type='url' step ='0.01'  placeholder='???????? ???????? ??????????????'>" +

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
