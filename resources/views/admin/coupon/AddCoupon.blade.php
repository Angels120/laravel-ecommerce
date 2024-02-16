{{-- Add Coupon --}}
<div class="modal fade" id="AddCoupon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg container-fluid">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add Coupon Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="#" method="post" id="Coupon-create-form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Coupon Code<span class="ms-1 text-danger">*</span></label>
                            <input id="code" name="code" type="text" class="form-control"
                                placeholder="Enter Coupon code">
                            <div class="invalid-feedback" id="CouponCodeError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Coupon Name<span class="ms-1 text-danger">*</span></label>
                            <input id="name" name="name" type="text" class="form-control"
                                placeholder="Enter Coupon name">
                            <div class="invalid-feedback" id="CouponNameError"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Coupon Type<span class="ms-1 text-danger">*</span></label>
                            <select id="type" class="form-select" name="type">
                                <option class="" value="fixed" selected>Fixed</option>
                                <option class="" value="percent">Percent</option>
                            </select>
                            <div class="invalid-feedback" id="TypeError"></div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Status<span class="ms-1 text-danger">*</span></label>
                            <select id="type" class="form-select" name="status">
                                <option class="" value="1" selected>Available</option>
                                <option class="" value="0">UnAvailable</option>
                            </select>
                            <div class="invalid-feedback" id="StatusError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="mb-3">
                                <label>Discount Amount<span class="ms-1 text-danger">*</span></label>
                                <input id="discount_amount" name="discount_amount" type="text"
                                    class="form-control" placeholder="Enter Discount amount">
                                <div class="invalid-feedback" id="DiscountAmountError"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3"> <label for="category_name"
                                class="control-label mb-1">Description</label>
                            <textarea id="description" name="description" type="text" class="form-control"></textarea>
                            <div class="invalid-feedback" id="DescriptionError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Min Amount</label>
                            <input id="min_amount" name="min_amount" type="text" class="form-control"
                                placeholder="Enter Discount amount">
                            <div class="invalid-feedback" id="MinAmountError"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Max Uses User</label>
                            <input id="max_uses_users" name="max_uses_users" type="number" class="form-control"
                                placeholder="Enter Max Uses For User">
                            <div class="invalid-feedback" id="UsesError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Max User</label>
                            <input id="max_users" name="max_users" type="number" class="form-control"
                                placeholder="Enter Max User">
                            <div class="invalid-feedback" id="UserError"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Start At</label>
                            <input id="starts_at" name="starts_at" type="datetime-local" class="form-control"
                                placeholder="Enter Start Time for Coupon">
                            <div class="invalid-feedback" id="StartAtError"></div>

                        </div>
                        <div class="col-md-6">
                            <label>Expires At</label>
                            <input id="expires_at" name="expires_at" type="datetime-local" class="form-control"
                                placeholder="Enter Expire Time for Coupon">
                            <div class="invalid-feedback" id="ExpiresAtError"></div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="save-Coupon">Add Coupon</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<script>
    $(document).ready(function() {
        $('#save-Coupon').click(function(e) {
            e.preventDefault();
            var data = $('#Coupon-create-form').serialize();
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.coupon.create') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function(response) {
                    console.log("finally");
                    showToast(response.message);
                    $('#AddCoupon').modal('hide');
                    $('#datatable-crud').DataTable().ajax.reload();
                },
                error: function(error) {
                    console.log(error);
                    document.getElementById('CouponCodeError').style.display = "none";
                    document.getElementById('CouponNameError').style.display = "none";
                    document.getElementById('DiscountAmountError').style.display = "none";
                    document.getElementById('MinAmountError').style.display = "none";
                    document.getElementById('UserError').style.display = "none";
                    document.getElementById('UsesError').style.display = "none";
                    document.getElementById('DescriptionError').style.display = "none";
                    document.getElementById('TypeError').style.display = "none";
                    document.getElementById('StatusError').style.display = "none";
                    document.getElementById('StartAtError').style.display = "none";
                    document.getElementById('ExpiresAtError').style.display = "none";

                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.code) {
                            var errMsg = document.getElementById('CouponCodeError');
                            if (error.responseJSON.errors.code[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.code[0];
                            }
                        }
                        if (error.responseJSON.errors.name) {
                            var errMsg = document.getElementById('CouponNameError');
                            if (error.responseJSON.errors.name[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.name[0];
                            }
                        }
                        if (error.responseJSON.errors.discount_amount) {
                            var errMsg = document.getElementById('DiscountAmountError');
                            if (error.responseJSON.errors.discount_amount[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.discount_amount[0];
                            }
                        }


                        if (error.responseJSON.errors.min_amount) {
                            var errMsg = document.getElementById('MinAmountError');
                            if (error.responseJSON.errors.min_amount[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.min_amount[
                                    0];
                            }
                        }

                        if (error.responseJSON.errors.max_users) {
                            var errMsg = document.getElementById('UserError');
                            if (error.responseJSON.errors.max_users[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.max_users[0];
                            }
                        }
                        if (error.responseJSON.errors.max_uses_user) {
                            var errMsg = document.getElementById('UsesError');
                            if (error.responseJSON.errors.max_uses_user[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors
                                    .max_uses_user[0];
                            }
                        }
                        if (error.responseJSON.errors.description) {
                            var errMsg = document.getElementById('DescriptionError');
                            if (error.responseJSON.errors.description[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.description[
                                    0];
                            }
                        }
                        if (error.responseJSON.errors.type) {
                            var errMsg = document.getElementById('TypeError');
                            if (error.responseJSON.errors.type[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.type[0];
                            }
                        }
                        if (error.responseJSON.errors.status) {
                            var errMsg = document.getElementById('StatusError');
                            if (error.responseJSON.errors.status[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.status[0];
                            }
                        }

                        if (error.responseJSON.errors.starts_at) {
                            var errMsg = document.getElementById('StartAtError');
                            if (error.responseJSON.errors.starts_at[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.starts_at[0];
                            }
                        }
                        if (error.responseJSON.errors.expires_at) {
                            var errMsg = document.getElementById('ExpiresAtError');
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

<script>
    $(document).ready(function() {
        // Hide the discount fields initially
        $('#percentDiv').hide();

        // Event listener for the select element
        $('#type').change(function() {
            var selectedType = $(this).val();

            // If selected type is percent, show percent input field and hide fixed input field
            if (selectedType === 'percent') {
                $('#percentDiv').show();
                $('#fixedDiv').hide();
                // Disable validation for fixed input field
                $('#discount_amount').prop('required', false);
            } else {
                // If selected type is fixed, show fixed input field and hide percent input field
                $('#percentDiv').hide();
                $('#fixedDiv').show();
                // Enable validation for fixed input field
                $('#discount_amount').prop('required', true);
            }
        });
    });
</script>
