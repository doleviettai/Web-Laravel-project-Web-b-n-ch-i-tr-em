<!DOCTYPE html>
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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

    <title>@yield('seller_page_title')</title>
    <link rel="icon" href="{{asset('admin_asset/img/photos/blocks.png')}}" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Link to Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> {{-- ajax --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link href="{{ asset('admin_asset/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar bg-blue-500">
            <div class="sidebar-content js-simplebar bg-success bg-gradient bg-opacity-50">
                <a class="sidebar-brand" href="#">
                    <center>
                    <img src="{{ asset('admin_asset/img/photos/blocks.png') }}" alt=""
                        style="width:45px;height:45px;object-fit:cover;">
                    <p class="align-middle">MyKingToys</p>
                        <div class="align-middle mt-3 bg-warning rounded-pill p-1 bg-opacity-50">
                            <p class="mb-1">Nhân viên</p>
                            <span class="mt-2">{{ Auth::user()->name }}</span>
                            {{-- <span>{{Auth::user()->id}}</span> --}}
                        </div>
                    </center>
                </a>

                <ul class="sidebar-nav bg-transparent">
                    <li class="sidebar-header">
                        Main
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('vendor') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('vendor') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('vendor.order.history') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('vendor.order.history') }}">
                            <i class="align-middle" data-feather="user"></i> <span
                                class="align-middle">Profile của tôi</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Sản phẩm
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('vendor.product.manage') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('vendor.product.manage') }}">
                            <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Xem các sản phẩm</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('vendor.product.manage_review') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('vendor.product.manage_review') }}">
                            <i class="align-middle" data-feather="list"></i> <span class="align-middle">Bán sản phẩm</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Đơn hàng
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('vendor.store.ship') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('vendor.store.ship') }}">
                            <i class="fa-solid fa-truck"></i> <span class="align-middle">Ship</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('vendor.store.manage') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('vendor.store.manage') }}">
                            <i class="fa-solid fa-clipboard-list"></i> <span class="align-middle">Danh sách đơn hàng</span>
                        </a>
                    </li>

                    {{--
                    <li class="sidebar-header">
                        History
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.cart.history') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.cart.history') }}">
                            <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Cart</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.order.history') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.order.history') }}">
                            <i class="align-middle" data-feather="list"></i> <span class="align-middle">Order</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.settings') }}">
                            <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Setting</span>
                        </a>
                    </li> --}}

                    {{-- <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-profile.html">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-sign-in.html">
                            <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Sign In</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-sign-up.html">
                            <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Sign
                                Up</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-blank.html">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>
                        </a>
                    </li> --}}
                </ul>
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
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                <img src="{{ asset('admin_asset/img/photos/'.Auth::user()->img_user) }}" class="avatar img-fluid rounded me-1"
                                    alt="Charles Hall" /> <span class="text-dark">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{route('vendor.order.history')}}"><i class="align-middle me-1"
                                        data-feather="user"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <center>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <input type="submit" value="Logout" class="text-center btn btn-outline-warning">
                                    </form>
                                </center>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    @yield('seller_layout')

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('admin_asset/js/app.js') }}"></script>

</body>

</html>
