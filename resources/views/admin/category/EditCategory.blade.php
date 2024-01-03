{{-- Edit Category --}}
<div class="modal fade" id="EditCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal1"></button>
            </div>
            <div class="modal-body">
                <form action="#" id="Edit_category_form">
                    <input type="text" name="id" id="ideditCategory" hidden>
                    <div class="mb-3">
                        <label for="category_name" class="control-label mb-1">Category</label>
                        <input id="category_name_edit" name="category_name" type="text" class="form-control"
                            value="{{ old('category_name') }}" placeholder="Enter Category Name">
                        <div class="invalid-feedback" id="CategoryNameEditError">Please enter a customer name.</div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Category Status</label>
                        <div class="form-check mb-2">
                            <input class="form-check-input" id="Available_edit" type="radio" name="status"
                                value="1">
                            <label class="form-check-label" for="flexRadioDefault1">Available</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" id="Unavailable_edit" type="radio" name="status"
                                checked="" value="0">
                            <label class="form-check-label" for="flexRadioDefault2">Unavailable</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="Edit-Category">Update Category</button>
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
        $('#Edit-Category').click(function(e) {
            console.log("u just clicekd add");
            e.preventDefault();
            var data = $('#Edit_category_form').serialize();
            $.ajax({
            type: 'POST',
            url: "{{ route('admin.category.update') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
                success: function(response) {
                    console.log("finally");
                showToast(response.message);
                $('#EditCategory').modal('hide');
                $('#datatable-crud').DataTable().ajax.reload();
                $('#successAlertContainer').html(successAlert);
            },
                error: function(error) {
                    console.log(error);
                document.getElementById('CategoryNameEditError').style.display = "none";
                document.getElementById('CategorySlugEditError').style.display = "none";
                if (error.responseJSON.errors.category_name) {
                    // Only show if error is present
                    var errMsg = document.getElementById('CategoryNameEditError');
                    if (error.responseJSON.errors.category_name[0]) {

                        errMsg.style.display = "block";
                        errMsg.textContent = error.responseJSON.errors.category_name[0];
                    }
                }
                if (error.responseJSON.errors.category_slug) {
                    // Only show if error is present
                    var errMsg = document.getElementById('CategorySlugEditError');
                    if (error.responseJSON.errors.category_slug[0]) {
                        errMsg.style.display = "block";
                        errMsg.textContent = error.responseJSON.errors.category_slug[0];
                    }
                }
            }
            });

        });
    });
</script>

{{-- ---------------------- show edit for Category  -------------------- --}}
<script>
    $(document).ready(function() {
     $('.data-table').on("click", ".editCategoryButton", function() {
         var id = $(this).data('id');
         console.log(id);
         $('#EditCategory').modal('show');
        console.log("clicked");
        $.ajax({
            type: 'GET',
            url: "{{ route('admin.category.edit') }}",
            data: {
                id: id
            },
            success: function(response) {
                console.log(response);
                $('#ideditCategory').val(response.id);
                $('#category_name_edit').val(response.category_name);
                $('#category_slug_edit').val(response.category_slug);
                if (response.status === 1) {
                    $('#Available_edit').prop('checked', true);
                } else if (response.status === 0) {
                    $('#Unavailable_edit').prop('checked', true);
                }
            },
            error: function(error) {
                // Handle any errors that occurred during the request
                console.log(error);
            }
        });
     });
 });

 </script>



