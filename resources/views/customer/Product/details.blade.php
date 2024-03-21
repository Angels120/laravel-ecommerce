@extends('customer.layouts.app')
@section('container')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid col-8">
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
                                            <div class="swiper product-thumbnail-slider p-2">
                                                <div class="swiper-wrapper">
                                                    @foreach ($product->image as $imageName)
                                                        <div class="swiper-slide">
                                                            <img src="{{ asset('uploads/products/' . $imageName) }}"
                                                                alt="" class="img-fluid d-block w-100 h-100"
                                                                style="object-fit: cover;">
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
                                                        <div class="swiper-slide ">
                                                            <div class="nav-slide-item">
                                                                <img src="{{ asset('uploads/products/' . $imageName) }}"
                                                                    alt="" class="img-fluid d-block" />
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
                                                    <h4 class="fs-36" style="color: #293362">{{ $product->name ?? '' }}
                                                    </h4>
                                                </div>
                                                <button type="button" class="btn btn-light me-2 " data-bs-container="body"
                                                    data-bs-toggle="popover" data-bs-html="true" data-bs-placement="bottom"
                                                    data-bs-content="
                                                <div style='text-align: center; font-size: 18px; font-weight: bold; margin-bottom: 10px;'>Share Via:</div>
                                                <a href='https://www.facebook.com/sharer.php?t={{ urlencode($product->name) }}&u={{ url('/Product/' . $product->slug) }}' target='_blank'>
                                                    <i class='ri-facebook-circle-fill fs-24 me-2'></i>
                                                </a>
                                                <a href='https://twitter.com/intent/tweet?text={{ urlencode($product->name) }}&url={{ url('/Product/' . $product->slug) }}&media={{ urlencode(asset('uploads/products/' . $product->image[0])) }}' target='_blank'>
                                                    <i class='ri-twitter-fill fs-24 me-2'></i>
                                                </a>
                                                <a href='https://wa.me/?text={{ url('/Product/' . $product->slug) }}' target='_blank'><i class='ri-whatsapp-fill fs-24 me-2'></i></a>
                                              ">
                                                    <i class="ri-share-line"></i>
                                                </button>
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


                                        </div>

                                        <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                                            <div class="star-rating mt-2" title="70%">
                                                <div class="back-stars">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>

                                                    <div class="front-stars" style="width: {{ $avgRatingPer }}%">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <small class="pt-1">({{ ($product->product_ratings_count>1)? $product->product_ratings_count.' Reviews': $product->product_ratings_count.'Review'}}) </small>

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
                                                            <p class="mb-1  fs-16 price">Price:
                                                                @if ($product->price)
                                                                    {{ $product->price }}
                                                                    <div>
                                                                        <s class="text-muted">
                                                                            {{ $product->compare_price }}
                                                                        </s>
                                                                        <span class="text-danger price">
                                                                            ({{ $product->discount }}% off)</span>
                                                                    </div>
                                                                @else
                                                                    {{ $product->compare_price ?? ' ' }}
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


                                        <div class=" mt-4">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <button type="submit" class="btn btn-info btn-lg btn-block me-3"
                                                        id="save-Category" style="width: 260px;">Buy Now</button>
                                                    @if ($product->stock > 0)
                                                        <button type="submit" class="btn btn-danger btn-lg btn-block"
                                                            id="save-Category" style="width: 260px;"
                                                            onclick="addToCart({{ $product->id }})">Add To Cart</button>
                                                    @else
                                                        <button class="btn btn-danger btn-lg btn-block"
                                                            style="width: 260px;">Out of stock</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mt-4">
                                                    <h5 class="fs-14">Sizes :</h5>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                                            @php
                                                                $sizesArray = is_array($product->sizes)
                                                                    ? $product->sizes
                                                                    : explode(',', $product->sizes);
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
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="nav-review-tab" data-bs-toggle="tab"
                                                            href="#nav-review" role="tab" aria-controls="nav-review"
                                                            aria-selected="false">Review And Rating</a>
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
                                                <div class="tab-pane fade" id="nav-review" role="tabpanel"
                                                    aria-labelledby="nav-review-tab">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <form action="post" name="rating-form"
                                                                id="productRatingForm">
                                                                <h3 class="h4 pb-3">Write a Review</h3>
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $product->id }}">
                                                                <div class="row">
                                                                    <div class="col-md-6 mb-3">
                                                                        <label for="name">Username <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control"
                                                                            name="username" id="username"
                                                                            placeholder="Username">
                                                                        <div class="invalid-feedback" id="UserNameError">
                                                                            Helo
                                                                        </div>

                                                                    </div>
                                                                    <div class="form-group col-md-6 mb-3">
                                                                        <label for="email">Email <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control"
                                                                            name="email" id="email"
                                                                            placeholder="Email">
                                                                        <div class="invalid-feedback" id="EmailError">
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="rating">Rating <span
                                                                            class="text-danger">*</span></label>
                                                                    <br>
                                                                    <div class="rating" style="width: 10rem">
                                                                        <input id="rating-5" type="radio"
                                                                            name="rating" value="5" /><label
                                                                            for="rating-5"><i
                                                                                class="fas fa-3x fa-star"></i></label>
                                                                        <input id="rating-4" type="radio"
                                                                            name="rating" value="4" /><label
                                                                            for="rating-4"><i
                                                                                class="fas fa-3x fa-star"></i></label>
                                                                        <input id="rating-3" type="radio"
                                                                            name="rating" value="3" /><label
                                                                            for="rating-3"><i
                                                                                class="fas fa-3x fa-star"></i></label>
                                                                        <input id="rating-2" type="radio"
                                                                            name="rating" value="2" /><label
                                                                            for="rating-2"><i
                                                                                class="fas fa-3x fa-star"></i></label>
                                                                        <input id="rating-1" type="radio"
                                                                            name="rating" value="1" /><label
                                                                            for="rating-1"><i
                                                                                class="fas fa-3x fa-star"></i></label>

                                                                    </div>
                                                                    <div class="invalid-feedback" id="RatingError"></div>

                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="">How was your overall
                                                                        experience? <span
                                                                            class="text-danger">*</span></label>
                                                                    <textarea name="comment" id="comment" class="form-control" cols="30" rows="10"
                                                                        placeholder="How was your overall experience?"></textarea>
                                                                    <div class="invalid-feedback" id="commentError"></div>

                                                                </div>
                                                                <div>
                                                                    <button class="btn btn-dark"
                                                                        id="review_submit">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-5">
                                                        <div class="overall-rating mb-3">
                                                            <div class="d-flex">
                                                                <h1 class="h3 pe-3">{{ $avgRating }}</h1>
                                                                <div class="star-rating mt-2" title="70%">
                                                                    <div class="back-stars">
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star" aria-hidden="true"></i>

                                                                        <div class="front-stars" style="width: {{ $avgRatingPer }}%">
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="pt-2 ps-2">({{ ($product->product_ratings_count>1)? $product->product_ratings_count.' Reviews': $product->product_ratings_count.' Review'}})</div>
                                                            </div>

                                                        </div>

                                                        @if ($product->product_ratings->isNotEmpty())

                                                    @foreach ($product->product_ratings as $rating)
                                                        @php
                                                            $ratingPer=($rating->rating*100)/5;
                                                        @endphp

                                                        <div class="rating-group mb-4">
                                                            <span class="author"><strong>{{ $rating->username }} </strong></span>
                                                            <div class="star-rating mt-2">
                                                                <div class="back-stars">
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>

                                                                    <div class="front-stars" style="width: {{ $ratingPer }}%">
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="my-3">
                                                                <p>{{ $rating->comment }}

                                                                </p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>


                                        </div>
                                        <!-- product-content -->

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
    <!-- CartErrorModal -->
    <div id="cartErrorModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/usownftb.json" trigger="loop"
                            style="width:100px;height:100px; ">
                        </lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4 class="text-danger">Your Product is already added in cart!</h4>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    @endsection
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
        <script>
            $(document).ready(function() {
                $('#review_submit').click(function(e) {
                    e.preventDefault();
                    var formData = new FormData(document.getElementById(
                        'productRatingForm'));
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('product.ratingSubmit') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == true) {
                                localStorage.setItem("successMessage", response.message);
                                window.location.reload();
                            }
                            if (response.status == false) {
                                localStorage.setItem("errorMessage", response.message);
                                window.location.reload();
                            }
                        },
                        error: function(error) {
                            document.getElementById('UserNameError').style.display = "none";
                            document.getElementById('EmailError').style.display = "none";
                            document.getElementById('RatingError').style.display = "none";
                            document.getElementById('commentError').style.display = "none";
                            if (error.responseJSON.errors) {
                                if (error.responseJSON.errors.username) {
                                    var errMsg = document.getElementById('UserNameError');
                                    if (error.responseJSON.errors.username[0]) {
                                        errMsg.style.display = "block";
                                        errMsg.textContent = error.responseJSON.errors.username[0];
                                    }
                                }

                                if (error.responseJSON.errors.email) {
                                    var errMsg = document.getElementById('EmailError');
                                    if (error.responseJSON.errors.email[0]) {
                                        errMsg.style.display = "block";
                                        errMsg.textContent = error.responseJSON.errors.email[0];
                                    }
                                }
                                if (error.responseJSON.errors.rating) {
                                    var errMsg = document.getElementById('RatingError');
                                    if (error.responseJSON.errors.rating[0]) {
                                        errMsg.style.display = "block";
                                        errMsg.textContent = error.responseJSON.errors.rating[0];
                                    }
                                }
                                if (error.responseJSON.errors.comment) {
                                    var errMsg = document.getElementById('commentError');
                                    if (error.responseJSON.errors.comment[0]) {
                                        errMsg.style.display = "block";
                                        errMsg.textContent = error.responseJSON.errors.comment[0];
                                    }
                                }
                            }
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                var errorMessage = localStorage.getItem('errorMessage');
                var successMessage = localStorage.getItem('successMessage');
                if (errorMessage) {
                    showErrorToast(errorMessage);
                    localStorage.removeItem('errorMessage');
                }
                if (successMessage) {
                    showToast(successMessage);
                    localStorage.removeItem('successMessage');
                }
            });
        </script>
    @endsection
