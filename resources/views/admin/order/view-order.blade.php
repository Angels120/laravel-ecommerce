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
                <div class="d-flex gap-2">
                    <div class="card" style="width: 75%; height: auto; ">
                        <div class="card-body" style="box-shadow: 0 0 10px rgba(135, 128, 128, 0.2);">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Shipping Address:</h4>
                                        <div class="fw-bold fs-4" id="fullname"></div>
                                        <div class="fs-5 my-2" id="email"></div>
                                        <div class="fs-5 my-2" id="phone"></div>
                                        <div class="fs-5 my-2" id="province"></div>
                                        <div class="fs-5 my-2" id="city"></div>
                                        <div class="fs-5 my-2" id="address"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3>
                                            <span class="fw-bold" style="display: inline-block;">Order:</span>
                                            <div id="idOrder" style="display: inline-block; white-space: nowrap;">
                                            </div>
                                        </h3>
                                        <h3>
                                            <span class="fw-bold" style="display: inline-block;">Total:</span>
                                            <div id="totalorderamount"
                                                style="display: inline-block; white-space: nowrap;"></div>
                                        </h3>
                                        <h2>
                                            <span class="fw-bold" style="display: inline-block;">Status:</span>
                                            <div id="status" style="display: inline-block; white-space: nowrap;">
                                            </div>
                                        </h2>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div style="width: 25%; ">
                        <div class="card ">
                            <div class="card-body" style="box-shadow: 0 0 10px rgba(135, 128, 128, 0.2);">
                                <h5>
                                    Order Status
                                </h5>
                                <form action="#" method="post" id="order-update-form">
                                    <input type="text" name="id" id="ideditOrder" hidden>

                                    <div class="col-lg-12">
                                        <label>Status<span class="ms-1 text-danger">*</span></label>
                                        <select id="status_edit" class="form-select" name="status">
                                            <option class="" value="">Select Status</option>
                                            <option value="pending">Pending</option>
                                            <option value="delivered">Delivered</option>
                                            <option value="shipped">Shipped</option>
                                        </select>
                                        <div class="invalid-feedback" id="StatusEditError"></div>
                                    </div>
                                    <div class="col-lg-12 mt-4">
                                        <label>Shipped Date<span class="ms-1 text-danger">*</span></label>
                                        <input type="datetime-local" class="form-control" name="shipped_date">
                                        <div class="invalid-feedback" id="ShippedEditError"></div>
                                    </div>
                                    <div class="col-lg-12 mt-4">
                                        <label>Send Invoice Email<span class="ms-1 text-danger">*</span></label>
                                        <select id="city_edit" class="form-select" name="">
                                            <option class="" value="">Select Status</option>
                                            <option value="pending">Pending</option>
                                            <option value="delivered">Delivered</option>
                                            <option value="shipped">Shipped</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="mt-2 btn btn-success" id="update-order">Update
                                        Order</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="mb-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product </th>
                                <th>Price</th>
                                <th>quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                        <tbody id="product_table">
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>
</div>




{{-- Edit Verification for Shipping --}}
<script>
    $(document).ready(function() {
        $('#update-order').click(function(e) {

            e.preventDefault();
            var data = $('#order-update-form').serialize();
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.order.update') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function(response) {
                    showToast(response.message);
                    $('#EditOrder').modal('hide');
                    $('#datatable-crud').DataTable().ajax.reload();
                },
                error: function(error) {
                    console.log(error);
                    document.getElementById('StatusEditError').style.display =
                        "none";
                    document.getElementById('ShippedEditError').style.display =
                        "none";

                    if (error.responseJSON.errors.status) {
                        // Only show if error is present
                        var errMsg = document.getElementById('StatusEditError');
                        if (error.responseJSON.errors.status[0]) {

                            errMsg.style.display = "block";
                            errMsg.textContent = error.responseJSON.errors.status[0];
                        }
                    }
                    if (error.responseJSON.errors.shipped_date) {
                        // Only show if error is present
                        var errMsg = document.getElementById('ShippedEditError');
                        if (error.responseJSON.errors.shipped_date[0]) {
                            errMsg.style.display = "block";
                            errMsg.textContent = error.responseJSON.errors.shipped_date[0];
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
                    console.log(response);
                    var selectedStatus = response.order.status;
                    $('#status_edit').val(selectedStatus).trigger('change');
                    $('#ideditOrder').val(response.order.id);
                    $('#amount_edit').val(response.order.amount);
                    $('#idOrder').text(' #' + response.order.id);
                    $('#fullname').text('Fullname: ' + response.order.full_name);
                    $('#totalorderamount').text('Rs ' + response.order.grand_total);
                    $('#email').text('Email: ' + response.order.email);
                    $('#phone').text('phone: ' + response.order.phone);
                    $('#province').text('Province: ' + response.order.province.name);
                    $('#city').text('City: ' + response.order.city.name);
                    $('#address').text('Address: ' + response.order.address);

                    var statusText = response.order.status;
                    $('#status').text(statusText);
                    if (statusText === 'shipped') {
                        $('#status').addClass('text-primary');
                    } else if (statusText === 'pending') {
                        $('#status').addClass('text-danger');
                    } else if (statusText === 'delivered') {
                        $('#status').addClass('text-success');
                    }


                    //Tables data from here
                    var orderItems = response.orderItems;

                    // Iterate over order items and append product names to the table
                    // Append OrderItem rows
                    orderItems.forEach(function(item) {
                        var row = '<tr>' +
                            '<td>' + item.name + '</td>' +
                            '<td>' + 'Rs. ' + item.price + '</td>' +
                            '<td>' + item.qty + '</td>' +
                            '<td>' + 'Rs. ' + item.total + '</td>' +
                            '</tr>';
                        $('#product_table').append(row);
                    });


                    // Append total row
                    var totalRow = '<tr>' +
                        '<td colspan="3" class="text-end"><strong>Subtotal:</strong></td>' +
                        '<td><strong>Rs. ' + response.order.subtotal + '</strong></td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td colspan="3" class="text-end"><strong>Discount:</strong></td>' +
                        '<td><strong>Rs. ' + response.order.discount + '</strong></td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td colspan="3" class="text-end"><strong>Shipping:</strong></td>' +
                        '<td><strong>Rs. ' + response.order.shipping + '</strong></td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td colspan="3" class="text-end"><strong>Grand Total:</strong></td>' +
                        '<td><strong>Rs. ' + response.order.grand_total + '</strong></td>' +
                        '</tr>';
                    $('#product_table').append(totalRow);

                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>
