@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">الموظفيين</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">الخدمات</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">الصفحة الرئيسية</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="title">
        <a href="{{url('services/create')}} "
           class="btn btn-info btn-bg">أضافة خدمه جديده</a>
    </div>
    <br>
    <div class="row">
        <table class="table full-color-table full-primary-table">
            <thead>
            <tr>
                <th class="text-lg-center">عنوان الخدمه بالعربي</th>
                <th class="text-lg-center">عنوان الخدمه بالانجليزي</th>
                <th class="text-lg-center">الصوره</th>
                <th class="text-lg-center">الاعدادات</th>
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
                        <li><a title="حذف" onclick="return confirm('هل انت متكد من حذف الخدمه')"
                               href="{{route('services.delete',$Service->id)}}"><i class="fa fa-trash"></i></a></li>
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