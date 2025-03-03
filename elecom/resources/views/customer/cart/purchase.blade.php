<form action="{{ route('customer.cart.createorder') }}" method="post">
    @csrf
    <input type="hidden" name="cus_product_user_id" value="{{Auth::user()->id}}">
    <input type="hidden" name="cus_product_name" value="{{$cartsList}}">
    <input type="hidden" name="cus_product_price" value="{{$carttotal_price}}">
    <input type="hidden" name="cus_product_quantity" value="{{$cartquantity}}">

    <p class="text-blue-900 text-xl font-bold">Hóa đơn</p>
    <div class="flex flex-col p-4 gap-4 text-lg shadow-md border rounded-sm">
        <div class="flex flex-row justify-between">
            <p class="text-gray-600 font-semibold">Các sản phẩm:</p>
            <p class="text-end">{{ $cartsList }}</p>
        </div>
        <hr class="bg-gray-200 h-0.5">
        <div class="flex flex-row justify-between">
            <p class="text-gray-600 font-semibold">Số lượng sản phẩm :</p>
            <p class="text-end">{{ $cartquantity }}</p>
        </div>
        <hr class="bg-gray-200 h-0.5">
        <div class="flex flex-row justify-between">
            <p class="text-gray-600 font-semibold">Số lượng mặt hàng :</p>
            <p class="text-end">{{ $cartquantity_pro }} mặt hàng</p>
        </div>
        <hr class="bg-gray-200 h-0.5">

        <div class="flex flex-row justify-between">
            <p class="text-gray-600 font-semibold">Tổng tiền khi thanh toán :</p>
            <div>
                <p class="text-end text-red-500">{{ $carttotal_price }} VND</p>
            </div>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="transition-colors text-lg bg-blue-600 hover:bg-sky-400 p-2 rounded-lg w-full text-white text-hover shadow-md">
                Thanh Toán
            </button>
        </div>
    </div>
</form>
