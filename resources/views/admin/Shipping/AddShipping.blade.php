{{-- Add Shipping --}}
<div class="modal fade" id="AddShipping" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add Shipping Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="#" method="post" id="Shipping-create-form">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>City<span class="ms-1 text-danger">*</span></label>
                        <select id="category_id" class="js-example-basic-singleEdit1 form-select" name="city_id">
                            <option class="" value="">City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">
                                    {{ $city->name ?? '' }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="CityIdError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="category_name" class="control-label mb-1">Amount<span
                                class="ms-1 text-danger">*</span></label>
                        <input id="name" name="amount" type="text" class="form-control"
                             placeholder="Enter Amount">
                        <div class="invalid-feedback" id="AmountError"></div>
                    </div>


                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="save-Shipping">Add Shipping</button>
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
        var dropdownParentEl = $('#AddShipping > .modal-dialog > .modal-content');
        $('.js-example-basic-singleEdit1').select2({
            dropdownParent: dropdownParentEl
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#save-Shipping').click(function(e) {
            e.preventDefault();
            var data = $('#Shipping-create-form').serialize();
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.shipping.create') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function(response) {
                    console.log("finally");
                    showToast(response.message);
                    $('#AddShipping').modal('hide');
                    $('#datatable-crud').DataTable().ajax.reload();
                },
                error: function(error) {
                    console.log(error);
                    document.getElementById('CityIdError').style.display = "none";
                    document.getElementById('AmountError').style.display = "none";

                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.city_id) {
                            var errMsg = document.getElementById('CityIdError');
                            if (error.responseJSON.errors.city_id[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.city_id[0];
                            }
                        }
                        if (error.responseJSON.errors.amount) {
                            var errMsg = document.getElementById('AmountError');
                            if (error.responseJSON.errors.amount[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.amount[0];
                            }
                        }

                    }
                }
            });
        });
    });
</script>

