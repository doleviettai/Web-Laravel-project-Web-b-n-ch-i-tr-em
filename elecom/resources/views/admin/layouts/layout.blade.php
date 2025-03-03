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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

    <title>@yield('admin_page_title')</title>

    <link rel="icon" href="{{ asset('admin_asset/img/photos/blocks.png') }}" type="image/png">
    <!-- Link to tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script> --}}
    <link href="{{ asset('admin_asset/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> {{-- ajax --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.min.css" rel="stylesheet" /> --}}
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar bg-blue-500">
            <div class="sidebar-content js-simplebar bg-info bg-gradient bg-opacity-75">
                <a class="sidebar-brand" href="#">
                    <img src="{{ asset('admin_asset/img/photos/blocks.png') }}" alt=""
                        style="width:45px;height:45px;object-fit:cover;">
                    <span class="align-middle">MyKingToys</span>
                    {{-- <p>Admin</p> --}}
                </a>

                <ul class="sidebar-nav ">
                    <li class="sidebar-header">
                        Main
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('admin') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Chuyên mục
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('category.create') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('category.create') }}">
                            <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Tạo</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('category.manage') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('category.manage') }}">
                            <i class="align-middle" data-feather="list"></i> <span class="align-middle">Danh sách</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Chuyên mục nhỏ
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('subcategory.create') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('subcategory.create') }}">
                            <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Tạo</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('subcategory.manage') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('subcategory.manage') }}">
                            <i class="align-middle" data-feather="list"></i> <span class="align-middle">Danh sách</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Dữ liệu sản phẩm
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('productattribute.create') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('productattribute.create') }}">
                            <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Tạo</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('productattribute.manage') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('productattribute.manage') }}">
                            <i class="align-middle" data-feather="list"></i> <span class="align-middle">Danh sách</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Sản phẩm
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('product.manage') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('product.manage') }}">
                            <i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Danh
                                sách sản phẩm</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('product.review.manage') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('product.review.manage') }}">
                            <i class="align-middle" data-feather="star"></i> <span class="align-middle">Bán sản
                                phẩm</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Quản lý người dùng
                    </li>


                    <li class="sidebar-item {{ request()->routeIs('vendor.manage') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('vendor.manage') }}">
                            <i class="align-middle bg-transparent" data-feather="users"></i> <span class="align-middle">Quản lý Nhân
                                viên</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('client.manage') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('client.manage') }}">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Quản lý khách
                                hàng</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Lịch sử
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.cart.history') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('admin.cart.history') }}">
                            <i class="align-middle" data-feather="shopping-cart"></i> <span
                                class="align-middle">Ship</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.order.history') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('admin.order.history') }}">
                            <i class="align-middle" data-feather="list"></i> <span class="align-middle">Đơn hàng</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                        <a class="sidebar-link bg-transparent" href="{{ route('admin.settings') }}">
                            <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Profile</span>
                        </a>
                    </li>
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
                                                <img src="{{asset('admin_asset/img/photos/unicornHG.jpg')}}"
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
                                                <img src="{{asset('admin_asset/img/photos/unsplash-2.jpg')}}"
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
                                                <img src="{{asset('admin_asset/img/photos/xe_cuu_hoa.jpg')}}"
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
                                                <img src="{{asset('admin_asset/img/photos/unicornHG.jpg')}}"
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
                                <img src="{{asset('admin_asset/img/photos/'.Auth::user()->img_user)}}" class="avatar img-fluid rounded me-1" alt="Tài đẹp trai" /> <span class="text-dark">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{route('admin.settings')}}"><i class="align-middle me-1"
                                        data-feather="user"></i> Profile</a>
                                {{-- <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                        data-feather="pie-chart"></i> Analytics</a> --}}
                                <div class="dropdown-divider"></div>
                                {{-- <a class="dropdown-item" href="index.html"><i class="align-middle me-1"
                                        data-feather="settings"></i> Settings & Privacy</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                        data-feather="help-circle"></i> Help Center</a>
                                <div class="dropdown-divider"></div> --}}
                                {{-- <a class="dropdown-item" href="#">Log out</a> --}}
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

                    @yield('admin_layout')

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
    <!-- MDB -->
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.umd.min.js"></script> --}}

</body>

</html>
