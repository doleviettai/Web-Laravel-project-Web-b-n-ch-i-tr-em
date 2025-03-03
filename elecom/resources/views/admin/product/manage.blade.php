@extends('admin/layouts/layout')
@section('admin_page_title')
    Manage Product - Admin Panel
@endsection
@section('admin_layout')
    <center>
        <h3>Danh sách sản phẩm</h3>
    </center>

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

    <div class="col-12 search_category">
        <label for="search_product" class="fw-bold">Tìm kiếm sản phẩm</label>
        <input type="search" name="search_product" id="search_product" placeholder="Nhập sản phẩm mà bạn muốn tìm kiếm!"
            class="form-control mb-2">
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Danh sách các sản phẩm</h5>
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
                    <thead>
                        <tr>
                            <th>
                                <a href="{{route('product.create')}}" class="btn btn-primary bg-gradient" style="width:200px;">Thêm sản phẩm</a>
                            </th>
                        </tr>
                    </thead>
                    <thead class="table-primary">
                        <tr>
                            {{-- <th>#</th> --}}
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Chuyên mục</th>
                            <th>Chuyên mục nhỏ</th>
                            <th>Dữ liệu</th>
                            <th>Trạng thái</th>
                            <th>Số lượng</th>
                            <th>Hình ảnh</th>
                            <th colspan="2">Hoạt động</th>
                        </tr>
                    </thead>

                    <tbody id="hien_table">
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_price }}</td>
                                <td>{{ $product->category->category_name }}</td>
                                <td>{{ $product->subcategory->subcategory_name }}</td>
                                <td>{{ $product->default_attribute->attribute_value }}</td>
                                <td>{{ $product->product_status }}</td>
                                <td>{{ $product->product_quantity }}</td>
                                <td>
                                    @if ($product->product_img == null)
                                        <img src="{{ asset('admin_asset/img/photos/blocks.png') }}" alt=""
                                            class="img_user">
                                    @else
                                        <img src="{{ asset("admin_asset/img/photos/$product->product_img") }}" alt=""
                                            class="img_user">
                                    @endif

                                </td>
                                <td>
                                    <a href="{{route('product.edit' , $product->id)}}" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                </td>
                                <td>
                                    <form action="{{route('product.delete' , $product->id)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                    <tbody id="an_table"></tbody>

                </table>
                {{$products->links()}}
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
        $('#search_product').on('keyup', function() {
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
                url: '{{ route('product.search') }}',
                data: {
                    'search_product': value
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
