
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="{{ asset('admin_asset/img/photos/blocks.png') }}" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#87CEFA', // Sky blue
                        secondary: '#FFD700', // Gold
                        accent: '#FF4500', // Orange red

                    },
                    backgroundImage: {
                        'hero-pattern': "url('https://static2.vieon.vn/vieplay-image/carousel_web_v4_ntc/2021/12/14/5p7qk3sw_1920x1080-carousel-cauchuyendochoi3_1920_1080.jpg')",
                    },
                },
            },
        }
    </script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">


</head>

<style>
    html {
        scroll-behavior: smooth;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }


    /* ------btn login------ */
    .h_login {
        position: relative;
        display: inline-block;
        margin: 15px;
        margin-left: 3px !important;
        margin-right: 5px !important;
        padding: 10px 20px;
        text-align: center;
        font-size: 16px;
        letter-spacing: 1px;
        text-decoration: none;
        color: white;
        background: #725AC1;
        cursor: pointer;
        transition: ease-out 0.5s;
        border: 2px solid #725AC1;
        border-radius: 10px;
        box-shadow: inset 0 0 0 0 #725AC1;
    }

    .h_register {
        position: relative;
        display: inline-block;
        margin: 15px;
        margin-left: 3px !important;
        margin-right: 5px !important;
        padding: 10px 20px;
        text-align: center;
        font-size: 16px;
        letter-spacing: 1px;
        text-decoration: none;
        color: #725AC1;
        background: transparent;
        cursor: pointer;
        transition: ease-out 0.5s;
        border: 2px solid #725AC1;
        border-radius: 10px;
        box-shadow: inset 0 0 0 0 #725AC1;

    }

    .h_register:hover {
        color: white;
        box-shadow: inset 0 -100px 0 0 #725AC1;
    }

    .h_login:hover {
        color: #725AC1;
        box-shadow: inset 0 -100px 0 0 transparent;
        background: transparent;
    }

    .h_login:active h_register:active {
        transform: scale(0.9);
    }



    /* ------------------------------- */

    .swiper-container {
        width: 100%;
        max-width: 1200px;
        margin: 40px auto;
        padding: 20px 0;
    }

    .swiper-slide {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        transition: transform 0.3s ease;
    }

    .swiper-slide:hover {
        transform: translateY(-10px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .swiper-slide img {
        width: 80px;
        height: 80px;
        object-fit: contain;
        margin-bottom: 10px;
    }

    .swiper-slide h3 {
        font-size: 16px;
        color: #333;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .swiper-slide a {
        color: #007BFF;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
    }

    .swiper-slide a:hover {
        text-decoration: underline;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: #007BFF;
    }

    .swiper-pagination-bullet {
        background-color: #007BFF;
    }

    .cart-icon {
        display: inline-block;
        position: relative;
        width: 40px;
        height: 40px;
    }

    .cart-count {
        position: absolute;
        top: 0px;
        right: 2px;
        background-color: aquamarine;
        color: white;
        font-size: 12px;
        font-weight: bold;
        width: 20px;
        /* Đường kính */
        height: 20px;
        /* Đường kính */
        border-radius: 50%;
        /* Tạo hình tròn */
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        /* Đổ bóng cho đẹp */
    }

    /* ------css nav-icon-right--------------- */
    .nav_icon_right {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        /* Canh phải */
        gap: 20px;
        /* Khoảng cách giữa các icon */
    }

    .cart-icon,
    .login-icon,
    .icon-search {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cart-count {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: red;
        color: white;
        font-size: 12px;
        font-weight: bold;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    /* --------------list-menu-mobile--------------------- */


    @media (max-width: 1024px) {
        .nav_menu_pc {
            display: none !important;
        }

        .login-icon {
            display: none;
        }

        .icon-search {
            display: none !important;
        }

        .h_logo {
            height: 2rem !important;
            width: 2rem !important;
        }

        .h_text {
            font-size: 1rem !important;
            line-height: 1.5rem !important;
        }

        .h_menu-list {
            display: block !important;
        }

        .mobile-menu {
            display: block !important;
            position: absolute;
            top: 60px;
            right: 0;
            width: 100%;
            background-color: white;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 50;
        }


        .mobile-menu a {
            display: block;
            padding: 10px 20px;
            border-bottom: 1px solid #f1f1f1;
            color: #333;
            text-decoration: none;
        }

        .mobile-menu a:hover {
            background-color: #f9f9f9;
            color: #007BFF;
        }

        /* Menu Mobile */
        .mobile-menu {
            transition: transform 0.3s ease;
            transform: translateY(-150%);

        }

        .mobile-menu.show {
            transform: translateY(0);

        }

        .overlay {
            position: fixed;
            top: 60px;
            /* Bắt đầu từ dưới header */
            left: 0;
            width: 100%;
            height: calc(150% - 60px);
            /* Trừ chiều cao của header */
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 30;
            transition: opacity 0.3s ease;
            opacity: 0;
            display: none;
        }

        .overlay.show {
            display: block;
            opacity: 1;
        }

        /* Mobile menu */
        .mobile-menu {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            background-color: white;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 50;
            transform: translateY(-150%);
            transition: transform 0.3s ease;
        }

        .mobile-menu.show {
            transform: translateY(60px);

        }


        .h_header {
            z-index: 50;
            position: relative;
            background-color: #fff;

        }

        .no-scroll {
            overflow: hidden;
        }
    }
</style>

<body>
    <style>
        /* Hiển thị spinner ban đầu */
        #spinner {
            opacity: 1;
            visibility: visible;
            transition: opacity 0.5s ease-out, visibility 0s linear 0.5s;
            z-index: 99999;
        }

        /* Khi ẩn spinner */
        #spinner.hide {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s ease-out, visibility 0s linear 0.5s;
        }

        /* Animation spinner */
        @keyframes spinner-grow {
            0% {
                transform: scale(0);
            }
            50% {
                opacity: 1;
                transform: none;
            }
        }

        .spinner-grow {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            vertical-align: -0.125em;
            background-color: currentColor;
            border-radius: 50%;
            opacity: 0;
            animation: 0.75s linear infinite spinner-grow;
        }

        .spinner-grow-sm {
            width: 1rem;
            height: 1rem;
        }

        @media (prefers-reduced-motion: reduce) {
            .spinner-grow {
                animation-duration: 1.5s;
            }
        }

        /* Định dạng vị trí */
        .spinner-wrapper {
            width: 100vw;
            height: 100vh;
            background: white;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>


    <!-- Spinner Start -->
    <div id="spinner" class="spinner-wrapper">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <script>
        // Ẩn spinner sau khi trang tải xong
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(function () {
                let spinner = document.getElementById("spinner");
                if (spinner) {
                    spinner.classList.add("hide"); // Ẩn spinner bằng class 'hide'
                }
            }, 1000); // Để 1s rồi mới ẩn
        });
    </script>

    <header class="h_header bg-gradient-to-r from-blue-300 via-white to-blue-300 text-gray-800 shadow-md">
        <div class="container mx-auto flex justify-between items-center p-5">
            <a class="flex items-center">
                <div class="h_menu-list hidden mr-2 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                    </svg>
                </div>
                <img class="h_logo h-16 w-16 rounded-lg cursor-pointer"
                    src="{{ asset('admin_asset/img/photos/blocks.png') }}" alt="Logo">
                <span class="h_text ml-3 text-2xl font-bold">MyKingToys</span>
            </a>
            <nav class="nav_menu_pc flex space-x-5">
                <a href="#" class="hover:text-gray-700">Trang chủ</a>
                <a href="#" class="hover:text-gray-700">Sản phẩm</a>
                <a href="#" class="hover:text-gray-700">Giới thiệu</a>
                <a href="#" class="hover:text-gray-700">Liên hệ</a>
            </nav>

            <!-- Menu Mobile -->
            <div class="mobile-menu hidden mt-7">
                <div class="search_mobile">
                    <div class="relative" id="input">
                        <input value="" placeholder="Search..."
                            class="block w-full text-sm h-[50px] px-4 text-slate-900 bg-white rounded-[8px] border border-slate-200 appearance-none focus:border-transparent focus:outline focus:outline-2 focus:outline-primary focus:ring-0 hover:border-brand-500-secondary- peer invalid:border-error-500 invalid:focus:border-error-500 overflow-ellipsis overflow-hidden text-nowrap pr-[48px]"
                            id="floating_outlined" type="text" />
                        <label
                            class="peer-placeholder-shown:-z-10 peer-focus:z-10 absolute text-[14px] leading-[150%] text-primary peer-focus:text-primary peer-invalid:text-error-500 focus:invalid:text-error-500 duration-300 transform -translate-y-[1.2rem] scale-75 top-2 z-10 origin-[0] bg-white data-[disabled]:bg-gray-50-background- px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-[1.2rem] rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1"
                            for="floating_outlined">
                            Tìm kiếm đồ chơi ưa thích
                        </label>
                        <div class="absolute top-3 right-3">
                            <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="slate-300"
                                viewBox="0 0 24 24" height="24" width="24">
                                <path
                                    d="M10.979 16.8991C11.0591 17.4633 10.6657 17.9926 10.0959 17.9994C8.52021 18.0183 6.96549 17.5712 5.63246 16.7026C4.00976 15.6452 2.82575 14.035 2.30018 12.1709C1.77461 10.3068 1.94315 8.31525 2.77453 6.56596C3.60592 4.81667 5.04368 3.42838 6.82101 2.65875C8.59833 1.88911 10.5945 1.79039 12.4391 2.3809C14.2837 2.97141 15.8514 4.21105 16.8514 5.86977C17.8513 7.52849 18.2155 9.49365 17.8764 11.4005C17.5979 12.967 16.8603 14.4068 15.7684 15.543C15.3736 15.9539 14.7184 15.8787 14.3617 15.4343C14.0051 14.9899 14.0846 14.3455 14.4606 13.9173C15.1719 13.1073 15.6538 12.1134 15.8448 11.0393C16.0964 9.62426 15.8261 8.166 15.0841 6.93513C14.3421 5.70426 13.1788 4.78438 11.81 4.34618C10.4412 3.90799 8.95988 3.98125 7.641 4.55236C6.32213 5.12348 5.25522 6.15367 4.63828 7.45174C4.02135 8.74982 3.89628 10.2276 4.28629 11.6109C4.67629 12.9942 5.55489 14.1891 6.75903 14.9737C7.67308 15.5693 8.72759 15.8979 9.80504 15.9333C10.3746 15.952 10.8989 16.3349 10.979 16.8991Z">
                                </path>
                                <rect transform="rotate(-49.6812 12.2469 14.8859)" rx="1" height="10.1881"
                                    width="2" y="14.8859" x="12.2469"></rect>
                            </svg>
                        </div>
                    </div>


                </div>
                <a href="#">Trang chủ</a>
                <a href="#">Sản phẩm</a>
                <a href="#">Giới thiệu</a>
                <a href="#">Liên hệ</a>
                <div class="bg-white mt-10">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('admin', 'vendor', 'customer') }}"
                                class="">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>

            </div>



            <div class="nav_icon_right flex flex-row items-center space-x-4">
                <div class="icons flex items-center space-x-6">

                    <!-- Search Icon -->

                    <div class="icon-search">
                        <div
                            class="p-3 overflow-hidden w-[40px] h-[40px] hover:w-[150px] bg-primary border-[1px] border-[black] shadow-[1px_1px_5px_rgba(0,0,0,0.1)] rounded-full flex group items-center hover:duration-300 duration-300">
                            <div class="flex items-center justify-center fill-black">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Isolation_Mode" data-name="Isolation Mode"
                                    viewBox="0 0 24 24" width="14" height="14">
                                    <path
                                        d="M18.9,16.776A10.539,10.539,0,1,0,16.776,18.9l5.1,5.1L24,21.88ZM10.5,18A7.5,7.5,0,1,1,18,10.5,7.507,7.507,0,0,1,10.5,18Z">
                                    </path>
                                </svg>
                            </div>
                            <input type="text"
                                class="focus:outline-none focus:ring-0 focus:border-[#FFD700] outline-none border-none bg-transparent w-full text-black font-normal px-1 text-[14px]" />
                        </div>

                    </div>

                </div>
                <!-- Cart Icon -->
                <div class="cart-icon relative cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-handbag" viewBox="0 0 16 16">
                        <path
                            d="M8 1a2 2 0 0 1 2 2v2H6V3a2 2 0 0 1 2-2m3 4V3a3 3 0 1 0-6 0v2H3.36a1.5 1.5 0 0 0-1.483 1.277L.85 13.13A2.5 2.5 0 0 0 3.322 16h9.355a2.5 2.5 0 0 0 2.473-2.87l-1.028-6.853A1.5 1.5 0 0 0 12.64 5zm-1 1v1.5a.5.5 0 0 0 1 0V6h1.639a.5.5 0 0 1 .494.426l1.028 6.851A1.5 1.5 0 0 1 12.678 15H3.322a1.5 1.5 0 0 1-1.483-1.723l1.028-6.851A.5.5 0 0 1 3.36 6H5v1.5a.5.5 0 1 0 1 0V6z" />
                    </svg>
                </div>

                <!-- Login Icon -->

                <div class="login-icon" div class="login-icon">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('admin', 'vendor', 'customer') }}"
                                class="h_register">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="h_register">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="h_register">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const hamburgerMenu = document.querySelector('.h_menu-list');
                        const mobileMenu = document.querySelector('.mobile-menu');
                        const overlay = document.querySelector('.overlay');
                        const body = document.body;

                        // Hiển thị menu và overlay
                        hamburgerMenu.addEventListener('click', function () {
                            mobileMenu.classList.toggle('show');
                            overlay.classList.toggle('show');
                            body.classList.toggle('no-scroll'); // Thêm hoặc xóa lớp "no-scroll"
                        });

                        // Ẩn menu và overlay khi click vào overlay
                        overlay.addEventListener('click', function () {
                            mobileMenu.classList.remove('show');
                            overlay.classList.remove('show');
                            body.classList.remove('no-scroll'); // Xóa lớp "no-scroll"
                        });
                    });
                </script>


            </div>
        </div>
    </header>


    <section class="relative bg-hero-pattern bg-cover bg-center bg-no-repeat">
        <section class="relative bg-hero-pattern bg-cover bg-center h-[500px] flex items-center">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/50 to-white"></div>
            <div class="container mx-auto z-10 text-center text-gray-800">
                <h1 class="text-5xl font-bold">Chào mừng bạn đã đến với MyKingToys</h1>
                <p class="mt-4 text-lg">Khám phá thế giới vui nhộn và trí tưởng tượng với đồ chơi độc quyền của chúng tôi!</p>
                <div class="mt-8">
                    <a href="#categories"
                        class="bg-primary text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-400 transition">Shop
                        Now</a>
                </div>
            </div>
        </section>

        <section class="py-10 bg-white">
            <div class="container mx-auto px-6 md:px-12">
                <!-- Phần trên: Thương hiệu -->
                <div
                    class="flex flex-col md:flex-row justify-between items-center text-center md:text-left space-y-6 md:space-y-0">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                            class="bi bi-truck" viewBox="0 0 16 16">
                            <path
                                d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                        </svg>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Miễn phí giao hàng</h3>
                            <p class="text-sm text-gray-500">Với đơn hàng trên 5,000,000đ</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                            class="bi bi-credit-card" viewBox="0 0 16 16">
                            <path
                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                            <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                        </svg>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Thanh toán tối ưu</h3>
                            <p class="text-sm text-gray-500">Bảo mật an toàn khi thanh toán</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                            class="bi bi-headset" viewBox="0 0 16 16">
                            <path
                                d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5" />
                        </svg>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Hỗ trợ 24/7</h3>
                            <p class="text-sm text-gray-500">Hỗ trợ tận tâm và nhiệt tình</p>
                        </div>
                    </div>
                </div>
                <!-- Phần dưới: Sản phẩm nổi bật -->
                <div class="swiper-container">
                    <!-- Slides Wrapper -->
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="https://lzd-img-global.slatic.net/g/p/f980c40c042cb40eae4d156180654f37.jpg_720x720q80.jpg"
                                alt="Category Icon">
                            <h3>Đồ chơi giáo dục</h3>
                            <a href="#">Khám phá</a>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('admin_asset/img/photos/lego.png') }}" alt="Category Icon">
                            <h3>Đồ chơi lắp ráp</h3>
                            <a href="#">Khám phá</a>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://cf.shopee.vn/file/2ed50c99df7be69c8216b313da159970" alt="Category Icon">
                            <h3>Đồ chơi mô hình</h3>
                            <a href="#">Khám phá</a>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://salt.tikicdn.com/cache/w1200/ts/product/e2/3d/3b/6691cc43a0f2a3e162475986fe44faaf.jpg"
                                alt="Category Icon">
                            <h3>Đồ chơi búp bê</h3>
                            <a href="#">Khám phá</a>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://salt.tikicdn.com/ts/product/74/1a/2d/190f4d413bcf4efd0f9c4a9d24ca395d.png"
                                alt="Category Icon">
                            <h3>Đồ chơi điện tử</h3>
                            <a href="#">Khám phá</a>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <!-- <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div> -->

                    <!-- Pagination -->
                    <!-- <div class="swiper-pagination"></div> -->
                </div>


                <!-- Swiper JS -->
                <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

                <!-- Initialize Swiper -->
                <script>
                    const swiper = new Swiper('.swiper-container', {
                        loop: true,
                        autoplay: {
                            delay: 3000, // Slide chuyển mỗi 3 giây
                            disableOnInteraction: false,
                        },
                        slidesPerView: 3,
                        spaceBetween: 20,
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                        breakpoints: {
                            640: {
                                slidesPerView: 1,
                            },
                            768: {
                                slidesPerView: 2,
                            },
                            1024: {
                                slidesPerView: 3,
                            },
                        },
                    });
                </script>
            </div>


            <section id="about-us" class="py-16 bg-white">
                <div class="container mx-auto px-6 md:px-12 lg:px-24 text-center">
                    <h2 class="text-4xl font-bold text-gray-800">About Us</h2>
                    <p class="mt-4 text-lg text-red-400 text-left">MYKINGTOYS</p><br>
                    <div class="content_about text-left">
                        Câu chuyện của MyKingToys bắt đầu từ niềm đam mê cháy bỏng với thế giới tuổi thơ vào năm 2020. Được sáng
                        lập bởi những con người trẻ đầy nhiệt huyết, MyKingToys mang trong mình sứ mệnh mang đến niềm vui và giá
                        trị thực sự cho cộng đồng qua những món đồ chơi chất lượng, an toàn nhưng vẫn phù hợp với mọi ngân
                        sách.<br><br>

                        Chúng tôi tin rằng, thế giới của trẻ thơ luôn cần được tô điểm bởi những khoảnh khắc vui vẻ, sáng tạo và
                        đầy ý nghĩa. Chính vì thế, MyKingToys không ngừng nỗ lực để sáng tạo nên những sản phẩm đồ chơi không
                        chỉ đẹp mắt mà còn giúp trẻ em phát triển toàn diện về trí tuệ, kỹ năng và cảm xúc. <br><br>

                        Mỗi món đồ chơi của MyKingToys đều được chăm chút từ ý tưởng đến chất lượng, để mỗi lần trẻ em cầm trên
                        tay là một lần niềm vui lan tỏa. Không chỉ mang lại nụ cười cho các bé, MyKingToys còn là cầu nối giúp
                        gia đình gắn kết, sẻ chia những giây phút tuyệt vời bên nhau.

                        Hãy để MyKingToys đồng hành cùng tuổi thơ của bé – nơi những ước mơ được chắp cánh và những kỷ niệm đáng
                        nhớ được khắc sâu mãi mãi!
                    </div>
                    <div class="flex flex-col md:flex-row mt-12 space-y-8 md:space-y-0 md:space-x-8">
                        <div class="bg-cyan-100 p-6 rounded-lg shadow-md flex-1">
                            <h3 class="text-2xl font-semibold text-cyan-600">Our Mission</h3>
                            <p class="mt-4 text-gray-600">Sứ mệnh của chúng tôi là cung cấp đồ chơi chất lượng cao nuôi dưỡng sự sáng tạo, học tập và niềm vui. Chúng tôi tận tâm tạo ra những sản phẩm truyền cảm hứng cho trẻ em khám phá và
                                học hỏi thông qua trò chơi.</p>
                        </div>
                        <div class="bg-cyan-100 p-6 rounded-lg shadow-md flex-1">
                            <h3 class="text-2xl font-semibold text-cyan-600">Our Values</h3>
                            <p class="mt-4 text-gray-600">Chúng tôi tin vào chất lượng, tính toàn vẹn và sự đổi mới. Các giá trị của chúng tôi hướng dẫn chúng tôi tạo ra những đồ chơi an toàn, bền vững và thú vị, mang lại giá trị cho cả cha mẹ và trẻ em.
                            </p>
                        </div>
                        <div class="bg-cyan-100 p-6 rounded-lg shadow-md flex-1">
                            <h3 class="text-2xl font-semibold text-cyan-600">Our Team</h3>
                            <p class="mt-4 text-gray-600">Chúng tôi là một nhóm các nhà thiết kế, kỹ sư và nhà giáo dục đầy nhiệt huyết, những người cam kết tạo ra những món đồ chơi tốt nhất cho trẻ em. Chúng tôi làm việc chăm chỉ mỗi ngày để đưa những ý tưởng mới vào cuộc sống.</p>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
    <footer class=" body-font bg-gradient-to-r from-cyan-500 to-blue-200 text-white">
        <div class="max-w-screen-xl px-4 py-16 mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <div>
                    <img src="{{ asset('admin_asset/img/photos/blocks.png') }}" class="h-20 w-20" alt="logo" />
                    <p class="max-w-xs mt-4 text-sm  text-white">
                        Mọi chi tiết xin liên hệ
                    </p>
                    <div class="flex mt-8 space-x-6  text-white">
                        <a class="hover:opacity-75" href target="_blank" rel="noreferrer">
                            <span class="sr-only"> Facebook </span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fillRule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clipRule="evenodd" />
                            </svg>
                        </a>
                        <a class="hover:opacity-75" href target="_blank" rel="noreferrer">
                            <span class="sr-only"> Instagram </span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fillRule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clipRule="evenodd" />
                            </svg>
                        </a>
                        <a class="hover:opacity-75" href target="_blank" rel="noreferrer">
                            <span class="sr-only"> Twitter </span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a class="hover:opacity-75" href target="_blank" rel="noreferrer">
                            <span class="sr-only"> GitHub </span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fillRule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    clipRule="evenodd" />
                            </svg>
                        </a>
                        <a class="hover:opacity-75" href target="_blank" rel="noreferrer">
                            <span class="sr-only"> Dribbble </span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fillRule="evenodd"
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                                    clipRule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-8 lg:col-span-2 sm:grid-cols-2 lg:grid-cols-4 text-white">
                    <div>
                        <p class="font-medium">
                            Company
                        </p>
                        <nav class="flex flex-col mt-4 space-y-2 text-sm  text-white">
                            <a class="hover:opacity-75" href> About </a>
                            <a class="hover:opacity-75" href> Meet the Team </a>
                            <a class="hover:opacity-75" href> History </a>
                            <a class="hover:opacity-75" href> Careers </a>
                        </nav>
                    </div>
                    <div>
                        <p class="font-medium">
                            Services
                        </p>
                        <nav class="flex flex-col mt-4 space-y-2 text-sm  text-white">
                            <a class="hover:opacity-75" href> 1on1 Coaching </a>
                            <a class="hover:opacity-75" href> Company Review </a>
                            <a class="hover:opacity-75" href> Accounts Review </a>
                            <a class="hover:opacity-75" href> HR Consulting </a>
                            <a class="hover:opacity-75" href> SEO Optimisation </a>
                        </nav>
                    </div>
                    <div>
                        <p class="font-medium">
                            Helpful Links
                        </p>
                        <nav class="flex flex-col mt-4 space-y-2 text-sm  text-white">
                            <a class="hover:opacity-75" href> Contact </a>
                            <a class="hover:opacity-75" href> FAQs </a>
                            <a class="hover:opacity-75" href> Live Chat </a>
                        </nav>
                    </div>
                    <div>
                        <p class="font-medium">
                            Legal
                        </p>
                        <nav class="flex flex-col mt-4 space-y-2 text-sm  text-white">
                            <a class="hover:opacity-75" href> Privacy Policy </a>
                            <a class="hover:opacity-75" href> Terms &amp; Conditions </a>
                            <a class="hover:opacity-75" href> Returns Policy </a>
                            <a class="hover:opacity-75" href> Accessibility </a>
                        </nav>
                    </div>
                </div>
            </div>
            <p class="mt-8 text-xs  text-white">
                © 2022 Comany Name
            </p>
        </div>
    </footer>
</body>

</html>
