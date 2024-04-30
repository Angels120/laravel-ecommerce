<script defer src="{{ asset('admin_asset/js/notification.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


<header id="page-topbar">
    <div class="d-none" id="toast-box">
        <div class="mainText d-flex align-items-center px-3">
            <i class="las la-bell fs-24 me-2"></i>
            <span id="toastContent" class="me-2"></span>
            <span id="closeToast" onclick="closeIt()" class="fs-19 text-strong cursor-pointer">x</span>
        </div>
    </div>

    <div class="d-none" id="toast-error-box">
        <div class="mainErrorText d-flex align-items-center px-3">
            <i class="las la-bell fs-24 me-2"></i>
            <span id="toastErrorContent" class="me-2"></span>
            <span id="closeErrorToast" onclick="closeThis()" class="fs-19 text-strong cursor-pointer">x</span>
        </div>
    </div>
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-md-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search..." autocomplete="off"
                            id="search-options" value="">
                        <span class="mdi mdi-magnify search-widget-icon"></span>
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                            id="search-close-options"></span>
                    </div>
                    <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                        <div data-simplebar style="max-height: 320px;">
                            <!-- item-->
                            <div class="dropdown-header">
                                <h6 class="text-overflow text-muted mb-0 text-uppercase">Recent Searches</h6>
                            </div>

                            <div class="dropdown-item bg-transparent text-wrap">
                                <a href="index.html" class="btn btn-soft-secondary btn-sm rounded-pill">how to setup <i
                                        class="mdi mdi-magnify ms-1"></i></a>
                                <a href="index.html" class="btn btn-soft-secondary btn-sm rounded-pill">buttons <i
                                        class="mdi mdi-magnify ms-1"></i></a>
                            </div>
                            <!-- item-->
                            <div class="dropdown-header mt-2">
                                <h6 class="text-overflow text-muted mb-1 text-uppercase">Pages</h6>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-bubble-chart-line align-middle fs-18 text-muted me-2"></i>
                                <span>Analytics Dashboard</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-lifebuoy-line align-middle fs-18 text-muted me-2"></i>
                                <span>Help Center</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                                <span>My account settings</span>
                            </a>

                            <!-- item-->
                            <div class="dropdown-header mt-2">
                                <h6 class="text-overflow text-muted mb-2 text-uppercase">Members</h6>
                            </div>
                        </div>

                        <div class="text-center pt-3 pb-1">
                            <a href="pages-search-results.html" class="btn btn-primary btn-sm">View All Results <i
                                    class="ri-arrow-right-line ms-1"></i></a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown d-md-none topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..."
                                        aria-label="Recipient's username">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="ms-1 header-item d-none d-sm-flex">
                    <a class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" href="{{route('home.page')}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Home Page">
                        <i class="ri-home-4-line fs-22"></i>
                    </a>
                </div>
                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        id="page-header-cart-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                        aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-shopping-bag fs-22'></i>
                        <span
                            class="position-absolute topbar-badge cartitem-badge fs-10 translate-middle badge rounded-pill bg-info">5</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0 dropdown-menu-cart"
                        aria-labelledby="page-header-cart-dropdown">
                        <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fs-16 fw-semibold"> My Cart</h6>
                                </div>
                                <div class="col-auto">
                                    <span class="badge bg-warning-subtle text-warning fs-13"><span
                                            class="cartitem-badge">7</span>
                                        items</span>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 300px;">
                            <div class="p-2">
                                @if (Cart::count() > 0)

                                @foreach (Cart::content() as $item)
                                    @php
                                        $subtotal = $item->qty * $item->price;

                                    @endphp
                                    <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('uploads/products/' . ($item->options->image ?? '')) }}"
                                                class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                                            <div class="flex-1">
                                                <h6 class="mt-0 mb-1 fs-14">
                                                    <a href="apps-ecommerce-product-details.html" class="text-reset">{{ $item->name }}</a>
                                                </h6>
                                                <p class="mb-0 fs-12 text-muted">
                                                    Quantity: <span>{{ $item->qty }} x Rs. {{ $item->price }}</span>
                                                </p>
                                            </div>
                                            <div class="px-2">
                                                <h5 class="m-0 fw-normal">Rs. <span class="cart-item-price">{{ $subtotal }}</span></h5>
                                            </div>
                                            <div class="ps-2">
                                                <a href="#" onclick="deleteItem('{{ $item->rowId }}')">
                                                <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i
                                                        class="ri-close-fill fs-16"></i></button></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="p-3 border-bottom-0 border-start-0 border-end-0 border-dashed border" id="checkout-elem">
                                    <div class="d-flex justify-content-between align-items-center pb-3">
                                        <h5 class="m-0 text-muted">Total:</h5>
                                        <div class="px-2">
                                            <h5 class="m-0" >Rs. {{ Cart::subtotal()}}</h5>
                                        </div>
                                    </div>
                                    <a href="{{ route('checkout.details') }}" class="btn btn-success text-center w-100">
                                        Checkout
                                    </a>
                                </div>
                                @else
                                    <div class="text-center">
                                        <div class="avatar-md mx-auto my-3">
                                            <div class="avatar-title bg-soft-info text-info fs-36 rounded-circle">
                                                <i class='bx bx-cart'></i>
                                            </div>
                                        </div>
                                        <h5 class="mb-3">Your Cart is Empty!</h5>
                                        <a href="{{ route('home.page') }}" class="btn btn-success w-md mb-3">Shop
                                            Now</a>
                                    </div>
                                @endif
                            </div>
                    </div>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen" data-bs-toggle="tooltip" data-bs-placement="bottom" title="FullScreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>



                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            @php
                                $userImage = auth()->user()->image ?? null;
                                $Name = auth()->user()->name ?? '';
                                $initial = strtoupper(substr($Name, 0, 1));
                            @endphp

                            @if ($userImage)
                                <img class="rounded-circle header-profile-user" src="{{ asset('admin_asset/images/users/avatar-1.jpg') }}" alt="Header Avatar">
                            @else
                                <div class="rounded-circle header-profile-user bg-primary text-white" style="width: 40px; height: 40px; line-height: 40px; text-align: center;">
                                    {{ $initial }}
                                </div>
                            @endif

                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"> {{ auth()->user()->username ?? '' }}</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome {{ auth()->user()->name ?? '' }}!</h6>
                        <a class="dropdown-item" href="{{ route('user.profile') }}">
                            <i class="ri-account-circle-fill fs-16 align-middle me-1"></i>
                            <span class="align-middle">Profile</span>
                        </a>
                        <a class="dropdown-item" href="pages-faqs.html">
                            <i class="ri-question-fill fs-16 align-middle me-1"></i>
                            <span class="align-middle">Help</span>
                        </a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="pages-profile-settings.html">
                            <span class="badge bg-success-subtle text-success mt-1 float-end">New</span>

                            <i class="ri-settings-fill text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ri-logout-box-fill text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle" data-key="t-logout">Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>



<script>
    function deleteItem(rowId) {
            $.ajax({
                url: "{{ route('carts.item.delete') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: {
                    rowId: rowId,
                },
                dataType: 'json',
                success: function(response) {

                },
            });
    }
    </script>

<script>
    function showToast(a) {
        const toastBox = document.getElementById('toast-box');
        console.log("toast showing");
        toastBox.classList.remove('d-none');
        document.getElementById('toastContent').textContent = a;
        toastBox.classList.add('show');

        setTimeout(() => {
            toastBox.classList.remove('show');
            toastBox.classList.add('hide');
        }, 5000);

        setTimeout(() => {
            toastBox.classList.add('d-none');
            toastBox.classList.remove('hide');
        }, 5500);
    }

    const closeToast = document.getElementById("closeToast");
    closeToast.addEventListener("click", closeIt);

    function closeIt() {
        const toastBox = document.getElementById("toast-box");
        toastBox.classList.add('hide');

        setTimeout(() => {
            toastBox.classList.add('d-none');
            toastBox.classList.remove('hide');
        }, 500);
    }



    function showErrorToast(b) {
        const toastErrorBox = document.getElementById('toast-error-box');
        toastErrorBox.classList.remove('d-none');
        document.getElementById('toastErrorContent').textContent = b;
        toastErrorBox.classList.add('show');

        setTimeout(() => {
            toastErrorBox.classList.remove('show');
            toastErrorBox.classList.add('hide');
        }, 5000);

        setTimeout(() => {
            toastErrorBox.classList.add('d-none');
            toastErrorBox.classList.remove('hide');
        }, 5500);
    }
    const closeErrorToast = document.getElementById("closeErrorToast");
    closeErrorToast.addEventListener("click", closeIt);

    function closeThis() {
        const toastErrorBox = document.getElementById("toast-error-box");
        toastErrorBox.classList.add('hide');

        setTimeout(() => {
            toastErrorBox.classList.add('d-none');
            toastErrorBox.classList.remove('hide');
        }, 500);
    }
</script>


