@extends('customer.layouts.app')

@section('container')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 sticky-side-div">
                        <h1 class="brands fs-24 ">Brands</h1>
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
                    <div class="col-md-2 sticky-side-div">
                        <h1 class="brands fs-24 ">Brands</h1>
                        <hr class="w-50" style="border: 2px solid #2c3662">
                        <div class="card">
                            <div class="card-body" style="flex: 1;">
                                <input type="text" class="js-range-slider" name="my_range" value="" />
                            </div>
                        </div>
                    </div>

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
        type:"double",
        min:0,
        max:1000,
        from:{{ $priceMin }},
        step:10,
        to:{{ $priceMax }},
        skin:"round",
        max_postfix:"+",
        prefix:"Rs. ",
        onFinish:function(){
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

        url += '&price_min='+slider.result.from+'&price_max='+slider.result.to;
        window.location.href = url + '&brand=' + brands.toString();
    }
</script>
@endsection
