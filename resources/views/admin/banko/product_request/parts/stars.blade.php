

@if($stars == 0)
    <a href="{{route('admin.product.requests.make_star',['id'=>$id,'stars'=>1])}}" title="جعل المنتج يظهر في الصفحة الرئيسية"
       class="btn btn-warning">
        <i class="fas fa-star"></i>
    </a>
@else
    <a href="{{route('admin.product.requests.make_star',['id'=>$id,'stars'=>1])}}" title="حذف المنتج من الظهور في الصفحة الرئيسية"
       class="btn btn-danger">
        <i class="fas fa-star"></i>
    </a>
@endif
