<div class="card-body ">
    <div class="row">
        <div class="form-group  col-3">
            <label>اسم المنتج بالعربية<span
                    class="text-danger">*</span></label>
            <input name="name_ar" placeholder="ادخل اسم المنتج" value="{{ old('name_ar', $data->name_ar ?? '') }}"
                   class="form-control  {{ $errors->has('name_ar') ? 'border-danger' : '' }}" type="text"
                   maxlength="255"/>
        </div>
        <div class="form-group  col-3">
            <label>اسم المنتج بالانجليزية<span
                    class="text-danger">*</span></label>
            <input name="name_en" placeholder="ادخل اسم المنتج" value="{{ old('name_en', $data->name_en ?? '') }}"
                   class="form-control  {{ $errors->has('name_en') ? 'border-danger' : '' }}" type="text"
                   maxlength="255"/>
        </div>
        <div class="form-group  col-3">
            <label>السعر<span
                    class="text-danger">*</span></label>
            <input name="price" placeholder="ادخل سعر المنتج" value="{{ old('price', $data->price ?? '') }}"
                   class="form-control  {{ $errors->has('price') ? 'border-danger' : '' }}" type="number" step="any"
                   maxlength="255"/>
        </div>
        <div class="form-group  col-3">
            <label>الكمية<span
                    class="text-danger">*</span></label>
            <input name="quantity" placeholder="ادخل كمية المنتج" value="{{ old('quantity', $data->quantity ?? '') }}"
                   class="form-control  {{ $errors->has('quantity') ? 'border-danger' : '' }}" type="number" step="any"
                   maxlength="255"/>
        </div>
    </div>
    <div class="row">
        <div class="form-group  col-3">
            <label>القسم الرئيسي<span
                    class="text-danger">*</span></label>
            <select name="section_id" required
                    class="form-control select2 {{ $errors->has('section_id') ? 'border-danger' : '' }}"
                    id="kt_select2_1_modal">
                <option value="" @if(Request::segment(3)!= 'edit') selected @endif >اختر القسم الرئيسي</option>
                @foreach($sections as $row)
                    <option
                        @if(Request::segment(3)== 'edit')
                        {{ $row->id == old('section_id',  $data->section_id)  ? 'selected' : '' }}
                        @else
                        {{ $row->id == old('section_id') ? 'selected' : '' }}
                        @endif
                        value="{{ $row->id }}">{{ $row->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group  col-3" id="sub_section_cont"
             @if(Request::segment(3)== 'edit')
             @if(!$data->sub_section_id)
             style="display: none;"
             @endif
             @else
             style="display: none;"
            @endif
        >
            <label>القسم الفرعي</label>
            <select name="sub_section_id" style="width: 100%"
                    class="form-control select2 {{ $errors->has('sub_section_id') ? 'border-danger' : '' }}"
                    id="kt_select2_2_modal">
                @if(Request::segment(3)== 'edit')
                    @foreach($sub_sections as $row)
                        <option
                            @if(Request::segment(3)== 'edit')
                            {{ $row->id == old('sub_section_id',  $data->sub_section_id)  ? 'selected' : '' }}
                            @else
                            {{ $row->id == old('sub_section_id') ? 'selected' : '' }}
                            @endif
                            value="{{ $row->id }}">{{ $row->title }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <label>نوع التقسيط
                <span
                    class="text-danger">*</span>
            </label>
            <div class="radio-inline">
                <label class="radio radio-success">
                    <input type="radio"  @if(request()->segment(3) == 'edit') @if($data->type == 'direct_installment') checked="checked" @endif @else checked="checked" @endif value="direct_installment" name="type">
                    <span></span>تقسيط مباشر</label>
                <label class="radio radio-success">
                    <input type="radio" @if(request()->segment(3) == 'edit') @if($data->type == 'not_direct_installment') checked="checked" @endif @endif value="not_direct_installment" name="type">
                    <span></span>تقسيط غير مباشر</label>
            </div>
            <span
                class="form-text text-muted">التقسيط المباشر : هو التقسيط الخاص بالتاجر وهو المسئول عن تحصيل الاقساط</span>
        </div>
    </div>
    <div class="row" id="direct_installment_panel" @if(request()->segment(3) == 'edit') @if($data->type == 'not_direct_installment') style="display: none;" @endif @endif>
        @foreach($benefits as $row)
            @if(request()->segment(3) == 'edit')
                @php
                    $benefit =  \App\Models\ProductBenefit::where('benefit_id',$row->id)->where('product_id',$data->id)->first();
                @endphp
            @endif
            <div class="form-group  col-3">
                <label>{{$row->name}} ( % )
                    <span class="text-danger">*</span>
                </label>
                <input name="benefits[{{$row->id}}]"
                       @if(request()->segment(3) == 'edit')
                       @if($benefit)
                       value="{{$benefit->ratio}}"
                       @endif
                       @endif

                       class="form-control" type="number" step="any"
                       max="100"/>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>وصف المنتج بالعربية</label>
            <textarea name="body_ar"
                      class="form-control  {{ $errors->has('body_ar') ? 'border-danger' : '' }}"
                      rows="10">{{ old('body_ar', $data->body_ar ?? '') }}</textarea>
        </div>
        <div class="form-group col-md-4">
            <label>وصف المنتج بالانجليزية</label>
            <textarea name="body_en"
                      class="form-control  {{ $errors->has('body_en') ? 'border-danger' : '' }}"
                      rows="10">{{ old('body_en', $data->body_en ?? '') }}</textarea>
        </div>
        <div class="form-group col-md-4">
            <label> صورة المنتج
                <span
                    class="text-danger">*</span>
            </label>
            <div class="col-lg-8">

                <div class="image-input image-input-outline" id="kt_image_1">
                    <div class="image-input-wrapper {{ $errors->has('image') ? 'border-danger' : '' }}"
                         style="background-image: url({{old('image', $data->image_path ?? 'default-image.png' )}})"></div>
                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-warning btn-shadow"
                           data-action="change" data-toggle="tooltip" title=""
                           data-original-title="اختر صوره">
                        <i class="fa fa-pen icon-sm text-muted"></i>
                        <input type="file" value="{{old('image', $data->image_path ?? '')}}" name="image"
                               accept=".png, .jpg, .jpeg"/>
                    </label>
                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-warning btn-shadow"
                          data-action="cancel" data-toggle="tooltip" title="حذف الصورة">

                      <i class="ki ki-bold-close icon-xs text-muted"></i>
                     </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card-body col-12">
            <label>صور المنتج

            </label>
            <div class="form-group ">
                <div class="dropzone dropzone-default dropzone-primary" id="kt_dropzone_car">
                    <div class="dropzone-msg dz-message needsclick">
                        <h3 class="dropzone-msg-title">قم باضافة الصور هنا أو انقر للتحميل.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(request()->segment(3) == 'edit')
        <div class="row">
                    @foreach($data->Images as $c)
                    <div class="col-2">
                        <a style="position: absolute;" class="btn btn-icon btn-danger btn-circle btn-sm"
                           onclick="confirm('هل متاكد من الحذف؟')"
                           href="{{route('seller.product.image.delete',$c->id)}}">
                            <i class="icon-nm fas far fa-trash" aria-hidden='true'></i>
                        </a>
                        <img class="p-2" style="height: 150px; width: 150px;"
                             src="{{$c->image_path}}">
                    </div>
                    @endforeach

        </div>
    @endif
</div>
<div class="card-footer text-left">
    <button type="Submit" id="submit" class="btn btn-success btn-default ">حفظ</button>
    <a href="{{ URL::previous() }}" class="btn btn-secondary">الغاء</a>
</div>


@push('script')
    <script src="{{url('/')}}/seller_assets/assets/js/pages/crud/file-upload/dropzonejs.js"></script>
    <script src="{{url('/')}}/seller_assets/assets/plugins/global/plugins.bundle.js"></script>
    <script type="text/javascript">
        $('#kt_dropzone_car').dropzone({
            paramName: "dzfile", // The name that will be used to transfer the file
            // autoProcessQueue: false,
            maxFilesize: 10, // MB
            clickable: true,
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            dictFallbackMessage: " المتصفح الخاص بكم لا يدعم خاصيه تعدد الصوره والسحب والافلات ",
            dictInvalidFileType: "لايمكنك رفع هذا النوع من الملفات ",
            dictCancelUpload: "الغاء الرفع ",
            dictCancelUploadConfirmation: " هل انت متاكد من الغاء رفع الملفات ؟ ",
            dictRemoveFile: "حذف الصوره",
            dictMaxFilesExceeded: "لايمكنك رفع عدد اكثر من هضا ",
            headers: {
                'X-CSRF-TOKEN':
                    "{{ csrf_token() }}"
            }
            ,
            url: "{{ route('seller.products.upload_images') }}", // Set the url
            success:
                function (file, response) {
                    $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
                },

        });
    </script>
    <script>
        $(document).ready(function () {
            $('input[name="type"]').click(function () {
                if ($(this).prop("checked") == true) {
                    if ($(this).prop("value") == 'direct_installment') {
                        $('#direct_installment_panel').show();
                    } else {
                        $('#direct_installment_panel').hide();
                    }
                }
            });
        });
    </script>
    <script !src="">
        var avatar1 = new KTImageInput('kt_image_1');
    </script>
    <script>
        // tagging support
        $('#kt_select2_1_modal').select2({
            placeholder: "اختر القسم الرئيسي",
            tags: true
        });
    </script>
    <script>
        // tagging support
        $('#kt_select2_2_modal').select2({
            placeholder: "اختر القسم الفرعي",
            tags: true
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#kt_select2_1_modal').change(function () {
                var level = $(this).val();
                $.ajax({
                    url: "{{url('/')}}/seller/products/get_sub_sections/" + level,
                    dataType: 'html',
                    type: 'get',
                    success: function (data) {
                        $('#sub_section_cont').show();
                        $('#kt_select2_2_modal').html(data);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('submit', 'form', function () {
                $('button').attr('disabled', 'disabled');
            });
        });
    </script>


@endpush
