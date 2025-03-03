@extends('customer.layouts.layout')
@section('customer_title')
    Profile Customer
@endsection
@section('customer_layout')
    <center>
        <div class="min-h-screen bg-gray-100">
            <center>
                <p class="text-xl mb-2">
                    Kiểm tra đơn hàng
                </p>
            </center>
            <div class="grid gap-6 w-full max-w-[90rem] sm:grid-cols-1 lg:grid-cols-2">
                @foreach ($customer_order_info as $customer_order)
                    <div class="relative flex flex-col rounded-xl bg-white text-gray-700 shadow-lg p-4">
                        <div class="relative flex items-center gap-4 overflow-hidden rounded-xl pt-0 pb-8 text-gray-700">
                            <img src="{{ asset('admin_asset/img/photos/blocks.png') }}" alt="tania andrew"
                                class="relative inline-block h-[58px] w-[58px] rounded-full object-cover object-center" />
                            <div class="flex flex-col gap-1 w-full">
                                <div class="flex items-center justify-between">
                                    <h5 class="font-sans text-xl font-semibold leading-snug text-blue-gray-900">
                                        Mã đơn hàng : {{ $customer_order->orders_id }}
                                    </h5>
                                    <div class="flex items-center gap-1">
                                        <!-- Star Ratings -->
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="h-5 w-5 text-yellow-400">
                                                <path fill-rule="evenodd"
                                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>

                                <div class="flex items-center justify-between">
                                    @if ($customer_order->orders_censor == 'Đã kiểm duyệt')
                                        <p class="font-sans text-base text-blue-500">
                                            Trạng thái đơn hàng : {{ $customer_order->orders_censor }}
                                        </p>
                                    @else
                                        <p class="font-sans text-base text-red-500">
                                            Trạng thái đơn hàng : {{ $customer_order->orders_censor }}
                                        </p>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="mb-6">
                            <table class="table-auto w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-200 text-left">
                                        <th class="border border-gray-300 px-2 py-1">Các sản phẩm</th>
                                        <th class="border border-gray-300 px-2 py-1">Tổng số lượng</th>
                                        <th class="border border-gray-300 px-2 py-1">Tổng tiền</th>
                                        <th class="border border-gray-300 px-2 py-1">Số điện thoại</th>
                                        <th class="border border-gray-300 px-2 py-1">Địa chỉ ship</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 px-2 py-1">{{ $customer_order->orders_product }}
                                        </td>
                                        <td class="border border-gray-300 px-2 py-1">{{ $customer_order->orders_quantity }}
                                        </td>
                                        <td class="border border-gray-300 px-2 py-1">{{ $customer_order->orders_price }}
                                        </td>
                                        <td class="border border-gray-300 px-2 py-1">
                                            {{ $customer_order->orders_phonenumber }}</td>
                                        <td class="border border-gray-300 px-2 py-1">{{ $customer_order->orders_address }}
                                        </td>
                                        {{-- <td class="border border-gray-300 px-2 py-1">{{ $customer_order->id }}</td> --}}
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex items-center text-sm text-gray-500">
                            @if ($customer_order->orders_censor == 'Đang kiểm duyệt')
                                <form action="{{ route('customer.list.order.delete', $customer_order->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button
                                        class="bg-red-500 ml-4 transition duration-300 hover:bg-red-400 w-10 h-10 rounded-md text-white">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            @elseif($customer_order->orders_censor == 'Đã kiểm duyệt')
                                <span class="text-base text-red-500">
                                    Đơn đã kiểm duyệt . Không thể hủy
                                </span>
                            @endif
                            
                            <span class="ml-auto">Đơn hàng được tạo: {{ $customer_order->created_at }}</span>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </center>

    <script>
        $(document).ready(function() {
            @if (session('success'))
                swal("Thành công", "{{ session('success') }}", "success");
            @elseif (session('error'))
                swal("Thất bại", "{{ session('error') }}", "error");
            @endif
        });
    </script>
@endsection
