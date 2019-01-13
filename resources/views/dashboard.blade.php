@extends('layouts.template')

@section('page_title', 'Dashboard')

@section('breadcrumbs')
    <li><i class="fa fa-dashboard"></i> Dashboard</li>
@endsection

@section('content')

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $topCards[0] }}</h3>

                        <p>Actieve Producten</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('products.index') }}" class="small-box-footer">Meer info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $topCards[1] }}</h3>

                        <p>Gesloten Producten</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('products.index') }}" class="small-box-footer">Meer info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $topCards[2] }}</h3>

                        <p>Gebruiker Registraties</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('users.index') }}" class="small-box-footer">Meer info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            €{{ number_format($topCards[3], 2, ',', '.') }}
                        </h3>

                        <p>Opbrengst</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('orders.index') }}" class="small-box-footer">Meer info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">

            <div id="monthly-recap-report-data" class="hide">
                {{ $monthlyRecapReport }}
            </div>

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Maandelijkse Orders</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-wrench"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-center">
                                    <strong>Verkoop: 1 Jan, 2018 - 31 Dec, 2018</strong>
                                </p>

                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="salesChart" style="height: 180px;"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <p class="text-center">
                                    <strong>Doelen Voltooiing</strong>
                                </p>

                                <div class="progress-group">
                                    <span class="progress-text">Producten toevoegen aan winkelwagen</span>
                                    <span class="progress-number"><b>0</b>/200</span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-aqua" style="width: 0%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    <span class="progress-text">Betaalde Orders</span>
                                    <span class="progress-number"><b>0</b>/400</span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-red" style="width: 0%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    <span class="progress-text">Visit Premium Page</span>
                                    <span class="progress-number"><b>0</b>/800</span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-green" style="width: 0%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    <span class="progress-text">Send Inquiries</span>
                                    <span class="progress-number"><b>0</b>/500</span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-yellow" style="width: 0%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> -%</span>
                                    <h5 class="description-header">€{{ number_format($topCards[3], 2, ',', '.') }}</h5>
                                    <span class="description-text">TOTALE OPBRENGST</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> -%</span>
                                    <h5 class="description-header"></h5>
                                    <span class="description-text"></span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> -%</span>
                                    <h5 class="description-header"></h5>
                                    <span class="description-text"></span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block">
                                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> -%</span>
                                    <h5 class="description-header"></h5>
                                    <span class="description-text"></span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-8">
                <!-- TABLE: LATEST ORDERS -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Laatste Bestellingen</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Bestelling ID</th>
                                    <th>Klant</th>
                                    <th>Status</th>
                                    <th>Aantal Producten</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orderList as $order)
                                    <tr>
                                        <td><a href="#">{{ $order->id }}</a></td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>
                                            @if($order->state->id == 1)
                                                <span class="label label-danger">{{ $order->state->name }}</span>
                                            @elseif($order->state->id == 2)
                                                    <span class="label label-warning">{{ $order->state->name }}</span>
                                            @elseif($order->state->id == 3)
                                                    <span class="label label-info">{{ $order->state->name }}</span>
                                            @elseif($order->state->id == 4)
                                                    <span class="label label-success">{{ $order->state->name }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $total_products = 0;
                                                foreach($order->products as $product){
                                                    $total_products += $product->pivot->amount;
                                                }
                                            @endphp
                                            {{ $total_products }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <a href="{{ url('orders')  }}" class="btn btn-sm btn-default btn-flat pull-right">Bekijk alle bestellingen</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

            <div class="col-md-4">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Betaalmethoden Gebruik</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="chart-responsive">
                                    <canvas id="pieChart" height="150"></canvas>
                                </div>
                                <!-- ./chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <ul class="chart-legend clearfix">
                                    @php
                                        $colors = ['text-red', 'text-green', 'text-yellow', 'text-aqua', 'text-red', 'text-red', 'text-red', 'text-red', 'text-red',];
                                    @endphp

                                    @foreach($paymentMethods as $index => $method)
                                        <li>
                                            <input type="hidden" name="{{ $method->name }}" value="{{ $method->payment->count() }}" class="method">
                                            <i class="fa fa-circle {{ $colors[$index] }}"></i>
                                            {{ $method->name }}
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
@endsection

@push('scripts')
    <!-- ChartJS -->
    <script src="/bower_components/chart.js/Chart.js"></script>

    <script>
        $("#dashboard").addClass("active");
    </script>

    <script>
        $(function () {

            'use strict';

            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            // -----------------------
            // - MONTHLY SALES CHART -
            // -----------------------

            var myChartData = new Array(document.getElementById("monthly-recap-report-data").innerHTML);

            // Get context with jQuery - using jQuery's .get() method.
            var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
            // This will get the first returned node in the jQuery collection.
            var salesChart       = new Chart(salesChartCanvas);

            var salesChartData = {
                labels  : ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'],
                datasets: [
                    {
                        label               : 'Orders',
                        fillColor           : 'rgba(60,141,188,0.9)',
                        strokeColor         : 'rgba(60,141,188,0.8)',
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : [1,1,1,1,1,1,1,2,2,4,7],
                    }
                ]
            };

            var salesChartOptions = {
                // Boolean - If we should show the scale at all
                showScale               : true,
                // Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines      : false,
                // String - Colour of the grid lines
                scaleGridLineColor      : 'rgba(0,0,0,.05)',
                // Number - Width of the grid lines
                scaleGridLineWidth      : 1,
                // Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                // Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines  : true,
                // Boolean - Whether the line is curved between points
                bezierCurve             : true,
                // Number - Tension of the bezier curve between points
                bezierCurveTension      : 0.3,
                // Boolean - Whether to show a dot for each point
                pointDot                : false,
                // Number - Radius of each point dot in pixels
                pointDotRadius          : 4,
                // Number - Pixel width of point dot stroke
                pointDotStrokeWidth     : 1,
                // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius : 20,
                // Boolean - Whether to show a stroke for datasets
                datasetStroke           : true,
                // Number - Pixel width of dataset stroke
                datasetStrokeWidth      : 2,
                // Boolean - Whether to fill the dataset with a color
                datasetFill             : true,
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio     : true,
                // Boolean - whether to make the chart responsive to window resizing
                responsive              : true
              };

              // Create the line chart
              salesChart.Line(salesChartData, salesChartOptions);

              // ---------------------------
              // - END MONTHLY SALES CHART -
              // ---------------------------

            // -------------
            // - PIE CHART -
            // -------------



            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
            var pieChart       = new Chart(pieChartCanvas);
            var PieData        = [
                {
                    value    : 0,
                    color    : '#f56954',
                    highlight: '#f56954',
                    label    : 'empty'
                },
                {
                    value    : 0,
                    color    : '#00a65a',
                    highlight: '#00a65a',
                    label    : 'empty'
                },
                {
                    value    : 0,
                    color    : '#f39c12',
                    highlight: '#f39c12',
                    label    : 'empty'
                },
                {
                    value    : 0,
                    color    : '#00c0ef',
                    highlight: '#00c0ef',
                    label    : 'empty'
                },
                {
                    value    : 0,
                    color    : '#00c0ef',
                    highlight: '#00c0ef',
                    label    : 'empty'
                },
                {
                    value    : 0,
                    color    : '#00c0ef',
                    highlight: '#00c0ef',
                    label    : 'empty'
                },
                {
                    value    : 0,
                    color    : '#00c0ef',
                    highlight: '#00c0ef',
                    label    : 'empty'
                },
                {
                    value    : 0,
                    color    : '#00c0ef',
                    highlight: '#00c0ef',
                    label    : 'empty'
                },
                {
                    value    : 0,
                    color    : '#00c0ef',
                    highlight: '#00c0ef',
                    label    : 'empty'
                },
                {
                    value    : 0,
                    color    : '#00c0ef',
                    highlight: '#00c0ef',
                    label    : 'empty'
                },
            ];

            var methods = document.getElementsByClassName("method");
            for (var i = 0; i < methods.length; i++) {
                PieData[i].label = methods[i].name;
                PieData[i].value = methods[i].value;
            }


            var pieOptions     = {
                // Boolean - Whether we should show a stroke on each segment
                segmentShowStroke    : true,
                // String - The colour of each segment stroke
                segmentStrokeColor   : '#fff',
                // Number - The width of each segment stroke
                segmentStrokeWidth   : 1,
                // Number - The percentage of the chart that we cut out of the middle
                percentageInnerCutout: 50, // This is 0 for Pie charts
                // Number - Amount of animation steps
                animationSteps       : 100,
                // String - Animation easing effect
                animationEasing      : 'easeOutBounce',
                // Boolean - Whether we animate the rotation of the Doughnut
                animateRotate        : true,
                // Boolean - Whether we animate scaling the Doughnut from the centre
                animateScale         : false,
                // Boolean - whether to make the chart responsive to window resizing
                responsive           : true,
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio  : false,
              };
              // Create pie or douhnut chart
              // You can switch between pie and douhnut using the method below.
              pieChart.Doughnut(PieData, pieOptions);
              // -----------------
              // - END PIE CHART -
              // -----------------
        });
    </script>
@endpush