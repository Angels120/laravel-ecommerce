<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
@include('customer.layouts.head')
<body>
    <div id="layout-wrapper">
   @yield('content')
    </div>
       <!--start back-to-top-->
       <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->


 <!-- JAVASCRIPT -->
 <script src="{{ asset('admin_asset/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('admin_asset/libs/simplebar/simplebar.min.js') }}"></script>
 <script src="{{ asset('admin_asset/libs/feather-icons/feather.min.js') }}"></script>
 <script src="{{ asset('admin_asset/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>


 <!-- App js -->
 <script src="{{ asset('admin_asset/js/app.js') }}"></script>



</body>

</html>
