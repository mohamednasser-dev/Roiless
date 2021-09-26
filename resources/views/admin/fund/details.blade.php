@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('admin.fund')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> بيانات التمويل</li>
                <li class="breadcrumb-item active"><a href="{{route('fund')}}">{{trans('admin.funds')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('admin.fund')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card"><img class="card-img" src="{{$fund->image}}" alt="Card image">
                <div class="card-img-overlay card-inverse social-profile d-flex ">
                    <div class="align-self-center">
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home" role="tab"> بيانات
                            التمويل</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel">
                        <div class="card-body">
                            <div class="profiletimeline">
                                <div class="sl-item">
                                    <div class="sl-right">
                                        <small class="text-muted">{{trans('admin.name_arabic')}}</small>
                                        <h6>{{$fund->name_ar}}</h6>
                                        <br/>
                                        <small class="text-muted">{{trans('admin.english_name')}}</small>
                                        <h6>{{$fund->name_en}}</h6>
                                        <br/>
                                        <small class="text-muted">{{trans('admin.category_name')}}</small>
                                        <h6>{{$fund->category->title_ar}}</h6>
                                        <br/>
                                        <small class="text-muted">{{trans('admin.fund_ratio')}}</small>
                                        <h6>{{$fund->financing_ratio}}</h6>
                                        <br/>

                                        <small class="text-muted">{{trans('admin.required')}}</small><br>
                                        @foreach(json_decode($fund->columns, true) as $fundinput)
                                            {{ $fundinput }} <br>
                                        @endforeach
                                        <br/>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>

@endsection
@section('scripts')

@endsection
