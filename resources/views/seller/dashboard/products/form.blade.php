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
            <select name="section_id"
                    class="form-control select2 {{ $errors->has('section_id') ? 'border-danger' : '' }}"
                    id="kt_select2_1_modal">
                <option value="" >اختر القسم الرئيسي</option>
                @foreach($sections as $row)
                    <option
                        @if(Request::segment(2)== 'edit')
                        {{ $row->id == old('section_id',  $data->city_id)  ? 'selected' : '' }}
                        @else
                        {{ $row->id == old('section_id') ? 'selected' : '' }}
                        @endif
                        value="{{ $row->id }}">{{ $row->title_ar }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group  col-3" id="sub_section_cont" style="display: none;">
            <label>القسم الفرعي</label>
            <select name="sub_section_id"
                    class="form-control select2 {{ $errors->has('sub_section_id') ? 'border-danger' : '' }}"
                    id="kt_select2_2_modal">
            </select>
        </div>
    </div>

    <div class="row">
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
                <input name="benefits[{{$row->id}}]" required
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
            <label>وصف المنتج بالانجليزية</label>
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
</div>
<div class="card-footer text-left">
    <button type="Submit" id="submit" class="btn btn-success btn-default ">حفظ</button>
    <a href="{{ URL::previous() }}" class="btn btn-secondary">الغاء</a>
</div>
