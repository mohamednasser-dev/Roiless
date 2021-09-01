@extends('admin_temp')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/dropify/dist/css/dropify.min.css') }}">
@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body wizard-content">
               
                <form class="tab-wizard wizard-circle" method="POST" action="{{ route('categories.update' ,$category->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                   @csrf
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName1">Title ar:</label>
                                    <input type="text" value="{{ $category->title_ar }}" name="title_ar" class="form-control" id="firstName1"> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastName1">Title en :</label>
                                    <input type="text" value="{{ $category->title_en }}" name="title_en" class="form-control" id="lastName1"> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailAddress1">Image :</label>
                                    <input type="file" name="image" class="form-control" id="emailAddress1"> </div>
                            </div>
                           
                           
                        </div>
                        
                        <div style="text-align: center" class="row">
                            <div class="col-md-12" style="text-align:center;">
                                <button type="submit" style=" background-color:#0d3d0b; border:none;" class="btn btn-success">تعديل</button>
                            </div>
                        </div>
                    </section>
                 

                </form>
            </div>
        </div>
    </div>
</div>


    @endsection
