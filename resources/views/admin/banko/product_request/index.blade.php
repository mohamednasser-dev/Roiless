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
            <h3 class="text-themecolor">{{trans('admin.add_product_requests')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.add_product_requests')}}</li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex">
                <div>
                    <h4 class="card-title"><span class="lstick"></span>الطلبات الجديدة</h4></div>
            </div>
{{--            {!! $dataTable->table() !!}--}}
            <div class="table-responsive m-t-5">
            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-lg-center">الصورة</th>
                    <th class="text-lg-center">اسم التاجر</th>
                    <th class="text-lg-center">اسم المنتج</th>
                    <th class="text-lg-center">القسم الرئيسي</th>
                    <th class="text-lg-center">القسم الفرعي</th>
                    <th class="text-lg-center">السعر</th>
                    <th class="text-lg-center">الكمية</th>
                    <th class="text-lg-center">تاريخ الانشاء</th>
                    <th class="text-lg-center">الظهور في الرئيسية</th>
                    <th class="text-lg-center">تفاصيل المنتج</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $row)
                    <tr>
                        <td class="text-lg-center"><img style="width: 100px;" src="{{$row->image_path}}"></td>
                        <td class="text-lg-center">{{$row->Seller->name}}</td>
                        <td class="text-lg-center">{{$row->name}}</td>
                        <td class="text-lg-center">{{($row->Section)?$row->Section->title: ''}}</td>
                        <td class="text-lg-center">{{($row->SubSection)?$row->SubSection->title: ''}}</td>
                        <td class="text-lg-center">{{$row->price}}</td>
                        <td class="text-lg-center">{{$row->quantity}}</td>
                        <td class="text-lg-center">{{$row->created_at->format('Y-m-d')}}</td>
                        <td class="text-lg-center">


                            @if($row->stars == 0)
                                <a href="{{route('admin.product.requests.make_star',['id'=>$row->id,'stars'=>1])}}" title="جعل المنتج يظهر في الصفحة الرئيسية"
                                   class="btn btn-warning">
                                    <i class="fas fa-star"></i>
                                </a>
                            @else
                                <a href="{{route('admin.product.requests.make_star',['id'=>$row->id,'stars'=>1])}}" title="حذف المنتج من الظهور في الصفحة الرئيسية"
                                   class="btn btn-danger">
                                    <i class="fas fa-star"></i>
                                </a>
                            @endif

                        </td>
                        <td class="text-lg-center">
                            <a href="{{route('admin.product.requests.show',$row->id)}}" title="{{trans('admin.product_details')}}"
                               class="btn btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
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
{{--    {!! $dataTable->scripts() !!}--}}
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
        $(document).ready(function () {
            $('#myTable').DataTable();
            $(document).ready(function () {
                var table = $('#example').DataTable({
                    "columnDefs": [{
                        "visible": false,
                        "targets": 2
                    }],
                    "order": [
                        [2, 'asc']
                    ],
                    "displayLength": 25,
                    "drawCallback": function (settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;
                        api.column(2, {
                            page: 'current'
                        }).data().each(function (group, i) {
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
