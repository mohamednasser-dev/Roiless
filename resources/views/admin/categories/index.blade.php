@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">الاقسام</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">الاقسام</li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">الصفحة الرئيسية</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="title">
        <a href="{{ route('categories.add') }}"
           class="btn btn-info btn-bg">أضافة قسم جديد</a>
    </div>
    <br>
    <div class="row">
        <table class="table full-color-table full-primary-table">
            <thead>
            <tr>
                <th class="text-lg-center">عنوان القسم بالعربي</th>
                <th class="text-lg-center">عنوان القسم بالانجليزي</th>
                <th class="text-lg-center">الصوره</th>
                <th class="text-lg-center">الاعدادات</th>
            </tr>
            </thead>

            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td class="text-lg-center">{{ $category->title_ar }}</td>
                    <td class="text-lg-center">{{ $category->title_en }}</td>
                    <td class="text-lg-center ">
                        <div class="pro-img m-t-20"><img style="height: 80px;" src= "{{$category->image}}" ></div>
                    </td>
                    <td class="text-lg-center ">

                        <a class='btn btn-info btn-circle' title="تعديل"
                           href="{{ route('categories.edit', $category->id )}}"><i class="fa fa-edit"></i></a>

                        <a class='btn btn-danger btn-circle' title="حذف" onclick="return confirm('هل انت متكد من حذف الخدمه')"
                           href="{{ route('categories.delete' ,$category->id) }}"><i class="fa fa-trash"></i></a>

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
