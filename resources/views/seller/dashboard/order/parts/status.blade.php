
@if($status == 'accepted')
    <span style="width: 100px;" class="label label-success label-rounded">تم الموافقة</span>
@elseif($status == 'rejected')
    <!-- Button trigger modal-->
    <span style="width: 100px;" class="label label-danger label-rounded">تم الرفض</span>
@elseif($status == 'pending')
    <span style="width: 100px;" class="label label-warning label-rounded">في انتظار الموافقة</span>
@endif
