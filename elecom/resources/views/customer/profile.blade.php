@extends('customer.layouts.layout')
@section('customer_title')
    Profile Customer
@endsection
@section('customer_layout')
    <style>
        /* Đảm bảo button luôn nằm dưới hình ảnh và không bị dịch chuyển */
        .submit-button-container {
            position: relative;
            top: 10px;
            /* khoảng cách giữa button và hình ảnh */
            text-align: center;
            /* căn giữa button dưới hình ảnh */
            z-index: 10;
            /* đảm bảo button ở trên layer xem trước ảnh */
        }

        /* Đảm bảo hình ảnh xem trước không che button */
        #preview_image {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 5;
            /* Đặt hình ảnh xem trước dưới button */
        }

        /* Đặt hình ảnh hiện tại và button ở cùng một khu vực */
        #current_image {
            display: block;
        }
    </style>


    <div class="max-w-lg lg:max-w-4xl mx-auto my-10 bg-white rounded-lg shadow-md p-5">
        <div class="flex flex-col lg:flex-row items-center">
            <!-- Phần hình ảnh và form -->
            <div class="lg:w-1/2 w-full mb-5 lg:mb-0">
                <p class="text-center text-gray-600 mt-3">
                    @if (Auth::user()->role == 2)
                        Khách hàng
                    @endif
                </p>
                <h2 class="text-center text-2xl font-semibold mt-3">{{ Auth::user()->name }}</h2>

                <div class="relative w-60 h-60 mx-auto">
                    <img class="w-full h-full rounded-full border-2 border-black"
                        src="{{ asset('admin_asset/img/photos/' . (Auth::user()->img_user ?? 'blocks.png')) }}"
                        alt="Profile picture" id="current_image">
                    <img class="w-full h-full rounded-full absolute top-0 left-0 z-10 border-2 border-black" src=""
                        alt="Preview image" id="preview_image" style="display: none;">

                    <div class="mb-5">
                        <label for="profileImageInput"
                            class="absolute right-8 bottom-8 transform translate-x-1/2 translate-y-1/2 cursor-pointer bg-blue-500 rounded-full p-2 transition duration-200 hover:bg-blue-400 shadow-md z-20">
                            <i class="fa-solid fa-pen text-white"></i>
                        </label>
                    </div>
                </div>

                <div class="submit-button-container m-2">
                    <form action="{{ route('customer.edit_profile', ['id' => Auth::user()->id]) }}" method="POST"
                        enctype="multipart/form-data" id="productForm">
                        @csrf
                        @method('put')
                        <input type="file" id="profileImageInput" name="profile_img" class="hidden"
                            onchange="previewImage(event)">
                        <button type="submit"
                            class="w-full sm:w-auto mt-4 p-2 font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow-md transition duration-200 ease-in-out transform hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Xác nhận thay đổi hình ảnh
                        </button>
                    </form>
                </div>
            </div>

            <!-- Phần Bio -->
            <div class="lg:w-1/2 w-full lg:pl-5 mt-5 lg:mt-0">
                <div>
                    <h3 class="text-xl font-semibold">Bio</h3>
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="p-3 font-bold  text-gray-600 lg:table-cell">Email của tôi :</th>
                                <td class="p-3  lg:table-cell">{{Auth::user()->email}}</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="p-3 font-bold  text-gray-600 lg:table-cell">ID của tôi :</th>
                                <td class="p-3  lg:table-cell">{{Auth::user()->id}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <h3 class="text-xl font-semibold">Kiểm tra đơn hàng</h3>
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="p-3 font-bold text-gray-600 lg:table-cell">Đang kiểm duyệt</th>
                                <th class="p-3 font-bold text-gray-600 lg:table-cell">Đã kiểm duyệt</th>
                                <th class="p-3 font-bold text-gray-600 lg:table-cell">Đã được gửi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-3 text-center align-middle lg:table-cell relative">
                                    <a href="{{route('customer.list.order' , ['id' => Auth::user()->id])}}" class="group">
                                        <div class="relative flex justify-center items-center">
                                            <i class="fa-solid fa-star-half-stroke text-4xl"></i>
                                            <label class="absolute bg-blue-400 text-white text-xs font-bold rounded-full px-2 py-0.5 -top-2 right-3 transition-transform duration-200 group-hover:-translate-y-1">
                                                {{$customer_uncensor}}
                                            </label>
                                        </div>
                                    </a>
                                </td>
                                <td class="p-3 text-center align-middle lg:table-cell relative">
                                    <a href="{{route('customer.list.order' , ['id' => Auth::user()->id])}}" class="group">
                                        <div class="relative flex justify-center items-center">
                                            <i class="fa-regular fa-star text-4xl"></i>
                                            <label class="absolute bg-blue-400 text-white text-xs font-bold rounded-full px-2 py-0.5 -top-2 right-3 transition-transform duration-200 group-hover:-translate-y-1">
                                                {{$customer_censor}}
                                            </label>
                                        </div>
                                    </a>
                                </td>
                                <td class="p-3 text-center align-middle lg:table-cell relative">
                                    <a href="{{route('customer.list.ship' , Auth::user()->name)}}" class="group">
                                        <div class="relative flex justify-center items-center">
                                            <i class="fa-solid fa-truck-fast text-4xl"></i>
                                            <label class="absolute bg-blue-400 text-white text-xs font-bold rounded-full px-2 py-0.5 -top-2 right-3 transition-transform duration-200 group-hover:-translate-y-1">
                                                {{$shipper_info}}
                                            </label>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

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

        function previewImage(event) {
            const preview = document.getElementById('preview_image');
            const currentImage = document.getElementById('current_image');

            // Hiển thị ảnh xem trước
            preview.src = URL.createObjectURL(event.target.files[0]);
            preview.style.display = 'block';
            preview.onload = () => URL.revokeObjectURL(preview.src); // Hủy URL để tránh rò rỉ bộ nhớ

            // Ẩn hình ảnh hiện tại
            currentImage.style.display = 'none';
        }
    </script>
@endsection
