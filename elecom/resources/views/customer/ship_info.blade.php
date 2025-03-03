@extends('customer.layouts.layout')
@section('customer_title')
    Profile Customer
@endsection
@section('customer_layout')
<center>
    <p class="text-xl mb-2">
        Kiểm tra đơn ship
    </p>
</center>
<center>
    <div class="w-full md:w-3/4 lg:w-1/2 px-4">
        @foreach ($customer_ship_info as $customer_ship)
            <div class="w-full flex flex-col bg-white mb-6">
                <div class="flex flex-col bg-white shadow-lg rounded-md items-center w-full border border-gray-200">

                    <!-- Header -->
                    <div class="flex flex-wrap md:flex-nowrap items-center p-4 border-b border-gray-200 w-full">
                        <img class="mr-4 h-12 w-12 rounded-full overflow-hidden bg-gray-200"
                            src="{{ asset('admin_asset/img/photos/blocks.png') }}">
                        <div class="flex flex-col justify-between items-center md:items-start">
                            <span class="font-bold text-lg">Mã đơn hàng: {{$customer_ship->order->orders_id}}</span>
                            <span class="text-blue-500 font-medium">Trạng thái: Đã kiểm duyệt</span>
                            <span class="text-blue-500 font-medium text-center md:text-left">Đang ship đến bạn. Bạn hãy chuẩn bị tiền để thanh toán</span>
                        </div>
                    </div>

                    <!-- Order Info Table -->
                    <div class="w-full p-4 overflow-x-auto">
                        <table class="w-full table-auto border-collapse text-sm md:text-base">
                            <thead>
                                <tr class="bg-blue-100 text-left">
                                    <th class="p-2 border border-gray-300">Sản phẩm</th>
                                    <th class="p-2 border border-gray-300">Số lượng</th>
                                    <th class="p-2 border border-gray-300">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-gray-700">
                                    <td class="p-2 border border-gray-300">{{$customer_ship->ship_product}}</td>
                                    <td class="p-2 border border-gray-300">{{$customer_ship->ship_quantity}}</td>
                                    <td class="p-2 border border-gray-300">{{$customer_ship->ship_price}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Customer Info Table -->
                    <div class="w-full p-4 overflow-x-auto">
                        <table class="w-full table-auto border-collapse text-sm md:text-base">
                            <tbody>
                                <tr>
                                    <th class="p-2 text-left text-gray-500">Số điện thoại:</th>
                                    <td class="p-2">{{$customer_ship->ship_phonenumber}}</td>
                                </tr>
                                <tr>
                                    <th class="p-2 text-left text-gray-500">Địa chỉ:</th>
                                    <td class="p-2">{{$customer_ship->ship_address}}</td>
                                </tr>
                                <tr>
                                    <th class="p-2 text-left text-gray-500">Lời cảm ơn:</th>
                                    <td class="p-2">{{$customer_ship->ship_thank}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Footer -->
                    <div class="flex flex-wrap justify-between items-center p-4 w-full border-t border-gray-200">
                        <div class="hidden md:block"></div>
                        <div data-placeholder
                            class="text-gray-500 text-sm italic text-center md:text-right w-full md:w-auto mt-2 md:mt-0">
                            {{$customer_ship->created_at}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <style>
            [data-placeholder]::after {
                content: " ";
                box-shadow: 0 0 50px 9px rgba(254, 254, 254);
                position: absolute;
                top: 0;
                left: -100%;
                height: 100%;
                animation: load 1s infinite;
            }

            @keyframes load {
                0% {
                    left: -100%;
                }

                100% {
                    left: 150%;
                }
            }

            table th, table td {
                text-align: left;
            }
        </style>
    </div>
</center>


@endsection
