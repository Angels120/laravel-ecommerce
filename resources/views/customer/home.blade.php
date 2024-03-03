@extends('customer.layouts.app')

@section('container')





    <div class="main-content">
        <div class="page-content px-0 m-0">
            <div class="px-0 mb-4">
                <div id="ProductSpecialEvent" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#ProductSpecialEvent" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#ProductSpecialEvent" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#ProductSpecialEvent" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://images.unsplash.com/photo-1545768076-cacd50c03728?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=740&ixid=MnwxfDB8MXxyYW5kb218MHx8bmF0dXJlLGNpdHl8fHx8fHwxNzA2Nzc4ODE1&ixlib=rb-4.0.3&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=1600"
                                class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Welcome To Python Django website</h5>
                                <p>This site is created by Aayush Kalikote.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1613688570481-820ec84316f3?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=740&ixid=MnwxfDB8MXxyYW5kb218MHx8bmF0dXJlLHJpdmVyfHx8fHx8MTcwNjc3NzQ1Mg&ixlib=rb-4.0.3&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=1600"
                                class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>I hope You like all this images of nature</h5>
                                <p>Enjoy My website.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1577945734821-2d35ecc2910e?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=740&ixid=MnwxfDB8MXxyYW5kb218MHx8c3VufHx8fHx8MTcwNjc3NzQ5NA&ixlib=rb-4.0.3&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=1600"class="d-block w-100"
                                alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>You can also contact me using contact form in services dropdown</h5>
                                <p>Try to fill the form and free to send me messages.</p>
                            </div>
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
            </div>
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
                    <div class="row d-flex align-items-center mt-3 mb-3">
                        <h1 class="titlecard">Recently Added</h1>
                        <hr class="w-100">

                        @foreach ($latestProducts as $index => $product)
                            @if ($index % 4 == 0)
                    </div>
                    <div class="row d-flex align-items-center mt-3 mb-3"> <!-- start a new row -->
                @endif

                <div class="col-sm-6 col-xl-3">
                    <!-- Simple card -->
                    <a href="{{ route('product.detail', $product->slug) }}" class="card-link">
                        <div class="card card-product">
                            <img class="card-img-top img-fluid" src="{{ asset('uploads/products/' . $product->image[0]) }}"
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
                                @if($product->stock>0)
                                <div class="add-to-cart-btn">
                                    <a class="btn btn-primary" href="javascript:void(0);" onclick="addToCart({{ $product->id }})"><i
                                            class="ri-shopping-cart-2-line fs-18"> Add To Cart </i> </a>
                                </div>
                                @else
                                <div class="add-to-cart-btn">
                                    <a class="btn btn-danger" href="javascript:void(0);"><i class="ri-close-fill fs-18"></i> Out Of Stock </i> </a>
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
            <p>No products available.</p>
            @endif

            <div class="row d-flex align-items-center">
                <h1 class="titlecard">Featured Products</h1>
                <hr class="w-100">

                @foreach ($products as $product)
                    @if ($product->featured == 1)
                        <div class="col-sm-6 col-xl-3">
                            <a href="{{ route('product.detail', $product->slug) }}" class="card-link">
                                <div class="card card-product">
                                    <img class="img-fluid d-block"
                                        src="{{ asset('uploads/products/' . $product->image[0]) }}" alt=""
                                        style="height: 200px; object-fit: cover;">
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
                                    @if($product->stock>0)
                                    <div class="add-to-cart-btn">
                                        <a class="btn btn-primary" href="javascript:void(0);" onclick="addToCart({{ $product->id }})"><i
                                                class="ri-shopping-cart-2-line fs-18"> Add To Cart </i> </a>
                                    </div>
                                    @else
                                    <div class="add-to-cart-btn">
                                        <a class="btn btn-danger" href="javascript:void(0);"><i class="ri-close-fill fs-18"></i> Out Of Stock </i> </a>
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
