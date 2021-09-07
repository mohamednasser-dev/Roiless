@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">الاسئله الشائعه</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">الاسئله الشائعه</li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">الصفحة الرئيسية</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="title">
        <a href="{{url('question/create')}} "
           class="btn btn-info btn-bg">أضافة سؤال جديده</a>
    </div>
    <br>
    <div class="row">
        <table class="table full-color-table full-primary-table">
            <thead>
            <tr>
                <th class="text-lg-center">السؤال بالعربيه</th>
                <th class="text-lg-center">السؤال بالانجليزيه</th>
                <th class="text-lg-center">الجواب بالعربيه</th>
                <th class="text-lg-center">الجواب بالانجليزيه</th>
                <th class="text-lg-center">الصوره</th>
                <th class="text-lg-center">الاجرائات</th>
            </tr>
            </thead>

            <tbody>
            @foreach($questions as $question)
                <tr>
                    <td class="text-lg-center">{{$question->question_ar}}</td>
                    <td class="text-lg-center">{{$question->question_en}}</td>
                    <td class="text-lg-center">{{$question->answer_ar}}</td>
                    <td class="text-lg-center">{{$question->answer_en}}</td>
                    <td class="text-lg-center ">
                        <div class="pro-img m-t-20"><img style="height: 80px;" src="{{$question->image}}"></div>
                    </td>

                    <td class="text-lg-center ">

                        <a class='btn btn-info btn-circle' title="تعديل"
                           href="{{route('question.edit',$question->id)}}"><i class="fa fa-edit"></i></a>

                        <a class='btn btn-danger btn-circle' title="حذف" onclick="return confirm('هل انت متكد من حذف الخدمه')"
                           href="{{route('question.delete',$question->id)}}"><i class="fa fa-trash"></i></a>

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