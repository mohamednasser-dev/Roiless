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
        <a href="{{url('banks/create/0')}}"
           class="btn btn-info btn-bg">{{trans('admin.add_bank')}}</a>
    </div>
    <br>
    <div class="row">
            <div class="table-responsive ">
                <table
                       class="table full-color-table full-primary-table">

                    <thead class="bg-primary">
                    <tr>
                        <th style="width: 20%">{{trans('admin.bank_name')}}</th>
                        <th style="width: 20%">{{trans('admin.logo')}}</th>
                        <th style="width: 20%">{{trans('admin.Orders_received')}}</th>
                        <th style="width: 20%">{{trans('admin.count_pranches')}}</th>
                        <th style="width: 20%">{{trans('admin.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($banks as $bank)
                        <tr>
                            <td scope="row">{{$bank->name_ar}}</td>
                            <td  style="width: 100px; height: 100px;">
                              
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
                                  <a href="{{route('funds.of.bank', $bank->id)}}"> {{$userfund}} </a> 
                                 @else
                                    {{trans('admin.not_order')}}
                                 @endif 
                           </td> 
                           <td>
                              <a href="{{route('banks.branches',$bank->id)}}"> {{count($bank->Branches)}}  </a>
                           </td>

                            <td>
                                <ul class="list-inline soc-pro m-t-30">
                                    <li>
                                             @if($bank->status=="active")
                                          
                                                <div class="ml-auto">
                                                    <button  class="pull-right btn btn-circle btn-success" id="btn_bank_unactive" data-bankid="{{$bank->id}}" data-toggle="modal" data-target="#myModal"><i class="ti-plus"></i></button>
                                                </div>
                                            
                                             @else  
                                           
                                                <div class="ml-auto">
                                                    <a href="{{route('banks.actived',$bank->id)}}" class="pull-right btn btn-circle btn-danger"  data-target="#myModal"><i class="ti-plus"></i></a>
                                                </div>
                                          
                                            @endif
                                    <li>
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{trans('admin.sure')}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('banks.unactived')}}" method="post">
                                                      @csrf  
                                                      <input type="hidden" name="id" id="txt_bank_id">
                                                        <div class="form-group">
                                                            <h3></h3>
                                                            <select class="custom-select form-control pull-right"  name="bank_id">
                                                                <option  selected >{{trans('admin.trans_bank')}}</option>
                                                                @foreach($active_banks as $active_bank)
                                                            
                                                                    <option value="{{$active_bank->id}}">{{$active_bank->name_ar}}</option>
                                    
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                          
                                                            <button type="submit" class="btn btn-success" >{{trans('admin.trans')}}</button>
                                                        </div>
                                                    </form> 
                                                   <form  action="{{route('banks.unactived')}}" method="post"> 
                                                      @csrf  
                                                      <input type="hidden" name="id" id="txt_bank_id2">
                                                   <div class="modal-footer">
                                                   <button type="submit" class="btn btn-danger" >{{trans('admin.trans')}}</button>
                                                   </div>
                                                   </form>       
                                                </div>             
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <li><a class="btn-circle btn btn-success" title="تعديل" href="{{url('banks/'.$bank->id.'/edit')}}"><i class="fa fa-edit"></i></a></li>
                                    <li><a class="btn-circle btn btn-danger" title="حذف" onclick="return confirm('هل انت متاكد من حذف البنك')"
                                           href="{{route('banks.delete',$bank->id)}}"><i class="fa fa-trash"></i></a></li>
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
  $('#btn_bank_unactive').click(function (event) {
    var inputF = document.getElementById("txt_bank_id");
    inputF.value = "{!! $bank->id !!}";
    });
</script>
@endsection
