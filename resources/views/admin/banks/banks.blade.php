@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.banks')}}</h3>
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
        <a href="{{url('banks/create')}} "
           class="btn btn-info btn-bg">{{trans('admin.add_bank')}}</a>
    </div>
    <br>
    <div class="row">
        @foreach($banks as $bank)
            <div class="col-lg-3 col-xlg-3">
                <div class="card">
                    <div class="card-body little-profile text-center">
                        <div class="pro-img m-t-20"><img src="{{$bank->image}}" alt="user"></div>
                        <h3 class="m-b-0">{{$bank->name_ar}}</h3>
                        <ul class="list-inline soc-pro m-t-30">
                            <li><a title="تعديل" href="{{url('banks/'.$bank->id.'/edit')}}"><i class="fa fa-edit"></i></a></li>
                            <li><a title="التفاصيل" href="{{route('banks.details',$bank->id)}}"><i class="fa fa-eye"></i></a></li>
                            <li><a title="حذف" onclick="return confirm('هل انت متاكد من حذف البنك')"
                                   href="{{route('banks.delete',$bank->id)}}"><i class="fa fa-trash"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
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
