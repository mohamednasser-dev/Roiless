<div class="row">
    <div class="col-md-6">
        <a href="{{route('admin.product_requests.change_status',['status'=>'accepted','id'=>$id])}}"
           class="btn btn-success">موافقة
            <i class="fa fa-check"> </i>
        </a>
    </div>
    <div class="col-md-6">
        <a href="{{route('admin.product_requests.change_status',['status'=>'rejected','id'=>$id])}}"
           class="btn btn-danger">
            مرفوض
            <i class="fa fa-close"> </i>
        </a>
    </div>
</div>
@if($status == 'accepted')
    <span class="label label-success label-rounded">موافق علية</span>
@elseif($status == 'rejected')
    <span class="label label-danger label-rounded">مرفوض</span>
@elseif($status == 'pending')
    <span class="label label-warning label-rounded">في انتظار الموافقة</span>
@endif
