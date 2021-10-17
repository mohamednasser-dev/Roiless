@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.branches_banks')}}</h3>
        </div>
        
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{trans('admin.branches_banks')}}</li>
                <li class="breadcrumb-item"><a href="{{route('banks.index')}}">{{trans('admin.banks')}}</a></li>
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
            <table
                   class="table full-color-table full-primary-table">

                <thead class="bg-primary">
                <tr>
                    <th scope="col">{{trans('admin.name')}}</th>
                    <th scope="col">{{trans('admin.image')}}</th>
                    <th scope="col">{{trans('admin.funds')}}</th>
                    <th scope="col">{{trans('admin.address')}}</th>
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
                          <a href="{{route('funds.of.bank',$branch->id)}}">  {{count($branch->funds)}} </a>
                        </td>
                        <td>
                            {{$branch->address}}
                        </td>
                        <td>
                            <ul class="list-inline soc-pro m-t-30">
                                            @if($branch->status=="active")
                                            <li><a id="btn_bank_unactive" class=" btn btn-success" title="تعديل" data-bankid="{{$branch->id}}" data-toggle="modal" data-target="#myModal" href="" id="btn_bank_unactive" >تعطيل</a></li>
                                             @else  
                                           <li>
                                                    <a href="{{route('banks.actived',$branch->id)}}" class="btn btn-danger"  data-target="#myModal">تفعيل</a>          
                                           </li> 
                                            @endif
                                <li><a class="btn-circle btn btn-success" title="تعديل"
                                       href="{{url('banks/'.$branch->id.'/edit')}}"><i class="fa fa-edit"></i></a></li>
                               
                                <li><a class="btn-circle btn btn-danger" title="حذف"
                                       onclick="return confirm('هل انت متاكد من حذف البنك')"
                                       href="{{route('banks.delete',$branch->id)}}"><i class="fa fa-trash"></i></a></li>

                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
                           
                            <select class="custom-select form-control pull-right"  name="bank_id">
                                <option  selected value="no_bank">{{trans('admin.trans_bank')}}</option>
                                @foreach($active_banks as $active_bank)                          
                                    <option value="{{$active_bank->id}}">{{$active_bank->name_ar}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-success " >{{trans('admin.trans_disaple')}}</button>
                          </div>
                        </div>
                    </form> 
                    <form  action="{{route('banks.unactived')}}" method="post"> 
                        @csrf  
                        <input type="hidden" name="id" id="txt_bank_id2">
                        <div class="modal-footer">
                            <div class="col text-center">
                               <button type="submit" class="btn btn-danger" >{{trans('admin.trans')}}</button>
                            </div> 
                        </div>
                    </form>       
                </div>             
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts')
<script >
    $(document).on('click','#btn_bank_unactive', function(){
        $('#txt_bank_id').val( $(this).data('bankid') );
        $('#txt_bank_id2').val( $(this).data('bankid') );
    });
</script>
@endsection
