@extends('customer.layouts.layout')

@section('customer_title')
    Product Customer
@endsection

@section('customer_layout')
    <div class="mx-auto px-4">
        <div class="flex flex-wrap">
            <!-- Sidebar -->
            <div class="w-full lg:w-1/4 p-2">
                <nav class="relative w-full py-4 shadow-md rounded-md">
                    <div class="flex items-center justify-between px-3 bg-cyan-500">
                        <span class="text-xl text-white">Tìm kiếm nâng cao</span>
                    </div>

                    <div class="flex items-center justify-between px-3">
                        <a href="#" class="block w-full px-4 py-2 text-black transition duration-300 hover:bg-hero-overlay rounded-md no-underline hover:no-underline search-btn" id="search_all">Tất cả sản phẩm</a>
                    </div>

                    <div class="flex items-center justify-between px-3">
                        <a href="#" class="block w-full px-4 py-2 text-black transition duration-300 hover:bg-hero-overlay rounded-md no-underline hover:no-underline search-btn" id="search1_100">0k đến 100k</a>
                    </div>

                    <div class="flex items-center justify-between px-3">
                        <a href="#" class="block w-full px-4 py-2 text-black transition duration-300 hover:bg-hero-overlay rounded-md no-underline hover:no-underline search-btn" id="search100_500">100k đến 500k</a>
                    </div>

                    <div class="flex items-center justify-between px-3">
                        <a href="#" class="block w-full px-4 py-2 text-black transition duration-300 hover:bg-hero-overlay rounded-md no-underline hover:no-underline search-btn" id="search500_1000">500k đến 1 triệu</a>
                    </div>

                    <div class="flex items-center justify-between px-3">
                        <a href="#" class="block w-full px-4 py-2 text-black transition duration-300 hover:bg-hero-overlay rounded-md no-underline hover:no-underline search-btn" id="search1000_2000">1 triệu đến 2 triệu</a>
                    </div>

                    <div class="flex items-center justify-between px-3">
                        <a href="#" class="block w-full px-4 py-2 text-black transition duration-300 hover:bg-hero-overlay rounded-md no-underline hover:no-underline search-btn" id="search2000_5000">2 triệu đến 5 triệu</a>
                    </div>

                    <div class="flex items-center justify-between px-3">
                        <a href="#" class="block w-full px-4 py-2 text-black transition duration-300 hover:bg-hero-overlay rounded-md no-underline hover:no-underline search-btn" id="search5000_10000">5 triệu đến 10 triệu</a>
                    </div>
                </nav>
            </div>

            <style>
                /* CSS for the selected state */
                .selected {
                    background-color: #00bcd4; /* Change to your desired color */
                    color: white !important;
                }
            </style>

            <script>
                // JavaScript to handle the selection
                document.addEventListener('DOMContentLoaded', function() {
                    const searchLinks = document.querySelectorAll('.search-btn');

                    searchLinks.forEach(link => {
                        link.addEventListener('click', function(event) {
                            event.preventDefault(); // Prevent the default anchor behavior

                            // Remove 'selected' class from all links
                            searchLinks.forEach(link => link.classList.remove('selected'));

                            // Add 'selected' class to the clicked link
                            this.classList.add('selected');
                        });
                    });
                });
            </script>


            <!-- Main Content -->
            <div class="w-full lg:w-3/4 p-2">
                <div id="notification"></div>

                <div class="bg-white shadow-md rounded-lg p-4">
                    <div class="mb-4">
                        <label for="search_product" class="font-bold">Tìm kiếm sản phẩm</label>
                        <input type="search" name="search_product" id="search_product" placeholder="Nhập sản phẩm mà bạn muốn tìm kiếm!" class="w-full border border-gray-300 rounded-lg p-2 mt-2">
                    </div>

                    <!-- Show dữ liệu sản phẩm -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4" id="product_results_hien">
                        @foreach ($products_info as $product)
                            <div class="bg-white border border-gray-200 shadow-lg rounded-lg p-4 transform transition duration-300 hover:-translate-y-2 shadow-black">
                                <center>
                                    <img src="{{ asset('admin_asset/img/photos/' . ($product->product_img ?? 'blocks.png')) }}" class="w-56 h-40 object-cover rounded-md mb-4" alt="Product Image">
                                </center>

                                <div class="text-center">
                                    <h5 class="font-semibold text-lg mb-2">{{ $product->product_name }}</h5>
                                    <input type="hidden" name="pro_item_id" value="{{ $product->id }}">
                                    <input type="hidden" name="pro_item_price" value="{{ $product->product_price }}">

                                    <table class="w-full text-left border-t border-gray-200 mt-2">
                                        <tbody id="hien_table">
                                            <tr class="border-b border-gray-200">
                                                <td class="py-2 font-semibold">Giá:</td>
                                                <td class="py-2">{{ $product->product_price }}</td>
                                            </tr>
                                            <tr class="border-b border-gray-200">
                                                <td class="py-2 font-semibold">Sản phẩm/Kích cỡ:</td>
                                                <td class="py-2">{{ $product->category->category_name }} / {{ $product->default_attribute->attribute_value  }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 font-semibold">Loại đồ chơi:</td>
                                                <td class="py-2">{{ $product->subcategory->subcategory_name }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="flex flex-col sm:flex-row items-center justify-center mt-4 space-y-2 sm:space-y-0 sm:space-x-2">
                                        <a href="{{ route('customer.product.see', $product->id) }}"
                                           class="w-full sm:w-auto bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-200 transform hover:scale-105 hover:bg-blue-600 hover:shadow-lg hover:no-underline">
                                            Xem sản phẩm
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4" id="product_results_an"></div>

                    <div class="">
                        {{$products_info->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            @if(session('success'))
                swal("Thành công", "{{ session('success') }}", "success");
            @elseif (session('error'))
                swal("Thất bại", "{{ session('error') }}", "error");
            @endif
        });

        // Sự kiện khi người dùng gõ tìm kiếm sản phẩm
        $('#search_product').on('keyup', function() {
            var value = $(this).val(); // Lấy giá trị từ input tìm kiếm

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('customer.product.search') }}',
                data: {
                    'search_product': value
                },
                success: function(data) {
                    $('#product_results_hien').html(data);
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                }
            });
        });
        // click show tất cả sản phẩm
        $('#search_all').on('click', function() {
            location.reload();
        });

        // Sự kiện khi người dùng click vào "0 đến 4.000" để tìm kiếm theo phạm vi giá
        $('#search1_100').on('click', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('customer.product.search_0_100') }}',
                success: function(data) {
                    $('#product_results_an').html(data); // Hiển thị kết quả tìm kiếm theo phạm vi giá
                    $('#product_results_hien').hide(); // Ẩn kết quả tìm kiếm ban đầu
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                }
            });
        });

        $('#search100_500').on('click', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('customer.product.search_100_500') }}',
                success: function(data) {
                    $('#product_results_an').html(data); // Hiển thị kết quả tìm kiếm theo phạm vi giá
                    $('#product_results_hien').hide(); // Ẩn kết quả tìm kiếm ban đầu
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                }
            });
        });

        $('#search500_1000').on('click', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('customer.product.search_500_1000') }}',
                success: function(data) {
                    $('#product_results_an').html(data); // Hiển thị kết quả tìm kiếm theo phạm vi giá
                    $('#product_results_hien').hide(); // Ẩn kết quả tìm kiếm ban đầu
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                }
            });
        });

        $('#search1000_2000').on('click', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('customer.product.search_1000_2000') }}',
                success: function(data) {
                    $('#product_results_an').html(data); // Hiển thị kết quả tìm kiếm theo phạm vi giá
                    $('#product_results_hien').hide(); // Ẩn kết quả tìm kiếm ban đầu
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                }
            });
        });

        $('#search2000_5000').on('click', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('customer.product.search_2000_5000') }}',
                success: function(data) {
                    $('#product_results_an').html(data); // Hiển thị kết quả tìm kiếm theo phạm vi giá
                    $('#product_results_hien').hide(); // Ẩn kết quả tìm kiếm ban đầu
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                }
            });
        });

        $('#search5000_10000').on('click', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('customer.product.search_5000_10tr') }}',
                success: function(data) {
                    $('#product_results_an').html(data); // Hiển thị kết quả tìm kiếm theo phạm vi giá
                    $('#product_results_hien').hide(); // Ẩn kết quả tìm kiếm ban đầu
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                }
            });
        });
    </script>
@endsection
