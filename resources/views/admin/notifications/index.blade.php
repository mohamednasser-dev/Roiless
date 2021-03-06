@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('admin.notification')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('notifications.index')}}">{{trans('admin.notification')}}</a></li>

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
    <div class="card">
        <div class="card-body">
            <div class="table-responsive m-t-5">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th class="text-lg-center">{{trans('admin.notification_in_arabic')}}</th>
                        <th class="text-lg-center">{{trans('admin.notification_in_english')}}</th>
                        <th class="text-lg-center">{{trans('admin.notification_content_in_arabic')}}</th>
                        <th class="text-lg-center">{{trans('admin.notification_content_in_english')}}</th>
                        <th class="text-lg-center">{{trans('admin.notification_image')}}</th>
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
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $notifications->links() }}
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
