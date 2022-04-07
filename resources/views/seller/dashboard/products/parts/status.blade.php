
@if($status == 'accepted')
    <span style="width: 100px;" class="label label-success label-rounded">تم الموافقة</span>
@elseif($status == 'rejected')
    <!-- Button trigger modal-->
    <button type="button" title="اضغط هنا لمعرفة سبب الرفض" id="reject_btn" class="btn btn-danger" data-toggle="modal" data-target="#rejectReasonModal" data-reason="{{$reject_reason}}">
        تم الرفض
    </button>
@elseif($status == 'pending')
    <span style="width: 100px;" class="label label-warning label-rounded">في انتظار الموافقة</span>
@endif
