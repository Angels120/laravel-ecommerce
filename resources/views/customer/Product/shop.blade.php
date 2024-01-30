@extends('customer.layouts.app')

@section('container')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Product Lists</h4>
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
                <div class="row">
                    <!-- Left Side Column -->
                    <div class="col-md-2">
                        <div class="sticky-side-div">
                            <h1 class="brands fs-24">Brands</h1>
                            <hr class="w-50" style="border: 2px solid #2c3662">
                            <div class="card">
                                <div class="card-body" style="flex: 1;">
                                    @foreach ($brands as $brand)
                                        <p class="card-text m-0 price text-muted">
                                            <input {{ in_array($brand->id, $brandsArray) ? 'checked' : '' }}
                                                class="form-check-input brand-label" type="checkbox" name="brand[]"
                                                value="{{ $brand->id }}" id="brand-{{ $brand->id }}">
                                            <label class="" for="brand-{{ $brand->id }}">
                                                {{ $brand->name }}
                                            </label>
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="sticky-side-div">
                            <h1 class="brands fs-24">Price</h1>
                            <hr class="w-50" style="border: 2px solid #2c3662">
                            <div class="card">
                                <div class="card-body" style="flex: 1;">
                                    <input type="text" class="js-range-slider" name="my_range" value="" />
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Right Side Column -->
                    <div class="col-md-10 mt-4">
                        <div class="row d-flex align-items-center">
                            @forelse ($products as $product)
                                @if ($product->status == 1)
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
                            @empty
                                <div class="col-md-12">
                                    <h1>No products Available </h1>
                                </div>
                            @endforelse
                        </div><!-- end row -->
                    </div><!-- end col-md-10 -->

                    <!-- Sort Select on Right Side -->
                    <div class="col-md-2 mt-3">
                        <div class="d-flex flex-column align-items-end">
                            <div class="ml-2 mb-4">
                                <select name="sort" id="sort" class="form-control">
                                    <option value="latest">Latest</option>
                                    <option value="latest">Price High</option>
                                    <option value="latest">Price Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div><!-- end row -->
            </div><!-- end container-fluid -->

        </div>

    </div>


@endsection
@section('script')
    <script>
        $(".brand-label").change(function() {
            apply_filters();
        });
        $(".js-range-slider").ionRangeSlider({
            type: "double",
            min: 1000,
            max: 1000000,
            from: {{ $priceMin }},
            step: 10000,
            to: {{ $priceMax }},
            skin: "round",
            max_postfix: "+",
            prefix: "Rs. ",
            onFinish: function() {
                apply_filters()
            }
        });
        var slider = $(".js-range-slider").data("ionRangeSlider")

        function apply_filters() {
            var brands = [];
            $(".brand-label").each(function() {
                if ($(this).is(":checked") == true) {
                    brands.push($(this).val());
                }
            });
            console.log(brands.toString())
            var url = '{{ url()->current() }}?';

            url += '&price_min=' + slider.result.from + '&price_max=' + slider.result.to;
            window.location.href = url + '&brand=' + brands.toString();
        }
    </script>
@endsection
