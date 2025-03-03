@extends('admin/layouts/layout')
@section('admin_page_title')
    Create Product Attribute - Admin Panel
@endsection
@section('admin_layout')
    {{-- <h3>Manage Product Attribute</h3> --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tạo Dữ Liệu Ban Đầu</h5>
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

                    <form action="{{route('attribute.create')}}" method="POST">
                        @csrf
                        <label for="attribute_value" class="fw-bold mb-2">Đặt tên cho dữ liệu ban đầu</label>
                        <input type="text" name="attribute_value" id="attribute_value" class="form-control"
                            placeholder="Nhập dữ liệu ban đầu của sản phẩm">

                        <button type="submit" class="btn btn-primary w-100 mt-2">Thêm dữ liệu ban đầu</button>

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
