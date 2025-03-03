@extends('admin/layouts/layout')

@section('admin_page_title')
    Create Product - Admin Panel
@endsection

@section('admin_layout')
    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-2">Hình ảnh hiện tại</h5>
                </div>
                <div class="card-body">
                    <!-- Hiển thị hình ảnh hiện tại -->
                    <img id="current_image" src="" alt="Client Image" class="img-fluid">
                    <!-- Xem trước hình ảnh mới -->
                    <img id="preview_image" src="" alt="Preview Image" class="img-fluid mt-3"
                        style="display: none;">
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thêm Sản phẩm</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form cập nhật hình ảnh -->
                    <form action="{{ route('product.insert') }}" method="POST" enctype="multipart/form-data"
                        id="productForm">
                        @csrf
                        <label for="product_name" class="fw-bold mb-2">Nhập tên sản phẩm</label>
                        <input type="text" name="product_name" id="product_name" class="form-control"
                            placeholder="Nhập tên sản phẩm">

                        <label for="product_price" class="fw-bold mb-2">Nhập giá cả sản phẩm</label>
                        <input type="number" name="product_price" id="product_price" class="form-control"
                            placeholder="Nhập giá cả sản phẩm" step="0.01" min="0">


                        <label for="product_cat_name" class="fw-bold mb-2">Chọn Chuyên mục lớn</label>
                        <div class="form-outline position-relative">
                            <select name="product_cat_name" id="product_cat_name"
                                class="form-control custom-select form-select" aria-label="Large select example">
                                <option value="">Chọn</option> <!-- Tùy chọn mặc định -->
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="product_subcat_name" class="fw-bold mb-2">Chọn Chuyên mục nhỏ</label>
                        <div class="form-outline position-relative">
                            <select name="product_subcat_name" id="product_subcat_name"
                                class="form-control custom-select form-select" aria-label="Large select example">
                                <option value="">Chọn</option> <!-- Tùy chọn mặc định -->
                                @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="product_attribute_name" class="fw-bold mb-2">Chọn dữ liệu ban đầu</label>
                        <div class="form-outline position-relative">
                            <select name="product_attribute_name" id="product_attribute_name"
                                class="form-control custom-select form-select" aria-label="Large select example">
                                <option value="">Chọn</option> <!-- Tùy chọn mặc định -->
                                @foreach ($attributes as $attribute)
                                    <option value="{{ $attribute->id }}">{{ $attribute->attribute_value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="product_status" class="fw-bold mb-2">Chọn trạng thái sản phẩm</label>
                        <div class="form-outline position-relative">
                            <select name="product_status" id="product_status" class="form-control custom-select form-select"
                                aria-label="Large select example">
                                <option value="">Chọn</option> <!-- Tùy chọn mặc định -->

                                <option value="Vẫn còn">Vẫn còn</option>
                                <option value="Đã hết">Đã hết</option>
                            </select>
                        </div>

                        <label for="product_quantity" class="fw-bold mb-2">Nhập số lượng sản phẩm</label>
                        <input type="number" name="product_quantity" id="product_quantity" class="form-control"
                            placeholder="Nhập số lượng sản phẩm">



                        <div class="card mt-2">
                            <label for="product_img" class="fw-bold mb-2">Chọn hình ảnh</label>
                            <input type="file" name="product_img" id="product_img" class="form-control form-control-lg"
                                onchange="previewImage(event)">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-2">Thêm sản phẩm</button>
                    </form>

                    @if (session('success'))
                        <div class="alert alert-success mt-2">
                            {{ session('success') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger mt-2">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        // Kiểm tra mật khẩu và mật khẩu xác nhận
        document.getElementById('productForm').addEventListener('submit', function(e) {
            var pass = document.getElementById('vendor_pass').value;
            var confirmPass = document.getElementById('vendor_pass_confirm').value;
            if (pass !== confirmPass) {
                e.preventDefault();
                swal("Thất bại", "Mật khẩu và mật khẩu xác nhận không khớp", "error");
            }
        });
    </script> --}}

    <script>
        // SweetAlert cho session thông báo
        $(document).ready(function() {
            @if (session('success'))
                swal("Thành công", "{{ session('success') }}", "success");
            @elseif (session('error'))
                swal("Thất bại", "{{ session('error') }}", "error");
            @endif
        });

        // JavaScript để xem trước hình ảnh mới
        function previewImage(event) {
            var output = document.getElementById('preview_image');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.style.display = 'block';
            // Ẩn hình ảnh hiện tại nếu người dùng đã chọn hình ảnh mới
            document.getElementById('current_image').style.display = 'none';
        }
    </script>
@endsection
