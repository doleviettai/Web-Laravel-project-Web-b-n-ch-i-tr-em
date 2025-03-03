<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn</title>
    <link rel="icon" href="{{ asset('admin_asset/img/photos/blocks.png') }}" type="image/png">
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .card-header,
        .card-footer {
            background-color: skyblue;
            color: #fff;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }

        .card-body {
            padding: 20px;
        }

        .text-muted {
            color: #888;
        }

        .fw-bold {
            font-weight: bold;
        }

        .lead {
            font-size: 1.2em;
            color: skyblue;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin: 10px 0;
        }

        .align-items-center {
            display: flex;
            align-items: center;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .phone-align {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-footer {
            background-color: skyblue;
            color: #fff;
            padding: 20px;
            border-radius: 0 0 10px 10px;
            position: relative;
        }

        .card-footer-date {
            position: absolute;
            bottom: 10px;
            right: 20px;
            font-size: 12px;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <center>
                    {{-- <img src= "{{asset('admin_asset/img/photos/blocks.png')}}" alt="Logo" style="width: 125px; height: 125px;"> --}}
                    {{-- <img src="{{ url('admin_asset/img/photos/blocks.png') }}" alt="Logo" style="width: 125px; height: 125px;"> --}}
                    <img src="{{ public_path('admin_asset/img/photos/blocks.png') }}" alt="Logo" style="width: 125px; height: 125px;">

                    <p style="font-size: 36px"><b>MyKingToys</b></p>
                    <h2 style="color: #fff;">Cảm ơn vì hóa đơn của bạn, {{ $shiper_order->ship_users }}!</h2>
                </center>
            </div>
            <div class="card-body">
                <div class="justify-content-between align-items-center">
                    <p class="lead fw-bold">Đơn hàng</p>
                    <p class="text-muted small">ID đơn hàng : {{ $shiper_order->order->orders_id }}</p>
                    <p class="text-muted small">Time : {{ $shiper_order->created_at }}</p>
                </div>

                <!-- Product Details -->
                <center>
                    <div class="card">
                        <table width="100%" border="1" cellspacing="0" cellpadding="5">
                            <tr>
                                <th colspan="2">Các sản phẩm bạn đã order</th>
                            </tr>
                            <tr>
                                <th>Sản phẩm (số lượng)</th>
                                <th>Tổng số lượng</th>
                            </tr>
                            <tr>
                                <td>{{ $shiper_order->ship_product }}</td>
                                <td>{{ $shiper_order->ship_quantity }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Order Summary -->
                    <table>
                        <tr>
                            <td>
                                <p class="text-muted">Số điện thoại :</p>
                            </td>
                            <td>
                                <p class="text-muted">0{{ $shiper_order->ship_phonenumber }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="text-muted">Địa chỉ :</p>
                            </td>
                            <td>
                                <p class="text-muted">{{ $shiper_order->ship_address }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="text-muted">Lời cảm ơn :</p>
                            </td>
                            <td>
                                <p class="text-muted">{{ $shiper_order->ship_thank }}</p>
                            </td>
                        </tr>
                    </table>
                </center>
            </div>
            <div class="card-footer">
                <span class="fw-bold" style="font-size: 24px">Tổng tiền : {{ $shiper_order->ship_price }} VND</span>
                {{-- <p class="card-footer-date">{{ $shiper_order->created_at }}</p> --}}
            </div>
        </div>
    </div>
</body>

</html>
