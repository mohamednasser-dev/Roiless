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
            <h3 class="text-themecolor">{{trans('admin.communication')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.communication')}}</li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive m-t-5">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th class="text-lg-center">{{trans('admin.consolution_name_user')}}</th>
                        <th class="text-lg-center"> {{trans('admin.consolution_email')}}</th>
                        <th class="text-lg-center">{{trans('admin.consolution_phone')}}</th>
                        <th class="text-lg-center">{{trans('admin.replay.status')}}</th>
                        <th class="text-lg-center">{{trans('admin.consolution_replies')}}</th>
                        <th class="text-lg-center">{{trans('admin.delete')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($consolutions as $consolution)
                <tr>
                    <td class="text-lg-center">{{$consolution->full_name}}</td>
                    <td class="text-lg-center">{{$consolution->email}}</td>
                    <td class="text-lg-center">{{$consolution->phone}}</td>
                    <td class="text-lg-center">

                        @php
                            $test= \App\Models\reply::where('consolution_id',$consolution->id)->orderby('created_at','DESC')->first();
                        @endphp
                        @if($test == null)
                            <span class="label label-danger">{{trans('admin.not.answerd')}}</span>
                        @elseif($test->admin_id == null)
                            <span class="label label-danger">{{trans('admin.not.answerd')}}</span>
                            @else
                            <span class="label label-info">{{trans('admin.answerd')}}</span>
                        @endif


                    </td>
                    <td class="text-lg-center ">
                    <!--
                    <a class='btn btn-info btn-circle' title="??????" style="position: absolute;margin-right: -22px;margin-top: -20px;"
                           href="{{route('consolutions.show',$consolution->id)}}"><i class="fa fa-eye">{{count($consolution->unseenreplies)}}</i></a> -->
                        <a class='btn btn-info btn-circle' title="????????????????"
                           href="{{route('consolutions.show',$consolution->id)}}"><i class="fa fa-eye"></i>
                            @if(count($consolution->unseenreplies)!=0)
                                <span class="unreadcount"
                                      style="position: absolute;margin-top: 3px;background-color: red;
                                                border-radius: 50%;
                                                width: 22px;
                                                height: 22px;
                                                color:white"
                                      title="dd">
                                           <span class="insidecount">
                                            {{count($consolution->unseenreplies)}}
                                           </span>
                                        </span>
                            @endif
                        </a>
                    </td>
                    <td class="text-lg-center ">
                        <a class='btn btn-danger btn-circle' title="??????"
                           onclick="return confirm('???? ?????? ???????? ???? ?????????? ??')"
                           href="{{route('delete',$consolution->id)}}"><i class="fa fa-trash"></i></a>
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
        var button = document.getElementById('test1').innerHTML = "<span style=' margin-left: 50%'></span>";
    </script>
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
                        [2, 'desc']
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
