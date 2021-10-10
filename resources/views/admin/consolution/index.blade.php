@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.funds')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.funds')}}</li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="title">
        <a href="{{route('fund.create')}} "
           class="btn btn-info btn-bg">{{trans('admin.add_fund')}}</a>
    </div>
    <br>
    <div class="row">
        <table class="table full-color-table full-primary-table">
            <thead>
            <tr>
                <th class="text-lg-center">{{trans('admin.consolution_name_user')}}</th>
                <th class="text-lg-center"> {{trans('admin.consolution_email')}}</th>
                <th class="text-lg-center">{{trans('admin.consolution_phone')}}</th>
                <th class="text-lg-center">{{trans('admin.consolution_kind')}}</th>
                <th class="text-lg-center">{{trans('admin.consolution_replies')}}</th>
                <th class="text-lg-center">{{trans('admin.main_Measures')}}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($consolutions as $consolution)
                <tr>
                    <td class="text-lg-center">{{$consolution->full_name}}</td>
                    <td class="text-lg-center">{{$consolution->email}}</td>
                    <td class="text-lg-center">{{$consolution->phone}}</td>
                    <td class="text-lg-center">{{$consolution->consolution_kind->name_ar}}</td>
                    <td class="text-lg-center ">
<!--                    
                    <a class='btn btn-info btn-circle' title="عرض" style="position: absolute;margin-right: -22px;margin-top: -20px;"
                           href="{{route('consolutions.show',$consolution->id)}}"><i class="fa fa-eye">{{count($consolution->unseenreplies)}}</i></a> -->
                           
                           <a class='btn btn-info btn-circle' title="التفاصيل"
                           href="{{route('consolutions.show',$consolution->id)}}"><i class="fa fa-eye"></i>
                           <span class="unreadcount"
                                              style="position: absolute;margin-top: 3px;background-color: red;
                                                border-radius: 50%;
                                                width: 22px;
                                                height: 22px;
                                                color:white"
                                            
                                              title="dd">
                                            <span class="insidecount" >
                                            {{count($consolution->unseenreplies)}}
                                            </span>
                                        </span>
                          
                                        </a>
                           <!-- <a href="{{route('consolutions.show',$consolution->id)}}"
                                           class="btn btn-info  mb-2 mr-2 rounded-circle"
                                           style="position: absolute;margin-right: 5px;margin-top: 5px; margin-right: 0px border-radius: 50%; width: 48px; hight:48;
                                                ;
                                                "
                                           data-original-title="Tooltip using BUTTON tag">
                                           <i class="fa fa-eye" style="margin-top: 5px;"></i>
                                        </a>
                                        <span class="unreadcount"
                                              style="position: absolute;margin-top: 3px;background-color: red;
                                                border-radius: 50%;
                                                width: 22px;
                                                height: 22px;
                                                color:white"
                                            
                                              title="dd">
                                            <span class="insidecount" >
                                            {{count($consolution->unseenreplies)}}
                                            </span>
                                        </span>
                               </a> -->

                    </td>
                   
                    <td class="text-lg-center ">
                       

                        <a class='btn btn-danger btn-circle' title="حذف"
                           onclick="return confirm('هل انت متكد من حذف الخدمه')"
                           href="{{route('delete',$consolution->id)}}"><i class="fa fa-trash"></i></a>
                         
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>




@endsection
@section('scripts')
 <script>
 var button=  document.getElementById('test1').innerHTML="<span style=' margin-left: 50%'></span>";
   console.log(button);

 </script>
@endsection
