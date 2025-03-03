@extends('admin/layouts/layout')
@section('admin_page_title')
    Order History Ship - Admin Panel
@endsection

@section('admin_layout')
    <style>
        .logo .img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-7">
            <div class="card">
                <form action="{{ route('admin.order.createship') }}" method="post">
                    @csrf
                    <div class="card-header text-center">
                        <div class="logo">
                            <img src="{{ asset('admin_asset/img/photos/blocks.png') }}" alt="" class="img">
                            <p>MyKingToys</p>
                        </div>
                        <span class="fs-1">Đơn hàng</span>
                        <p class="fs-2"><i class="fa-solid fa-user"></i> : {{ $orders_info->user->name }}</p>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive">
                            <tr>
                                <th>Mã đơn hàng :</th>
                                <td>
                                    <input type="hidden" name="ship_order_id" value="{{ $orders_info->id }}">
                                    <span class="form-control">{{ $orders_info->orders_id }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Tên khách hàng :</th>
                                <td>
                                    <input type="hidden" name="ship_users" value="{{ $orders_info->user->name }}">
                                    <span class="form-control">{{ $orders_info->user->name }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Các sản phẩm đã Order :</th>
                                <td>
                                    <input type="hidden" name="ship_product" value="{{ $orders_info->orders_product }}">
                                    <span class="form-control">{{ $orders_info->orders_product }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Số lượng sản phẩm :</th>
                                <td>
                                    <input type="hidden" name="ship_quantity" value="{{ $orders_info->orders_quantity }}">
                                    <span class="form-control">{{ $orders_info->orders_quantity }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Giá sản phẩm :</th>
                                <td>
                                    <input type="hidden" name="ship_price" value="{{ $orders_info->orders_price }}">
                                    <span class="form-control">{{ $orders_info->orders_price }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Số điện thoại :</th>
                                <td>
                                    <input type="hidden" name="ship_phonenumber" value="{{ $orders_info->orders_phonenumber }}">
                                    <span class="form-control">{{ $orders_info->orders_phonenumber }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Địa chỉ gửi đơn hàng :</th>
                                <td>
                                    <input type="hidden" name="ship_address" value="{{ $orders_info->orders_address }}">
                                    <span class="form-control">{{ $orders_info->orders_address }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Lời nhắn :</th>
                                <td>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="ship_thank"></textarea>
                                </td>
                            </tr>
                        </table>

                        <button type="submit" class="btn btn-success rounded-pill form-control fs-3 mt-4">Xác nhận gửi ship đơn hàng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
