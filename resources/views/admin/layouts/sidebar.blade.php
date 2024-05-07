 <!-- ========== App Menu ========== -->
 <div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('home.page') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('admin_asset/images/logos/webmart-dark.svg')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin_asset/images/logos/webmart-dark.svg')}}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('home.page') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('admin_asset/images/logos/webmart-light.svg')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin_asset/images/logos/webmart-light.svg')}}" alt="" height="50">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.dashboard') }}"  role="button" aria-expanded="false">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboards</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-team-fill"></i> <span data-key="t-apps">Users</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.user.index') }}" class="nav-link" data-key="t-calendar"> Admins</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.customer.index') }}" class="nav-link" data-key="t-chat">Customer</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.pages.index') }}"  role="button" aria-expanded="false">
                        <i class="ri-pages-line"></i> <span>Pages</span>
                    </a>
                </li><li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.banners.index') }}"  role="button" aria-expanded="false">
                        <i class="ri-flag-2-fill"></i><span>Banner</span>
                    </a>
                </li>


               <!-- end Dashboard Menu -->
               <li class="menu-title"><i class="ri-more-fill"></i> <span >Order Management</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.orders.index') }}"  role="button" aria-expanded="false">
                        <i class="ri-shopping-bag-fill"></i> <span>Orders</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span >Product Management</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.products.index') }}"  role="button" aria-expanded="false">
                        <i class="ri-product-hunt-fill"></i> <span>Products</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.productRatings.get') }}"  role="button" aria-expanded="false">
                        <i class="ri-star-fill"></i> <span>Product Rating</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.categories.index') }}"  role="button" aria-expanded="false">
                        <i class="ri-file-list-line"></i> <span>Category</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.subcategories.index') }}"  role="button" aria-expanded="false">
                        <i class="ri-file-list-fill"></i> <span>Sub Category</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.brands.index') }}"  role="button" aria-expanded="false">
                        <i class="ri-flag-line"></i><span>Brands</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.shipping.index') }}"  role="button" aria-expanded="false">
                        <i class="ri-truck-line"></i><span>Shipping</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.coupon.index') }}"  role="button" aria-expanded="false">
                        <i class="ri-coupon-3-line"></i><span>Coupon</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
