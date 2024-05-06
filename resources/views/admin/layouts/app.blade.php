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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin_asset/libs/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_asset/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin_asset/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('admin_asset/js/plugins.js') }}"></script>

    {{-- ck editor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    {{-- <script src="{{ asset('admin_asset/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script> --}}
    <!-- apexcharts -->
    <script src="{{ asset('admin_asset/libs/apexcharts/apexcharts.min.js') }}"></script>


    <!-- init js -->
    <script src="{{ asset('admin_asset/js/pages/form-editor.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('admin_asset/js/app.js') }}"></script>

    <!-- filepond js -->

    <script src="{{ asset('admin_asset/libs/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('admin_asset/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}">
    </script>
    <script
        src="{{ asset('admin_asset/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
    </script>
    <script
        src="{{ asset('admin_asset/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
    </script>
    <script src="{{ asset('admin_asset/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>
    <script src="{{ asset('admin_asset/js/pages/form-file-upload.init.js') }}"></script>
    <!-- include jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="{{ asset('admin_asset/js/pages/datatables.init.js') }}"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/10.2.0/choices.min.js"
        integrity="sha512-OrRY3yVhfDckdPBIjU2/VXGGDjq3GPcnILWTT39iYiuV6O3cEcAxkgCBVR49viQ99vBFeu+a6/AoFAkNHgFteg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</body>

</html>
