@extends('admin_temp')
@section('content')
<div class="row page-titles">
        <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">{{trans('admin.users')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
            <li class="breadcrumb-item">{{trans('admin.users')}}</li>
                <li class="breadcrumb-item active"><a href="{{url('home')}}">{{trans('admin.home_page')}}</a></li>
            </ol>
        </div>
    </div>

        <div class="row">
            <div class="col-sm-12">  

              <form  action="{{route('user.export.search')}}" method="post"> 
                  @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{trans('admin.export_user_excel')}}</h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-2">
                                <input name="group1" checked type="radio" class="with-gap" id="radio_1" name="radio_1" value="1">
                                <label for="radio_1"></label>
                            </div>
                                <div class="col-lg-2">
                                <label>الكل</label>
                            </div>

                            <div class="col-lg-4">
                              
                            </div>

                            <div class="col-lg-4">
                              
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-lg-2">
                                <input name="group1" type="radio" class="with-gap" id="radio_2" name="radio_2" value="2">
                                <label for="radio_2"></label>
                                </div>
                                <div class="col-lg-2">
                                <label>شهري</label>
                            </div>

                            <div class="col-lg-4">
                                <div id="monthely" style="display:none;">
                                    <select class="select2 m-b-10 select2-multiple" style="width: 100%" data-placeholder="Choose" name="month" >
                                        <option value="1" selected>1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>    
                            </div>

                            <div class="col-lg-4" id="monthely_year" style="display:none;">
                            <select  class="select2 m-b-10 select2-multiple" style="width: 100%" data-placeholder="Choose" name="annual"  >
                                        <option value="2021" selected>2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                        <option value="2032">2032</option>
                                        <option value="2033">2033</option>
                                        <option value="2034">2034</option>
                                        <option value="2035">2035</option>
                            </select>   
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-lg-2">
                                <input name="group1" type="radio" class="with-gap" id="radio_3" name="radio_3" value="3">
                                <label for="radio_3"></label>
                                </div>
                                <div class="col-lg-2">
                                <label>سنوي</label>
                            </div>

                            <div class="col-lg-4" style="display:none;" id="annual">
                            <select  class="select2 m-b-10 select2-multiple" style="width: 100%" data-placeholder="Choose" name="annualy"  >
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                        <option value="2032">2032</option>
                                        <option value="2033">2033</option>
                                        <option value="2034">2034</option>
                                        <option value="2035">2035</option>
                            </select>
                            </div>

                            <div class="col-lg-4">
                           
                            </div>
                        </div>  
                     

                            <div class="card">
                                <div class="card-body">
                                    <div class="center">
                                       <input type="submit" class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                        </div>
                     </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('scripts')

<script src="{{asset('../assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('../assets/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('../assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('js/perfect-scrollbar.jquery.min.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{asset('../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{asset('../assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('js/custom.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- Plugins for this page -->
    <!-- ============================================================== -->
    <!-- Plugin JavaScript -->
    <script src="{{asset('../assets/plugins/moment/moment.js')}}"></script>
    <script src="{{asset('../assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="{{asset('../assets/plugins/clockpicker/dist/jquery-clockpicker.min.js')}}"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="{{asset('../assets/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js')}}"></script>
    <script src="{{asset('../assets/plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js')}}"></script>
    <script src="{{asset('../assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js')}}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{asset('../assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="{{asset('../assets/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{asset('../assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script>
    // MAterial Date picker    
    $('#mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
    $('#timepicker').bootstrapMaterialDatePicker({ format: 'HH:mm', time: true, date: false });
    $('#date-format').bootstrapMaterialDatePicker({ format: 'dddd DD MMMM YYYY - HH:mm' });

    $('#min-date').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY HH:mm', minDate: new Date() });
    // Clock pickers
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });
    $('.clockpicker').clockpicker({
        donetext: 'Done',
    }).find('input').change(function() {
        console.log(this.value);
    });
    $('#check-minutes').click(function(e) {
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show').clockpicker('toggleView', 'minutes');
    });
    if (/mobile/i.test(navigator.userAgent)) {
        $('input').prop('readOnly', true);
    }
    // Colorpicker
    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
    // Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#date-range').datepicker({
        toggleActive: true
    });
    jQuery('#datepicker-inline').datepicker({
        todayHighlight: true
    });
    // Daterange picker
    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        format: 'MM/DD/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-limit-datepicker').daterangepicker({
        format: 'MM/DD/YYYY',
        minDate: '06/01/2015',
        maxDate: '06/30/2015',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        dateLimit: {
            days: 6
        }
    });
    </script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{asset('../assets/plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>

    <script>
$( document ).ready(function() {
    $('#radio_1').change(function(){      
    console.log( "ready!" );  
    $('#monthely').hide();
    $('#monthely_year').hide();
    $('#annual').hide();
    $('#category').hide();
     });
    $('#radio_2').change(function(){      
    console.log( "ready!" );
    $('#monthely').show();
    $('#monthely_year').show();
    $('#annual').hide();
    $('#category').hide();
     });
     $('#radio_3').change(function(){      
    console.log( "ready!" );
    $('#monthely').hide();
    $('#monthely_year').hide();
    $('#annual').show();
    $('#category').hide();
     });
     $('#radio_4').change(function(){      
    console.log( "ready!" );
    $('#monthely').hide();
    $('#monthely_year').hide();
    $('#annual').hide();
    $('#category').show();
     });
});
    </script>
@endsection