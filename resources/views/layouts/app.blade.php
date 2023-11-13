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



















{{-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fontfaces CSS-->
    <link href="{{asset('admin_asset/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_asset/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_asset/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_asset/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('admin_asset/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset('admin_asset/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_asset/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_asset/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_asset/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_asset/vendor/slick/slick.css" rel="stylesheet')}}" media="all">
    <link href="{{asset('admin_asset/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_asset/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('admin_asset/css/theme.css')}}" rel="stylesheet" media="all">
    <!-- Jquery JS-->
    <script src="{{asset('admin_asset/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('admin_asset/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('admin_asset/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{asset('admin_asset/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{asset('admin_asset/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('admin_asset/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('admin_asset/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{asset('admin_asset/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('admin_asset/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{asset('admin_asset/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('admin_asset/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('admin_asset/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('admin_asset/vendor/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{asset('admin_asset/js/main.js')}}"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'WebMart') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html> --}}
