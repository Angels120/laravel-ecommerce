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
                    <div class="col-md-2 sidebar">
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
                    <div class="col-md-9">
                        <div class="row pb-3">
                            <!-- Sort Select on Right Side -->
                            <div class="col-12 pb-1">
                                <div class="d-flex flex-column align-items-end">
                                    <div class="ml-2 mb-4">
                                        <select class="form-select" name="sort" id="sort">
                                            <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Latest</option>
                                            <option value="price_high" {{ $sort == 'price_high' ? 'selected' : '' }}>Price
                                                High
                                            </option>
                                            <option value="price_low" {{ $sort == 'price_low' ? 'selected' : '' }}>Price
                                                Low
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                                @forelse ($products as $product)
                                    @if ($product->status == 1)
                                        <div class="col-md-4">
                                            <!-- Simple card with a link -->
                                            <a href="{{ route('product.detail', $product->slug) }}" class="card-link">
                                                <div class="card">
                                                    <img class="card-img-top img-fluid"
                                                        src="{{ asset('uploads/products/' . $product->image[0]) }}"
                                                        alt="Card image cap" style="height: 200px; width:300px">
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
                                                                <span class="text-danger">
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

                        </div>
                        {{-- Paginate Div --}}

                        <div class="d-flex justify-content-end col-md-12 pt-2 ">
                            {{ $products->links('pagination::bootstrap-4') }}
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
        $("#sort").change(function() {
            apply_filters()
        })
        $(".js-range-slider").ionRangeSlider({
            type: "double",
            min: 1000,
            max: 100000,
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
            //Brands Filter
            console.log(brands.toString())
            var url = '{{ url()->current() }}?';

            //Price Range Filter
            url += '&price_min=' + slider.result.from + '&price_max=' + slider.result.to;

            //Sorting filter
            url += '&sort=' + $("#sort").val()
            window.location.href = url + '&brand=' + brands.toString();

        }
    </script>
@endsection
