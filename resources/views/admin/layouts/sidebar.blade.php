 <!-- ========== App Menu ========== -->
 <div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('admin_asset/images/logo-sm.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin_asset/images/logo-dark.png')}}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('admin_asset/images/logo-sm.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin_asset/images/logo-light.png')}}" alt="" height="17">
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
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="dashboard-analytics.html" class="nav-link" data-key="t-analytics"> Analytics </a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crm.html" class="nav-link" data-key="t-crm"> CRM </a>

                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span data-key="t-apps">Apps</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="apps-calendar.html" class="nav-link" data-key="t-calendar"> Calendar </a>
                            </li>
                            <li class="nav-item">
                                <a href="apps-chat.html" class="nav-link" data-key="t-chat"> Chat </a>
                            </li>

                        </ul>
                    </div>
                </li>

               <!-- end Dashboard Menu -->

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Pages</span></li>



                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.products.index') }}"  role="button" aria-expanded="false">
                        <i class="ri-product-hunt-fill"></i> <span>Products</span>
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
                    <a class="nav-link menu-link" href="#sidebarPages" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPages">
                        <i class="ri-pages-line"></i> <span data-key="t-pages">Pages</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPages">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="pages-starter.html" class="nav-link" data-key="t-starter"> Starter </a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarProfile" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProfile" data-key="t-profile"> Profile
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarProfile">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="pages-profile.html" class="nav-link" data-key="t-simple-page">
                                                Simple Page </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages-profile-settings.html" class="nav-link" data-key="t-settings"> Settings </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="pages-team.html" class="nav-link" data-key="t-team"> Team </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-timeline.html" class="nav-link" data-key="t-timeline"> Timeline </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-faqs.html" class="nav-link" data-key="t-faqs"> FAQs </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-pricing.html" class="nav-link" data-key="t-pricing"> Pricing </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-gallery.html" class="nav-link" data-key="t-gallery"> Gallery </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-maintenance.html" class="nav-link" data-key="t-maintenance"> Maintenance
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-coming-soon.html" class="nav-link" data-key="t-coming-soon"> Coming Soon
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-sitemap.html" class="nav-link" data-key="t-sitemap"> Sitemap </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-search-results.html" class="nav-link" data-key="t-search-results"> Search Results </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-privacy-policy.html" class="nav-link"><span data-key="t-privacy-policy">Privacy Policy</span> <span class="badge badge-pill bg-success" data-key="t-new">New</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-term-conditions.html" class="nav-link"><span data-key="t-term-conditions">Term & Conditions</span> <span class="badge badge-pill bg-success" data-key="t-new">New</span></a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLanding" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                        <i class="ri-rocket-line"></i> <span data-key="t-landing">Landing</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLanding">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="landing.html" class="nav-link" data-key="t-one-page"> One Page </a>
                            </li>
                            <li class="nav-item">
                                <a href="nft-landing.html" class="nav-link" data-key="t-nft-landing"> NFT Landing </a>
                            </li>
                            <li class="nav-item">
                                <a href="job-landing.html" class="nav-link"><span data-key="t-job">Job</span> <span class="badge badge-pill bg-success" data-key="t-new">New</span></a>
                            </li>
                        </ul>
                    </div>
                </li>




            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->







 {{-- <!-- MENU SIDEBAR-->
 <aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="images/icon/logo.png" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="@yield('category_select')">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="@yield('category_select')">
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="fas fa-regular fa-list"></i>Category</a>
                </li>
                <li class="@yield('category_select')">
                    <a href="{{ route('admin.subcategories.index') }}">
                        <i class="fas fa-regular fa-list"></i>Sub Category</a>
                </li>
                <li class="@yield('category_select')">
                    <a href="{{ route('admin.products.index') }}">
                        <i class="fa fa-product-hunt"></i>Product</a>
                </li>
                <li class="@yield('category_select')">
                    <a href="{{ route('admin.brands.index') }}">
                        <i class="fa fa-product-hunt"></i>Brands</a>
                </li>
                <li class="@yield('category_select')">
                    <a href="{{ route('admin.coupons.index') }}">
                        <i class="fas fa-solid fa-tag"></i>Coupon</a>
                </li>
                <li class="@yield('category_select')">
                    <a href="{{ route('admin.sizes.index') }}">
                        <i class="fas fa-solid fa-tag"></i>Size</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR--> --}}
