<head>
    <meta charset="utf-8" />
    <title>WebMart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin_asset/images/logos/webmart-dark.png') }}">


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
    <!--Range slider css-->
    <link href="{{ asset('admin_asset/css/ion.rangeSlider.min.css') }}" rel="stylesheet" type="text/css" />

     <!-- Custom Card For Product - -->
    <link href="{{ asset('admin_asset/css/product-card.css') }}" rel="stylesheet" type="text/css" />

    <!-- Fab Icon cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">



    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    @vite(['resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;600&family=Merriweather:wght@300;700&family=Mukta:wght@200;300;400;500;600;700;800&family=Roboto+Mono:ital,wght@1,700&family=Sofia+Sans:wght@500&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <style>
        .rating {
            direction: rtl;
            unicode-bidi: bidi-override;
            color: #ddd;
            /* Personal choice */
            font-size: 8px;
            margin-left: -15px;
        }

        .rating input {
            display: none;
        }

        .rating label:hover,
        .rating label:hover~label,
        .rating input:checked+label,
        .rating input:checked+label~label {
            color: #ffc107;
            /* Personal color choice. Lifted from Bootstrap 4 */
            font-size: 8px;
        }


        .front-stars,
        .back-stars,
        .star-rating {
            display: flex;
        }

        .star-rating {
            align-items: left;
            font-size: 1.5em;
            justify-content: left;
            margin-left: -5px;
        }

        .back-stars {
            color: #CCC;
            position: relative;
        }

        .front-stars {
            color: #FFBC0B;
            overflow: hidden;
            position: absolute;
            top: 0;
            transition: all 0.5s;
        }


        .percent {
            color: #bb5252;
            font-size: 1.5em;
        }

        .brands {
            font-family: "Roboto Condensed", sans-serif;
            font-optical-sizing: auto;
            font-weight: 500;
            color: #363e61;
            font-style: normal;
            font-size: 40px;
        }

        .price {
            font-family: "Roboto", sans-serif;
            font-weight: 500;
            font-style: normal;
        }

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

        h1.titlecard {
            font-family: "Mukta", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>

</head>
