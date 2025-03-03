@extends('customer.layouts.layout')
@section('customer_title')
    Product cart Customer
@endsection
@section('customer_layout')
    <p class="text-4xl text-center">Giỏ hàng của bạn</p>

    <div class="flex flex-col xl:flex-row w-screen h-full px-14">

        <!-- My Cart -->
        <div class="w-full flex flex-col h-fit gap-4 p-4 ">
            <p class="text-blue-900 text-xl font-bold">Giỏ của bạn</p>
            <!-- Product -->
            <div class="flex flex-col p-4 text-lg font-semibold shadow-md border rounded-sm">

                @foreach ($mycarts as $cart)
                    <div class="flex flex-col md:flex-row gap-3 justify-between items-center">
                        <!-- Product Information -->
                        <div class="flex flex-row gap-6 items-center w-full md:w-auto">
                            <div class="w-40 h-full">
                                <center>
                                    <img class="w-full h-full rounded-sm" src="{{ asset('admin_asset/img/photos/' . ($cart->product->product_img ?? 'blocks.png')) }}">
                                </center>
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="text-lg text-gray-800 font-semibold">{{$cart->product->product_name}}</p>
                                <p class="text-xs text-gray-600 font-semibold">Loại sản phẩm: <span class="font-normal">{{$cart->product->category->category_name}}</span></p>
                                <p class="text-xs text-gray-600 font-semibold">Kích cỡ: <span class="font-normal">{{$cart->product->subcategory->subcategory_name}}</span></p>
                                <p class="text-xs text-gray-600 font-semibold">Số lượng: <span class="font-normal">{{$cart->cart_quantity}}</span></p>
                            </div>
                        </div>

                        <!-- Price Information -->
                        <div class="text-gray-800 font-normal text-2xl text-right md:ml-auto md:w-40">
                            {{$cart->cart_price}} VND
                        </div>

                        <!-- Remove Product Icon -->
                        <div class="self-center">
                            <form action="{{route('customer.cart.delete', $cart->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button class="bg-red-500 transition duration-300 hover:bg-red-400 w-16 h-16 rounded-md text-white">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <br>
                @endforeach

            </div>

        </div>

        <!-- Purchase Resume -->
        <div class="flex flex-col w-full xl:w-2/3 h-fit gap-4 p-4">
            @include('customer.cart.purchase')
        </div>
    </div>

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
