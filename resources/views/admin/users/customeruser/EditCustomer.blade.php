{{-- Edit admin --}}
<div class="modal fade" id="EditCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Edit Customer Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal1"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="Edit_customer_form">
                    <div class="modal-body">
                        <input type="text" name="id" id="ideditUser" hidden>
                        <div class="mb-3">
                            <label for="Editadmin_name" class="control-label mb-1">Customer Name<span
                                    class="text-danger">*</span></label>
                            <input id="name_edit" name="name" type="text" class="form-control"
                                placeholder="Please enter name">
                            <div class="invalid-feedback" id="EditCustomerNameError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="Editusername" class="control-label mb-1">Customer UserName<span
                                    class="text-danger">*</span></label>
                            <input id="username_edit" name="username" type="text" class="form-control"
                                placeholder="Enter Username">
                            <div class="invalid-feedback" id="EditUserNameError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="Editphonenumber" class="control-label mb-1">Phone Number<span
                                    class="text-danger">*</span></label>
                            <input id="phonenumber_edit" name="phone_number" type="text" class="form-control"
                                placeholder="Enter Phone Number">
                            <div class="invalid-feedback" id="EditPhoneNumberError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="Editphonenumber" class="control-label mb-1">Email<span
                                    class="text-danger">*</span></label>
                            <input id="email_edit" name="email" type="email" class="form-control"
                                placeholder="Enter Email">
                            <div class="invalid-feedback" id="EditEmailError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">User Verify</label>
                        <div class="form-check mb-2">
                            <input class="form-check-input" id="Available_edit" type="radio" name="verify"  checked=""
                            value="1">
                        <label class="form-check-label" for="flexRadioDefault1">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="Unavailable_edit" type="radio" name="verify"
                            value="0">
                        <label class="form-check-label" for="flexRadioDefault2">No</label>
                        </div>
                    </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="edit-customer">Edit Customer User</button>
                            </div>
                        </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- Edit Verification for Brand --}}
<script>
    $(document).ready(function() {
        $('#edit-customer').click(function(e) {

            e.preventDefault();
            var data = $('#Edit_customer_form').serialize();
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.customer.update') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function(response) {

                    showToast(response.message);
                    $('#EditCustomer').modal('hide');
                    $('#datatable-crud').DataTable().ajax.reload();
                },
                error: function(error) {

                    document.getElementById('EditCustomerNameError').style.display = "none";
                    document.getElementById('EditUserNameError').style.display = "none";
                    document.getElementById('EditPhoneNumberError').style.display = "none";
                    document.getElementById('EditEmailError').style.display = "none";

                    if (error.responseJSON.errors.name) {
                        // Only show if error is present
                        var errMsg = document.getElementById('EditCustomerNameError');
                        if (error.responseJSON.errors.name[0]) {

                            errMsg.style.display = "block";
                            errMsg.textContent = error.responseJSON.errors.name[0];
                        }
                    }
                    if (error.responseJSON.errors.username) {
                        // Only show if error is present
                        var errMsg = document.getElementById('EditUserNameError');
                        if (error.responseJSON.errors.username[0]) {

                            errMsg.style.display = "block";
                            errMsg.textContent = error.responseJSON.errors.username[0];
                        }
                    }
                    if (error.responseJSON.errors.phone_number) {
                        // Only show if error is present
                        var errMsg = document.getElementById('EditPhoneNumberError');
                        if (error.responseJSON.errors.phone_number[0]) {

                            errMsg.style.display = "block";
                            errMsg.textContent = error.responseJSON.errors.phone_number[0];
                        }
                    }
                    if (error.responseJSON.errors.email) {
                        // Only show if error is present
                        var errMsg = document.getElementById('EditEmailError');
                        if (error.responseJSON.errors.email[0]) {

                            errMsg.style.display = "block";
                            errMsg.textContent = error.responseJSON.errors.email[0];
                        }
                    }

                }
            });

        });
    });
</script>

{{-- ---------------------- show edit for Customer  -------------------- --}}
<script>
    $(document).ready(function() {
        $('.data-table').on("click", ".editCustomerButton", function() {
            var id = $(this).data('id');

            $('#EditCustomer').modal('show');

            $.ajax({
                type: 'GET',
                url: "{{ route('admin.customer.edit') }}",
                data: {
                    id: id
                },
                success: function(response) {

                    $('#ideditUser').val(response.id);
                    $('#name_edit').val(response.name);
                    $('#username_edit').val(response.username);
                    $('#phonenumber_edit').val(response.phone_number);
                    $('#email_edit').val(response.email);
                    if (response.verify === 1) {
                        $('#Available_edit').prop('checked', true);
                    } else if (response.verify === 0) {
                        $('#Unavailable_edit').prop('checked', true);
                    }
                },
                error: function(error) {

                }
            });
        });
    });
</script>
