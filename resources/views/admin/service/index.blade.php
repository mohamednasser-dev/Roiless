@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.services')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.services')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="title">
        <a href="{{url('services/create')}} "
           class="btn btn-info btn-bg">{{trans('admin.create_service')}}</a>
    </div>
    <br>
    <div class="row">
        <table class="table full-color-table full-primary-table">
            <thead>
            <tr>
                <th class="text-lg-center">{{trans('admin.service_address_in_arabic')}}</th>
                <th class="text-lg-center">{{trans('admin.service_address_in_english')}}</th>
                <th class="text-lg-center">{{trans('admin.service_image')}}</th>
                <th class="text-lg-center">{{trans('admin.detailes')}}</th>
                <th class="text-lg-center">{{trans('admin.Measures')}}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($Services as $Service)
                <tr>
                    <td class="text-lg-center">{{$Service->title_ar}}</td>
                    <td class="text-lg-center">{{$Service->title_en}}</td>
                    <td class="text-lg-center ">
                        <div class="pro-img m-t-20"><img style="height: 80px;" src="{{$Service->image}}"></div>
                    </td>
                    <td class="text-lg-center ">

                        <a class='btn btn-info btn-circle' title="التفاصيل"
                           href="{{route('services.details',$Service->id)}}"><i class="fa fa-eye"></i></a>


                    </td>
                    <td class="text-lg-center ">

                        <a class='btn btn-info btn-circle' title="تعديل"
                           href="{{route('services.edit',$Service->id)}}"><i class="fa fa-edit"></i></a>

                        <a class='btn btn-danger btn-circle' title="حذف" onclick="return confirm('هل انت متكد من حذف الخدمه')"
                           href="{{route('services.delete',$Service->id)}}"><i class="fa fa-trash"></i></a>

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        function update_active(el) {
            if (el.checked) {
                var status = 'active';
            } else {
                var status = 'unactive';
            }
            $.post('{{ route('users.actived') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function (data) {
                if (data == 1) {
                    toastr.success("{{trans('admin.statuschanged')}}");
                } else {
                    toastr.error("{{trans('admin.statuschanged')}}");
                }
            });
        }
    </script>
@endsection
