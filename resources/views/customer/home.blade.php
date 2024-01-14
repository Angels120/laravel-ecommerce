@extends('customer.layouts.app')

@section('container')
    <style>
        .card {
            cursor: pointer;
            transition: 0.3s;
            padding: 10px;
        }

        .card:hover {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        h1.titlecard {
            font-family: "Mukta", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

    </style>

    <div class="swiper navigation-swiper rounded">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img class="" src="{{ asset('admin_asset/images/small/img-11.jpg') }}" alt="" width="100%"
                    height="780px">
            </div>
            <div class="swiper-slide">
                <img class="" src="{{ asset('admin_asset/images/sidebar/img-2.jpg') }}" alt="" width="100%"
                    height="780px">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('admin_asset/images/small/img-6.jpg') }}" alt="" width="100%" height="780px">
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>


    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid ">

                <div class="row  d-flex align-items-center mt-3 mb-3">
                    <h1 class="titlecard">Recently Added</h1>
                    <hr class="w-100">
                    <div class="col-sm-6 col-xl-3">
                        <!-- Simple card -->
                        <div class="card">
                            <img class="card-img-top img-fluid" src="{{ asset('admin_asset/images/small/img-11.jpg') }}"
                                alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title mb-2">Web Developer</h4>
                                <p class="card-text">Price</p>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-sm-6 col-xl-3">
                        <!-- Simple card -->
                        <div class="card">
                            <img class="card-img-top img-fluid" src="{{ asset('admin_asset/images/sidebar/img-3.jpg') }}"
                                alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title mb-2">Web Developer</h4>
                                <p class="card-text">Price</p>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-sm-6 col-xl-3">
                        <!-- Simple card -->
                        <div class="card">
                            <img class="card-img-top img-fluid" src="{{ asset('admin_asset/images/small/img-11.jpg') }}"
                                alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title mb-2">Web Developer</h4>
                                <p class="card-text">Price</p>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-sm-6 col-xl-3">
                        <!-- Simple card -->
                        <div class="card">
                            <img class="card-img-top img-fluid" src="{{ asset('admin_asset/images/small/img-11.jpg') }}"
                                alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title mb-2">Web Developer</h4>
                                <p class="card-text">Price</p>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div>
                @foreach ($products as $product)
    @if ($product->featured == 1)
        <div class="row  d-flex align-items-center">
            <h1 class="titlecard">Featured Product</h1>
            <hr class="w-100">
            <div class="col-sm-6 col-xl-3">
                <!-- Simple card with a link -->
                <a href="{{ route('product.detail', $product->slug) }}" class="card-link">
                    <div class="card">
                        <img class="card-img-top img-fluid" src="{{ asset('uploads/products/' . $product->image[0]) }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <h1 class="card-title mb-2 fs-20">{{ $product->name }}</h1>
                            <p class="card-text price">
                                @if ($product->discount)
                                <h5> <span class="text-danger">
                                    Rs. {{ $product->price - ($product->price * $product->discount) / 100 }}</span></h5>

                                    <div class="text-muted">
                                        <s>
                                            Rs.{{ $product->price }}
                                        </s>
                                        ({{ $product->discount }}% off)
                                    </div>
                                @else
                                    <span class="text-danger price">
                                        Rs. {{ $product->price ?? ' ' }}
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div><!-- end card -->
                </a>
            </div><!-- end col -->
        </div>
    @endif
@endforeach

            </div>
        </div>
    </div>
@endsection
