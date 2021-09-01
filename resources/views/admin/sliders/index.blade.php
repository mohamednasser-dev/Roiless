@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">الصور</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">الصور</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">الصفحة الرئيسية</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="title">
        <a href="{{ route('sliders.add') }}"
           class="btn btn-info btn-bg">أضافة صورة</a>
    </div>
    <br>
    <div class="row">
        <table class="table full-color-table full-primary-table">
            <thead>
            <tr>
             
                <th class="text-lg-center">الصوره</th>
                <th class="text-lg-center">الاعدادات</th>

              
            </tr>
            </thead>

            <tbody>
            @foreach($Sliders as $slider)
                <tr>
                    
                    <td class="text-lg-center ">
                        <div class="pro-img m-t-20"><img style="height: 150px; width:200px;" src= "{{ asset ('images/slider/'.$slider->image) }}" ></div>
                    </td>
                    <td class="text-lg-center ">

                        <a href="{{ route('sliders.edit', $slider->id )}}" > <i class="fa fa-edit"></i> </a>
                    <form style="display:inline;" action="{{ route('sliders.delete' ,$slider->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('هل انت متكد من حذف الخدمه')"   type="submit" ><i class="fa fa-trash"></i></button>

                    </form>
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
