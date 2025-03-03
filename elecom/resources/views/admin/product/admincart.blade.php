{{-- @section('admin_seller_cart') --}}
<div class="card-header">
    <label class="fw-bold">Giỏ hàng</label>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th colspan="3"></th>
                    <th>
                        <form action="{{ route('product.review.truncate_order') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Clear</button>
                        </form>
                    </th>
                </tr>
            </thead>
            <thead class="table-primary">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->product->product_name }}</td>
                        <td>{{ $order->order_quantity }}</td>
                        <td>{{ number_format($order->order_price, 3) }}</td>
                        <td>
                            <form action="{{ route('product.review.delete_item_order', $order->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="Xóa">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <label class="fw-bold fs-2">Tính toán</label>
    </div>
    <div class="card-body">
        <form action="{{ route('product.review.insert_order') }}" method="post">
            @csrf
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <td>Các sản phẩm :</td>
                        <td>
                            <span>{{ $productList }}</span>
                            <input type="hidden" name="ac_order_namepro" value="{{ $productList }}">
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tổng số lượng :</td>
                        <td>
                            <span>{{ $quantity }}</span>
                            <input type="hidden" name="ac_order_totalquantitypro" value="{{ $quantity }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Tổng tiền :</td>
                        <td>
                            <span>{{ number_format($total, 3) }} vnd</span>
                            <input type="hidden" name="ac_order_totalpricepro" value="{{ $total }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Khách hàng :</td>
                        <td>
                            <select name="ac_order_user_id" id="ac_order_user_id"
                                class="form-control custom-select form-select">
                                <option value="">Chọn</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>

    <div class="card-footer d-flex align-items-center justify-content-center mt-2">
        <button type="submit" class="btn btn-success form-control fs-2">Xác nhận thanh toán</button>
    </div>
    </form>
</div>


{{-- @endsection --}}
