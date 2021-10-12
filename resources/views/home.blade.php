@extends('admin_temp')
@section('content')
    @can('home')
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('admin.home_page')}}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card bg-info">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div class="m-r-20 align-self-center"><img src="../assets/images/icon/staff-w.png"
                                                                       alt="Income"/></div>
                            <div class="align-self-center">
                                <h6 class="text-white m-t-10 m-b-0">{{trans('admin.employee_count')}}</h6>
                                <h2 class="m-t-0 text-white">{{$employercount}}</h2></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card bg-success">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div class="m-r-20 align-self-center"><img src="../assets/images/icon/staff-w.png"
                                                                       alt="Income"/></div>
                            <div class="align-self-center">
                                <h6 class="text-white m-t-10 m-b-0">{{trans('admin.users_count')}}</h6>
                                <h2 class="m-t-0 text-white">{{$usercount}}</h2></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card bg-primary">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div class="m-r-20 align-self-center"><img src="../assets/images/icon/assets-w.png"
                                                                       alt="Income"/></div>
                            <div class="align-self-center">
                                <h6 class="text-white m-t-10 m-b-0">{{trans('admin.bank_count')}}</h6>
                                <h2 class="m-t-0 text-white">{{$bankcount}}</h2></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card bg-danger">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div class="m-r-20 align-self-center"><img src="../assets/images/icon/expense-w.png"
                                                                       alt="Income"/></div>
                            <div class="align-self-center">
                                <h6 class="text-white m-t-10 m-b-0">{{trans('admin.fund_count')}}</h6>
                                <h2 class="m-t-0 text-white">{{$fundcount}}</h2></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{trans('admin.fund_chart')}}</h4>
                        <div>
                            <canvas id="chart3" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{trans('admin.user_chart')}}</h4>
                        <div>
                            <canvas id="chart1" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
@section('scripts')
    <script src="{{ asset('/assets/plugins/Chart.js/Chart.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Chart for Super admin

            var ctx3 = document.getElementById("chart3").getContext("2d");
            var data3 = [
                {
                    value: {!! $rejected_fund !!},
                    color: "#ef5350",
                    highlight: "#ef5350",
                    label: '@lang('admin.rejected_fund')'
                },
                {
                    value: {!! $accepted_fund !!},
                    color: "#06d79c",
                    highlight: "#06d79c",
                    label: '@lang('admin.accepted_fund')'
                },
                {
                    value: {!! $pending_fund !!},
                    color: "#398bf7",
                    highlight: "#398bf7",
                    label: '@lang('admin.pending_fund')'
                },
            ];
            var myPieChart = new Chart(ctx3).Pie(data3, {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 0,
                animationSteps: 100,
                tooltipCornerRadius: 0,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
                responsive: true
            });
            var ctx1 = document.getElementById("chart1").getContext("2d");
            var data1 = {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "#009efb",
                        strokeColor: "#009efb",
                        pointColor: "#009efb",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#009efb",
                        data: {!! $user_count !!}
                    }
                ],
            };
            Chart.types.Line.extend({
                name: "LineAlt",
                initialize: function () {
                    Chart.types.Line.prototype.initialize.apply(this, arguments);
                    var ctx = this.chart.ctx;
                    var originalStroke = ctx.stroke;
                    ctx1.stroke = function () {
                        ctx1.save();
                        ctx1.shadowColor = 'rgba(0, 0, 0, 0.4)';
                        ctx1.shadowBlur = 10;
                        ctx1.shadowOffsetX = 8;
                        ctx1.shadowOffsetY = 8;
                        originalStroke.apply(this, arguments)
                        ctx1.restore();

                    }
                }
            });
            var chart1 = new Chart(ctx1).LineAlt(data1, {
                scaleShowGridLines: true,
                scaleGridLineColor: "rgba(0,0,0,.005)",
                scaleGridLineWidth: 0,
                scaleShowHorizontalLines: true,
                scaleShowVerticalLines: true,
                bezierCurve: true,
                bezierCurveTension: 0.4,
                pointDot: true,
                pointDotRadius: 4,
                pointDotStrokeWidth: 2,
                pointHitDetectionRadius: 2,
                datasetStroke: true,
                tooltipCornerRadius: 2,
                datasetStrokeWidth: 0,
                datasetFill: false,
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                responsive: true
            });
        });
    </script>
@endsection
