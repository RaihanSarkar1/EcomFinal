<div class="sidebar-menu toggle-others fixed">

    <div class="sidebar-menu-inner">

        <header class="logo-env">

            <!-- logo -->
            <div class="logo">
                <a href="dashboard-1.html" class="logo-expanded">
                    <img src="{{ asset('backend/images/logo@2x.png') }}" width="80" alt="" />
                </a>

                <a href="dashboard-1.html" class="logo-collapsed">
                    <img src="{{ asset('backend/images/logo-collapsed@2x.png') }}" width="40" alt="" />
                </a>
            </div>

            <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
            <div class="mobile-menu-toggle visible-xs">
                <a href="#" data-toggle="user-info-menu">
                    <i class="fa-bell-o"></i>
                    <span class="badge badge-success">7</span>
                </a>

                <a href="#" data-toggle="mobile-menu">
                    <i class="fa-bars"></i>
                </a>
            </div>

            <!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
            <div class="settings-icon">
                <a href="#" data-toggle="settings-pane" data-animate="true">
                    <i class="linecons-cog"></i>
                </a>
            </div>


        </header>



        <ul id="main-menu" class="main-menu">
            <!-- add class "multiple-expanded" to allow multiple submenus to open -->
            <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
            <li class="active opened active">
                <a href="dashboard-1.html">
                    <i class="linecons-cog"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            @if (Auth::check() && Auth::user()->isAdmin())
                <!-- Show admin options here -->
                <li class="active opened active">
                    <a href="#">
                        <i class="linecons-user"></i>
                        <span class="title">Users</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ url('add_user') }}">
                                <span class="title">Add User</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('users') }}">
                                <span class="title">Manage Users</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="active opened active">
                    <a href="#">
                        <i class="linecons-shop"></i>
                        <span class="title">Products</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ url('add_product') }}">
                                <span class="title">Add Product</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('view_products') }}">
                                <span class="title">Manage Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('manage_categories') }}">
                                <span class="title">Manage Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('customer_view_product') }}">
                                <span class="title">View Products</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="active opened active">
                    <a href="#">
                        <i class="linecons-truck"></i>
                        <span class="title">Orders</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ url('manage_orders') }}">
                                <span class="title">Manage Orders</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('cart') }}">
                                <span class="title">View Cart</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('my_orders') }}">
                                <span class="title">My Orders</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @else
                <!-- Show non-admin options here -->
                <li class="active opened active">
                    <a href="#">
                        <i class="linecons-shop"></i>
                        <span class="title">Products</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ url('customer_view_product') }}">
                                <span class="title">View Products</span>
                            </a>
                        </li>
                    </ul>

                    <li class="active opened active">
                    <a href="#">
                        <i class="linecons-truck"></i>
                        <span class="title">Orders</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ url('cart') }}">
                                <span class="title">View Cart</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('my_orders') }}">
                                <span class="title">My Orders</span>
                            </a>
                        </li>
                    </ul>
                </li>
                </li>
            @endif
        </ul>

    </div>

</div>
