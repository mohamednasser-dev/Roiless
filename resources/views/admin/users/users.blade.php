@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.users')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.users')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('/')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="d-flex">
         <div class="title">
            <a href="{{url('users/create')}} "
            class="btn btn-info btn-bg">{{trans('admin.add_new_user')}}</a> 
        </div>
        <div class="ml-auto">
            <a href="{{route('export_view_user')}}"
                class="btn btn-info btn-bg ml-auto">تصدير الي اكسيل</a>
          </div>
    </div>
    <br>
    <div class="row">
        <div class="table-responsive ">
            <table class="table full-color-table full-primary-table">
                <thead class="bg-primary">
                <tr>
                    <th scope="col">{{trans('admin.name')}}</th>
                    <th scope="col">{{trans('admin.phone')}}</th>
                    <th scope="col">{{trans('admin.email')}}</th>
                    <th scope="col">{{trans('admin.orders')}}</th>
                    <th scope="col">{{trans('admin.sign_up_data')}}</th>
                    <th scope="col">{{trans('admin.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->name}}</th>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->UserFunds->count()}}</td>
                        <td>{{$user->created_at->format('Y-m-d')}}</td>
                        <td>
                            <ul class="list-inline soc-pro m-t-30">
                                <li><a class="btn-circle btn btn-success" title="تعديل" href="{{url('users/'.$user->id.'/edit')}}"><i
                                            class="fa fa-edit"></i></a></li>
{{--                                <li><a class="btn-circle btn btn-info" title="التفاصيل" href="{{route('users.details',$user->id)}}"><i--}}
{{--                                            class="fa fa-eye"></i></a></li>--}}
                                <li><a  class="btn-circle btn btn-danger" title="حذف" onclick="return confirm('{{trans('admin.are_y_sure_delete')}}')"
                                       href="{{route('users.delete',$user->id)}}"><i class="fa fa-trash"></i></a></li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
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
