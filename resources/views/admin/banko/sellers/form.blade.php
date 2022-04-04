<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{trans('admin.seller_info')}}</h4>
        <hr>
        <div class="form-group m-t-40 row">
            <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.name')}}</label>
            <div class="col-md-10">
                {{ Form::text('name',old('name', $data->name ?? ''),["class"=>"form-control" ,"required"]) }}
            </div>
        </div>
        <div class="form-group m-t-40 row">
            <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.phone')}}</label>
            <div class="col-md-10">
                {{ Form::text('phone',old('phone', $data->phone ?? ''),["class"=>"form-control" ,"required"]) }}
            </div>
        </div>
        <div class="form-group m-t-40 row">
            <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.email')}}</label>
            <div class="col-md-10">
                {{ Form::email('email',old('email', $data->email ?? ''),["class"=>"form-control" ,"required"]) }}
            </div>
        </div>
        <div class="form-group row">
            <label for="example-password-input"
                   class="col-md-2 col-form-label">{{trans('admin.password')}}</label>
            <div class="col-md-10">
                <input class="form-control" type="password" name="password" id="example-password-input">
            </div>
        </div>
        <div class="form-group row">
            <label for="example-password-input2"
                   class="col-md-2 col-form-label">{{trans('admin.password_confirmation')}}</label>
            <div class="col-md-10">
                <input class="form-control" type="password" name="password_confirmation"
                       id="example-password-input2" >
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{trans('admin.seller_image')}}</h4>
                <input type="file" value="{{old('image', $data->image ?? '')}}" name="image" id="input-file-now"
                       class="dropify"/>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="center">
            {{ Form::submit( trans('admin.save') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
        </div>
    </div>
</div>
