@extends('auth.account.sidebar')
@section('all-content')
    <!-- User Information starts -->
    <div class="col-md-10 ms-3">
        <div class="card">
            <div class="card-header">
                <h2 class="h5 mb-0 pt-2 pb-2">User Information</h2>
            </div>
            <form action="" id="profileForm">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="mb-3">
                            <label for="name">Name<span class="ms-1 text-danger">*</span></label>
                            <input type="text" value="{{ $user->name }}" name="name" placeholder="Enter your Name"
                                class="form-control">
                            <div class="invalid-feedback" id="NameError"></div>

                        </div>
                        <div class="mb-3">
                            <label for="email">Email<span class="ms-1 text-danger">*</span></label>
                            <input type="text" value="{{ $user->email }}" name="email" placeholder="Enter your Email"
                                class="form-control">
                            <div class="invalid-feedback" id="EmailError"></div>

                        </div>
                        <div class="mb-3">
                            <label for="phone">Phone<span class="ms-1 text-danger">*</span></label>
                            <input type="text" value="{{ $user->phone_number }}" name="phone_number"
                                placeholder="Enter your phone" class="form-control">
                            <div class="invalid-feedback" id="numberError"></div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" id="profile-update" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card">
            <div class="card-header">
                <h2 class="h5 mb-0 pt-2 pb-2">Billing Address Information</h2>
            </div>
            <form action="" id="BillingAddressForm">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="name">Full Name<span class="ms-1 text-danger">*</span></label>
                                <input type="text" value="{{ $customerAddress->full_name }}" name="full_name"
                                    placeholder="Enter your Full Name" class="form-control">
                                <div class="invalid-feedback" id="FullNameError"></div>

                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="text" value="{{ $customerAddress->email }}" name="email"
                                    placeholder="Enter your Email" class="form-control">
                                <div class="invalid-feedback" id="AddressEmailError"></div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="phone">Phone<span class="ms-1 text-danger">*</span></label>
                                <input type="text" value="{{ $customerAddress->phone }}" name="phone"
                                    placeholder="Enter your phone" class="form-control">
                                <div class="invalid-feedback" id="PhoneNumberError"></div>

                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="mb-3">
                                <label for="province" class="form-label">Province<span
                                        class="ms-1 text-danger">*</span></label>
                                <select class="js-example-basic-single-Province-city form-select" id="province_id"
                                    name="province_id" data-plugin="choices">
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
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="city" class="form-label">City/Municipality<span
                                        class="ms-1 text-danger">*</span></label>
                                <select class="js-example-basic-single-Province-city form-select" id="cities_id"
                                    name="city_id" data-plugin="choices">
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
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="billinginfo-address" class="form-label">Address<span
                                        class="ms-1 text-danger">*</span></label>
                                <input class="form-control" name="address" value="{{ $customerAddress->address ?? '' }}"
                                    id="billinginfo-address" placeholder="House no. /building /street/area"
                                    rows="3"></input>
                                <div class="invalid-feedback" id="addressError"></div>

                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" id="address-update" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('script')
    {{-- Script for select2 --}}
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single-Province-city').select2({

            });
        });
    </script>

    <script>
        //For Profile form submit
        $(document).ready(function() {
            $('#profile-update').click(function(e) {
                console.log('click');
                e.preventDefault();
                var data = $('#profileForm').serialize();
                $.ajax({
                    url: "{{ route('user.updateProfile') }}",
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,

                    success: function(response) {
                        localStorage.setItem("successMessage", response.message);
                        window.location.reload();
                    },
                    error: function(error) {
                        document.getElementById('NameError').style.display = "none";
                        document.getElementById('EmailError').style.display = "none";
                        document.getElementById('numberError').style.display = "none";
                        if (error.responseJSON.errors) {
                            if (error.responseJSON.errors.name) {
                                var errMsg = document.getElementById('NameError');
                                if (error.responseJSON.errors.name[0]) {
                                    errMsg.style.display = "block";
                                    errMsg.textContent = error.responseJSON.errors.name[0];
                                }
                            }
                            if (error.responseJSON.errors.email) {
                                var errMsg = document.getElementById('EmailError');
                                if (error.responseJSON.errors.email[0]) {
                                    errMsg.style.display = "block";
                                    errMsg.textContent = error.responseJSON.errors.email[0];
                                }
                            }
                            if (error.responseJSON.errors.phone_number) {
                                var errMsg = document.getElementById('numberError');
                                if (error.responseJSON.errors.phone_number[0]) {
                                    errMsg.style.display = "block";
                                    errMsg.textContent = error.responseJSON.errors.phone_number[
                                        0];
                                }
                            }
                        }
                    }
                });
            });
        });
    </script>
    <script>
        //For Billing address form submit
        $(document).ready(function() {
            $('#address-update').click(function(e) {
                console.log('click');
                e.preventDefault();
                var data = $('#BillingAddressForm').serialize();
                $.ajax({
                    url: "{{ route('user.updateAddress') }}",
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,

                    success: function(response) {
                        localStorage.setItem("successMessage", response.message);
                        window.location.reload();
                    },
                    error: function(error) {
                        document.getElementById('FullNameError').style.display = "none";
                        document.getElementById('AddressEmailError').style.display = "none";
                        document.getElementById('PhoneNumberError').style.display = "none";
                        document.getElementById('ProvinceError').style.display = "none";
                        document.getElementById('CityError').style.display = "none";
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
                                var errMsg = document.getElementById('AddressEmailError');
                                if (error.responseJSON.errors.email[0]) {
                                    errMsg.style.display = "block";
                                    errMsg.textContent = error.responseJSON.errors.email[0];
                                }
                            }
                            if (error.responseJSON.errors.phone) {
                                var errMsg = document.getElementById('numberError');
                                if (error.responseJSON.errors.phone[0]) {
                                    errMsg.style.display = "block";
                                    errMsg.textContent = error.responseJSON.errors.phone[
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
                                if (error.responseJSON.errors.phone[0]) {
                                    errMsg.style.display = "city_id ";
                                    errMsg.textContent = error.responseJSON.errors.city_id[
                                        0];
                                }
                            }
                            if (error.responseJSON.errors.address) {
                                var errMsg = document.getElementById('addressError');
                                if (error.responseJSON.errors.address[0]) {
                                    errMsg.style.display = "block";
                                    errMsg.textContent = error.responseJSON.errors.address[
                                        0];
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
