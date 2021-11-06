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
            <h3 class="text-themecolor">{{trans('admin.Required_funds')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.Required_funds')}}</li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="d-flex">
        <a class="btn btn-info ml-auto" href="{{route('export_userfund')}}">تصدير الي اكسيل</a>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive m-t-5">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="text-lg-center">ID</th>
                        <th class="text-lg-center">{{trans('admin.date')}}</th>
                        <th class="text-lg-center">{{trans('admin.user')}}</th>
                        <th class="text-lg-center">{{trans('admin.request')}}</th>
                        <th class="text-lg-center">{{trans('admin.status')}}</th>
                        <th class="text-lg-center">{{trans('admin.revision')}}</th>
                   </tr>
                    </thead>
                    <tbody>
                    @foreach($usefunds as $usefund)
                <tr>
                    <td class="text-lg-center">{{$usefund->id}}</td>
                    <td class="text-lg-center">{{$usefund->created_at->format('Y-m-d g:i a')}}</td>
                    <td class="text-lg-center">{{$usefund->Users->name}}</td>
                    <td class="text-lg-center">@if($usefund->Fund) {{$usefund->Fund->name_ar}} @endif </td>
                    <td class="text-lg-center">{{$usefund->payment}}</td>
                    <td class="text-lg-center ">
                        @if(is_null($usefund->emp_id))
                            <a class='btn btn-danger btn-circle' title="المراجعه"
                               href="{{route('employerchosen',$usefund->id)}}"><i class="fa fa-eye"></i></a>

                        @elseif(($usefund->emp_id == auth()->user()->id) && $usefund->bank_id == null)

                            @if($usefund->Banks_sent->count() > 0 )
                                {{trans('admin.sent_to_banks')}}
                            @else
                                <a class='btn btn-info btn-circle' title="{{trans('admin.follow')}}"
                                   href="{{route('review',$usefund->id)}}"><i class="fa fa-pencil-square-o"></i></a>
                            @endif
                        @else

                            @if($usefund->Banks)
                                {{$usefund->Banks->name_ar}}
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </script>
        <script src="{{asset('../assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('../assets/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('../assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
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

