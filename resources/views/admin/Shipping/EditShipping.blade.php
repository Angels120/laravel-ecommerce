{{-- Edit Shipping --}}
<div class="modal fade" id="EditShipping" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Edit Shipping Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal1"></button>
            </div>
            <div class="modal-body">
                <form action="" id="Edit_shipping_form">
                    <input type="text" name="id" id="ideditShipping" hidden>


                    <div class="mb-3">
                        <label>City<span class="ms-1 text-danger">*</span></label>
                        <select id="city_edit" class="js-example-basic-singleEdit2 form-select" name="city_id">
                            <option class="" value="">Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">
                                    {{ $city->name ?? '' }}</option>
                            @endforeach

                        </select>
                        <div class="invalid-feedback" id="ShippingCityEditError"></div>
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


<script>
    $(document).ready(function() {
        var dropdownParentEl = $('#EditShipping > .modal-dialog > .modal-content');
        $('.js-example-basic-singleEdit2').select2({
            dropdownParent: dropdownParentEl
        });
    });
</script>

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
                    document.getElementById('ShippingAmountEditError').style.display = "none";

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

{{-- ---------------------- show edit for Shipping charge  -------------------- --}}

<script>
    $(document).ready(function() {
        $('.data-table').on("click", ".editShippingButton", function() {
            var id = $(this).data('id');
            $('#EditShipping').modal('show');
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.shipping.edit') }}",
                data: {
                    id: id
                },
                success: function(response) {
                    var selectedCityId = response.city_id;
                    console.log(selectedCityId);
                    // Set the selected option using Select2's val method
                    $('#city_edit').val(selectedCityId).trigger('change');
                    $('#ideditShipping').val(response.id);

                    $('#amount_edit').val(response.amount);

                },
                error: function(error) {
                    // Handle any errors that occurred during the request
                    console.log(error);
                }
            });
        });
    });
</script>
