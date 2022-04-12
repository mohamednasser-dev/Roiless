@if($status == 'pending')
    <div class="row">
        <div class="col-md-6">
            <a
                href="{{route('seller.orders.change_status',['status'=>'accepted','id'=>$id])}}"
                class="btn btn-success">موافقة
                <i class="fa fa-check"> </i>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{route('seller.orders.change_status',['status'=>'rejected','id'=>$id])}}"
               class="btn btn-danger">
                رفض
                <i class="fa fa-close"> </i>
            </a>
        </div>
    </div>
@elseif($status == 'accepted')
    <a href="{{route('seller.orders.change_status',['status'=>'rejected','id'=>$id])}}"
       class="btn btn-danger">
        رفض
        <i class="fa fa-close"> </i>
    </a>
@elseif($status == 'rejected')
    <a
        href="{{route('seller.orders.change_status',['status'=>'accepted','id'=>$id])}}"
        class="btn btn-success">موافقة
        <i class="fa fa-check"> </i>
    </a>
@endif
