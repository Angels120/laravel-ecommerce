<!DOCTYPE html>
<html lang="en" data-layout="horizontal" data-layout-style="" data-layout-position="fixed" data-topbar="light">
@include('customer.layouts.head')

<body>
    <div id="layout-wrapper">
        @include('customer.layouts.header')

        @yield('container')

    </div>
    @include('customer.layouts.footer')

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->
    @include('customer.layouts.script')
    @yield('script')

</body>

</html>
