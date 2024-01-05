{{-- Add admin  --}}
<div class="modal fade" id="AddAdminUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add Admin User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="#" method="post"  id="admin-create-form">

                <div class="modal-body">

                    <div class="mb-3">
                        <label for="admin_name" class="control-label mb-1">Admin Name<span class="text-danger">*</span></label>
                        <input id="admin_name" name="name" type="text" class="form-control"
                             placeholder="Enter name">
                        <div class="invalid-feedback" id="AdminNameError">Please enter a user name.</div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="control-label mb-1">UserName<span class="text-danger">*</span></label>
                        <input id="admin_username" name="username" type="text" class="form-control"
                           placeholder="Enter Username">
                        <div class="invalid-feedback" id="UserNameError">Please enter a username.</div>
                    </div>
                    <div class="mb-3">
                        <label for="phonenumber" class="control-label mb-1">Phone Number<span class="text-danger">*</span></label>
                        <input id="phonenumber" name="phone_number" type="number" class="form-control"
                      placeholder="Enter Phone Number">
                        <div class="invalid-feedback" id="PhoneNumberError">Please enter a phonenumber.</div>
                    </div>
                    <div class="mb-3">
                        <label for="phonenumber" class="control-label mb-1">Email<span class="text-danger">*</span></label>
                        <input id="email" name="email" type="email" class="form-control"
                          placeholder="Enter Email">
                        <div class="invalid-feedback" id="EmailError">Please enter a email.</div>
                    </div>
                    <div class="mb-3 position-relative auth-pass-inputgroup mb-3">
                        <label>Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input id="password" type="password" class="form-control password-input"
                                   name="password" autocomplete="new-password" placeholder="Password">
                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                    type="button" data-target="password">
                                <i class="ri-eye-fill align-middle"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback" id="PasswordError">Please enter a password.</div>
                    </div>

                    <div class="position-relative auth-pass-inputgroup mb-3">
                        <label>Confirm Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input id="password-confirm" type="password" class="form-control password-input"
                                   name="password_confirmation" autocomplete="new-password" placeholder="Confirm Password">
                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                    type="button" data-target="password-confirm">
                                <i class="ri-eye-fill align-middle"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback" id="ConfirmPasswordError">Please enter a password.</div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">User Verify</label>
                    <div class="form-check mb-2">
                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="verify"  checked=""
                        value="1">
                    <label class="form-check-label" for="flexRadioDefault1">Yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="flexRadioDefault2" type="radio" name="verify"
                        value="0">
                    <label class="form-check-label" for="flexRadioDefault2">No</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button  type="submit" class="btn btn-success" id="save-admin" >Add Admin User</button>
                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



{{-- password Hide and unhide js --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var passwordInputs = document.querySelectorAll('.password-input');
        var passwordAddons = document.querySelectorAll('.password-addon');

        passwordAddons.forEach(function (addon, index) {
            addon.addEventListener('click', function () {
                // Toggle the password input type between "password" and "text"
                var targetInput = passwordInputs[index];
                targetInput.type = (targetInput.type === 'password') ? 'text' : 'password';
            });
        });
    });
</script>


<script>
    function AddAdminUsermodel() {
        $('#AddAdminUser').modal('show');
    }
 </script>
{{-- Add Verification for Categroy --}}
<script>
    $(document).ready(function() {
        $('#save-admin').click(function(e) {

            e.preventDefault();
            var data = $('#admin-create-form').serialize();
            $.ajax({
            type: 'POST',
            url: "{{ route('admin.user.create') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
                success: function(response) {
                    showToast(response.message);
                    $('#AddAdminUser').modal('hide');
                    $('#datatable-crud').DataTable().ajax.reload();
            },
                error: function(error) {

                document.getElementById('AdminNameError').style.display = "none";
                document.getElementById('UserNameError').style.display = "none";
                document.getElementById('PhoneNumberError').style.display = "none";
                document.getElementById('EmailError').style.display = "none";
                document.getElementById('PasswordError').style.display = "none";
                document.getElementById('ConfirmPasswordError').style.display = "none";
                if (error.responseJSON.errors.name) {
                    // Only show if error is present
                    var errMsg = document.getElementById('AdminNameError');
                    if (error.responseJSON.errors.name[0]) {

                        errMsg.style.display = "block";
                        errMsg.textContent = error.responseJSON.errors.name[0];
                    }
                }
                if (error.responseJSON.errors.username) {
                    // Only show if error is present
                    var errMsg = document.getElementById('UserNameError');
                    if (error.responseJSON.errors.username[0]) {

                        errMsg.style.display = "block";
                        errMsg.textContent = error.responseJSON.errors.username[0];
                    }
                }
                if (error.responseJSON.errors.phone_number) {
                    // Only show if error is present
                    var errMsg = document.getElementById('PhoneNumberError');
                    if (error.responseJSON.errors.phone_number[0]) {

                        errMsg.style.display = "block";
                        errMsg.textContent = error.responseJSON.errors.phone_number[0];
                    }
                }
                if (error.responseJSON.errors.email) {
                    // Only show if error is present
                    var errMsg = document.getElementById('EmailError');
                    if (error.responseJSON.errors.email[0]) {

                        errMsg.style.display = "block";
                        errMsg.textContent = error.responseJSON.errors.email[0];
                    }
                }
                if (error.responseJSON.errors.password) {
                    // Only show if error is present
                    var errMsg = document.getElementById('PasswordError');
                    if (error.responseJSON.errors.password[0]) {
                        errMsg.style.display = "block";
                        errMsg.textContent = error.responseJSON.errors.password[0];
                    }
                }
                if (error.responseJSON.errors.password_confirmation) {
                    // Only show if error is present
                    var errMsg = document.getElementById('ConfirmPasswordError');
                    if (error.responseJSON.errors.password_confirmation[0]) {
                        errMsg.style.display = "block";
                        errMsg.textContent = error.responseJSON.errors.password_confirmation[0];
                    }
                }
            }
            });

        });
    });
</script>

