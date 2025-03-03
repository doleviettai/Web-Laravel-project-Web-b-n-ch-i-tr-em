@extends('customer.layouts.layout')

@section('customer_title')
    Chi tiết Đơn Hàng
@endsection

@section('customer_layout')
    <style>
        #Logo {
            width: 125px;
            height: 125px;
        }
    </style>

    <div class="container mx-auto py-10">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-xl p-8">
            <center>
                <div class="flex items-center justify-center mb-6">
                    <div class="mr-4">
                        <img src="{{ asset('admin_asset/img/photos/blocks.png') }}" alt="Logo"
                            class="w-16 h-16 object-cover" id="Logo">
                        <p class="text-2xl font-semibold text-gray-700">MyKingToys</p>
                        <p class="text-lg text-gray-600"><i class="fa-solid fa-user"></i> : {{Auth::user()->name}}</p>
                    </div>
                </div>

            </center>

            <h2 class="text-3xl font-bold text-center my-8 text-gray-800">Thông Tin Đơn Hàng</h2>
            <form action="{{ route('customer.cart.insertorder') }}" method="post">
                @csrf
                <table class="w-full text-left table-auto">
                    <input type="hidden" name="order_user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="order_product" value="{{$productName}}">
                    <input type="hidden" name="order_quantity" value="{{$productQuantity}}">
                    <input type="hidden" name="order_totalprice" value="{{ $productPrice }}">

                    <tr class="border-b">
                        <th class="py-3 px-4 text-lg font-medium text-gray-700">ID khách hàng của bạn:</th>
                        <td class="py-3 px-4 text-lg text-gray-600">{{ $customerNameID }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="py-3 px-4 text-lg font-medium text-gray-700">Tên Sản Phẩm:</th>
                        <td class="py-3 px-4 text-lg text-gray-600">{{ $productName }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="py-3 px-4 text-lg font-medium text-gray-700">Số Lượng:</th>
                        <td class="py-3 px-4 text-lg text-gray-600">{{ $productQuantity }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="py-3 px-4 text-lg font-medium text-gray-700">Tổng Tiền:</th>
                        <td class="py-3 px-4 text-lg font-semibold text-red-600">{{ $productPrice }} VND
                        </td>
                    </tr>
                    <tr class="border-b">
                        <th class="py-3 px-4 text-lg font-medium text-gray-700">Phương thức thanh toán:</th>
                        <td class="py-3 px-4 text-lg text-gray-600">
                            <input type="radio" name="payment_method" value="Thanh toán sau khi nhận hàng"> Thanh toán sau khi
                            nhận hàng<br>
                            <input type="radio" name="payment_method" value="Thanh toán trước khi nhận hàng"> Thanh toán trước khi nhận hàng
                        </td>
                    </tr>
                    <tr class="border-b">
                        <th class="py-3 px-4 text-lg font-medium text-gray-700">Số điện thoại:</th>
                        <td class="py-3 px-4 text-lg text-gray-600">
                            <input type="text" class="rounded-xl w-full" placeholder="Nhập số điện thoại"
                                name="order_phonenumber">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <th class="py-3 px-4 text-lg font-medium text-gray-700">Địa chỉ:</th>
                        <td class="py-3 px-4 text-lg text-gray-600">
                            <input type="text" class="rounded-xl w-full" placeholder="Nhập địa chỉ"
                                name="order_address">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <th colspan="2">
                            <button type="submit"
                                class="w-full  bg-sky-500 text-white px-6 py-3 rounded-full shadow hover:bg-sky-400 transition duration-300 focus:outline-none text-lg">
                                <i class="fa-regular fa-heart"></i>
                                Xác nhận đơn hàng</button>
                        </th>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            @if(session('success'))
                swal("Thành công", "{{ session('success') }}", "success");
            @elseif (session('error'))
                swal("Thất bại", "{{ session('error') }}", "error");
            @endif
        });
    </script>
@endsection
