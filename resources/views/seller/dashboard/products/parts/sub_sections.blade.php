<option value="" >اختر القسم الفرعي</option>
@foreach($data as $row)
    <option value="{{$row->id}}">{{$row->title}}</option>
@endforeach
