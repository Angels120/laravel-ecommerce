@extends('customer.layouts.app')
@section('container')
    <div class="main-content overflow-hidden">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Checkout</h4>

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
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body checkout-tab">

                                <form id="Billing-information-form">
                                    <div class="step-arrow-nav mt-n3 mx-n3 mb-3">

                                        <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link fs-15 p-3 active" id="pills-bill-info-tab"
                                                    data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button"
                                                    role="tab" aria-controls="pills-bill-info" aria-selected="true">
                                                    <i
                                                        class="ri-user-2-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                                    Personal Info
                                                </button>
                                            </li>

                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link fs-15 p-3" id="pills-payment-tab"
                                                    data-bs-toggle="pill" data-bs-target="#pills-payment" type="button"
                                                    role="tab" aria-controls="pills-payment" aria-selected="false"
                                                    disabled>
                                                    <i
                                                        class="ri-bank-card-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                                    Payment Info
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link fs-15 p-3" id="pills-finish-tab"
                                                    data-bs-toggle="pill" data-bs-target="#pills-finish" type="button"
                                                    role="tab" aria-controls="pills-finish" aria-selected="false"
                                                    disabled>
                                                    <i
                                                        class="ri-checkbox-circle-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                                    Finish
                                                </button>
                                            </li>

                                        </ul>
                                    </div>

                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel"
                                            aria-labelledby="pills-bill-info-tab">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0">Billing Information</h5>

                                                </div>
                                                <p class="text-muted mb-4">Please fill all information below</p>
                                            </div>

                                            <div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="billinginfo-firstName" class="form-label">Full
                                                                Name<span class="ms-1 text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $customerAddress->full_name ?? '' }}"
                                                                id="billinginfo-FullName" placeholder="Enter first name"
                                                                name="full_name">
                                                            <div class="invalid-feedback" id="FullNameError"></div>

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="billinginfo-email" class="form-label">Email<span
                                                                    class="text-muted">(Optional)</span></label>
                                                            <input type="email" name="email" class="form-control"
                                                                value="{{ $customerAddress->email ?? '' }}"
                                                                id="billinginfo-email" placeholder="Enter email">
                                                            <div class="invalid-feedback" id="EmailError"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="province" class="form-label">Province<span
                                                                    class="ms-1 text-danger">*</span></label>
                                                            <select
                                                                class="js-example-basic-single-Province-city form-select"
                                                                id="province_id" name="province_id" data-plugin="choices">
                                                                <option value="">Select Province...</option>
                                                                @if ($provinces->isNotEmpty())
                                                                    @foreach ($provinces as $province)
                                                                        <option
                                                                            {{ !empty($customerAddress) && $customerAddress->province_id == $province->id ? 'selected' : '' }}
                                                                            value="{{ $province->id }}">
                                                                            {{ $province->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            <div class="invalid-feedback" id="ProvinceError"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="city"
                                                                class="form-label">City/Municipality<span
                                                                    class="ms-1 text-danger">*</span></label>
                                                            <select
                                                                class="js-example-basic-single-Province-city form-select"
                                                                id="cities_id" name="city_id" data-plugin="choices">
                                                                <option value="">Select City/Municipality...</option>
                                                                @foreach ($cities as $city)
                                                                    <option
                                                                        {{ !empty($customerAddress) && $customerAddress->city_id == $city->id ? 'selected' : '' }}
                                                                        value="{{ $city->id }}">
                                                                        {{ $city->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback" id="CityError"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="billinginfo-phone" class="form-label">Mobile
                                                                no<span class="ms-1 text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $customerAddress->phone ?? '' }}"
                                                                id="billinginfo-phone" name="phone"
                                                                placeholder="Enter mobile no.">
                                                            <div class="invalid-feedback" id="mobileError"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="billinginfo-address"
                                                                class="form-label">Address<span
                                                                    class="ms-1 text-danger">*</span></label>
                                                            <input class="form-control" name="address"
                                                                value="{{ $customerAddress->address ?? '' }}"
                                                                id="billinginfo-address"
                                                                placeholder="House no. /building /street/area"
                                                                rows="3"></input>
                                                            <div class="invalid-feedback" id="addressError"></div>
                                                            <div class="invalid-feedback" id="addressError"></div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-start gap-3 mt-3">
                                                    <button type="button"
                                                        class="btn btn-primary btn-label right ms-auto nexttab"
                                                        id="save-information">
                                                        <i
                                                            class="ri-bank-card-line label-icon align-middle fs-16 ms-2"></i>
                                                        Proceed to Payment Info
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->



                                        <div class="tab-pane fade" id="pills-payment" role="tabpanel"
                                            aria-labelledby="pills-payment-tab">
                                            <div>
                                                <h5 class="mb-1">Payment Selection</h5>
                                                <p class="text-muted mb-4">Please select and enter your billing information
                                                </p>
                                            </div>

                                            <div class="row g-4">
                                                <div class="col-lg-4 col-sm-6">
                                                    <div data-bs-toggle="collapse"
                                                        data-bs-target="#paymentmethodCollapse.show" aria-expanded="false"
                                                        aria-controls="paymentmethodCollapse">
                                                        <div class="form-check card-radio">
                                                            <input id="paymentMethod01" name="paymentMethod"
                                                                type="radio" value="paypal" class="form-check-input">
                                                            <label class="form-check-label" for="paymentMethod01">
                                                                <span class="fs-16 text-muted me-2"><i
                                                                        class="ri-paypal-fill align-bottom"></i></span>
                                                                <span class="fs-14 text-wrap">Paypal</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6">
                                                    <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse"
                                                        aria-expanded="true" aria-controls="paymentmethodCollapse">
                                                        <div class="form-check card-radio">
                                                            <input id="paymentMethod02" name="paymentMethod"
                                                                type="radio" value="credit_card"
                                                                class="form-check-input" checked>
                                                            <label class="form-check-label" for="paymentMethod02">
                                                                <span class="fs-16 text-muted me-2"><i
                                                                        class="ri-bank-card-fill align-bottom"></i></span>
                                                                <span class="fs-14 text-wrap">Credit / Debit Card</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-sm-6">
                                                    <div data-bs-toggle="collapse"
                                                        data-bs-target="#paymentmethodCollapse.show" aria-expanded="false"
                                                        aria-controls="paymentmethodCollapse">
                                                        <div class="form-check card-radio">
                                                            <input id="paymentMethod03" name="paymentMethod"
                                                                type="radio" value="cod" class="form-check-input">
                                                            <label class="form-check-label" for="paymentMethod03">
                                                                <span class="fs-16 text-muted me-2"><i
                                                                        class="ri-money-dollar-box-fill align-bottom"></i></span>
                                                                <span class="fs-14 text-wrap">Cash on Delivery</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="collapse show" id="paymentmethodCollapse">
                                                <div class="card p-4 border shadow-none mb-0 mt-4">
                                                    <div class="row gy-3">
                                                        <div class="col-md-12">
                                                            <label for="cc-name" class="form-label">Name on card</label>
                                                            <input type="text" class="form-control" id="cc-name"
                                                                placeholder="Enter name">
                                                            <small class="text-muted">Full name as displayed on
                                                                card</small>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="cc-number" class="form-label">Credit card
                                                                number</label>
                                                            <input type="text" class="form-control" id="cc-number"
                                                                placeholder="xxxx xxxx xxxx xxxx">
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label for="cc-expiration"
                                                                class="form-label">Expiration</label>
                                                            <input type="text" class="form-control" id="cc-expiration"
                                                                placeholder="MM/YY">
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label for="cc-cvv" class="form-label">CVV</label>
                                                            <input type="text" class="form-control" id="cc-cvv"
                                                                placeholder="xxx">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-muted mt-2 fst-italic">
                                                    <i data-feather="lock" class="text-muted icon-xs"></i> Your
                                                    transaction is secured with SSL encryption
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-start gap-3 mt-4">
                                                <button type="button" class="btn btn-light btn-label previestab"
                                                    data-previous="pills-bill-info-tab"><i
                                                        class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Back
                                                    to Personal Info</button>
                                                <button type="button"
                                                    class="btn btn-primary btn-label right ms-auto nexttab"
                                                    id="order_complete"><i
                                                        class="ri-shopping-basket-line label-icon align-middle fs-16 ms-2"></i>Complete
                                                    Order</button>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->

                                        <div class="tab-pane fade" id="pills-finish" role="tabpanel"
                                            aria-labelledby="pills-finish-tab">
                                            <div class="text-center py-5">
                                                <div class="mb-4">
                                                    <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop"
                                                        colors="primary:#0ab39c,secondary:#405189"
                                                        style="width:120px;height:120px"></lord-icon>
                                                </div>
                                                <h5>Thank you ! Your Order is Completed !</h5>
                                                <p class="text-muted">You will receive an order confirmation email with
                                                    details of your order.</p>

                                                <h3 class="fw-semibold">Order ID: <span id="orderID"
                                                        class="text-decoration-underline"></span></h3>
                                            </div>
                                        </div>

                                        <!-- end tab pane -->
                                    </div>
                                    <!-- end tab content -->
                                </form>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-0">Order Summary</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header bg-soft-light border-bottom-dashed">
                                <div class="text-center">
                                    <h6 class="mb-2">
                                        Have a <span class="fw-semibold">Coupon</span> code ?
                                    </h6>
                                </div>
                                <div class="hstack gap-3 px-3 mx-n3">
                                    <input class="form-control me-auto" type="text" name="code" id="discount_code"
                                        placeholder="Enter coupon code" aria-label="Add Promo Code here..." />
                                    <button type="button" id="apply-discount" class="btn btn-success w-xs">
                                        Apply
                                    </button>
                                </div>
                                <div id="discount-response-wrapper">
                                    @if (Session::has('code'))
                                        <div id="discount-response">
                                            <button type="button" class="btn btn-primary btn-label right mt-2"
                                                id="delete-coupon-code">
                                                <i
                                                    class="ri-delete-bin-5-line label-icon align-middle fs-16 ms-2 text-danger"></i>
                                                {{ Session::get('code')->code }}
                                            </button>
                                        </div>
                                    @endif
                                </div>


                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless align-middle mb-0">
                                        <thead class="table-light text-muted">
                                            <tr>
                                                <th style="width: 90px;" scope="col">Product</th>
                                                <th scope="col">Product Info</th>
                                                <th scope="col" class="text-end">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (Cart::Content() as $item)
                                                <tr>
                                                    <td>
                                                        <div class="avatar-md bg-light rounded p-1">
                                                            <img class="img-fluid d-block"
                                                                src="{{ asset('uploads/products/' . ($item->options->image ?? '')) }}"
                                                                alt="">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14"><a href="apps-ecommerce-product-details.html"
                                                                class="text-dark">{{ $item->name }} </a></h5>
                                                        <p class="text-muted mb-0">Quantity: ({{ $item->qty }})</p>
                                                    </td>
                                                    <td class="text-end">Rs. {{ $item->price }}</td>

                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td class="fw-semibold" colspan="2">Sub Total :</td>
                                                <td class="fw-semibold text-end">Rs. {{ Cart::subTotal() }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Discount :
                                                </td>

                                                <td class="text-end" id="discount_value">-Rs {{ $discount }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Shipping Charge :</td>
                                                <td class="text-end" id="shippingAmount">Rs.
                                                    {{ number_format($totalShippingCharge, 2) }}</td>
                                            </tr>
                                            <tr class="table-active">
                                                <th colspan="2">Total (Rs) :</th>
                                                <td class="text-end">
                                                    <span class="fw-semibold" id="grandTotal">
                                                        Rs. {{ number_format($grandTotal, 2) }}
                                                    </span>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>
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


    {{-- Script for select2 --}}
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single-Province-city').select2({

            });
        });
    </script>

    {{-- Dynamic Dropdown for Province and City --}}
    <script>
        $(document).ready(function() {

            $('#province_id').change(function() {
                var provinceId = $(this).val();
                if (provinceId) {
                    var url = "{{ route('cities.get', ['id' => ':id']) }}";
                    var urlWithId = url.replace(':id', provinceId);
                    $.ajax({
                        type: "GET",
                        url: urlWithId,
                        success: function(res) {
                            if (res) {
                                $("#cities_id").empty();
                                $("#cities_id").append(
                                    '<option value="">Select City/Municipality...</option>');
                                $.each(res, function(key, value) {
                                    $("#cities_id").append('<option value="' +
                                        value.id + '">' + value.name +
                                        '</option>');
                                });
                                $('#cities_id').prop('disabled', false);
                            } else {
                                $("#cities_id").empty();
                                $('#cities_id').prop('disabled', true);
                            }
                        }
                    });
                } else {
                    $("#cities_id").empty();
                    $('#cities_id').prop('disabled', true);
                }
            });
        });
    </script>


    {{-- Address customer Form  and Payment Detail --}}
    <script>
        $(document).ready(function() {
            $('#save-information').click(function(e) {
                var data = $('#Billing-information-form').serializeArray();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('process.checkout.address') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function(response) {
                        console.log("finally");
                        showToast(response.message);
                        // Switch to the next tab
                        if (!response.errors) {
                            $('#pills-payment-tab').removeAttr('disabled');
                            $('#pills-payment-tab').tab('show');
                        }
                    },
                    error: function(error) {
                        document.getElementById('FullNameError').style.display = "none";
                        document.getElementById('EmailError').style.display = "none";
                        document.getElementById('ProvinceError').style.display = "none";
                        document.getElementById('CityError').style.display = "none";
                        document.getElementById('mobileError').style.display = "none";
                        document.getElementById('addressError').style.display = "none";
                        if (error.responseJSON.errors) {
                            if (error.responseJSON.errors.full_name) {
                                var errMsg = document.getElementById('FullNameError');
                                if (error.responseJSON.errors.full_name[0]) {
                                    errMsg.style.display = "block";
                                    errMsg.textContent = error.responseJSON.errors.full_name[0];
                                }
                            }
                            if (error.responseJSON.errors.email) {
                                var errMsg = document.getElementById('EmailError');
                                if (error.responseJSON.errors.email[0]) {
                                    errMsg.style.display = "block";
                                    errMsg.textContent = error.responseJSON.errors.email[
                                        0];
                                }
                            }
                            if (error.responseJSON.errors.province_id) {
                                var errMsg = document.getElementById('ProvinceError');
                                if (error.responseJSON.errors.province_id[0]) {
                                    errMsg.style.display = "block";
                                    errMsg.textContent = error.responseJSON.errors.province_id[
                                        0];
                                }
                            }
                            if (error.responseJSON.errors.city_id) {
                                var errMsg = document.getElementById('CityError');
                                if (error.responseJSON.errors.city_id[0]) {
                                    errMsg.style.display = "block";
                                    errMsg.textContent = error.responseJSON.errors.city_id[0];
                                }
                            }
                            if (error.responseJSON.errors.phone) {
                                var errMsg = document.getElementById('mobileError');
                                if (error.responseJSON.errors.phone[0]) {
                                    errMsg.style.display = "block";
                                    errMsg.textContent = error.responseJSON.errors.phone[0];
                                }
                            }
                            if (error.responseJSON.errors.address) {
                                var errMsg = document.getElementById('addressError');
                                if (error.responseJSON.errors.address[0]) {
                                    errMsg.style.display = "block";
                                    errMsg.textContent = error.responseJSON.errors.address[0];
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
            $('#order_complete').click(function(e) {
                var data = $('#Billing-information-form').serializeArray();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('process.checkout.payment') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function(response) {
                        console.log("finally");
                        showToast(response.message);
                        // Switch to the next tab
                        if (!response.errors) {
                            $('#pills-finish-tab').removeAttr('disabled');
                            $('#pills-finish-tab').tab('show');
                            $('#orderID').text(response.order_id);
                            $('#pills-payment-tab').prop('disabled', true);
                            $('#pills-bill-info-tab').prop('disabled', true);
                        }
                    },
                    error: function(error) {

                    }
                });
            });
        });
    </script>




    {{-- Shipping charge change Script --}}
    <script>
        $(document).ready(function() {
            $('#cities_id').change(function() {

                $.ajax({
                    url: "{{ route('order.summary') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        cities_id: $(this).val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == true) {
                            console.log('here');
                            $("#shippingAmount").html('Rs ' + response.shippingCharge);
                            $("#grandTotal").html('Rs ' + response.grandTotal);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>



    {{-- script for discount coupon --}}
    <script>
        $(document).ready(function() {
            $("#apply-discount").click(function(e) {
                console.log('clicked');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('discountcode') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        code: $("#discount_code").val(),
                        cities_id: $("#cities_id").val()
                    },
                    success: function(response) {
                        if (response.status == true) {
                            showToast('Discount Coupon added succesfully');
                            $("#shippingAmount").html('Rs ' + response.shippingCharge);
                            $("#grandTotal").html('Rs ' + response.grandTotal);
                            $("#discount_value").html('-Rs ' + response.discount);
                            $("#discount-response-wrapper").html(response.discountString);
                        }
                        if (response.status == false) {
                            showErrorToast(response.message);
                        }
                    }
                });
            });
        });
        $(document).ready(function() {
            $('body').on('click', "#delete-coupon-code", function() {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('remove.discountcode') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        cities_id: $("#cities_id").val()
                    },
                    success: function(response) {
                        if (response.status == true) {
                            showToast('Discount coupon Removed Succesfully');
                            $("#shippingAmount").html('Rs ' + response
                                .shippingCharge);
                            $("#grandTotal").html('Rs ' + response.grandTotal);
                            $("#discount_value").html('-Rs ' + response.discount);
                            $("#discount-response-wrapper").html('');
                            $("#discount_code").val('');
                        }
                        if (response.status == false) {
                            showErrorToast(response.message);
                        }
                    }
                });
            })

        });
    </script>
@endsection
