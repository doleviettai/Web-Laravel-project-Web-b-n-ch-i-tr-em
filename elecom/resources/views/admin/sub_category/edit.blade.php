@extends('admin/layouts/layout')
@section('admin_page_title')
    Edit Sub Category - Admin Panel
@endsection
@section('admin_layout')
    {{-- <h3>Create Category Page</h3> --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thay đổi danh mục nhỏ</h5>
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

                    <form action="{{ route('update.subcat', $subcategory_info->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="subcategory_name" class="fw-bold mb-2">Đặt tên cho danh mục nhỏ</label>
                        <input type="text" name="subcategory_name" id="subcategory_name" class="form-control"
                        value="{{ $subcategory_info->subcategory_name }}">

                        <button type="submit" class="btn btn-primary w-100 mt-2">Sửa chuyên mục nhỏ</button>

                        {{-- Hiển thị thông báo thành công hoặc thất bại --}}
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
@endsection
