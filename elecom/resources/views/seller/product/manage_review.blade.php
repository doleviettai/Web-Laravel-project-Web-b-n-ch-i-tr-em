@extends('seller/layouts/layout')
@section('seller_page_title')
    Manage Product - Seller Panel
@endsection
@section('seller_layout')
    <center>
        <h3>Bán sản phẩm</h3>
    </center>

    <style>
        .img_item {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }

        .card-container .card {
            width: 300px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.6);
        }
    </style>

    <div class="row">
        <div class="col-12">
            <div id="notification"></div>
            <div class="card">
                <div class="card-header">
                    <label for="search_product" class="fw-bold">Tìm kiếm sản phẩm</label>
                    <input type="search" name="search_product" id="search_product"
                        placeholder="Nhập sản phẩm mà bạn muốn tìm kiếm!" class="form-control mb-2">
                </div>
                <div class="card-body">
                    <div class="row mt-1 card-container" id="product_results" style="height: 500px; overflow-y: scroll;">
                        @foreach ($products as $product)
                            <div class="card m-4">
                                <center>
                                    <img src="{{ asset('admin_asset/img/photos/' . ($product->product_img ?? 'blocks.png')) }}"
                                        class="card-img-top mt-1 img_item" alt="...">
                                </center>
                                <div class="card-body">
                                    <form id="add-to-cart-form">
                                        @csrf
                                        <h5 class="card-title">{{ $product->product_name }}</h5>
                                        <input type="hidden" name="pro_item_id" value="{{ $product->id }}">
                                        <input type="hidden" name="pro_item_price" value="{{ $product->product_price }}">
                                        <table class="table table-responsive">
                                            <thead>
                                                <tr>
                                                    <td>Giá : </td>
                                                    <td>{{ $product->product_price }}</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Loại sản phẩm : </td>
                                                    <td>{{ $product->category->category_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Kích cỡ : </td>
                                                    <td>{{ $product->default_attribute->attribute_value }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="d-flex align-items-center mt-2">
                                            <div class="form-outline m-1">
                                                <input type="number" name="pro_item_quantity" min="0" value="0"
                                                    class="form-control me-2">
                                            </div>
                                            <button type="button" class="btn btn-primary m-1" id="btn-add-to-cart">Thêm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


        @include('seller/product/admincart')

    </div>

    <script>
        $(document).ready(function() {
            @if (session('success'))
                swal("Thành công", "{{ session('success') }}", "success");
            @elseif (session('error'))
                swal("Thất bại", "{{ session('error') }}", "error");
            @endif

            $('#search_product').on('keyup', function() {
                var value = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('vendor.review.search') }}',
                    data: {
                        'search_product': value
                    },
                    success: function(data) {
                        $('#product_results').html(data);
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            });

            function loadCartContent() {
                $.ajax({
                    url: '{{ route('vendor.review.create') }}',
                    type: 'GET',
                    success: function(data) {
                        $('#cart_content').html(data);
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            }

            $(document).on('click', '#btn-add-to-cart', function() {
                var form = $(this).closest('#add-to-cart-form');
                var formData = form.serialize();

                $.ajax({
                    url: '{{ route('vendor.review.insert_item_order') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#notification').html(
                            '<div class="alert alert-success">Sản phẩm đã được thêm vào giỏ hàng.</div>'
                            );
                        swal("Thành công", "{{ session('success') }}", "success");
                        loadCartContent();
                    },
                    error: function(xhr) {
                        $('#notification').html(
                            '<div class="alert alert-danger">Lỗi khi thêm sản phẩm vào giỏ hàng.</div>'
                            );
                        console.log('Error:', xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
