
    <a href="{{route('seller.products.show',$id)}}" title="التفاصيل"
       class="btn btn-icon btn-light-success btn-circle mr-2">
        <i class="fas fa-eye"></i>
    </a>
    <a href="{{route('seller.products.edit',$id)}}" title="تعديل" class="btn btn-icon btn-light-primary btn-circle mr-2">
        <i class="flaticon-edit"></i>
    </a>
    <a href="{{route('seller.products.delete',$id)}}" title="حذف" onclick=" return confirm('هل متاكد من الحذف ؟ ')"
       class="btn btn-icon btn-light-danger btn-circle mr-2 ">
        <i class="flaticon2-rubbish-bin-delete-button "></i>
    </a>
