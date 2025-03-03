@extends('seller/layouts/layout')
@section('seller_page_title')
    Order History Edit - Seller Panel
@endsection
@section('seller_layout')
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
                <form action="{{ route('vendor.order.update', $orders_info->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-header text-center">
                        <div class="logo">
                            <img src="{{ asset('admin_asset/img/photos/blocks.png') }}" alt="" class="img">
                            <p>MyKingToys</p>
                        </div>
                        <span class="fs-1">Đơn hàng</span>
                        {{-- <p class="fs-2"><i class="fa-solid fa-user"></i> : {{ $orders_info->user->name }}</p> --}}
                        <p class="fs-2"><i class="fa-solid fa-user"></i> :
                            @if ($orders_info->user)
                                {{ $orders_info->user->name }}
                            @else
                                Không có
                            @endif
                        </p>
                        <p></p>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive">
                            <tr>
                                <th>Tên khách hàng :</th>
                                {{-- <td>{{ $orders_info->user->name }}</td> --}}
                                <td>
                                    @if ($orders_info->user)
                                        {{ $orders_info->user->name }}
                                    @else
                                        Không có
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Mã đơn hàng :</th>
                                <td>{{ $orders_info->orders_id }}</td>
                            </tr>

                            <tr>
                                <th>Các sản phẩm đã Order :</th>
                                <td>{{ $orders_info->orders_product }}</td>
                            </tr>

                            <tr>
                                <th>Số lượng sản phẩm :</th>
                                <td>{{ $orders_info->orders_quantity }}</td>
                            </tr>

                            <tr>
                                <th>Giá sản phẩm :</th>
                                <td>{{ $orders_info->orders_price }}</td>
                            </tr>

                            <tr>
                                <th>Trạng thái đơn hàng :</th>
                                <td>
                                    <select name="orders_status" id="orders_status"
                                        class="form-control custom-select form-select" aria-label="Large select example">
                                        <option value="">Chọn</option> <!-- Tùy chọn mặc định -->

                                        <option value="Đã kiểm duyệt">Đã kiểm duyệt</option>
                                        <option value="Đang kiểm duyệt">Đang kiểm duyệt</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th>Số điện thoại :</th>
                                <td>
                                    <input type="text" name="orders_phonenumber" id="orders_phonenumber"
                                        class="form-control" placeholder="Nhập số điện thoại"
                                        value="{{ $orders_info->orders_phonenumber }}">
                                </td>
                            </tr>

                            <tr>
                                <th>Địa chỉ gửi đơn hàng :</th>
                                <td>
                                    <input type="text" name="orders_address" id="orders_address" class="form-control"
                                        placeholder="Nhập địa chỉ gửi đơn hàng" value="{{ $orders_info->orders_address }}">
                                </td>
                            </tr>
                        </table>

                        <button type="submit" class="btn btn-success rounded-pill form-control fs-3 mt-4">Xác nhận thay đổi
                            đơn hàng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
