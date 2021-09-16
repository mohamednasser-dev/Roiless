@extends('admin_temp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">التمويل</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> مراجعه الطلب</li>
                <li class="breadcrumb-item active"><a href="{{route('userfunds')}}">التمويلات المطلوبه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">الرائيسيه</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home" role="tab">مراجعه
                            الطلب</a></li>
                </ul>

                <!-- Tab panes -->
                </br>
                <a
                   href="{{route('employerunchosen',[$requestreview->id,$requestreview->emp_id] )}}"><button type="submit" class="btn btn-danger">لا يمكنني اتخاذ القرار</button>
                </a>


                <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel">
                        <div class="card-body">
                            <div class="profiletimeline">
                                <div class="sl-item">
                                    <div class="sl-right">

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
