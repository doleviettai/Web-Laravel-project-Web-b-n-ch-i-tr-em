@extends('admin/layouts/layout')
@section('admin_page_title')
    Edit Image Client - Admin Panel
@endsection
@section('admin_layout')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Thay đổi hình ảnh khách hàng</h5>
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
                <form action="{{ route('updateimg.client', $client->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label for="img_user" class="fw-bold mb-2">Chọn hình ảnh</label>
                    <input type="file" name="img_user" id="img_user" class="form-control form-control-lg" onchange="previewImage(event)">

                    <button type="submit" class="btn btn-primary w-100 mt-2" id="alert_img">Sửa hình ảnh</button>

                    @if (session('success'))
                        <div class="alert alert-success mt-2">
                            {{ session('success') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger mt-2">
                            {{ session('error') }}
                        </div>
                    @endif

                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-2">Hình ảnh hiện tại</h5>
            </div>
            <div class="card-body">
                <!-- Hiển thị hình ảnh hiện tại -->
                <img id="current_image" src="{{ asset($client->img_user ? 'admin_asset/img/photos/' . $client->img_user : 'admin_asset/img/photos/blocks.png') }}"
                     alt="Client Image" class="img-fluid">

                <!-- Xem trước hình ảnh mới -->
                <img id="preview_image" src="" alt="Preview Image" class="img-fluid mt-3" style="display: none;">
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        @if(session('success'))
            swal("Thành công", "{{ session('success') }}", "success");
        @elseif(session('error'))
            swal("Thất bại", "{{ session('error') }}", "error");
        @endif
    });
</script>

<script>
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
