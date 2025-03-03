@extends('admin/layouts/layout')

@section('admin_page_title')
    Manage Category - Admin Panel
@endsection

@section('admin_layout')
    <div class="row">
        <div class="col-12">
            <div class="col-12 search_category">
                <label for="search_category" class="fw-bold">Tìm kiếm chuyên mục</label>
                <input type="search" name="search_category" id="search_category" placeholder="Nhập từ bạn muốn tìm kiếm!"
                    class="form-control mb-2">
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tất cả các danh mục</h5>
                </div>

                @if (session('success'))
                    <div class="alert alert-success" id="success-alert">
                        {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger" id="error-alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" align="center">
                            <thead class="table-primary">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên danh mục</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="hien_table">
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>
                                            <form action="{{ route('delete.cat', $category->id) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <input type="submit" value="Xóa" class="btn btn-danger">
                                            </form>
                                            
                                            <a href="{{ route('show.cat', $category->id) }}" class="btn btn-success">Cập nhật</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody id="an_table"></tbody>
                        </table>
                    </div>
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

        $('#search_category').on('keyup', function() {
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
                url: '{{ route('search.cat') }}',
                data: {
                    'search_category': value
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
