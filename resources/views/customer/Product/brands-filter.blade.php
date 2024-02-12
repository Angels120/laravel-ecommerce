@extends('customer.layouts.app')

@section('container')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Brand Filters</h4>
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
                <div class="row align-items-center">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body" style="flex: 1;">
                                <img class="card-img-top img-fluid" src="{{ asset('uploads/brands/' . $brands->image) }}"
                                    alt="Card image cap" style="height: 100%; object-fit: cover;">
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2">
                        <h1 class="brands fs-26">{{ $brands->name }}</h1>
                    </div>
                </div><!-- end row -->

                <!-- Products Section (Right Side) -->
                <div class="col-md-8 mt-3">
                    <div class="row d-flex align-items-stretch">
                        @foreach ($products as $product)
                            @if ($product->status == 1)
                                <div class="col-xl-4 mb-3">
                                    <!-- Simple card with a link -->
                                    <a href="{{ route('product.detail', $product->slug) }}" class="card-link">
                                        <div class="card card-product">
                                            <img class="card-img-top img-fluid"
                                                src="{{ asset('uploads/products/' . $product->image[0]) }}"
                                                alt="Card image cap" style="height: 200px; object-fit: cover;">
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
                                            <div class="add-to-cart-btn">
                                                <button class="btn btn-primary" onclick="addToCart({{ $product->id }})"><i
                                                        class="ri-shopping-cart-2-line fs-6"> Add To Cart </i> </button>
                                            </div>
                                            <div class="favorite-btn">
                                                <button class="btn btn-outline-danger btn-favorite"><i
                                                        class="ri-heart-line"></i></button>
                                            </div>
                                        </div><!-- end card -->
                                    </a>
                                </div><!-- end col -->
                            @endif
                        @endforeach
                    </div>
                </div><!-- end col-md-9 -->


            </div><!-- end container-fluid -->

        </div>
    </div>


@endsection
