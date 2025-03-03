@extends('admin/layouts/layout')
@section('admin_page_title')
    Manage User - Admin Panel
@endsection
@section('admin_layout')
    <center>
        <h3>Trang danh sách khách hàng và các tài khoản</h3>
    </center>

    <style>
        .img_user {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        ;
    </style>

    <div class="col-12 search_category">
        <label for="search_client" class="fw-bold">Tìm kiếm Khách Hàng</label>
        <input type="search" name="search_client" id="search_client" placeholder="Nhập khách hàng mà bạn muốn tìm kiếm!"
            class="form-control mb-2">
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Danh sách các tài khoản khách hàng</h5>
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

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover" align="center">
                    <thead class="table-primary">
                        <tr>
                            <th>STT</th>
                            <th>Tên Khách Hàng</th>
                            <th>Email liên lạc</th>
                            <th>Hình ảnh</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="hien_table">
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->email }}</td>
                                <td>
                                    @if ($client->img_user == null)
                                        <img src="{{ asset('admin_asset/img/photos/blocks.png') }}" alt=""
                                            class="img_user">
                                    @else
                                        <img src="{{ asset("admin_asset/img/photos/$client->img_user") }}" alt=""
                                            class="img_user">
                                    @endif

                                </td>
                                <td>
                                    <a href="{{route('show.client' , $client->id)}}" class="btn btn-success">Cập nhật hình ảnh khách hàng</a>
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
            @if(session('success'))
                swal("Thành công", "{{ session('success') }}", "success");
            @elseif(session('error'))
                swal("Thất bại", "{{ session('error') }}", "error");
            @endif
        });
    </script>

    <script type="text/javascript">
        $('#search_client').on('keyup', function() {
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
                url: '{{ route('client.search') }}',
                data: {
                    'search_client': value
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
