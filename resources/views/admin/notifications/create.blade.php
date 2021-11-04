@extends('admin_temp')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/dropify/dist/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/bootstrap-select/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/multiselect/css/multi-select.css')}}">


@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.create_notification')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a
                        href="{{route('notifications.index')}}">{{trans('admin.notification')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    {{ Form::open( ['route'  => ['notifications.store'],'method'=>'post' , 'class'=>'form','files'=>true] ) }}
                    <h4 class="card-title">{{trans('admin.notification_info')}}</h4>
                    <hr>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.notification_address_in_arabic')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('title_ar',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.notification_address_in_english')}}</label>
                        <div class="col-md-10">
                            {{ Form::text('title_en',null,["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.content_in_arabic')}}</label>
                        <div class="col-md-10">
                            {{  Form::textarea('body_ar', null, [
                                'class'      => 'form-control',
                                'rows'       => 5,
                                 'required',
                                  ]) }}
                        </div>
                    </div>
                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.content_in_english')}}</label>
                        <div class="col-md-10">
                            {{  Form::textarea('body_en', null, [
                                    'class'      => 'form-control',
                                    'rows'       => 5,
                                     'required',
                                      ]) }}
                        </div>
                    </div>


                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.kind_recive')}}</label>
                        <div class="col-md-10">
                            <select class="custom-select form-control pull-right" id="cmb_type" name="Receive">
                                <option selected value="all">{{trans('admin.all')}}</option>
                                <option value="users">{{trans('admin.users')}}</option>
                                <option value="funds">{{trans('admin.funds')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group m-t-40 row" style="display:none;" id="div_users_container">
                    <label for="example-text-input"
                           class="col-md-2 col-form-label">{{trans('admin.multi_select')}}</label>
                    <div class="col-lg-12 col-xlg-4">
                        <select class="form-control" multiple id="public-methods" name='users_id[]'>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        <div class="button-box m-t-20">
                            <a id="select-all" class="btn btn-danger" href="#">{{trans('admin.select all')}}</a>
                            <a id="deselect-all" class="btn btn-info" href="#">{{trans('admin.deselect all')}}</a>
                        </div>
                    </div>
                </div>
                    <div class="form-group m-t-40 row" style="display:none;" id="div_funds_container">
                        <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.funds')}}</label>
                        <div class="col-md-10">
                            <select class="custom-select form-control pull-right" name="funds">
                                @foreach($funds as $fund)
                                    <option value="{{$fund->id}}">{{$fund->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group m-t-40 row">
                        <label for="example-text-input"
                               class="col-md-2 col-form-label">{{trans('admin.notification_image')}}</label>
                        <div class="col-md-10">
                            <input type="file" name="image" id="input-file-now" class="dropify"/>
                        </div>
                    </div>

                    <div class="center">
                        {{ Form::submit( trans('admin.add') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                    </div>
                    {{ Form::close() }}

            </div>
        </div>
        @endsection
        @section('scripts')

            <script src="{{ asset('/assets/plugins/dropify/dist/js/dropify.min.js')}}"></script>
            <script src="{{ asset('/assets/plugins/select2/dist/js/select2.full.min.js')}}"></script>
            <script src="{{ asset('/assets/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
            <script src="{{ asset('/assets/plugins/multiselect/js/jquery.multi-select.js')}}"></script>
            <script>
                $('#public-methods').multiSelect();
                $('#select-all').click(function () {
                    $('#public-methods').multiSelect('select_all');
                    return false;
                });
                $('#deselect-all').click(function () {
                    $('#public-methods').multiSelect('deselect_all');
                    return false;
                });
            </script>

            <script>
                $(document).ready(function () {

                    $('#cmb_type').change(function () {
                        var level = $(this).val();
                        if (level == 'users') {
                            $('#div_users_container').show();
                            $('#div_funds_container').hide();
                        } else if (level == 'all') {
                            $('#div_users_container').hide();
                            $('#div_funds_container').hide();
                        } else {
                            $('#div_funds_container').show();
                            $('#div_users_container').hide();
                        }
                    });
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



            <script>

                jQuery(document).ready(function () {
                    // Switchery
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('.js-switch').each(function () {
                        new Switchery($(this)[0], $(this).data());
                    });
                    // For select 2
                    $(".select2").select2();
                    $('.selectpicker').selectpicker();
                    //Bootstrap-TouchSpin
                    $(".vertical-spin").TouchSpin({
                        verticalbuttons: true,
                        verticalupclass: 'ti-plus',
                        verticaldownclass: 'ti-minus'
                    });
                    var vspinTrue = $(".vertical-spin").TouchSpin({
                        verticalbuttons: true
                    });
                    if (vspinTrue) {
                        $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
                    }
                    $("input[name='tch1']").TouchSpin({
                        min: 0,
                        max: 100,
                        step: 0.1,
                        decimals: 2,
                        boostat: 5,
                        maxboostedstep: 10,
                        postfix: '%'
                    });
                    $("input[name='tch2']").TouchSpin({
                        min: -1000000000,
                        max: 1000000000,
                        stepinterval: 50,
                        maxboostedstep: 10000000,
                        prefix: '$'
                    });
                    $("input[name='tch3']").TouchSpin();
                    $("input[name='tch3_22']").TouchSpin({
                        initval: 40
                    });
                    $("input[name='tch5']").TouchSpin({
                        prefix: "pre",
                        postfix: "post"
                    });
                    // For multiselect
                    $('#pre-selected-options').multiSelect();
                    $('#optgroup').multiSelect({
                        selectableOptgroup: true
                    });
                    $('#public-methods').multiSelect();
                    $('#select-all').click(function () {
                        $('#public-methods').multiSelect('select_all');
                        return false;
                    });
                    $('#deselect-all').click(function () {
                        $('#public-methods').multiSelect('deselect_all');
                        return false;
                    });
                    $('#refresh').on('click', function () {
                        $('#public-methods').multiSelect('refresh');
                        return false;
                    });
                    $('#add-option').on('click', function () {
                        $('#public-methods').multiSelect('addOption', {
                            value: 42,
                            text: 'test 42',
                            index: 0
                        });
                        return false;
                    });
                    $(".ajax").select2({
                        ajax: {
                            url: "https://api.github.com/search/repositories",
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    q: params.term, // search term
                                    page: params.page
                                };
                            },
                            processResults: function (data, params) {
                                // parse the results into the format expected by Select2
                                // since we are using custom formatting functions we do not need to
                                // alter the remote JSON data, except to indicate that infinite
                                // scrolling can be used
                                params.page = params.page || 1;
                                return {
                                    results: data.items,
                                    pagination: {
                                        more: (params.page * 30) < data.total_count
                                    }
                                };
                            },
                            cache: true
                        },
                        escapeMarkup: function (markup) {
                            return markup;
                        }, // let our custom formatter work
                        minimumInputLength: 1,
                        templateResult: formatRepo, // omitted for brevity, see the source of this page
                        templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
                    });
                });

            </script>

@endsection

