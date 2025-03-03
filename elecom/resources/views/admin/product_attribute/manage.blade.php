@extends('admin/layouts/layout')
@section('admin_page_title')
    Manage product attribute - Admin Panel
@endsection
@section('admin_layout')
    {{-- <h3>Manage product Attribute</h3> --}}
    <div class="row">

        <div class="col-12">
            <div class="col-12 search_category">
                <label for="search_attribute" class="fw-bold">Tìm kiếm chuyên mục</label>
                <input type="search" name="search_attribute" id="search_attribute" placeholder="Nhập từ bạn muốn tìm kiếm!"
                    class="form-control mb-2">
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tất cả các dữ liệu ban đầu</h5>
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
                                    <th>Dữ liệu ban đầu</th>
                                    <th>Xóa</th>
                                    <th>Cập nhật</th>
                                </tr>
                            </thead>

                            <tbody id="hien_table">
                                @foreach ($allattribute as $attribute)
                                    <tr>
                                        <td>{{ $attribute->id }}</td>
                                        <td>{{ $attribute->attribute_value }}</td>
                                        <td>
                                            <form action="{{route('delete.attribute' , $attribute->id)}}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <input type="submit" value="Xóa" class="btn btn-danger">
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{route('show.attribute' , $attribute->id)}}" class="btn btn-success">Cập nhật</a>
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
    </script>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <script type="text/javascript">
        $('#search_attribute').on('keyup', function() {
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
                url: '{{ route('search.attribute') }}',
                data: {
                    'search_attribute': value
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
