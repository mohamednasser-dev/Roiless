<div class="row">
    @if($status == 'rejected' || $status == 'pending')
        <div class="col-md-6">
            <a href="{{route('admin.product_requests.change_status',['status'=>'accepted','id'=>$id])}}"
               class="btn btn-success">موافقة
                <i class="fa fa-check"> </i>
            </a>
        </div>
    @endif
    @if($status == 'accepted' || $status == 'pending')
        <div class="col-md-6">
            <a href="{{route('admin.product_requests.change_status',['status'=>'rejected','id'=>$id])}}"
               class="btn btn-danger">
                رفض
                <i class="fa fa-close"> </i>
            </a>
        </div>
    @endif
</div>
