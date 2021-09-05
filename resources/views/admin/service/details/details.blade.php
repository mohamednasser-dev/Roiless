@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">تفاصيل الخدمه</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">تفاصيل الخدمه</li>
                <li class="breadcrumb-item"><a href="{{route('services')}}">الخدمات</a></li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">الصفحة الرئيسية</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="title">
        <a href="{{route('services.details.create',$id)}} "
           class="btn btn-info btn-bg">أضافة تفصيله جديده</a>
    </div>
    <br>
    <div class="row">
        <table class="table full-color-table full-primary-table">
            <thead>
            <tr>
                <th class="text-lg-center">عنوان الخدمه بالعربي</th>
                <th class="text-lg-center">عنوان الخدمه بالانجليزي</th>
                <th class="text-lg-center">محتوي الخدمه بالعربي</th>
                <th class="text-lg-center">محتوي الخدمه بالانجليزي</th>
                <th class="text-lg-center">الاجرائات</th>
            </tr>
            </thead>

            <tbody>
            @foreach($services_details as $services_detail)
                <tr>
                    <td class="text-lg-center">{{$services_detail->title_ar}}</td>
                    <td class="text-lg-center">{{$services_detail->title_en}}</td>
                    <td class="text-lg-center">{{$services_detail->desc_ar}}</td>
                    <td class="text-lg-center">{{$services_detail->desc_en}}</td>

                    <td class="text-lg-center ">

                        <a class='btn btn-info btn-circle' title="تعديل"
                           href="{{route('services.details.edit',$services_detail->id)}}"><i class="fa fa-edit"></i></a>

                        <a class='btn btn-danger btn-circle' title="حذف" onclick="return confirm('هل انت متكد من حذف تقاصيل الخدمه')"
                           href="{{route('services.details.delete',$services_detail->id)}}"><i class="fa fa-trash"></i></a>

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
