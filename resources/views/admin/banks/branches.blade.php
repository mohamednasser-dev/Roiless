@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.branches_banks')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.banks')}}</li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="title">
        <a href="{{url('banks/create/'.$id)}}"
           class="btn btn-info btn-bg">{{trans('admin.add_branche_bank')}}</a>
    </div>
    <br>
    <div class="row">
        <div class="table-responsive ">
            <table id="example23"
                   class="display full-color-table full-primary-table  nowrap table table-hover table-striped table-bordered"
                   cellspacing="0" width="100%">
                <thead class="bg-primary">
                <tr>
                    <th scope="col">{{trans('admin.name')}}</th>
                    <th scope="col">{{trans('admin.image')}}</th>
                    <th scope="col">
                        {{trans('admin.actions')}}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($branches as $branch)
                    <tr>
                        <th scope="row">{{$branch->name_ar}}</th>
                        <td>
                            <img src="{{$branch->image}}" class="img-fluid"
                                 style="width: 100px; height: 100px; border-radius: 15px" alt="">
                        </td>
                        <td>
                            <ul class="list-inline soc-pro m-t-30">
                                <li><a class="btn-circle btn btn-success" title="تعديل" href="{{url('banks/'.$branch->id.'/edit')}}"><i class="fa fa-edit"></i></a></li>
                                <li><a class="btn-circle btn btn-info" title="التفاصيل" href="{{route('banks.details',$branch->id)}}"><i class="fa fa-eye"></i></a></li>
                                <li><a class="btn-circle btn btn-danger" title="حذف" onclick="return confirm('هل انت متاكد من حذف البنك')"
                                       href="{{route('banks.delete',$branch->id)}}"><i class="fa fa-trash"></i></a></li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
            $.post('{{ route('banks.actived') }}', {
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