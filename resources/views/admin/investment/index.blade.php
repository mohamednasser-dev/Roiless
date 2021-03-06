@extends('admin_temp')
@section('styles')
<link href="{{asset('../assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{asset('css/colors/default-dark.css')}}" id="theme" rel="stylesheet">
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.investment')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.investment')}}</li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="title">
        <a href="{{route('investment.create')}} "
           class="btn btn-info btn-bg">{{trans('admin.add_investment')}}</a>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive m-t-5">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">{{trans('admin.name_in_arabic')}}</th>
                            <th class="text-center">{{trans('admin.name_in_english')}}</th>
                            <th class="text-center" >{{trans('admin.image')}}</th>
                            <th class="text-center" >{{trans('admin.value')}}</th>
                            <th  class="text-center" >{{trans('admin.actions')}}</th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                <tr>
                    <td class="text-lg-center">{{$row->name_ar}}</td>
                    <td class="text-lg-center">{{$row->name_en}}</td>
                    <td class="text-lg-center"><img src="{{$row->image}}" style="width: 60px"></td>
                    <td class="text-lg-center">{{$row->value}}</td>
                    <td class="text-lg-center ">
                        <a class='btn btn-info btn-circle' title="??????????"
                           href="{{ route('investment.edit', $row->id )}}"><i class="fa fa-edit"></i></a>
                        <a class='btn btn-danger btn-circle' title="??????"
                           onclick="return confirm('???? ?????? ???????? ???? ?????? ????????????')"
                           href="{{ route('investment.delete' ,$row->id) }}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
                if (featured == 1) {
                    toastr.success("{{trans('admin.Appearance')}}");
                } else {
                    toastr.error("{{trans('admin.deAppearance')}}");
                }
            });
        }
        function update_apperance(el) {
            if (el.checked)
                var appearance = '1';
            else
                var appearance = '0';

            $.post('{{ route('fund.change.appearance') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: appearance
            }, function (data) {
                if (appearance == 1) {
                    toastr.success("{{trans('admin.active')}}");
                } else {
                    toastr.error("{{trans('admin.deactive')}}");
                }
            });
        }
    </script>
       <script src="{{asset('../assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('../assets/plugins/bootstrap/js/popper.min.js')}}"></script>
{{--    <script src="{{asset('../assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>--}}
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('js/perfect-scrollbar.jquery.min.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{asset('../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{asset('../assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('js/custom.min.js')}}"></script>
    <!-- This is data table -->
    <script src="{{asset('../assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
        });
    });
    </script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
@endsection
