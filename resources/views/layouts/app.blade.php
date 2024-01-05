<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
@include('layouts.head')
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
 <script src="{{ asset('admin_asset/libs/node-waves/waves.min.js') }}"></script>
 <script src="{{ asset('admin_asset/libs/feather-icons/feather.min.js') }}"></script>
 <script src="{{ asset('admin_asset/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
 <script src="{{ asset('admin_asset/js/plugins.js') }}"></script>

 <!-- apexcharts -->
 <script src="{{ asset('admin_asset/libs/apexcharts/apexcharts.min.js') }}"></script>

 <!-- Vector map-->
 <script src="{{ asset('admin_asset/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
 <script src="{{ asset('admin_asset/libs/jsvectormap/maps/world-merc.js') }}"></script>

 <!--Swiper slider js-->
 <script src="{{ asset('admin_asset/libs/swiper/swiper-bundle.min.js') }}"></script>

 <!-- Dashboard init -->
 <script src="{{ asset('admin_asset/js/pages/dashboard-ecommerce.init.js') }}"></script>

 <!-- App js -->
 <script src="{{ asset('admin_asset/js/app.js') }}"></script>
 <!-- particles js -->
 <script src="{{ asset('admin_asset/libs/particles.js/particles.js') }}"></script>
 <!-- particles app js -->
 <script src="{{ asset('admin_asset/js/pages/particles.app.js') }}"></script>
 <!-- password-addon init -->
 <script src="{{ asset('admin_asset/js/pages/password-addon.init.js') }}"></script>

  <!-- filepond js -->
  <script src="{{ asset('admin_asset/libs/filepond/filepond.min.js') }}"></script>
  <script src="{{ asset('admin_asset/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
  <script src="{{ asset('admin_asset/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}"></script>
  <script src="{{ asset('admin_asset/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}"></script>
  <script src="{{ asset('admin_asset/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>
  <script src="{{ asset('admin_asset/js/pages/form-file-upload.init.js') }}"></script>

</body>

</html>
