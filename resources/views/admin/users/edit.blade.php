@extends('admin_temp')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/dropify/dist/css/dropify.min.css') }}">
@endsection
@section('content')
  <div class="row page-titles">
      <div class="col-md-5 align-self-center">
          <h3 class="text-themecolor">{{trans('admin.edit_user')}}</h3>
      </div>
      <div class="col-md-7 align-self-center">
          <ol class="breadcrumb">
               <li class="breadcrumb-item">{{trans('admin.edit_user')}}</li>
              <li class="breadcrumb-item"><a href="{{url('users')}}">{{trans('admin.nav_users')}}</a></li>
              <li class="breadcrumb-item active"><a href="{{url('home')}}" >{{trans('admin.home_page')}}</a> </li>
          </ol>
      </div>
  </div>
  <div class="row">
      <div class="col-sm-12">
          <div class="card">
              <div class="card-body">
                  <h4 class="card-title">{{trans('admin.user_info')}}</h4>
                  <hr>
                  {!! Form::model($user_data, ['route' => ['users.update',$user_data->id] , 'method'=>'put','files'=> true]) !!}
                  {{ csrf_field() }}
                  <div class="form-group m-t-40 row">
                      <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.name')}}</label>
                        <div class="col-md-10">
                          {{ Form::text('name',$user_data->name,["class"=>"form-control" ,"required"]) }}
                        </div>
                  </div>
                  <div class="form-group m-t-40 row">
                      <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.email')}}</label>
                        <div class="col-md-10">
                          {{ Form::email('email',$user_data->email,["class"=>"form-control" ,"required"]) }}
                        </div>
                  </div>
                  <div class="form-group row">
                      <label for="example-password-input" class="col-md-2 col-form-label">{{trans('admin.password')}}</label>
                        <div class="col-md-10">
                          <input class="form-control" type="password" name="password"  id="example-password-input">
                        </div>
                  </div>
                  <div class="form-group row">
                    <label for="example-password-input2" class="col-md-2 col-form-label">{{trans('admin.password_confirmation')}}</label>
                      <div class="col-md-10">
                          <input class="form-control" type="password" name="password_confirmation"  id="example-password-input2">
                      </div>
                  </div>
                  <!--
                  <div class="form-group row">
                      <label for="example-password-input2" class="col-md-2 col-form-label">{{trans('admin.permission')}}</label>
                      <div class="col-md-10">
                        <select name="role_id" required class="form-control custom-select col-12">
                        {{--   @foreach($roles as $role)
                                <option value="{{$role->id}}" @php if($user_data->role_id == $role->id) echo "selected"; @endphp >{{$role->name}}</option>
                            @endforeach  --}}
                        </select>
                      </div>
                  </div>
                  -->
                  <div class="row">
                      <div class="col-lg-12 col-md-6">
                          <div class="card">
                              <div class="card-body">
                                  <h4 class="card-title">Image</h4>
                                  <input type="file" name="image" data-default-file="{{$user_data->image}}"  id="input-file-now" class="dropify"/>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="center">
                    {{ Form::submit( trans('admin.public_Edit') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
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
