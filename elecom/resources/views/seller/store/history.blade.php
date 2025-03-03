@extends('seller/layouts/layout')
@section('seller_page_title')
    History order - Seller Panel
@endsection
@section('seller_layout')
    <style>
        .img_user {
            width: 125px;
            height: 125px;
            /* border: 2px solid black; */
            object-fit: cover;
        }

        ;

        .tb_scoll {
            width: 100%;
            height: 500px;
            overflow-y: scroll;
        }
    </style>

    <div class="card">
        <div class="card-header">
            <div class="col-12">
                <div class="row">
                    <div class="col-7 search_category">
                        <label for="search_orders" class="fw-bold">Tìm kiếm Đơn hàng</label>
                        <input type="search" name="search_orders" id="search_orders"
                            placeholder="Nhập Đơn hàng mà bạn muốn tìm kiếm!" class="form-control mb-2">
                    </div>

                    <div class="col-5 search_category">
                        <center><span class="fs-1">Danh sách đơn hàng</span></center>
                    </div>
                </div>
            </div>

            <label class="card-title mb-0 fs-2">Danh sách các đơn hàng</label>
        </div>



        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card-body tb_scoll">

            <div class="table-responsive">
                <table class="table table-hover" align="center">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Mã đơn hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Các đơn hàng đặt</th>
                            <th>Số lượng hàng đặt</th>
                            <th>Giá đơn hàng</th>
                            <th>Trạng thái đơn hàng</th>
                            <th>Thời gian đặt</th>
                            <th colspan="2">Hoạt động</th>
                        </tr>
                    </thead>

                    <tbody id="hien_table">
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->orders_id }}</td>
                                <td>{{ $order->user->name ?? 'Không có' }}</td>
                                <td>{{ $order->orders_product }}</td>
                                <td>{{ $order->orders_quantity }}</td>
                                <td class="text-end">{{ $order->orders_price }}</td>
                                <td>
                                    @if ($order->orders_censor == 'Đang kiểm duyệt')
                                        <div class="bg-warning bg-gradient bg-opacity-75 text-center rounded-pill p-1">
                                            {{ $order->orders_censor }}
                                        </div>
                                    @elseif($order->orders_censor == 'Đã kiểm duyệt')
                                        <div class="bg-success bg-gradient bg-opacity-75 text-center rounded-pill p-1">
                                            {{ $order->orders_censor }}
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $order->created_at }}</td>
                                {{-- <td>
                            <a href="" class="btn btn-secondary"><i class="fa-solid fa-eye"></i></a>
                        </td> --}}
                                <td>
                                    <a href="{{route('vendor.order.edit' , $order->id)}}" class="btn btn-success"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                </td>

                                <td>
                                    @if ($order->orders_censor == 'Đã kiểm duyệt')
                                        <a href="{{route('vendor.order.insertship', $order->id)}}"
                                            class="btn btn-primary"><i class="fa-solid fa-truck-fast"></i></a>
                                    @endif
                                </td>


                            </tr>
                        @endforeach
                    </tbody>

                    <tbody id="an_table"></tbody>
                </table>
            </div>
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

    <script type="text/javascript">
        $('#search_orders').on('keyup', function() {
            var value = $(this).val();

            if (value == "") {
                $('#hien_table').show();
                $('#an_table').hide();
            } else {
                $('#hien_table').hide();
                $('#an_table').show();
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'post',
                url: '{{ route('vendor.order.search') }}',
                data: {
                    'search_orders': value
                },
                success: function(data) {
                    console.log('Data returned:', data); // Kiểm tra dữ liệu trả về
                    $('#an_table').html(data); // Thêm dữ liệu tìm kiếm vào bảng ẩn
                },
                error: function(xhr, status, error) {
                    console.log('Error:', xhr.responseText); // Kiểm tra lỗi nếu có
                }
            });
        });
    </script>
@endsection
