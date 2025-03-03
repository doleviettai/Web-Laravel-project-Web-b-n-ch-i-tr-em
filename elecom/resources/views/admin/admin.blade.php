{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

@extends('admin/layouts/layout')
@section('admin_page_title')
    Dashboard - Admin Panel
@endsection


@section('admin_layout')
    <style>
        #chartdiv1 {
            width: 100%;
            height: 500px;
            /* overflow-x: scroll; */
        }

        #chartdiv2 {
            width: 100%;
            height: 500px;
            /* overflow-x: scroll; */
        }

        #chartdiv {
            width: 100%;
            height: 500px;
            max-width: 100%;
        }
    </style>
    <center>
        <h3>Admin Dashboard</h3>
    </center>



    <div class="container">
        <div class="card">
            <div class="row m-2">
                <div class="col-md-3 col-sm-6 col-12 mb-3">
                    <div class="card text-bg-primary bg-gradient h-100"> <!-- Bỏ max-width và thêm h-100 để card có chiều cao đầy đủ -->
                        <div class="card-body">
                            <div class="card-header bg-transparent">Sản phẩm trong kho</div>
                            <span class="card-header bg-transparent fs-2"><i class="fa-brands fa-product-hunt"></i> :</span>
                            <span class="card-text fs-2">{{$products}}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12 mb-3">
                    <div class="card text-bg-success bg-gradient h-100"> <!-- Bỏ max-width và thêm h-100 để card có chiều cao đầy đủ -->
                        <div class="card-body">
                            <div class="card-header bg-transparent text-white">Số đơn hàng chưa duyệt</div>
                            <span class="card-header bg-transparent fs-2 text-white"><i class="fa-solid fa-arrow-up-short-wide"></i> :</span>
                            <span class="card-text fs-2 text-white">{{$orders}}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12 mb-3">
                    <div class="card text-bg-info bg-gradient h-100"> <!-- Bỏ max-width và thêm h-100 để card có chiều cao đầy đủ -->
                        <div class="card-body">
                            <div class="card-header bg-transparent">Số Lượng Nhân viên</div>
                            <span class="card-header bg-transparent fs-2"><i class="fa-solid fa-users"></i> :</span>
                            <span class="card-text fs-2">{{$vendors}}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12 mb-3">
                    <div class="card text-bg-warning bg-gradient h-100"> <!-- Bỏ max-width và thêm h-100 để card có chiều cao đầy đủ -->
                        <div class="card-body">
                            <div class="card-header bg-transparent text-white">Tổng tiền</div>
                            <span class="card-header bg-transparent text-end fs-2 text-white"><i class="fa-solid fa-money-bill"></i>:</span>
                            <span class="card-text fs-2 text-end text-white">{{$total_price}}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="card">
            <div class="row">
                <div class="col-12">
                    <div id="chartdiv"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-12">
                    <div id="chartdiv1"></div>
                </div>
                <div class="col-md-6 col-12">
                    <div id="chartdiv2"></div>
                </div>
            </div>
        </div>

    </div>

    {{-- Biểu đồ cột kết hợp với tròn --}}
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>


    {{-- <script src="https://cdn.amcharts.com/lib/5/index.js"></script> --}}
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <script>
        am5.ready(function() {

            var data = [{
                "date": "2024-01-01",
                "distance": 227,
                "townName": "New York",
                "townSize": 12,
                "latitude": 40.71,
                "duration": 408
            }, {
                "date": "2024-01-02",
                "distance": 371,
                "townName": "Washington",
                "townSize": 7,
                "latitude": 38.89,
                "duration": 482
            }, {
                "date": "2024-01-03",
                "distance": 433,
                "townName": "Wilmington",
                "townSize": 3,
                "latitude": 34.22,
                "duration": 562
            }, {
                "date": "2024-01-04",
                "distance": 345,
                "townName": "Jacksonville",
                "townSize": 3.5,
                "latitude": 30.35,
                "duration": 379
            }, {
                "date": "2024-01-05",
                "distance": 480,
                "townName": "Miami",
                "townSize": 5,
                "latitude": 25.83,
                "duration": 501
            }, {
                "date": "2024-01-06",
                "distance": 386,
                "townName": "Tallahassee",
                "townSize": 3.5,
                "latitude": 30.46,
                "duration": 443
            }, {
                "date": "2024-01-07",
                "distance": 348,
                "townName": "New Orleans",
                "townSize": 5,
                "latitude": 29.94,
                "duration": 405
            }, {
                "date": "2024-01-08",
                "distance": 238,
                "townName": "Houston",
                "townSize": 8,
                "latitude": 29.76,
                "duration": 309
            }, {
                "date": "2024-01-09",
                "distance": 218,
                "townName": "Dalas",
                "townSize": 8,
                "latitude": 32.8,
                "duration": 287
            }, {
                "date": "2024-01-10",
                "distance": 349,
                "townName": "Oklahoma City",
                "townSize": 5,
                "latitude": 35.49,
                "duration": 485
            }, {
                "date": "2024-01-11",
                "distance": 603,
                "townName": "Kansas City",
                "townSize": 5,
                "latitude": 39.1,
                "duration": 890
            }, {
                "date": "2024-01-12",
                "distance": 534,
                "townName": "Denver",
                "townSize": 9,
                "latitude": 39.74,
                "duration": 810
            }, {
                "date": "2024-01-13",
                "townName": "Salt Lake City",
                "townSize": 6,
                "distance": 425,
                "duration": 670,
                "latitude": 40.75,
                "dashLength": 8,
                "alpha": 0.4
            }, {
                "date": "2024-01-14",
                "distance": 150,
                "townName": "Bangkok",
                "townSize": 6,
                "latitude": 40,
                "duration": 500
            }, {
                "date": "2024-01-15",
                "distance": 350,
                "townName": "VietNam",
                "townSize": 6,
                "latitude": 40,
                "duration": 500
            }, {
                "date": "2024-01-16"
            }, {
                "date": "2024-01-17"
            }];

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv1");

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root)
            ]);


            // Create chart
            // https://www.amcharts.com/docs/v5/charts/xy-chart/
            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelY: "none"
            }));

            chart.zoomOutButton.set("forceHidden", true);

            chart.get("colors").set("step", 2);

            // Create axes
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
                baseInterval: {
                    timeUnit: "day",
                    count: 1
                },
                renderer: am5xy.AxisRendererX.new(root, {
                    minGridDistance: 70,
                    minorGridEnabled: true
                }),
                tooltip: am5.Tooltip.new(root, {})
            }));


            var distanceAxisRenderer = am5xy.AxisRendererY.new(root, {});
            distanceAxisRenderer.grid.template.set("forceHidden", true);
            var distanceAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: distanceAxisRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            var latitudeAxisRenderer = am5xy.AxisRendererY.new(root, {});
            latitudeAxisRenderer.grid.template.set("forceHidden", true);
            var latitudeAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: latitudeAxisRenderer,
                forceHidden: true
            }));

            var durationAxisRenderer = am5xy.AxisRendererY.new(root, {
                opposite: true
            });
            durationAxisRenderer.grid.template.set("forceHidden", true);
            var durationAxis = chart.yAxes.push(am5xy.DurationAxis.new(root, {
                baseUnit: "minute",
                renderer: durationAxisRenderer,
                extraMax: 0.3
            }));

            // Create series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            var distanceSeries = chart.series.push(am5xy.ColumnSeries.new(root, {
                xAxis: xAxis,
                yAxis: distanceAxis,
                valueYField: "distance",
                valueXField: "date",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY} miles"
                })
            }));

            distanceSeries.data.processor = am5.DataProcessor.new(root, {
                dateFields: ["date"],
                dateFormat: "yyyy-MM-dd"
            });

            var latitudeSeries = chart.series.push(am5xy.LineSeries.new(root, {
                xAxis: xAxis,
                yAxis: latitudeAxis,
                valueYField: "latitude",
                valueXField: "date",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "latitude: {valueY} ({townName})"
                })
            }));

            latitudeSeries.strokes.template.setAll({
                strokeWidth: 2
            });

            // Add circle bullet
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/#Bullets
            latitudeSeries.bullets.push(function() {
                var graphics = am5.Circle.new(root, {
                    strokeWidth: 2,
                    radius: 5,
                    stroke: latitudeSeries.get("stroke"),
                    fill: root.interfaceColors.get("background"),
                });

                graphics.adapters.add("radius", function(radius, target) {
                    return target.dataItem.dataContext.townSize;
                })

                return am5.Bullet.new(root, {
                    sprite: graphics
                });
            });

            var durationSeries = chart.series.push(am5xy.LineSeries.new(root, {
                xAxis: xAxis,
                yAxis: durationAxis,
                valueYField: "duration",
                valueXField: "date",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "duration: {valueY.formatDuration()}"
                })
            }));

            durationSeries.strokes.template.setAll({
                strokeWidth: 2
            });

            // Add circle bullet
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/#Bullets
            durationSeries.bullets.push(function() {
                var graphics = am5.Rectangle.new(root, {
                    width: 10,
                    height: 10,
                    centerX: am5.p50,
                    centerY: am5.p50,
                    fill: durationSeries.get("stroke")
                });

                return am5.Bullet.new(root, {
                    sprite: graphics
                });
            });

            // Add cursor
            // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
            chart.set("cursor", am5xy.XYCursor.new(root, {
                xAxis: xAxis,
                yAxis: distanceAxis
            }));


            distanceSeries.data.setAll(data);
            latitudeSeries.data.setAll(data);
            durationSeries.data.setAll(data);
            xAxis.data.setAll(data);

            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            distanceSeries.appear(1000);
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>




    {{-- Biểu đồ tròn quay --}}

    <!-- Chart code -->
    <script>
        am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv2");

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            // Create chart
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
            // start and end angle must be set both for chart and series
            var chart = root.container.children.push(am5percent.PieChart.new(root, {
                startAngle: 180,
                endAngle: 360,
                layout: root.verticalLayout,
                innerRadius: am5.percent(50)
            }));

            // Create series
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
            // start and end angle must be set both for chart and series
            var series = chart.series.push(am5percent.PieSeries.new(root, {
                startAngle: 180,
                endAngle: 360,
                valueField: "value",
                categoryField: "category",
                alignLabels: false
            }));

            series.states.create("hidden", {
                startAngle: 180,
                endAngle: 180
            });

            series.slices.template.setAll({
                cornerRadius: 5
            });

            series.ticks.template.setAll({
                forceHidden: true
            });

            // Set data
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
            series.data.setAll([{
                    value: 10,
                    category: "One"
                },
                {
                    value: 9,
                    category: "Two"
                },
                {
                    value: 6,
                    category: "Three"
                },
                {
                    value: 5,
                    category: "Four"
                },
                {
                    value: 4,
                    category: "Five"
                },
                {
                    value: 3,
                    category: "Six"
                },
                {
                    value: 1,
                    category: "Seven"
                }
            ]);

            series.appear(1000, 100);

        }); // end am5.ready()
    </script>



    {{-- Biểu đồ lớn  --}}
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- Chart code -->
    <script>
        am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv");

            const myTheme = am5.Theme.new(root);

            myTheme.rule("AxisLabel", ["minor"]).setAll({
                dy: 1
            });

            myTheme.rule("Grid", ["x"]).setAll({
                strokeOpacity: 0.05
            });

            myTheme.rule("Grid", ["x", "minor"]).setAll({
                strokeOpacity: 0.05
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
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                maxTooltipDistance: 0,
                pinchZoomX: true
            }));


            var date = new Date();
            date.setHours(0, 0, 0, 0);
            var value = 100;

            function generateData() {
                value = Math.round((Math.random() * 10 - 4.2) + value);
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
                maxDeviation: 0.2,
                baseInterval: {
                    timeUnit: "day",
                    count: 1
                },
                renderer: am5xy.AxisRendererX.new(root, {
                    minorGridEnabled: true
                }),
                tooltip: am5.Tooltip.new(root, {})
            }));

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {})
            }));


            // Add series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            for (var i = 0; i < 10; i++) {
                var series = chart.series.push(am5xy.LineSeries.new(root, {
                    name: "Series " + i,
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: "value",
                    valueXField: "date",
                    legendValueText: "{valueY}",
                    tooltip: am5.Tooltip.new(root, {
                        pointerOrientation: "horizontal",
                        labelText: "{valueY}"
                    })
                }));

                date = new Date();
                date.setHours(0, 0, 0, 0);
                value = 0;

                var data = generateDatas(100);
                series.data.setAll(data);

                // Make stuff animate on load
                // https://www.amcharts.com/docs/v5/concepts/animations/
                series.appear();
            }


            // Add cursor
            // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                behavior: "none"
            }));
            cursor.lineY.set("visible", false);


            // Add scrollbar
            // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
            chart.set("scrollbarX", am5.Scrollbar.new(root, {
                orientation: "horizontal"
            }));

            chart.set("scrollbarY", am5.Scrollbar.new(root, {
                orientation: "vertical"
            }));


            // Add legend
            // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
            var legend = chart.rightAxesContainer.children.push(am5.Legend.new(root, {
                width: 200,
                paddingLeft: 15,
                height: am5.percent(100)
            }));

            // When legend item container is hovered, dim all the series except the hovered one
            legend.itemContainers.template.events.on("pointerover", function(e) {
                var itemContainer = e.target;

                // As series list is data of a legend, dataContext is series
                var series = itemContainer.dataItem.dataContext;

                chart.series.each(function(chartSeries) {
                    if (chartSeries != series) {
                        chartSeries.strokes.template.setAll({
                            strokeOpacity: 0.15,
                            stroke: am5.color(0x000000)
                        });
                    } else {
                        chartSeries.strokes.template.setAll({
                            strokeWidth: 3
                        });
                    }
                })
            })

            // When legend item container is unhovered, make all series as they are
            legend.itemContainers.template.events.on("pointerout", function(e) {
                var itemContainer = e.target;
                var series = itemContainer.dataItem.dataContext;

                chart.series.each(function(chartSeries) {
                    chartSeries.strokes.template.setAll({
                        strokeOpacity: 1,
                        strokeWidth: 1,
                        stroke: chartSeries.get("fill")
                    });
                });
            })

            legend.itemContainers.template.set("width", am5.p100);
            legend.valueLabels.template.setAll({
                width: am5.p100,
                textAlign: "right"
            });

            // It's is important to set legend data after all the events are set on template, otherwise events won't be copied
            legend.data.setAll(chart.series.values);


            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>
@endsection
