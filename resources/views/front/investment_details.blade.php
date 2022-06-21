@extends('layouts.web')
@section('header')
    header-menu-3
@endsection
@section('main')
    <main>
        <!-- Persinal Details start -->
        <section class="loan-deatils-area bg_disable pt-130 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="stepper-widget mt-sm-5 px-3 px-sm-0 bg_white">
                            <div class="blog-widget-1 wow fadeInUp" data-wow-delay="0.1s">
                                <img class="w-100" style="height:160px" src="{{$data->image}}" alt="news image">
                                <div class="blog-content pr-10 pl-10">
                                    <h6><a href="#">{{$data->name_ar}}</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="loan-details-widget bg_white">
                            <form action="{{route('front.investment.store')}}" method="post" files="true" enctype="multipart/form-data" >
                                @csrf
                                <div class="row gy-4">
                                    <input type="hidden" name="investment_id" value="{{$data->id}}">
                                    <input type="hidden" name="investment_type" value="test_investment_type">
                                    <input type="hidden" name="address" value="test_address">
                                    <div class="col-md-12">
                                        <label class="label">الاسم ثلاثي</label>
                                        <input class="form-control" name="name" type="text" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="label">رقم الهاتف</label>
                                        <input class="form-control" name="phone" type="text" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="label">مبلغ الاستثمار</label>
                                        <input class="form-control" name="amount" type="text" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="label">مدة العائد</label>
                                        <select name="profites" class="form-control" required id="cmd_profites">
                                            <option disabled selected>اختر مدة العائد</option>
                                            <option value="1">شهري</option>
                                            <option value="3">ريع سنوي</option>
                                            <option value="6">نصف سنوي</option>
                                            <option value="12">سنوي</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" style="display: none;" id="total_container">
                                        <label class="label" for="'.$field.'">مبلغ العائد : <span id="lbl_total" style="color: red;">100</span> جنية مصري </label>

                                    </div>
                                    <div class="col-md-12">
                                        <label class="label"> رفع صور الهوية</label>
                                        <input class="form-control" name="images[]" type="file" multiple required>
                                    </div>
                                </div>
                                <div class="row mt-60">
                                    <div class="col-md-12">
                                        <div class="nav-btn d-flex flex-wrap justify-content-between">
                                            <button type="submit"
                                                    class=" next-btn theme-btn-primary_alt theme-btn ">حفظ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Persinal Details end -->
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
