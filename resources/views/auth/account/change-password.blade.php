@extends('auth.account.sidebar')
@section('all-content')
    <!-- User Information starts -->
    <div class="col-md-10 ms-3">
        <div class="card">
            <div class="card-header">
                <h2 class="h5 mb-0 pt-2 pb-2">Change Password</h2>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <form action="#" id="changePasswordForm">
                        <div class="mb-3">
                            <label for="name">Old Password</label>
                            <input type="password" name="old_password" id="old_password" placeholder="Old Password"
                                class="form-control">
                            <div class="invalid-feedback" id="OldPasswordError"></div>

                        </div>
                        <div class="mb-3">
                            <label for="name">New Password</label>
                            <input type="password" name="new_password" id="new_password" placeholder="New Password"
                                class="form-control">
                                <div class="invalid-feedback" id="NewPasswordError"></div>

                        </div>
                        <div class="mb-3">
                            <label for="name">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password"
                                placeholder="Confirm Password" class="form-control">
                                <div class="invalid-feedback" id="ConfirmPasswordError"></div>

                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" id="change-password-save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        //For ChangePassword form submit
        $(document).ready(function() {
            $('#change-password-save').click(function(e) {
                e.preventDefault();
                var data = $('#changePasswordForm').serialize();
                $.ajax({
                    url: "{{ route('user.PasswordChangePost') }}",
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function(response) {
                        if (response.status == true) {
                        localStorage.setItem("successMessage", response.message);
                        window.location.reload();
                        }
                         if (response.status == false) {
                            localStorage.setItem("errorMessage", response.message);
                            window.location.reload();
                        }
                    },
                    error: function(error) {
                        document.getElementById('OldPasswordError').style.display = "none";
                        document.getElementById('NewPasswordError').style.display = "none";
                        document.getElementById('ConfirmPasswordError').style.display = "none";
                        if (error.responseJSON.errors) {
                            if (error.responseJSON.errors.old_password) {
                                var errMsg = document.getElementById('OldPasswordError');
                                if (error.responseJSON.errors.old_password[0]) {
                                    errMsg.style.display = "block";
                                    errMsg.textContent = error.responseJSON.errors.old_password[0];
                                }
                            }
                            if (error.responseJSON.errors.new_password) {
                                var errMsg = document.getElementById('NewPasswordError');
                                if (error.responseJSON.errors.new_password[0]) {
                                    errMsg.style.display = "block";
                                    errMsg.textContent = error.responseJSON.errors.new_password[0];
                                }
                            }
                            if (error.responseJSON.errors.confirm_password) {
                                var errMsg = document.getElementById('ConfirmPasswordError');
                                if (error.responseJSON.errors.confirm_password[0]) {
                                    errMsg.style.display = "block";
                                    errMsg.textContent = error.responseJSON.errors.confirm_password[
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
