@extends('admin_temp')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/dropify/dist/css/dropify.min.css') }}">
@endsection
@section('content')

<div class="table-responsive">
    <a href="{{ route('categories.add') }}" class="btn btn-success">اضافة قسم </a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Title-ar</th>
                <th>Title-en</th>
                <th>Image</th>
                <th>financing_ratio</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($categories as $category)


            <tr>
                <td>{{ $category->title_ar }}</td>
                <td>{{ $category->title_en }}</td>
                <td> <img width="60px" src= "{{ asset ('images/category/'.$category->image) }}" alt='image' /> </td>
                <td>{{ $category->financing_ratio }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->id )}}" class="btn btn-success"> تعديل </a>
                    <form style="display:inline;" action="{{ route('categories.delete' ,$category->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button   type="submit" class="btn btn-danger">Delete</button>

                    </form>
                   

                </td>
              
                </tr>

           

            @endforeach

        </tbody>
    </table>
</div>







@endsection
                