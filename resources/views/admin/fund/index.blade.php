@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">التمويلات</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">التمويلات</li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">الصفحة الرئيسية</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="title">
        <a href="{{route('fund.create')}} "
           class="btn btn-info btn-bg">أضافة تمويل جديد</a>
    </div>
    <br>
    <div class="row">
        <table class="table full-color-table full-primary-table">
            <thead>
            <tr>
                <th class="text-lg-center">اسم التمويل بالعربي</th>
                <th class="text-lg-center"> اسم التمويل بالانجليزيه</th>
                <th class="text-lg-center"> القسم</th>
                <th class="text-lg-center"> الصوره</th>
                <th class="text-lg-center"> الحاله</th>
                <th class="text-lg-center">الاجرائات</th>
            </tr>
            </thead>

            <tbody>
            @foreach($funds as $fund)
                <tr>
                    <td class="text-lg-center">{{$fund->name_ar}}</td>
                    <td class="text-lg-center">{{$fund->name_en}}</td>
                    <td class="text-lg-center">{{$fund->category->title_ar}}</td>
                    <td class="text-lg-center"><img src="{{$fund->image}}" style="width: 120px"></td>
                    <td class="text-lg-center">
                        <div class="switch">
                            <label>
                                <input type="checkbox" onchange="update_active(this)" value="{{$fund->id}}"
                                       name="featured" @if($fund->featured == '1') checked @endif ><span
                                    class="lever switch-col-green"></span></label>
                        </div>
                    </td>
                    <td class="text-lg-center ">
                        <a class='btn btn-info btn-circle' title="تفاصيل"
                           href="{{route('fund.details',$fund->id)}}"><i class="fa fa-eye"></i></a>

                        <a class='btn btn-info btn-circle' title="تعديل"
                           href="{{route('fund.edit',$fund->id)}}"><i class="fa fa-edit"></i></a>

                        <a class='btn btn-danger btn-circle' title="حذف"
                           onclick="return confirm('هل انت متكد من حذف الخدمه')"
                           href="{{route('fund.delete',$fund->id)}}"><i class="fa fa-trash"></i></a>

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
            if (el.checked)
                var featured = '1';
            else
                var featured = '0';

            $.post('{{ route('fund.change.featured') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: featured
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
