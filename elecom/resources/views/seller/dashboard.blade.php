@extends('seller/layouts/layout')
@section('seller_page_title')
    Dashboard Seller
@endsection
@section('seller_layout')
    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
        }
    </style>

    <div class="container">
        <div class="card">
            <div class="row">
                <center>
                    <label for="" class="fs-2">Chào mừng nhân viên</label>
                    <p class="fs-1">{{ Auth::user()->name }}</p>
                </center>
            </div>
            <div class="row m-2">
                <div class="col-md-3 col-sm-6 col-12 mb-3">
                    <div class="card text-bg-primary bg-gradient h-100">
                        <!-- Bỏ max-width và thêm h-100 để card có chiều cao đầy đủ -->
                        <div class="card-body">
                            <div class="card-header bg-transparent">Sản phẩm trong kho</div>
                            <span class="card-header bg-transparent fs-2"><i class="fa-brands fa-product-hunt"></i> :</span>
                            <span class="card-text fs-2">{{ $products }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12 mb-3">
                    <div class="card text-bg-success bg-gradient h-100">
                        <!-- Bỏ max-width và thêm h-100 để card có chiều cao đầy đủ -->
                        <div class="card-body">
                            <div class="card-header bg-transparent text-white">Số đơn hàng chưa duyệt</div>
                            <span class="card-header bg-transparent fs-2 text-white"><i class="fa-solid fa-list"></i>
                                :</span>
                            <span class="card-text fs-2 text-white">{{ $orders }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12 mb-3">
                    <div class="card text-bg-info bg-gradient h-100">
                        <!-- Bỏ max-width và thêm h-100 để card có chiều cao đầy đủ -->
                        <div class="card-body">
                            <div class="card-header bg-transparent">Số Lượng Nhân viên</div>
                            <span class="card-header bg-transparent fs-2"><i class="fa-solid fa-users"></i> :</span>
                            <span class="card-text fs-2">{{ $vendors }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12 mb-3">
                    <div class="card text-bg-warning bg-gradient h-100">
                        <!-- Bỏ max-width và thêm h-100 để card có chiều cao đầy đủ -->
                        <div class="card-body">
                            <div class="card-header bg-transparent text-white">Tổng tiền</div>
                            <span class="card-header bg-transparent text-end fs-2 text-white"><i
                                    class="fa-solid fa-dollar-sign"></i> :</span>
                            <span class="card-text fs-2 text-end text-white">{{ $total_price }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="chartdiv"></div>
                </div>
            </div>
        </div>
    </div>


    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- Chart code -->
    <script>
        am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv");

            const myTheme = am5.Theme.new(root);

            // Move minor label a bit down
            myTheme.rule("AxisLabel", ["minor"]).setAll({
                dy: 1
            });

            // Tweak minor grid opacity
            myTheme.rule("Grid", ["minor"]).setAll({
                strokeOpacity: 0.08
            });

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root),
                myTheme
            ]);


            // Create chart
            // https://www.amcharts.com/docs/v5/charts/xy-chart/
            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "panX",
                wheelY: "zoomX",
                paddingLeft: 0
            }));


            // Add cursor
            // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                behavior: "zoomX"
            }));
            cursor.lineY.set("visible", false);

            var date = new Date();
            date.setHours(0, 0, 0, 0);
            var value = 100;

            function generateData() {
                value = Math.round((Math.random() * 10 - 5) + value);
                am5.time.add(date, "day", 1);
                return {
                    date: date.getTime(),
                    value: value
                };
            }

            function generateDatas(count) {
                var data = [];
                for (var i = 0; i < count; ++i) {
                    data.push(generateData());
                }
                return data;
            }


            // Create axes
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
                maxDeviation: 0,
                baseInterval: {
                    timeUnit: "day",
                    count: 1
                },
                renderer: am5xy.AxisRendererX.new(root, {
                    minorGridEnabled: true,
                    minGridDistance: 200,
                    minorLabelsEnabled: true
                }),
                tooltip: am5.Tooltip.new(root, {})
            }));

            xAxis.set("minorDateFormats", {
                day: "dd",
                month: "MM"
            });

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {})
            }));


            // Add series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            var series = chart.series.push(am5xy.LineSeries.new(root, {
                name: "Series",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                valueXField: "date",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}"
                })
            }));

            // Actual bullet
            series.bullets.push(function() {
                var bulletCircle = am5.Circle.new(root, {
                    radius: 5,
                    fill: series.get("fill")
                });
                return am5.Bullet.new(root, {
                    sprite: bulletCircle
                })
            })

            // Add scrollbar
            // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
            chart.set("scrollbarX", am5.Scrollbar.new(root, {
                orientation: "horizontal"
            }));

            var data = generateDatas(30);
            series.data.setAll(data);


            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series.appear(1000);
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>
@endsection
