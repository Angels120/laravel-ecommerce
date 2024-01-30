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
                <h1 class="brands">Popular Brands</h1>
                <hr class="w-100">
                <div class="row">
                    @foreach ($brands as $brand)
                        <div class="col-md-3 mb-3 brand-card" data-brand="{{ $brand->slug }}">
                            <div class="card">
                                <img class="card-img-top img-fluid" src="{{ asset('uploads/brands/' . $brand->image) }}"
                                    alt="Brand Image" style="height: 130px; object-fit: cover;">
                                <div class="card-body">
                                    <!-- You can add any additional information or links related to the brand here -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($latestProducts->count() > 0)
                    <div class="row  d-flex align-items-center mt-3 mb-3">
                        <h1 class="titlecard">Recently Added</h1>
                        <hr class="w-100">

                        @foreach ($latestProducts as $product)
                            <div class="col-sm-6 col-xl-3">
                                <!-- Simple card -->
                                <a href="{{ route('product.detail', $product->slug) }}" class="card-link">
                                    <div class="card">
                                        <img class="card-img-top img-fluid"
                                            src="{{ asset('uploads/products/' . $product->image[0]) }}" alt=""
                                            style="height: 100%; object-fit: cover;">
                                        <div class="card-body">
                                            <h1 class="card-title mb-2 fs-20">{{ $product->name }}</h1>
                                            <p class="card-text price">
                                                @if ($product->discount)
                                                    <h5> <span class="text-danger">
                                                            Rs.
                                                            {{ $product->price - ($product->price * $product->discount) / 100 }}</span>
                                                    </h5>

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
                        @endforeach
                    </div>
                @else
                    <p>No products available.</p>
                @endif
                <div class="row d-flex align-items-center">
                    <h1 class="titlecard">Featured Products</h1>
                    <hr class="w-100">

                    @foreach ($products as $product)
                        @if ($product->featured == 1)
                            <div class="col-sm-6 col-xl-3">
                                <a href="{{ route('product.detail', $product->slug) }}" class="card-link">
                                    <div class="card">
                                        <img class="card-img-top img-fluid"
                                            src="{{ asset('uploads/products/' . $product->image[0]) }}" alt=""
                                            style="height: 200px; object-fit: cover;">
                                        <div class="card-body">
                                            <h1 class="card-title mb-2 fs-20">{{ $product->name }}</h1>
                                            <p class="card-text price">
                                                @if ($product->discount)
                                                    <h5>
                                                        <span class="text-danger">
                                                            Rs.{{ $product->price - ($product->price * $product->discount) / 100 }}
                                                        </span>
                                                    </h5>
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
                        @endif
                    @endforeach

                </div>


            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            // Check localStorage for previously selected brands
            var selectedBrands = localStorage.getItem('selectedBrands');
            if (selectedBrands) {
                selectedBrands = selectedBrands.split(',');
                selectedBrands.forEach(function(brand) {
                    $('[data-brand="' + brand + '"]').addClass('selected');
                });
            }

            // Handle brand card click
            $('.brand-card').click(function() {
                console.log('clicked')
                var brandSlug = $(this).data('brand');

                // Toggle the 'selected' class
                $(this).toggleClass('selected');

                // Update localStorage with selected brands
                var selectedBrands = $('.brand-card.selected').map(function() {
                    return $(this).data('brand');
                }).get();

                // Store the updated selected brands
                localStorage.setItem('selectedBrands', selectedBrands.join(','));

                // Redirect to another page with selected brands
                redirectToPage(selectedBrands);
            });

            function redirectToPage(selectedBrands) {
                var baseUrl = "{{ route('brands.filter', ['brandSlug' => '']) }}";
                // Remove any empty elements from the selectedBrands array
                selectedBrands = selectedBrands.filter(Boolean);
                // Append the selected brands to the URL
                var brandSlug = selectedBrands.join('/');
                var url = baseUrl + '/' + brandSlug;

                // Redirect to the constructed URL
                window.location.href = url;
                // Clear previous selected brands from local storage
localStorage.removeItem('selectedBrands');

            }
        });
    </script>
@endsection
