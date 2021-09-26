@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.common_questions')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.communication')}}</li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->

    <div class="row">
        <table class="table full-color-table full-primary-table">
            <thead>
            <tr>
                <th class="text-lg-center">{{trans('admin.name')}}</th>
                <th class="text-lg-center">{{trans('admin.phone_num')}}</th>
                <th class="text-lg-center">{{trans('admin.email')}}</th>
                <th class="text-lg-center">{{trans('admin.message')}}</th>
                <th class="text-lg-center">{{trans('admin.Measures')}}</th>
{{--                <th class="text-lg-center">{{trans('admin.user')}}</th>--}}
            </tr>
            </thead>

            <tbody>
            @foreach($inboxs as $inbox)
                <tr>
                    <td class="text-lg-center">{{$inbox->name}}</td>
                    <td class="text-lg-center">{{$inbox->phone}}</td>
                    <td class="text-lg-center">{{$inbox->email}}</td>
                    <td class="text-lg-center">{{$inbox->message}}</td>
                    <td class="text-lg-center ">

                        <a class='btn btn-danger btn-circle' title="حذف" onclick="return confirm('هل انت متكد من حذف الخدمه')"
                           href="{{route('inbox.delete',$inbox->id)}}"><i class="fa fa-trash"></i></a>

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
