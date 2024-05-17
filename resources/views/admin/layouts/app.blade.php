<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">
@include('admin.layouts.head')

<body>
    <div id="layout-wrapper">
        @include('admin.layouts.header')
        @include('admin.layouts.sidebar')
        <div class="col-12">
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">@yield('page_head')</h4>
                                    <div class="page-title-right">
                                        @if ($breadcrumb['breadcrumbs'])
                                            <ol class="breadcrumb m-0">
                                                @foreach ($breadcrumb['breadcrumbs'] as $label => $link)
                                                    <li class="breadcrumb-item">
                                                        @if ($label == 'current_menu')
                                                            <a>
                                                                {{ $link }}
                                                            </a>
                                                        @else
                                                            <a href="{{ $link }}">
                                                                {{ $label }}
                                                            </a>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ol>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        @yield('container')
                    </div>
                    <!-- container-fluid -->
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.footer')

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->



    @include('admin.layouts.script')
    @yield('script')

</body>

</html>
