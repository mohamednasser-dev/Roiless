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
                                    <h6><a href="#">{{$data->title_ar}}</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="single-job-post me-1 wow fadeInUp mt-25">
                            <div class="post-header">
                                <div>
                                    <h6 class="job-title">{{$service_detailes->title_ar}}</h6>
                                </div>
                            </div>
                            <div class="post-content">
                                <p>{!! $service_detailes->desc_ar !!}</p>
                            </div>
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
