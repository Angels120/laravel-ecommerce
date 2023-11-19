<head>
    <meta charset="utf-8" />
    <title>WebMart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin_asset/images/favicon.ico') }}">
      <!-- Filepond Css -->
      <link rel="stylesheet" href="{{ asset('admin_asset/libs/filepond/filepond.min.css') }}" type="text/css" />
      <link rel="stylesheet" href="{{ asset('admin_asset/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
    <!-- jsvectormap css -->
    <link href="{{ asset('admin_asset/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">


    <!--Swiper slider css-->
    <link href="{{ asset('admin_asset/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ asset('admin_asset/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('admin_asset/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin_asset/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin_asset/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('admin_asset/css/custom.min.css') }}" rel="stylesheet" type="text/css" />


    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <!--datatable css-->
   <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
   <!--datatable responsive css-->
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

   <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">


   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
   @vite(['resources/js/app.js'])

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
    integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
   <style>
    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #d7d8d9;
        height: 37px
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 5px;
        right: 1px;
        width: 20px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        margin-top: 3px;
    }

    .select2-container--default .select2-selection--multiple {
        background-color: white;
        border: 1px solid rgb(170, 170, 170);
        border-radius: 20px;
        cursor: text;

    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #405189;
        margin-top: 6px;
        margin-left: 3px;
    }

</style>
<style>
      /* Customize Chosen single select */
      .chosen-container-single .chosen-single {
        background-color: #fff !important;
        border: 1px solid #d7d8d9 !important;
        height: 37px !important;
    }

    .chosen-container-single .chosen-single .chosen-single div {
        height: 26px !important;
        position: absolute !important;
        top: 5px !important;
        right: 1px !important;
        width: 20px !important;
    }

    .chosen-container-single .chosen-single .chosen-single span {
        color: #444 !important;
        margin-top: 3px !important;
        line-height: normal !important; /* Add this line to adjust the line height */
    }
    /* Customize Chosen multiple select */
    .chosen-container-multi .chosen-choices {
        background-color: white;
        border: 1px solid rgb(170, 170, 170);
        border-radius: 20px;
        cursor: text;
        height: 30px; /* Adjust the height as needed */
        padding: 3px; /* Adjust the padding as needed */
    }

    .chosen-container-multi .chosen-choices .search-choice {
        background-color: #405189;
        margin-top: 6px;
        margin-left: 3px;
    }
</style>
</head>
