@extends('customer.layouts.app')
@section('container')
<div class="main-content">
    <div class="page-content px-0">
        <div class=" position-relative mb-4 mt-n4">
            <div id="ProductSpecialEvent" class="carousel slide" data-bs-ride="carousel" data-bs-interval="10000">
                <div class="carousel-indicators">
                    @foreach ($banners as $key => $banner)
                        <button type="button" data-bs-target="#ProductSpecialEvent" data-bs-slide-to="{{ $key }}" {{ $key === 0 ? 'class=active' : '' }} aria-label="Slide {{ $key + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($banners as $key => $banner)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ asset('uploads/banners/' . $banner->image) }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="mb-4">
                                    <a href="{{ route('checkout.details') }}"
                                        class="btn btn-success w-lg btn-label right ms-auto"><i
                                            class="ri-arrow-right-line label-icon align-bottom fs-16 ms-2"></i> Shop
                                        Now</a>
                                </div>
                                <h5 class="card-title text-success fs-20">Welcome To Ecommerce website</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#ProductSpecialEvent"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#ProductSpecialEvent"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container-fluid ">
            <div>
                <h1 class="brands">Popular Brands</h1>
                <hr class="w-100">
                @if ($brands->count() > 0)
                    <div class="row">
                        @foreach ($brands as $brand)
                            <div class="col-md-3 mb-3 brand-card" data-brand="{{ $brand->slug }}">
                                <div class="card">
                                    <img class="card-img-top img-fluid" src="{{ asset('uploads/brands/' . $brand->image) }}"
                                        alt="Brand Image" style="height: 130px; object-fit: cover;">

                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h1>No Brands Available</h1>
                @endif
            </div>
            @if ($latestProducts->count() > 0)
                <h1 class="titlecard">Recently Added</h1>
                <hr class="w-100">
                <div class="row">
                    @foreach ($latestProducts as $index => $product)
                        <div class="col-md-3">
                            <!-- Simple card -->
                            <a href="{{ route('product.detail', $product->slug) }}" class="card-link">
                                <div class="card card-product">
                                    <div class="image-card" style="height: 200px; width: 280px;">
                                        <img class="card-img-top img-fluid"
                                            src="{{ asset('uploads/products/' . $product->image[0]) }}" alt=""
                                            style="height:100%; width:100%; object-fit: contain;">
                                    </div>
                                    <div class="card-body">
                                        <h1 class="card-title mb-2 fs-20">{{ $product->name }}</h1>
                                        <p class="card-text price">
                                            @if ($product->price)
                                                <h5>
                                                    <span class="text-danger">
                                                        Rs.{{ $product->price }}
                                                    </span>
                                                </h5>
                                                <div class="text-muted">
                                                    <s>
                                                        Rs.{{ $product->compare_price }}
                                                    </s>
                                                    ({{ $product->discount }}% off)
                                                </div>
                                            @else
                                                <span class="text-danger price">
                                                    Rs. {{ $product->compare_price ?? ' ' }}
                                                </span>
                                            @endif
                                        </p>
                                        @if ($product->stock > 0)
                                            <div class="add-to-cart-btn">
                                                <a class="btn btn-primary" href="javascript:void(0);"
                                                    onclick="addToCart({{ $product->id }})"><i
                                                        class="ri-shopping-cart-2-line fs-18">
                                                        Add To
                                                        Cart </i> </a>
                                            </div>
                                        @else
                                            <div class="add-to-cart-btn">
                                                <a class="btn btn-danger" href="javascript:void(0);"><i
                                                        class="ri-close-fill fs-18"></i>
                                                    Out
                                                    Of Stock </i> </a>
                                            </div>
                                        @endif
                                        <div class="favorite-btn">
                                            <a onclick="addToWishlist({{ $product->id }})"
                                                class="btn btn-outline-danger btn-favorite"><i class="ri-heart-line"></i></a>
                                        </div>
                                    </div>
                                </div><!-- end card -->
                            </a>
                        </div><!-- end col -->
                    @endforeach
                </div>
            @else
                <div class="card d-flex align-items-center justify-content-center">
                    <img src="{{ asset('admin_asset/images/no-product.png') }}" height="250px" width="auto" class="d-block"
                        alt="...">
                </div>
            @endif
            <div class="row d-flex align-items-center">
                <h1 class="titlecard">Featured Products</h1>
                <hr class="w-100">
                @if ($products->where('featured', 1)->count() > 0)
                    @foreach ($products as $product)
                        @if ($product->featured == 1)
                            <div class="col-sm-6 col-xl-3">
                                <a href="{{ route('product.detail', $product->slug) }}" class="card-link">
                                    <div class="card card-product">
                                        <img class="img-fluid d-block" src="{{ asset('uploads/products/' . $product->image[0]) }}"
                                            alt="" style="height: 200px; object-fit: cover;">
                                        <div class="card-body">
                                            <h1 class="card-title mb-2 fs-20">{{ $product->name }}</h1>
                                            <p class="card-text price">
                                                @if ($product->price)
                                                    <h5>
                                                        <span class="text-danger">
                                                            Rs.{{ $product->price }}
                                                        </span>
                                                    </h5>
                                                    <div class="text-muted">
                                                        <s>
                                                            Rs.{{ $product->compare_price }}
                                                        </s>
                                                        ({{ $product->discount }}% off)
                                                    </div>
                                                @else
                                                    <span class="text-danger price">
                                                        Rs. {{ $product->compare_price ?? ' ' }}
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                        @if ($product->stock > 0)
                                            <div class="add-to-cart-btn">
                                                <a class="btn btn-primary" href="javascript:void(0);"
                                                    onclick="addToCart({{ $product->id }})"><i class="ri-shopping-cart-2-line fs-18">
                                                        Add To Cart </i> </a>
                                            </div>
                                        @else
                                            <div class="add-to-cart-btn">
                                                <a class="btn btn-danger" href="javascript:void(0);"><i class="ri-close-fill fs-18"></i>
                                                    Out Of Stock </i> </a>
                                            </div>
                                        @endif
                                        <div class="favorite-btn">
                                            <a onclick="addToWishlist({{ $product->id }})"
                                                class="btn btn-outline-danger btn-favorite"><i class="ri-heart-line"></i></a>
                                        </div>
                                    </div><!-- end card -->
                                </a>
                            </div><!-- end col -->
                        @endif
                    @endforeach
                @else
                    <div class="card d-flex align-items-center justify-content-center">
                        <img src="{{ asset('admin_asset/images/no-product.png') }}" height="250px" width="auto"
                            class="d-block" alt="...">
                    </div>

                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        var selectedBrands = localStorage.getItem('selectedBrands');
        if (selectedBrands) {
            selectedBrands = selectedBrands.split(',');
            selectedBrands.forEach(function (brand) {
                $('[data-brand="' + brand + '"]').addClass('selected');
            });
        }

        $('.brand-card').click(function () {
            console.log('clicked')
            var brandSlug = $(this).data('brand');

            $(this).toggleClass('selected');

            var selectedBrands = $('.brand-card.selected').map(function () {
                return $(this).data('brand');
            }).get();

            localStorage.setItem('selectedBrands', selectedBrands.join(','));

            redirectToPage(selectedBrands);
        });

        function redirectToPage(selectedBrands) {
            var baseUrl = "{{ route('brands.filter', ['brandSlug' => '']) }}";

            selectedBrands = selectedBrands.filter(Boolean);

            var brandSlug = selectedBrands.join('/');
            var url = baseUrl + '/' + brandSlug;

            window.location.href = url;
            localStorage.removeItem('selectedBrands');

        }
    });
</script>
@endsection
