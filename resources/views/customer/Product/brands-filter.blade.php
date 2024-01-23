@extends('customer.layouts.app')

@section('container')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
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
                <div class="col-md-7 mt-3">
                    <div class="row d-flex align-items-center">
                        @foreach ($products as $product)
                            @if ($product->featured == 1)
                                <div class="col-xl-3">
                                    <!-- Simple card with a link -->
                                    <a href="{{ route('product.detail', $product->slug) }}" class="card-link">
                                        <div class="card">
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
