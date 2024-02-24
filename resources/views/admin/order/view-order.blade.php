{{-- Edit Shipping --}}
<div class="modal fade" id="EditOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Edit Order Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal1"></button>
            </div>
            <div class="modal-body">
                <form action="" id="Edit_shipping_form">
                    <input type="text" name="id" id="ideditOrder" hidden>
                    <div class="d-flex gap-2">
                        <div class="card" style="width: 65%; height: auto; ">
                            <div class="card-body" style="box-shadow: 0 0 10px rgba(135, 128, 128, 0.2);">
                                <h5>
                                    Order
                                </h5>
                                <div class="row">
                                    <h3>Shipping Address:</h3>
                                    <div class="fw-bold fs-4" id="fullname"></div>
                                    <div class=" fs-4" id="email"></div>
                                    <div class="fs-4" id="phone"></div>
                                    <div class=" fs-4" id="address"></div>
                                </div>
                            </div>
                        </div>
                        <div style="width: 35%; ">
                            <div class="card ">
                                <div class="card-body" style="box-shadow: 0 0 10px rgba(135, 128, 128, 0.2);">
                                    <h5>
                                        Order Status
                                    </h5>
                                    <div class="col-lg-12">
                                        <label>Status<span class="ms-1 text-danger">*</span></label>
                                        <select id="status_edit" class="form-select" name="status">
                                            <option class="" value="">Select Status</option>
                                            <option value="pending">Pending</option>
                                            <option value="delivered">Delivered</option>
                                            <option value="shipped">Shipped</option>

                                        </select>
                                        <div class="invalid-feedback" id="ShippingCityEditError"></div>
                                    </div>
                                    <div class="col-lg-12 mt-4">
                                        <label>Send Invoice Email<span class="ms-1 text-danger">*</span></label>
                                        <select id="city_edit" class="js-example-basic-singleEdit2 form-select"
                                            name="city_id">
                                            <option class="" value="">Select Status</option>
                                            <option value="pending">Pending</option>
                                            <option value="delivered">Delivered</option>
                                            <option value="shipped">Shipped</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="name" class="control-label mb-1">Amount<span
                                class="ms-1 text-danger">*</span></label>
                        <input id="amount_edit" name="amount" type="text" class="form-control"
                            value="{{ old('name') }}" placeholder="Enter Amount">
                        <div class="invalid-feedback" id="ShippingAmountEditError"></div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="edit-Shipping">Edit Shipping
                                Charge</button>
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
        $('#edit-Shipping').click(function(e) {

            e.preventDefault();
            var data = $('#Edit_shipping_form').serialize();
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.shipping.update') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function(response) {
                    showToast(response.message);
                    $('#EditShipping').modal('hide');
                    $('#datatable-crud').DataTable().ajax.reload();
                },
                error: function(error) {
                    console.log(error);
                    document.getElementById('ShippingCityEditError').style.display =
                        "none";
                    document.getElementById('ShippingAmountEditError').style.display =
                        "none";

                    if (error.responseJSON.errors.city_id) {
                        // Only show if error is present
                        var errMsg = document.getElementById('ShippingCityEditError');
                        if (error.responseJSON.errors.city_id[0]) {

                            errMsg.style.display = "block";
                            errMsg.textContent = error.responseJSON.errors.city_id[0];
                        }
                    }
                    if (error.responseJSON.errors.amount) {
                        // Only show if error is present
                        var errMsg = document.getElementById('ShippingAmountEditError');
                        if (error.responseJSON.errors.amount[0]) {
                            errMsg.style.display = "block";
                            errMsg.textContent = error.responseJSON.errors.amount[0];
                        }
                    }

                }
            });

        });
    });
</script>

{{-- ---------------------- show edit for Order -------------------- --}}

<script>
    $(document).ready(function() {
        $('.data-table').on("click", ".editOrderButton", function() {
            var id = $(this).data('id');
            $('#EditOrder').modal('show');
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.order.edit') }}",
                data: {
                    id: id
                },
                success: function(response) {
                    var selectedStatus = response.status;
                    // Set the selected option using Select2's val method
                    $('#status_edit').val(selectedStatus).trigger('change');
                    $('#ideditOrder').val(response.id);
                    $('#amount_edit').val(response.amount);
                    $('#fullname').text('Fullname: ' + response.full_name);
                    $('#email').text('Email: ' + response.email);
                    $('#phone').text('phone: ' + response.phone);
                    $('#address').text('Address: ' + response.address);
                },
                error: function(error) {
                    // Handle any errors that occurred during the request
                    console.log(error);
                }
            });
        });
    });
</script>
