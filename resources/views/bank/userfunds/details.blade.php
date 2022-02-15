@extends('bank.bank_temp')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/dropify/dist/css/dropify.min.css') }}">
    <link href="{{ asset('/assets/plugins/summernote/dist/summernote.css') }}" rel="stylesheet">
    <style>
        .carousel-inner img {
            width: 640px;
            max-height: 670px;
        }
    </style>

@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">مراجعه التمويلات</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">مراجعه طلب التمويل</li>
                <li class="breadcrumb-item active"><a href="{{route('bank.home')}}">الصفحة الرئيسية</a></li>
            </ol>
        </div>
    </div>
    <div class="row row-cols-2">
        {{--Start dataform --}}
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        @if( auth()->user()->parent_id == null)
                            <h3>{{trans('admin.date_preview')}}</h3>
                            @foreach($fund_banks as $row)
                                ( {{$row->Bank->name_ar}})
                            @endforeach
                        @else
                            <h3>{{trans('admin.date_preview')}}</h3>
                        @endif
                        @foreach(json_decode($userfund->dataform, true) as $data)
                            @if($data['value'] != "null")
                                @if($data['name'] != "bank_id")
                                    @php $inputnow = \App\Models\Fundinput::where('slug',$data['name'])->first(); @endphp
                                    <h3 class="control-label">{{ $inputnow->name }}</h3>
                                    <input type="text" id="firstName" class="form-control" value="{{ $data['value'] }}"
                                           readonly>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Start fund photos --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>{{trans('admin.img_preview')}}</h5>
                    </div>

                <!-- <div id="image-popups" class="row">
                        @foreach($userfund->Files_img as $file)
                    <div class="col-lg-2 col-md-4">
                        <a href="{{asset('/uploads/fund_file').'/'.$file->file_name}}"
                                   data-effect="mfp-zoom-in"><img
                                        src="{{asset('/uploads/fund_file').'/'.$file->file_name}}"
                                        class="img-responsive"/></a>
                            </div>
                        @endforeach
                    </div> -->
                    @if(count($userfund->Files_img)>0)
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">

                            </ol>

                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    @foreach($userfund->Files_img as $key => $file)
                                        @if ($key == 0)
                                            @continue
                                        @endif
                                        <img class="d-block w-100"
                                             src="{{asset('/uploads/fund_file').'/'.$file->file_name}}"
                                             alt="First slide">
                                        @if ($key == 1)
                                            @break
                                        @endif
                                    @endforeach
                                </div>
                                @foreach($userfund->Files_img as $key => $file)
                                    @if($loop->iteration  <= 1)
                                        <div class="carousel-item">
                                            <img class="d-block w-100"
                                                 src="{{asset('/uploads/fund_file').'/'.$file->file_name}}"
                                                 alt="Second slide">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                               data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                               data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{--end fund photos --}}

    {{--Start fund pdf --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>{{trans('admin.pdf_preview')}}</h5>
                    </div>

                    <div id="image-popups" class="row">

                        @foreach($userfund->Files_pdf as $file)
                            <div class="col-6">
                                <iframe src="{{asset('/uploads/fund_file').'/'.$file->file_name}}"
                                        style="width:600px; height:500px;"></iframe>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end fund pdf --}}
    @if( auth()->user()->parent_id != null)
        <div class="row">
            <div class="card col-12 ">
                <div class="card-body  center">
                    <button
                        type="button" class="btn btn-success" data-toggle="modal" data-target="#approve">الموافقه علي
                        الطلب
                    </button>
                    <button
                        type="button" class="btn btn-danger" data-toggle="modal" data-target="#user">مراجعه الطلب
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="modal fade" id="user" tabindex="-1" role="dialog" aria-labelledby="userLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="banksLabel1">مراجعه الورق المطلوب مره اخري</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                <!-- <form class="form"
                          action="{{route('request.rejected',$userfund->id)}}"
                          method="POST">
                        @csrf -->
                    {{ Form::open( ['route'  =>  ['request.rejected',$userfund->id],'method'=>'post' , 'class'=>'form','files'=>true] ) }}
                    <div class="col-md-12">
                        <div class="form-group has-success">
                            <label class="control-label"> ملحوظه بالعربيه </label>
                            <input type="text" class="form-control" name="note_ar" required>
                            <label class="control-label"> ملحوظه بالانجليزيه </label>
                            <input type="text" class="form-control" name="note_en" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">اختيار</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>


    </div>


    <div class="row">
        <div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="userLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="banksLabel1">الموافقه علي الطلب</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    {{ Form::open( ['route'  =>  ['request.accept',$userfund->id],'method'=>'post' , 'class'=>'form','files'=>true] ) }}

                    <div class="col-md-12">
                        <div class="form-group has-success">
                            <div class="form-group m-t-40 row">
                                <label for="example-text-input"
                                       class="col col-form-label"> {{trans('bank.detailes_ar')}}</label>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::textarea('details_ar','',["class"=>"form-control summernote " ,'cols' => 10, "rows" => "5","required"])  }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group has-success">
                            <div class="form-group m-t-40 row">
                                <label for="example-text-input"
                                       class="col col-form-label"> {{trans('bank.detailes_en')}}</label>
                                <div class="col-md-12">
                                    <div class="form-group" style="">
                                        {{ Form::textarea('details_en','',["class"=>"form-control summernote " ,'cols' => 10, "rows" => "5","required"])  }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">اختيار</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>


    </div>


@endsection
@section('scripts')
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
