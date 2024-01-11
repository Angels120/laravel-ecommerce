@extends('customer.layouts.app')

@section('container')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Product Details</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                    <li class="breadcrumb-item active">Product Details</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row gx-lg-5">
                                    <div class="col-xl-4 mx-auto">
                                        <div class="product-img-slider sticky-side-div">
                                            <div class="swiper product-thumbnail-slider p-2 ">
                                                <div class="swiper-wrapper">
                                                    @foreach ($product->image as $imageName)
                                                        <div class="swiper-slide">
                                                            <img src="{{ asset('uploads/products/' . $imageName) }}"
                                                                alt="" class="img-fluid d-block"
                                                                 />
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="swiper-button-next"></div>
                                                <div class="swiper-button-prev"></div>
                                            </div>

                                            <!-- end swiper thumbnail slide -->
                                            <div class="swiper product-nav-slider mt-2">
                                                <div class="swiper-wrapper">
                                                    @foreach ($product->image as $imageName)
                                                    <div class="swiper-slide">
                                                        <div class="nav-slide-item">
                                                            <img src="{{ asset('uploads/products/' . $imageName) }}"
                                                                alt="" class="img-fluid d-block"
                                                                 />
                                                        </div>
                                                    </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                            <!-- end swiper nav slide -->
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-xl-8">
                                        <div class="mt-xl-0 mt-5">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <h4>{{ $product->name ?? '' }}</h4>

                                                </div>
                                                @role(['Admin', 'Super Admin'])
                                                    <div class="flex-shrink-0">
                                                        <div>
                                                            <a href="apps-ecommerce-add-product.html" class="btn btn-light"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Edit"><i class="ri-pencil-fill align-bottom"></i></a>
                                                        </div>
                                                    </div>
                                                @endrole
                                            </div>

                                            <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                                                <div class="text-muted fs-16">
                                                    <span class="mdi mdi-star text-warning"></span>
                                                    <span class="mdi mdi-star text-warning"></span>
                                                    <span class="mdi mdi-star text-warning"></span>
                                                    <span class="mdi mdi-star text-warning"></span>
                                                    <span class="mdi mdi-star text-warning"></span>
                                                </div>

                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-lg-4 ">
                                                    <div class="p-2 border border-dashed rounded">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2">
                                                                <div
                                                                    class="avatar-title rounded bg-transparent text-success fs-24">
                                                                    Rs.
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <p class="mb-1  fs-16">Price:
                                                                    @if ($product->discount)
                                                                        {{ $product->price - ($product->price * $product->discount) / 100 }}
                                                                        <div>
                                                                            <strike>
                                                                                {{ $product->price }}
                                                                            </strike>
                                                                            <span class="text-danger">
                                                                                ({{ $product->discount }}% off)</span>
                                                                        </div>
                                                                    @else
                                                                        {{ $product->price ?? ' ' }}
                                                                    @endif
                                                                </p>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="p-2 border border-dashed rounded">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2">
                                                                <div
                                                                    class="avatar-title rounded bg-transparent text-success fs-24">
                                                                    <i class="ri-stack-fill"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <p class="text-muted mb-1">Available Stocks :</p>
                                                                <h5 class="mb-0 stock-info">{{ $product->stock ?? '' }}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->

                                                <!-- end col -->
                                            </div>
                                            <div class="col-sm-6">
                                                <div>
                                                    <h5 class="fs-13 fw-medium mt-3">Quantity:</h5>

                                                    <div class="input-step">
                                                        <button type="button" class="minus">-</button>
                                                        <input type="number" class="product-quantity" value="1"
                                                            min="0" max="100" readonly>
                                                        <button type="button" class="plus">+</button>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row mt-4">
                                                <div class="col-lg-12">
                                                    <button type="submit" class="btn btn-info btn-lg btn-block me-3"
                                                        id="save-Category" style="width: 260px;">Buy Now</button>
                                                    <button type="submit" class="btn btn-danger btn-lg btn-block"
                                                        id="save-Category" style="width: 260px;">Add To Cart</button>
                                                </div>
                                            </div>





                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="mt-4">
                                                        <h5 class="fs-14">Sizes :</h5>
                                                        <div class="d-flex flex-wrap gap-2">
                                                            @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                                                @php
                                                                    $sizesArray = is_array($product->sizes) ? $product->sizes : explode(',', $product->sizes);
                                                                    $isAvailable = in_array($size, $sizesArray);
                                                                @endphp
                                                                <div data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                    data-bs-placement="top"
                                                                    title="{{ $isAvailable ? 'Available' : 'Out of Stock' }}">
                                                                    <input type="radio" class="btn-check"
                                                                        name="productsize-radio"
                                                                        id="productsize-radio{{ $loop->index + 1 }}"
                                                                        {{ $isAvailable ? '' : 'disabled' }}>
                                                                    <label
                                                                        class="btn btn-soft-primary avatar-xs rounded-circle p-0 d-flex justify-content-center align-items-center"
                                                                        for="productsize-radio{{ $loop->index + 1 }}">{{ $size }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- end col -->


                                            </div>
                                            <!-- end row -->

                                            <div class="mt-4 text-muted">
                                                <h5 class="fs-14">Description :</h5>
                                                {!! html_entity_decode($product->description ?? '') !!}

                                            </div>



                                            <div class="product-content mt-5">
                                                <h5 class="fs-14 mb-3">Product Description :</h5>
                                                <nav>
                                                    <ul class="nav nav-tabs nav-tabs-custom nav-success" id="nav-tab"
                                                        role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="nav-speci-tab"
                                                                data-bs-toggle="tab" href="#nav-speci" role="tab"
                                                                aria-controls="nav-speci"
                                                                aria-selected="true">Specification</a>
                                                        </li>

                                                    </ul>
                                                </nav>
                                                <div class="tab-content border border-top-0 p-4" id="nav-tabContent">
                                                    <div class="tab-pane fade show active" id="nav-speci" role="tabpanel"
                                                        aria-labelledby="nav-speci-tab">
                                                        <div class="table-responsive">
                                                            <table class="table mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row" style="width: 200px;">
                                                                            Category</th>
                                                                        <td>{{ $product->category->category_name ?? '' }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Brand</th>
                                                                        <td>{{ $product->brand->name ?? '' }}</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <th scope="row">SubCategory</th>
                                                                        <td>{{ $product->subcategory->subcategory_name ?? '' }}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- product-content -->

                                            <div class="mt-5">
                                                <div>
                                                    <h5 class="fs-14 mb-3">Ratings & Reviews</h5>
                                                </div>
                                                <div class="row gy-4 gx-0">
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <div class="pb-3">
                                                                <div class="bg-light px-3 py-2 rounded-2 mb-2">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-grow-1">
                                                                            <div class="fs-16 align-middle text-warning">
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-half-fill"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-shrink-0">
                                                                            <h6 class="mb-0">4.5 out of 5</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="text-center">
                                                                    <div class="text-muted">Total <span
                                                                            class="fw-medium">5.50k</span> reviews
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mt-3">
                                                                <div class="row align-items-center g-2">
                                                                    <div class="col-auto">
                                                                        <div class="p-2">
                                                                            <h6 class="mb-0">5 star</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="p-2">
                                                                            <div
                                                                                class="progress animated-progress progress-sm">
                                                                                <div class="progress-bar bg-success"
                                                                                    role="progressbar"
                                                                                    style="width: 50.16%"
                                                                                    aria-valuenow="50.16"
                                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <div class="p-2">
                                                                            <h6 class="mb-0 text-muted">2758</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end row -->

                                                                <div class="row align-items-center g-2">
                                                                    <div class="col-auto">
                                                                        <div class="p-2">
                                                                            <h6 class="mb-0">4 star</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="p-2">
                                                                            <div
                                                                                class="progress animated-progress progress-sm">
                                                                                <div class="progress-bar bg-success"
                                                                                    role="progressbar"
                                                                                    style="width: 19.32%"
                                                                                    aria-valuenow="19.32"
                                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <div class="p-2">
                                                                            <h6 class="mb-0 text-muted">1063</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end row -->

                                                                <div class="row align-items-center g-2">
                                                                    <div class="col-auto">
                                                                        <div class="p-2">
                                                                            <h6 class="mb-0">3 star</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="p-2">
                                                                            <div
                                                                                class="progress animated-progress progress-sm">
                                                                                <div class="progress-bar bg-success"
                                                                                    role="progressbar"
                                                                                    style="width: 18.12%"
                                                                                    aria-valuenow="18.12"
                                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <div class="p-2">
                                                                            <h6 class="mb-0 text-muted">997</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end row -->

                                                                <div class="row align-items-center g-2">
                                                                    <div class="col-auto">
                                                                        <div class="p-2">
                                                                            <h6 class="mb-0">2 star</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="p-2">
                                                                            <div
                                                                                class="progress animated-progress progress-sm">
                                                                                <div class="progress-bar bg-warning"
                                                                                    role="progressbar"
                                                                                    style="width: 7.42%"
                                                                                    aria-valuenow="7.42" aria-valuemin="0"
                                                                                    aria-valuemax="100"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-auto">
                                                                        <div class="p-2">
                                                                            <h6 class="mb-0 text-muted">408</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end row -->

                                                                <div class="row align-items-center g-2">
                                                                    <div class="col-auto">
                                                                        <div class="p-2">
                                                                            <h6 class="mb-0">1 star</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="p-2">
                                                                            <div
                                                                                class="progress animated-progress progress-sm">
                                                                                <div class="progress-bar bg-danger"
                                                                                    role="progressbar"
                                                                                    style="width: 4.98%"
                                                                                    aria-valuenow="4.98" aria-valuemin="0"
                                                                                    aria-valuemax="100"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <div class="p-2">
                                                                            <h6 class="mb-0 text-muted">274</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end row -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->


                                                </div>
                                                <!-- end Ratings & Reviews -->
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    </div>
@section('script')

    {{-- Script for increment and decrement quantity --}}
    <script>
        $(function() {
            $('.plus').click(function(e) {
                e.preventDefault();
                var input = $(this).siblings('.product-quantity');
                var quantity = parseInt(input.val());
                var availableStock = parseInt($('.stock-info').text());
                console.log(availableStock);

                if (quantity < availableStock) {
                    quantity++;
                    input.val(quantity);
                }
            });

            $('.minus').click(function(e) {
                e.preventDefault();
                var input = $(this).siblings('.product-quantity');
                var quantity = parseInt(input.val());

                if (quantity > 1) {
                    quantity--;
                    input.val(quantity);
                }
            });
        });
    </script>
@endsection

@endsection
