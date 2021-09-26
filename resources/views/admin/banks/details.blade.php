@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.nav_users')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.details')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('users')}}" >{{trans('admin.nav_users')}}</a> </li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}" >{{trans('admin.nav_home')}}</a> </li>
            </ol>
        </div>
    </div>
        <!-- /.card-header -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card"> <img class="card-img" src="{{$banks->image}}" alt="Card image">
                <div class="card-img-overlay card-inverse social-profile d-flex ">
                    <div class="align-self-center">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <small class="text-muted">{{trans('admin.name_in_arabic')}} </small>
                    <h6>{{$banks->name_ar}}</h6>
                    <small class="text-muted">{{trans('admin.name_in_english')}} </small>
                    <h6>{{$banks->name_en}}</h6>
                    <small class="text-muted">{{trans('admin.email')}}</small>
                    <h6>{{$banks->email}}</h6>
                    <small class="text-muted p-t-30 db">{{trans('admin.phone_num')}}</small>
                    <h6>{{$banks->phone}}</h6>
                    <br/>
                    <a class="btn btn-circle btn-secondary" title="تعديل" href="{{url('users/'.$banks->id.'/edit')}}"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-circle btn-secondary" title="حذف" onclick="return confirm('هل انت متاكد من حذف هذا البنك')" href="{{route('banks.delete',$banks->id)}}"><i class="fa fa-trash"></i></a>

                </div>
            </div>
        </div>
        <!-- Column -->

    </div>
@endsection
@section('scripts')
  <script type="text/javascript">
      function update_active(el){
            if(el.checked){
                var status = 'active';
            }
            else{
                var status = 'unactive';
            }
            $.post('{{ route('users.actived') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(banks == 1){
                    toastr.success("{{trans('admin.statuschanged')}}");
                }
                else{
                    toastr.error("{{trans('admin.statuschanged')}}");
                }
            });
        }
  </script>
@endsection
