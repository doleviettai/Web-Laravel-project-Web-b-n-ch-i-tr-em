@extends('admin/layouts/layout')
@section('admin_page_title')
    Create Sub Category- Admin Panel
@endsection
@section('admin_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tạo danh mục</h5>
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

                    <form action="{{ route('store.subcat') }}" method="POST">
                        @csrf
                        <label for="subcategory_name" class="fw-bold mb-2">Đặt tên cho danh mục nhỏ</label>
                        <input type="text" name="subcategory_name" id="subcategory_name" class="form-control"
                            placeholder="Nhập chuyên mục">

                        <label for="category_id" class="fw-bold mb-2">Chọn Chuyên mục lớn</label>
                        <div class="form-outline position-relative">
                            <select name="category_id" id="category_id" class="form-control custom-select form-select" aria-label="Large select example">
                                <option value="">Chọn</option> <!-- Tùy chọn mặc định -->
                                @foreach ($categories as $category)
                                   <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <button type="submit" class="btn btn-primary w-100 mt-2">Thêm chuyên mục nhỏ</button>

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
