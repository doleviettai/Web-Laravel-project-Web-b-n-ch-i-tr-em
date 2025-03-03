@extends('admin.layouts.layout')

@section('admin_page_title')
    Edit Seller - Admin Panel
@endsection

@section('admin_layout')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Sửa Nhân viên</h5>
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
                    <form action="{{ route('vendor.update', $vendor_info->id) }}" method="POST" enctype="multipart/form-data" id="vendorForm">
                        @csrf
                        @method('PUT')

                        <label for="vendor_name" class="fw-bold mb-2">Nhập lại tên nhân viên</label>
                        <input type="text" name="vendor_name" id="vendor_name" class="form-control" value="{{ $vendor_info->name }}">

                        <label for="vendor_email" class="fw-bold mb-2">Nhập lại email nhân viên</label>
                        <input type="email" name="vendor_email" id="vendor_email" class="form-control" value="{{ $vendor_info->email }}">

                        <label for="vendor_pass" class="fw-bold mb-2">Nhập lại mật khẩu cho tài khoản nhân viên</label>
                        <input type="password" name="vendor_pass" id="vendor_pass" class="form-control" placeholder="Nhập mật khẩu tài khoản">

                        <label for="vendor_pass_confirm" class="fw-bold mb-2">Xác nhận mật khẩu</label>
                        <input type="password" name="vendor_pass_confirm" id="vendor_pass_confirm" class="form-control" placeholder="Nhập mật khẩu xác nhận để kích hoạt tài khoản nhân viên">

                        <div class="card mt-2">
                            <label for="vendor_img" class="fw-bold mb-2">Chọn hình ảnh</label>
                            <input type="file" name="vendor_img" id="vendor_img" class="form-control form-control-lg" onchange="previewImage(event)">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-2">Thay đổi thông tin nhân viên</button>
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

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-2">Hình ảnh thay đổi</h5>
                </div>
                <div class="card-body">
                    <!-- Hiển thị hình ảnh hiện tại -->
                    <img id="current_image" src="{{ asset('admin_asset/img/photos/' . ($vendor_info->img_user ?? 'blocks.png')) }}" alt="Client Image" class="img-fluid">
                    <!-- Xem trước hình ảnh mới -->
                    <img id="preview_image" src="" alt="Preview Image" class="img-fluid mt-3" style="display: none;">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('vendorForm').addEventListener('submit', function(e) {
            var pass = document.getElementById('vendor_pass').value;
            var confirmPass = document.getElementById('vendor_pass_confirm').value;
            if (pass !== confirmPass) {
                e.preventDefault();
                swal("Thất bại", "Mật khẩu và mật khẩu xác nhận không khớp", "error");
            }
        });

        $(document).ready(function() {
            @if (session('success'))
                swal("Thành công", "{{ session('success') }}", "success");
            @elseif (session('error'))
                swal("Thất bại", "{{ session('error') }}", "error");
            @endif
        });

        function previewImage(event) {
            var output = document.getElementById('preview_image');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.style.display = 'block';
            document.getElementById('current_image').style.display = 'none';
        }
    </script>
@endsection
