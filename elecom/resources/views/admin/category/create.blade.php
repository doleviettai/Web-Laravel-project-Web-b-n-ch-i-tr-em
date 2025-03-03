@extends('admin/layouts/layout')
@section('admin_page_title')
    Create Category - Admin Panel
@endsection
@section('admin_layout')
    {{-- <h3>Create Category Page</h3> --}}

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

                    <form action="{{ route('store.cat') }}" method="POST">
                        @csrf
                        <label for="category_name" class="fw-bold mb-2">Đặt tên cho danh mục</label>
                        <input type="text" name="category_name" id="category_name" class="form-control"
                            placeholder="Nhập chuyên mục">

                        <button type="submit" class="btn btn-primary w-100 mt-2">Thêm chuyên mục</button>

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
