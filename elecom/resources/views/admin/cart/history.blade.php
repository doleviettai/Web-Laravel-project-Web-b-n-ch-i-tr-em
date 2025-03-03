@extends('admin/layouts/layout')
@section('admin_page_title')
    Cart History - Admin Panel
@endsection
@section('admin_layout')
    {{-- <h3>Cart history Page</h3> --}}

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
                        <label for="search_shipper" class="fw-bold">Tìm kiếm Đơn Ship</label>
                        <input type="search" name="search_shipper" id="search_shipper"
                            placeholder="Nhập Đơn hàng đã gửi mà bạn muốn tìm kiếm!" class="form-control mb-2">
                    </div>

                    <div class="col-5 search_category">
                        <center><span class="fs-1">Danh sách đơn ship</span></center>
                    </div>
                </div>
            </div>

            <label class="card-title mb-0 fs-2">Danh sách các đơn ship</label>
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
                            <th>Mã đơn hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Các đơn hàng đặt</th>
                            <th>Số lượng hàng đặt</th>
                            <th>Giá đơn hàng</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ ship</th>
                            <th>Lời nhắn nhủ</th>
                            <th>Xóa</th>
                            <th>In file PDF</th>
                        </tr>
                    </thead>

                    <tbody id="hien_table">
                        @foreach ($shipers as $shiper)
                            <tr>
                                <td>{{ $shiper->order->orders_id }}</td>
                                <td>{{ $shiper->ship_users }}</td>
                                <td>{{ $shiper->ship_product }}</td>
                                <td>{{ $shiper->ship_quantity }}</td>
                                <td class="text-end">{{ $shiper->ship_price }}</td>
                                <td>{{ $shiper->ship_phonenumber }}</td>
                                <td>{{ $shiper->ship_address }}</td>
                                <td>{{ $shiper->ship_thank }}</td>
                                <td>
                                    <form action="{{route('admin.cart.delete' , $shiper->id)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <a class="btn btn-secondary" href="{{route('admin.cart.print_pdf' , $shiper->id)}}">
                                        <i class="fa-regular fa-file-pdf"></i>
                                    </a>
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
        $('#search_shipper').on('keyup', function() {
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
                url: '{{ route('admin.cart.search') }}',
                data: {
                    'search_shipper': value
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
