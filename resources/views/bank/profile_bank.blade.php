@extends('bank.bank_temp')
@section('styles')
       <style>
            .cont-image{
             position: relative;

             }
            .cont-img img { display: block; }
            .img-circle{
                height: 180px;
                width: 175px;
            }
            .cont-image .fa-camera {position: absolute;
                bottom: 0;
                left: 85px;
                background: #d5ffff;
                font-size: 21px;
                width: 35px;
                height: 35px;
                text-align: center;
                line-height: 35px;
                border-radius: 50%; }
        </style>
@endsection
@section('content')
<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">{{trans('bank.profile')}}</h3>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">الحساب</li>
                            <li class="breadcrumb-item active"><a href="{{route('home')}}">{{trans('bank.nav_home')}}</a></li>
                        </ol>
                    </div>
                    <div>
                        <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="cont-image">
                                  <center class="m-t-30"> <img  id='output' src="{{ Auth::user()->image}}" class="img-circle" width="150" / >
                                  <label for="file" style="cursor: pointer;"><i class="fas fa-camera fa-2x"></i></label>
                                </div>
                                     <div>
                                     <center class="m-t-30"> <h4 class="card-title m-t-10">{{Auth::user()->name}}</h4>
                                    </div>
                                    <center class="m-t-30"> <form action="{{route('banks.update.image')}}" class="form-horizontal form-material" method="POST"enctype="multipart/form-data" >
                                     @csrf
                                    
                                     <div class="form-group">
                                                <div class="col-sm-12">
                                                <p><input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(this)" style="display: none;"></p>

                                                    <button class="btn btn-success">{{trans('bank.change_photo')}}</button>
                                                </div>
                                            </div>
                                      </form>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">{{trans('bank.email')}} </small>
                                <h6>{{Auth::user()->email}}</h6> <small class="text-muted p-t-30 db">{{trans('bank.phone')}}</small>
                               <p>{{Auth::user()->phone}}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">{{trans('bank.user_info')}}</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">{{trans('bank.password')}}</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">

                                    @if(Session::has('wrong_pass'))
                                        <div class="alert alert-danger" role="alert">
                                        {{Session::get('wrong_pass')}}
                                        </div>
                                    @endif
                                    <div class="tab-pane" id="settings" role="tabpanel">
                                    <div class="card-body">
                                        <form action="{{route('banks.update')}}" class="form-horizontal form-material" method="POST">
                                        @csrf
                                            <div class="form-group">
                                                <label class="col-md-12">{{trans('bank.name_arabic')}}</label>
                                                <div class="col-md-12">
                                                    <input name="name_ar" type="text" value="{{Auth::user()->name_ar}}" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">{{trans('bank.english_name')}}</label>
                                                <div class="col-md-12">
                                                    <input name="name_en" type="text" value="{{Auth::user()->name_en}}" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="example-email" class="col-md-12">{{trans('bank.email')}}</label>
                                                <div class="col-md-12">
                                                    <input type="email" value="{{Auth::user()->email}}" class="form-control form-control-line" name="email" id="example-email">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-12">{{trans('bank.phone_num')}}</label>
                                                <div class="col-md-12">
                                                    <input name="phone" type="text" value="{{Auth::user()->phone}}" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success" type="submit">{{trans('bank.edit')}}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                    </div>
                                </div>
                                <!--second tab-->
                                <div class="tab-pane" id="profile" role="tabpanel">
                                <div class="tab-pane" id="settings" role="tabpanel">
                                    <div class="card-body">
                                    <form action="{{route('banks.update.password')}}" class="form-horizontal form-material" method="POST">
                                        @csrf
                                      
                                           <div class="form-group">
                                                <label class="col-md-12">{{trans('bank.old_password')}}</label>
                                                <div class="col-md-12">
                                                    <input type="password" name="old_password"  class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">{{trans('bank.password')}}</label>
                                                <div class="col-md-12">
                                                    <input type="password" name="password"  class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="example-email" class="col-md-12">{{trans('bank.confirm_password')}}</label>
                                                <div class="col-md-12">
                                                    <input type="password" name="password_confirmation" class="form-control form-control-line" name="example-email" id="example-email">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success">{{trans('bank.change_password')}}</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme">4</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme working">7</a></li>
                                <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2017 Admin Pro by wrappixel.com
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->






@endsection
@section('scripts')
    <script type="text/javascript">
        function update_active(el) {
            if (el.checked) {
                var status = 'active';
            } else {
                var status = 'unactive';
            }
            $.post('{{ route('users.actived') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function (data) {
                if (data == 1) {
                    toastr.success("{{trans('admin.statuschanged')}}");
                } else {
                    toastr.error("{{trans('admin.statuschanged')}}");
                }
            });
        }






        var loadFile = function(event) {

var url = event.value;
console.log(url);
var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
 if (event.files && event.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "webp")) {

    var image = document.getElementById('output');
      image.src = URL.createObjectURL(event.files[0]);

 }

};
    </script>
@endsection
