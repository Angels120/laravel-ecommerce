{{-- Edit Shipping --}}
<div class="modal fade" id="EditCoupon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg container-fluid">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Edit Coupon Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="#" method="post" id="Coupon-edit-form">
                <div class="modal-body">
                    <input type="text" name="id" id="ideditCoupon" hidden>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Coupon Code<span class="ms-1 text-danger">*</span></label>
                            <input id="Editcode" name="code" type="text" class="form-control"
                                placeholder="Enter Coupon code">
                            <div class="invalid-feedback" id="EditCouponCodeError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Coupon Name<span class="ms-1 text-danger">*</span></label>
                            <input id="Editname" name="name" type="text" class="form-control"
                                placeholder="Enter Coupon name">
                            <div class="invalid-feedback" id="EditCouponNameError"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Coupon Type<span class="ms-1 text-danger">*</span></label>
                            <select id="EditType" class="form-select" name="type">
                                <option class="" value="fixed" selected>Fixed</option>
                                <option class="" value="percent">Percent</option>
                            </select>
                            <div class="invalid-feedback" id="EditTypeError"></div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Status<span class="ms-1 text-danger">*</span></label>
                            <select id="EditStatus" class="form-select" name="status">
                                <option class="" value="1" selected>Available</option>
                                <option class="" value="0">UnAvaialble</option>
                            </select>
                            <div class="invalid-feedback" id="EditStatusError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="mb-3">
                                <label>Discount Amount<span class="ms-1 text-danger">*</span></label>
                                <input id="Editdiscount_amount" name="discount_amount" type="text"
                                    class="form-control" placeholder="Enter Discount amount">
                                <div class="invalid-feedback" id="EditDiscountAmountError"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3"> <label for="category_name"
                                class="control-label mb-1">Description</label>
                            <textarea id="Editdescription" name="description" type="text" class="form-control"></textarea>
                            <div class="invalid-feedback" id="EditDescriptionError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Min Amount</label>
                            <input id="Editmin_amount" name="min_amount" type="text" class="form-control"
                                placeholder="Enter Discount amount">
                            <div class="invalid-feedback" id="EditMinAmountError"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Max Uses User</label>
                            <input id="Editmax_uses_users" name="max_uses_users" type="number" class="form-control"
                                placeholder="Enter Max Uses For User">
                            <div class="invalid-feedback" id="EditUsesError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Max User</label>
                            <input id="Editmax_users" name="max_users" type="number" class="form-control"
                                placeholder="Enter Max User">
                            <div class="invalid-feedback" id="EditUserError"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Start At</label>
                            <input id="Editstarts_at" name="starts_at" type="datetime-local" class="form-control"
                                placeholder="Enter Start Time for Coupon">
                            <div class="invalid-feedback" id="EditStartAtError"></div>

                        </div>
                        <div class="col-md-6">
                            <label>Expires At</label>
                            <input id="Editexpires_at" name="expires_at" type="datetime-local" class="form-control"
                                placeholder="Enter Expire Time for Coupon">
                            <div class="invalid-feedback" id="EditExpiresAtError"></div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="update-Coupon">Update Coupon</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- Edit Verification for Shipping --}}
<script>
    $(document).ready(function() {
        $('#update-Coupon').click(function(e) {

            e.preventDefault();
            var data = $('#Coupon-edit-form').serialize();
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.coupon.update') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function(response) {
                    showToast(response.message);
                    $('#EditCoupon').modal('hide');
                    $('#datatable-crud').DataTable().ajax.reload();
                },
                error: function(error) {
                    console.log(error);
                    document.getElementById('EditCouponCodeError').style.display = "none";
                    document.getElementById('EditCouponNameError').style.display = "none";
                    document.getElementById('EditDiscountAmountError').style.display ="none";
                    document.getElementById('EditMinAmountError').style.display = "none";
                    document.getElementById('EditUserError').style.display = "none";
                    document.getElementById('EditUsesError').style.display = "none";
                    document.getElementById('EditDescriptionError').style.display = "none";
                    document.getElementById('EditTypeError').style.display = "none";
                    document.getElementById('EditStatusError').style.display = "none";
                    document.getElementById('EditStartAtError').style.display = "none";
                    document.getElementById('EditExpiresAtError').style.display = "none";

                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.code) {
                            var errMsg = document.getElementById('EditCouponCodeError');
                            if (error.responseJSON.errors.code[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.code[0];
                            }
                        }
                        if (error.responseJSON.errors.name) {
                            var errMsg = document.getElementById('EditCouponNameError');
                            if (error.responseJSON.errors.name[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.name[0];
                            }
                        }
                        if (error.responseJSON.errors.discount_amount) {
                            var errMsg = document.getElementById('EditDiscountAmountError');
                            if (error.responseJSON.errors.discount_amount[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors
                                    .discount_amount[0];
                            }
                        }
                        if (error.responseJSON.errors.min_amount) {
                            var errMsg = document.getElementById('EditMinAmountError');
                            if (error.responseJSON.errors.min_amount[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.min_amount[
                                0];
                            }
                        }

                        if (error.responseJSON.errors.max_users) {
                            var errMsg = document.getElementById('EditUserError');
                            if (error.responseJSON.errors.max_users[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.max_users[0];
                            }
                        }
                        if (error.responseJSON.errors.max_uses_user) {
                            var errMsg = document.getElementById('EditUsesError');
                            if (error.responseJSON.errors.max_uses_user[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors
                                    .max_uses_user[0];
                            }
                        }
                        if (error.responseJSON.errors.description) {
                            var errMsg = document.getElementById('EditDescriptionError');
                            if (error.responseJSON.errors.description[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.description[
                                    0];
                            }
                        }
                        if (error.responseJSON.errors.type) {
                            var errMsg = document.getElementById('EditTypeError');
                            if (error.responseJSON.errors.type[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.type[0];
                            }
                        }
                        if (error.responseJSON.errors.status) {
                            var errMsg = document.getElementById('EditStatusError');
                            if (error.responseJSON.errors.status[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.status[0];
                            }
                        }

                        if (error.responseJSON.errors.starts_at) {
                            var errMsg = document.getElementById('EditStartAtError');
                            if (error.responseJSON.errors.starts_at[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.starts_at[0];
                            }
                        }
                        if (error.responseJSON.errors.expires_at) {
                            var errMsg = document.getElementById('EditExpiresAtError');
                            if (error.responseJSON.errors.expires_at[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.expires_at[
                                0];
                            }
                        }

                    }
                }
            });

        });
    });
</script>

{{-- ---------------------- show edit for Shipping charge  -------------------- --}}

<script>
    $(document).ready(function() {
        $('.data-table').on("click", ".editCouponButton", function() {
            var id = $(this).data('id');
            $('#EditCoupon').modal('show');
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.coupon.edit') }}",
                data: {
                    id: id
                },
                success: function(response) {
                    $('#Editcode').val(response.code);
                    $('#Editname').val(response.name);
                    $('#Editdiscount_amount').val(response.discount_amount);
                    $('#Editmin_amount').val(response.min_amount);
                    $('#Editdescription').val(response.description);
                    $('#Editmax_uses_users').val(response.max_uses_user);
                    $('#Editmax_users').val(response.max_users);
                    $('#Editstarts_at').val(response.starts_at);
                    $('#Editexpires_at').val(response.expires_at);
                    var CouponType = response.type;
                    $('#EditType').val(CouponType).trigger('change');
                    var CouponStatus = response.status;
                    $('#EditStatus').val(CouponStatus).trigger('change');
                    $('#ideditCoupon').val(response.id);


                },
                error: function(error) {
                    // Handle any errors that occurred during the request
                    console.log(error);
                }
            });
        });
    });
</script>
