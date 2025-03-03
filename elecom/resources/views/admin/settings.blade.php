
@extends('admin/layouts/layout')
@section('admin_page_title')
    Setting - Admin Panel
@endsection
@section('admin_layout')
{{-- {{ route('vendor.order.edit_img', ['id' => Auth::user()->id]) }} --}}
{{-- admin.setting.edit_img --}}
<form action="{{ route('admin.setting.edit_img', ['id' => Auth::user()->id]) }}" method="POST" enctype="multipart/form-data" id="productForm">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-2">Hình ảnh hiện tại</h5>
                </div>
                <center>
                    <div class="card-body">
                        <!-- Hiển thị hình ảnh hiện tại -->
                        <img id="current_image" src="{{ asset('admin_asset/img/photos/' . Auth::user()->img_user) }}"
                            alt="Client Image" class="img-fluid rounded-circle" style="border: 3px solid black;width:350px;height:auto;object-fit:cover;">
                        <!-- Xem trước hình ảnh mới -->
                        <img id="preview_image" src="" alt="" class="img-fluid mt-3 rounded-circle"
                            style="border: 3px solid black;width:350px;height:auto;object-fit:cover;">
                    </div>
                </center>

                <div class="m-2">
                    <label for="profile_img" class="fw-bold mb-2">Chọn hình ảnh</label>
                    <input type="file" name="profile_img" id="profile_img" class="form-control form-control-lg"
                        onchange="previewImage(event)">
                </div>


            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">My Profile</h5>
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


                        <table class="table table-responsive">
                            <tbody>
                                <tr>
                                    <th>Tên của bạn :</th>
                                    <td><span name="profile_name">{{ Auth::user()->name }}</span></td>
                                </tr>

                                <tr>
                                    <th>Mã của bạn :</th>
                                    <td><span name="profile_id">{{ Auth::user()->id }}</span></td>
                                </tr>

                                <tr>
                                    <th>Email được cấp phát :</th>
                                    <td><span name="profile_email">{{ Auth::user()->email }}</span></td>
                                </tr>

                                <tr>
                                    <th>Chức vụ :</th>
                                    <td>
                                        @if (Auth::user()->role == 0)
                                            <span name="profile_role">
                                               Chủ tịch
                                            </span>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <button type="submit" class="btn btn-primary form-control">Cập nhật hình ảnh</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

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
</form>

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
