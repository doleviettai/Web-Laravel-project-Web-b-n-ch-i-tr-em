{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

    <title>@yield('customer_page_title')</title>

    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin_asset/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar bg-blue-500">
            <div class="sidebar-content js-simplebar ">
                <a class="sidebar-brand" href="index.html">
                    <span class="align-middle">Customer</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Main
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('dashboard') }}">
                            <i class="align-middle" data-feather="home"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('customer.history') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('customer.history') }}">
                            <i class="align-middle" data-feather="clipboard"></i> <span
                                class="align-middle">Order History</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('customer.payment') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('customer.payment') }}">
                            <i class="align-middle" data-feather="credit-card"></i> <span
                                class="align-middle">Payment</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('customer.affilate') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('customer.affilate') }}">
                            <i class="align-middle" data-feather="users"></i> <span
                                class="align-middle">Affiliate</span>
                        </a>
                    </li>


                </ul>

                <div class="sidebar-cta">
                    <div class="sidebar-cta-content">
                        <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
                        <div class="mb-3 text-sm">
                            Are you looking for more components? Check out our premium version.
                        </div>
                        <div class="d-grid">
                            <a href="upgrade-to-pro.html" class="btn btn-primary">Upgrade to Pro</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown"
                                data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                                aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">
                                    4 New Notifications
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Update completed</div>
                                                <div class="text-muted small mt-1">Restart server 12 to complete the
                                                    update.</div>
                                                <div class="text-muted small mt-1">30m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-warning" data-feather="bell"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Lorem ipsum</div>
                                                <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate
                                                    hendrerit et.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-primary" data-feather="home"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Login from 192.186.1.8</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-success" data-feather="user-plus"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">New connection</div>
                                                <div class="text-muted small mt-1">Christina accepted your request.
                                                </div>
                                                <div class="text-muted small mt-1">14h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all notifications</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown"
                                data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="message-square"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                                aria-labelledby="messagesDropdown">
                                <div class="dropdown-menu-header">
                                    <div class="position-relative">
                                        4 New Messages
                                    </div>
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-5.jpg"
                                                    class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Vanessa Tucker</div>
                                                <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis
                                                    arcu tortor.</div>
                                                <div class="text-muted small mt-1">15m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-2.jpg"
                                                    class="avatar img-fluid rounded-circle" alt="William Harris">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">William Harris</div>
                                                <div class="text-muted small mt-1">Curabitur ligula sapien euismod
                                                    vitae.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-4.jpg"
                                                    class="avatar img-fluid rounded-circle" alt="Christina Mason">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Christina Mason</div>
                                                <div class="text-muted small mt-1">Pellentesque auctor neque nec urna.
                                                </div>
                                                <div class="text-muted small mt-1">4h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-3.jpg"
                                                    class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Sharon Lessman</div>
                                                <div class="text-muted small mt-1">Aenean tellus metus, bibendum sed,
                                                    posuere ac, mattis non.</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all messages</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1"
                                    alt="Charles Hall" /> <span class="text-dark">Charles Hall</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1"
                                        data-feather="user"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                        data-feather="pie-chart"></i> Analytics</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.html"><i class="align-middle me-1"
                                        data-feather="settings"></i> Settings & Privacy</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                        data-feather="help-circle"></i> Help Center</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    @yield('customer_layout')

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="https://adminkit.io/"
                                    target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted"
                                    href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin
                                        Template</strong></a> &copy;
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('admin_asset/js/app.js') }}"></script>

</body>

</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    {{-- <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script> --}}
    <link href="{{ asset('admin_asset/css/app.css') }}" rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> {{-- ajax --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                    zIndex: {
                        '9999': '9999',
                    }
                },
            },
        }
    </script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <title>@yield('customer_title')</title>
    <link rel="icon" href="{{ asset('admin_asset/img/photos/blocks.png') }}" type="image/png">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script type="text/javascript">
        (function() {
            emailjs.init({
                publicKey: "ezxagVzcmS0NQ4CZl",
            });
        })();
    </script>

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

    .userMenuDropdown {
        z-index: 90;
    }



    /* ------btn login------ */
    /* From Uiverse.io by adamgiebl */
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
        color: #725AC1;
        background: transparent;
        cursor: pointer;
        transition: ease-out 0.5s;
        border: 2px solid #725AC1;
        border-radius: 10px;
        box-shadow: inset 0 0 0 0 #725AC1;
    }

    .h_login:hover {
        color: white;
        box-shadow: inset 0 -100px 0 0 #725AC1;
    }

    .h_login:active {
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

    <!-- CSS cho màn hình iPad từ 780px đến 1280px -->
    <style>
        @media (min-width: 780px) and (max-width: 1280px) {

            /* Hiển thị menu điều hướng và nút user cho màn hình iPad */
            .md\\:hidden {
                display: none !important;
            }

            /* Menu user */
            .relative.md\\:block {
                display: block !important;
            }

            /* Tăng kích thước menu để dễ dàng nhấn trên iPad */
            .text-base {
                font-size: 1rem;
            }
        }

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
            }, 250); // Để 1s rồi mới ẩn
        });
    </script>

    <header class="h_header bg-gradient-to-r from-blue-300 via-white to-blue-300 text-gray-800 shadow-md">
        <div class="container mx-auto flex p-5 items-center justify-between">
            <!-- Logo -->
            <a class="flex items-center hover:no-underline" href="{{ route('customer.dashboard') }}">
                <img class="h_logo h-16 w-16 rounded-lg cursor-pointer"
                    src="{{ asset('admin_asset/img/photos/blocks.png') }}" alt="Logo">
                <span class="h_text ml-3 text-2xl font-bold">MyKingToys</span>
            </a>

            <!-- Menu điều hướng cho màn hình lớn -->
            <nav class="hidden lg:flex md:items-center md:space-x-8 text-base text-gray-700 font-medium">
                <a href="{{ route('customer.dashboard') }}"
                    class="hover:text-white hover:bg-blue-300 hover:no-underline px-2 py-1 rounded-lg transition duration-300 ease-in-out">
                    Dashboard
                </a>
                <a href="{{ route('customer.introduce') }}"
                    class="hover:text-white hover:bg-blue-300 hover:no-underline px-2 py-1 rounded-lg transition duration-300 ease-in-out">
                    Giới thiệu
                </a>
                <a href="{{ route('customer.product') }}"
                    class="hover:text-white hover:bg-blue-300 hover:no-underline px-2 py-1 rounded-lg transition duration-300 ease-in-out">
                    Sản phẩm
                </a>
                <a href="{{ route('customer.contact') }}"
                    class="hover:text-white hover:bg-blue-300 hover:no-underline px-2 py-1 rounded-lg transition duration-300 ease-in-out">
                    Liên hệ
                </a>
            </nav>



            <!-- Nút user với menu thả xuống cho màn hình lớn -->
            <div class="relative hidden lg:flex items-center space-x-4">
                <!-- Icon giỏ hàng -->
                <div class="relative group">
                    <!-- Nút giỏ hàng -->
                    <a class="cart-icon relative cursor-pointer border-2 border-black rounded-md p-2 transition duration-300 transform hover:scale-105"
                        href="{{ route('customer.cart') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-handbag text-gray-700" viewBox="0 0 16 16">
                            <path
                                d="M8 1a2 2 0 0 1 2 2v2H6V3a2 2 0 0 1 2-2m3 4V3a3 3 0 1 0-6 0v2H3.36a1.5 1.5 0 0 0-1.483 1.277L.85 13.13A2.5 2.5 0 0 0 3.322 16h9.355a2.5 2.5 0 0 0 2.473-2.87l-1.028-6.853A1.5 1.5 0 0 0 12.64 5zm-1 1v1.5a.5.5 0 0 0 1 0V6h1.639a.5.5 0 0 1 .494.426l1.028 6.851A1.5 1.5 0 0 1 12.678 15H3.322a1.5 1.5 0 0 1-1.483-1.723l1.028-6.851A.5.5 0 0 1 3.36 6H5v1.5a.5.5 0 1 0 1 0V6z" />
                        </svg>
                        <!-- Số lượng sản phẩm -->
                        <span id="cart-count"
                            class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center transition-transform duration-300 transform hover:-translate-y-2">
                            0
                        </span>
                    </a>

                    <!-- Danh sách sản phẩm -->
                    <div id="cart-items"
                        class="absolute right-0 mt-2 w-96 bg-white border border-gray-200 shadow-lg rounded-lg hidden group-hover:block z-50">
                        <div class="p-4 text-sm text-gray-600">
                            <ul class="divide-y divide-gray-200">
                            </ul>
                        </div>
                    </div>

                </div>



                <!-- Nút user -->
                <button id="user-button"
                    class="flex items-center space-x-2 text-black hover:text-white focus:outline-none h_login">
                    <!-- Thêm hover:text-white cho span để áp dụng màu trắng khi hover vào chữ -->
                    <span class="hover:text-white transition duration-300">
                        <i class="fa-solid hover:text-white fa-user" style="width: 16px; height: 16px;"></i>
                        {{ Auth::user()->name }}
                    </span>
                    <img src="{{ asset('admin_asset/img/photos/' . (Auth::user()->img_user ?? 'blocks.png')) }}"
                        class="avatar img-fluid border-white rounded-sm h-8 w-8" alt="Charles Hall">
                </button>


                <!-- Menu thả xuống khi click -->
                <div id="dropdown-menu"
                    class="hidden absolute right-0 mt-2 w-48 bg-slate-500 rounded-md text-white shadow-lg z-[9999]">
                    <a href="{{ route('customer.profile') }}"
                        class="block px-4 py-2 text-white transition duration-300 hover:bg-gray-700 rounded-md no-underline hover:no-underline">Profile</a>
                    {{-- <a href="{{ route('customer.cart') }}"
                        class="block px-4 py-2 text-white transition duration-300 hover:bg-gray-700 rounded-md no-underline hover:no-underline">Xem
                        giỏ hàng</a> --}}
                    <form action="{{ route('logout') }}" method="post"
                        class="transition duration-300 hover:bg-gray-700 rounded-md">
                        @csrf
                        <input type="submit" value="Logout"
                            class="block px-4 py-2 text-white no-underline hover:no-underline">
                    </form>
                </div>
            </div>


            <!-- Nút menu hamburger cho màn hình nhỏ và iPad -->
            <div class="lg:hidden">
                <button id="mobile-menu-button" class="text-white focus:outline-none">
                    <i class="fas fa-bars" style="width: 24px; height: 24px;"></i>
                </button>
            </div>
        </div>

        <!-- Menu di động cho màn hình nhỏ và iPad -->
        <div id="mobile-menu" class="hidden lg:hidden bg-hero-overlay text-black">
            <a href="{{ route('customer.dashboard') }}"
                class="block px-4 py-2 no-underline hover:no-underline hover:bg-gray-700">DashBoard</a>
            <a href="{{ route('customer.introduce') }}"
                class="block px-4 py-2 no-underline hover:no-underline hover:bg-gray-700">Giới thiệu</a>
            <a href="{{ route('customer.product') }}"
                class="block px-4 py-2 no-underline hover:no-underline hover:bg-gray-700">Sản phẩm</a>
            <a href="{{ route('customer.contact') }}"
                class="block px-4 py-2 no-underline hover:no-underline hover:bg-gray-700">Liên hệ</a>
            <!-- Nút user trong menu di động -->
            <div class="border-t border-gray-200 mt-2">
                <a href="{{ route('customer.profile') }}"
                    class="block px-4 py-2 no-underline hover:no-underline hover:bg-gray-700">Profile</a>
                <a href="{{ route('customer.cart') }}"
                    class="block px-4 py-2 no-underline hover:no-underline hover:bg-gray-700">Xem giỏ hàng</a>
                <form action="{{ route('logout') }}" method="post" class="hover:bg-gray-700 rounded-md">
                    @csrf
                    <input type="submit" value="Logout"
                        class="block px-4 py-2 text-black no-underline hover:no-underline">
                </form>
            </div>
        </div>
    </header>

    <!-- JavaScript -->
    <script>
        // Hiện/ẩn menu user khi click trên màn hình lớn
        const userButton = document.getElementById("user-button");
        const dropdownMenu = document.getElementById("dropdown-menu");

        userButton.addEventListener("click", () => {
            dropdownMenu.classList.toggle("hidden");
        });

        // Ẩn menu khi click ra ngoài
        document.addEventListener("click", (event) => {
            const isClickInsideUserButton = userButton.contains(event.target);
            const isClickInsideDropdownMenu = dropdownMenu.contains(event.target);

            if (!isClickInsideUserButton && !isClickInsideDropdownMenu) {
                dropdownMenu.classList.add("hidden");
            }
        });

        // Hiện/ẩn menu di động khi nhấn vào nút hamburger
        const mobileMenuButton = document.getElementById("mobile-menu-button");
        const mobileMenu = document.getElementById("mobile-menu");

        mobileMenuButton.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });
    </script>


    {{-- @if (Route::has('login'))
            @auth
                <a href="{{ route('admin' , 'vendor' , 'customer') }}"
                    class="hover:text-gray-900 inline-flex items-center bg-blue-500 border-0 py-2 px-5 focus:outline-none rounded text-base text-white mt-4 hover:bg-opacity-80">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="hover:text-gray-900 inline-flex items-center bg-blue-500 border-0 py-2 px-5 focus:outline-none rounded text-base text-white mt-4 hover:bg-opacity-80">
                    Log in
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="hover:text-gray-900 inline-flex items-center bg-blue-500 border-0 py-2 px-5 focus:outline-none rounded text-base text-white mt-4 hover:bg-opacity-80">
                        Register
                    </a>
                @endif
            @endauth
    @endif --}}

    {{-- bg-hero-pattern --}}
    <section class="relative bg-cover bg-center bg-no-repeat m-3">
        @yield('customer_layout')
    </section>


    @yield('customer_footer')

    <script src="{{ asset('admin_asset/js/app.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let userId = {{ Auth::user()->id ?? 'null' }};
            if (userId) {
                $.ajax({
                    url: "{{ route('customer.count.procart', '') }}/" + userId,
                    method: "GET",
                    success: function(response) {
                        // Cập nhật số lượng sản phẩm
                        $('#cart-count').text(response.cart_pro_count);

                        // Cập nhật danh sách sản phẩm
                        let cartItems = response.cart_pro;
                        let cartListHtml = '';
                        cartItems.forEach(function(item) {
                            cartListHtml +=
                                `
        <li class="flex items-center justify-between p-2 border-b border-gray-200 hover:bg-gray-50 transition">
            <!-- Hình ảnh sản phẩm -->
            <div class="flex items-center space-x-4">
                <img src="{{ asset('admin_asset/img/photos/') }}/${item.product.product_img}" alt="${item.product.product_name}"
                     class="w-12 h-12 rounded-md object-cover">
                <!-- Thông tin sản phẩm -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-700">${item.product.product_name}</h4>
                    <p class="text-xs text-gray-500">Số lượng: ${item.cart_quantity}</p>
                </div>
            </div>
            <!-- Giá sản phẩm -->
            <span class="text-sm font-bold text-green-600">${item.cart_price.toLocaleString()}₫</span>
        </li>
                        `;
                        });

                        $('#cart-items ul').html(cartListHtml);
                    },
                    error: function() {
                        console.error('Không thể lấy thông tin giỏ hàng.');
                    }
                });
            }
        });
    </script>



</body>

</html>
