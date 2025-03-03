@extends('admin/layouts/layout')
@section('admin_page_title')
    Manage Vendor - Admin Panel
@endsection
@section('admin_layout')
    <center>
        <h3>Trang danh sách nhân viên và các tài khoản</h3>
    </center>

    <style>
        .img_user {
            width: 125px;
            height: 125px;
            border-radius: 50%;
            border:2px solid black;
            object-fit: cover;
        };
        .tb_scoll{
            width: 100%;
            height: 500px;
            overflow-y: scroll;
        }
    </style>

    <div class="col-12 search_category">
        <label for="search_vendor" class="fw-bold">Tìm kiếm nhân viên</label>
        <input type="search" name="search_vendor" id="search_vendor" placeholder="Nhập nhân viên mà bạn muốn tìm kiếm!"
            class="form-control mb-2">
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Danh sách các tài khoản Nhân viên</h5>
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
                                <a href="{{route('vendor.create')}}" class="btn btn-primary bg-gradient">Thêm nhân viên</a>
                            </th>
                        </tr>
                    </thead>
                    <thead class="table-primary">
                        <tr>
                            {{-- <th>#</th> --}}
                            <th>Tên Nhân Viên</th>
                            <th>Email liên lạc</th>
                            <th>Hình ảnh</th>
                            <th>Cập nhật</th>
                            <th>Xóa tài khoản</th>
                        </tr>
                    </thead>

                    <tbody id="hien_table">
                        @foreach ($vendors as $vendor)
                            <tr>
                                {{-- <td>{{ $vendor->id }}</td> --}}
                                <td>{{ $vendor->name }}</td>
                                <td>{{ $vendor->email }}</td>
                                <td>
                                    @if ($vendor->img_user == null)
                                        <img src="{{ asset('admin_asset/img/photos/blocks.png') }}" alt=""
                                            class="img_user">
                                    @else
                                        <img src="{{ asset("admin_asset/img/photos/$vendor->img_user") }}" alt=""
                                            class="img_user">
                                    @endif

                                </td>
                                <td>
                                    <a href="{{route('vendor.edit' , $vendor->id)}}" class="btn btn-success">Cập nhật hình ảnh nhân viên</a>
                                </td>
                                <td>
                                    <form action="{{ route('vendor.delete', $vendor->id) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Xóa" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tbody id="an_table"></tbody>
                </table>
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
        $('#search_vendor').on('keyup', function() {
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
                url: '{{ route('vendor.search') }}',
                data: {
                    'search_vendor': value
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
