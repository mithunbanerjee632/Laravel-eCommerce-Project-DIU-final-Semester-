<div id="app">
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>


        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{url('/admin/dashboard')}}">M-Vendor Store</a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">

                        <li class="sidebar-item active ">
                            <a href="{{url('/admin/dashboard')}}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="{{ url('/products') }}" class='sidebar-link'>
                                <i class="bi bi-shop"></i>
                                <span>Products</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="{{ url('/category') }}" class='sidebar-link'>
                                <i class="bi bi-view-list"></i>
                                <span>Category</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="{{ url('/brand') }}" class='sidebar-link'>
                                <i class="bi bi-view-list"></i>
                                <span>Brand</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="{{url('/orders')/*route('admin.orders')*/}}" class='sidebar-link'>
                                <i class="bi bi-clipboard-data"></i>
                                <span>Orders</span>
                            </a>
                        </li>



                        <li class="sidebar-item  ">
                            <a href="" class='sidebar-link'>
                                <i class="bi bi-person"></i>
                                <span>Customers</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="" class='sidebar-link'>
                                <i class="bi bi-gear"></i>
                                <span>Settings</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="{{url('/admin/logout')}}" class='sidebar-link'>
                                <i class="bi bi-box-arrow-left"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
