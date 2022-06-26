@extends('layouts.web')
@section('header')
    header-menu-3
@endsection
@section('main')
    <main>
        <section class="loan-deatils-area bg_disable pt-130 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="stepper-widget mt-sm-5 px-3 px-sm-0 bg_white">
                            <div class="blog-widget-1 wow fadeInUp" data-wow-delay="0.1s">
                                <img class="w-100" style="height:160px" src="{{$data->Investments->image}}"
                                     alt="news image">
                                <div class="blog-content pr-10 pl-10">
                                    <h6><a href="#">{{$data->Investments->name_ar}}</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="loan-details-widget bg_white">
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <label class="label">الاسم ثلاثي</label>
                                    <input class="form-control" name="name" value="{{$data->name}}" type="text"
                                           readonly>
                                </div>
                                <div class="col-md-12">
                                    <label class="label">رقم الهاتف</label>
                                    <input class="form-control" name="phone" value="{{$data->phone}}" type="text"
                                           readonly>
                                </div>
                                <div class="col-md-12">
                                    <label class="label">مبلغ الاستثمار</label>
                                    <input class="form-control" name="amount" value="{{$data->amount}}" type="text"
                                           readonly>
                                </div>
                                <div class="col-md-12">
                                    <label class="label">مدة العائد</label>
                                    <input class="form-control" name="amount" value="{{$data->amount}}"
                                           type="text" readonly>
                                </div>
                                <h3>صور الهوية</h3>
                                @foreach($data->Images as $image)
                                    <div class="col-md-2">
                                        <img src="{{ asset('uploads/Investments') . '/' . $image->image}}"
                                             style="width: 170px; height: 150px;">
                                    </div>
                                    &nbsp;<div class="col-md-1">  </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#cmd_profites').change(function () {
                var level = $(this).val();
                $('#total_container').show();

                // $.ajax({
                //     url: "/get_subjects/" + level,
                //     dataType: 'html',
                //     type: 'get',
                //     success: function (data) {
                //         $('#subject_cont').show();
                //         $('#lbl_subject_cont').show();
                //         $('#cmb_subjects').html(data);
                //     }
                // });
            });
        });

    </script>
@endsection
