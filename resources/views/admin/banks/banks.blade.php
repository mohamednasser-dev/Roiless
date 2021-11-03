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
        <a href="{{url('banks/create/0')}}"
           class="btn btn-info btn-bg">{{trans('admin.add_bank')}}</a>
    </div>
    <br>
    <div class="card">
        <div class="card-body"> 
            <div class="table-responsive m-t-5">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{trans('admin.bank_name')}}</th>
                            <th>{{trans('admin.logo')}}</th>
                            <th>{{trans('admin.Orders_received')}}</th>
                            <th>{{trans('admin.count_pranches')}}</th>
                            <th>{{trans('admin.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($banks as $bank)
                    <tr>
                        <td scope="row">{{$bank->name_ar}}</td>
                        <td style="width: 100px; height: 100px;">
                            <img src="{{$bank->image}}" class="img-fluid"
                            style="width: 100px; height: 100px; border-radius: 15px" alt="">
                        </td>
                        <td>
                            @php
                                $branches_ids = \App\Models\Bank::where('parent_id',$bank->id)->get()->pluck('id')->toArray();
                                array_push($branches_ids,$bank->id);
                                $userfund=\App\Models\User_fund::wherein('bank_id',$branches_ids)->get()->count();
                            @endphp
                            @if($userfund)
                                <a href="{{route('funds.of.bank', $bank->id)}}" style="color: #000; font-size: 22px;"> {{$userfund}} </a>
                            @else
                                {{trans('admin.not_order')}}
                            @endif
                        </td>
                        <td>
                            <a href="{{route('banks.branches',$bank->id)}}" style="color: #000; font-size: 22px;"> {{count($bank->Branches)}}  </a>
                        </td>
                        <td>
                            <ul class="list-inline soc-pro m-t-30">
                                @if($bank->status=="active")
                                    <li><a id="btn_bank_unactive" class=" btn btn-success" title="تعديل"
                                           data-bankid="{{$bank->id}}" data-toggle="modal" data-target="#myModal"
                                           href="" id="btn_bank_unactive">تعطيل</a></li>
                                @else
                                    <li>
                                        <a href="{{route('banks.actived',$bank->id)}}" class="btn btn-danger"
                                           data-target="#myModal">تفعيل</a>
                                    </li>
                                @endif
                                <li><a class="btn-circle btn btn-success" title="تعديل"
                                       href="{{url('banks/'.$bank->id.'/edit')}}"><i class="fa fa-edit"></i></a></li>
                                <li><a class="btn-circle btn btn-danger" title="حذف"
                                       onclick="return confirm('هل انت متاكد من حذف البنك')"
                                       href="{{route('banks.delete',$bank->id)}}"><i class="fa fa-trash"></i></a></li>
                            </ul>
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
    <script>
        $(document).on('click', '#btn_bank_unactive', function () {
            $('#txt_bank_id').val($(this).data('bankid'));
            $('#txt_bank_id2').val($(this).data('bankid'));
        });
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
