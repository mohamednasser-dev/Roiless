@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('admin.notification')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.notification')}}</li>

                <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="title">
        <a href="{{route('notifications.create')}} "
           class="btn btn-info btn-bg">{{trans('admin.add_new_notification')}}</a>
    </div>
    <br>
    <div class="row">
        <table class="table full-color-table full-primary-table">
            <thead>
            <tr>
                <th class="text-lg-center">{{trans('admin.notification_in_arabic')}}</th>
                <th class="text-lg-center">{{trans('admin.notification_in_english')}}</th>
                <th class="text-lg-center">{{trans('admin.notification_content_in_arabic')}}</th>
                <th class="text-lg-center">{{trans('admin.notification_in_english')}}</th>
                <th class="text-lg-center">{{trans('admin.notification_image')}}</th>
                <th class="text-lg-center">{{trans('admin.Measures')}}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($notifications as $notification)
                <tr>
                    <td class="text-lg-center">{{$notification->title_ar}}</td>
                    <td class="text-lg-center">{{$notification->title_en}}</td>
                    <td class="text-lg-center">{{$notification->body_ar}}</td>
                    <td class="text-lg-center">{{$notification->body_en}}</td>
                    <td class="text-lg-center ">
                        <div class="pro-img"><img style="height: 50px; width: 50px; border-radius: 50%" src="{{$notification->image}}"></div>
                    </td>

                    <td class="text-lg-center ">

                        <a class='btn btn-info btn-circle' title="تعديل"
                           href="{{route('question.edit',$notification->id)}}"><i class="fa fa-edit"></i></a>

                        <a class='btn btn-danger btn-circle' title="حذف" onclick="return confirm('هل انت متكد من حذف الخدمه')"
                           href="{{route('question.delete',$notification->id)}}"><i class="fa fa-trash"></i></a>

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
