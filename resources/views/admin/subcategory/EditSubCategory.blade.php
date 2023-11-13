{{-- Edit Category --}}
<div class="modal fade" id="EditSubCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Edit Sub Category Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal1"></button>
            </div>
            <div class="modal-body">
                <form action="" id="Edit_subcategory_form">
                <input type="text" name="id" id="ideditSubCategory" hidden>
                <div class="mb-3">
                    <label for="name" class="control-label mb-1">Sub-Category<span
                            class="ms-1 text-danger">*</span></label>
                    <input id="name_edit" name="subcategory_name" type="text" class="form-control"
                        value="{{ old('name') }}" placeholder="Enter Sub Category Name">
                    <div class="invalid-feedback" id="SubcategoryNameEditError"></div>
                </div>

                <div class="mb-3">
                    <label>Category<span class="ms-1 text-danger">*</span></label>
                    <select id="category_id_edit" class="form-select" name="category_id">
                        <option class="" value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->category_name ?? '' }}</option>
                        @endforeach

                    </select>
                    <div class="invalid-feedback" id="CategoryIdEditError"></div>
                </div>
                <div class="mb-3">
                    <label for="email-field" class="form-label">Sub Category Slug<span
                            class="ms-1 text-danger">*</span></label>
                    <input type="text" id="slug_edit" name="subcategory_slug" class="form-control"
                        placeholder="SUb category Slug" />
                    <div class="invalid-feedback" id="SubcategorySlugEditError">Please Category Slug</div>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">SUb Category Status</label>
                    <div class="form-check mb-2">
                        <input class="form-check-input" id="flexRadioDefault1" type="radio" name="status"
                            value="1">
                        <label class="form-check-label" for="flexRadioDefault1">Available</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="flexRadioDefault2" type="radio" name="status"
                            checked="" value="0">
                        <label class="form-check-label" for="flexRadioDefault2">Unavailable</label>
                    </div>
                </div>



                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="edit-SubCategory">Add Category</button>
                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>


{{-- Edit Verification for Categroy --}}
<script>
    $(document).ready(function() {
        $('#edit-SubCategory').click(function(e) {
            console.log("u just clicekd add");
            e.preventDefault();
            var data = $('#Edit_subcategory_form').serialize();
            $.ajax({
            type: 'POST',
            url: "{{ route('admin.subcategory.update') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
                success: function(response) {
                    console.log("finally");
                showToast(response.message);

                $('#EditSubCategory').modal('hide');
                $('#datatable-crud').DataTable().ajax.reload();
                $('#successAlertContainer').html(successAlert);
            },
                error: function(error) {
                    console.log(error);
                document.getElementById('SubcategoryNameEditError').style.display = "none";
                document.getElementById('CategoryIdEditError').style.display = "none";
                document.getElementById('SubcategorySlugEditError').style.display = "none";
                if (error.responseJSON.errors.subcategory_name) {
                    // Only show if error is present
                    var errMsg = document.getElementById('SubcategoryNameEditError');
                    if (error.responseJSON.errors.subcategory_name[0]) {

                        errMsg.style.display = "block";
                        errMsg.textContent = error.responseJSON.errors.name[0];
                    }
                }
                if (error.responseJSON.errors.category_id) {
                    // Only show if error is present
                    var errMsg = document.getElementById('CategoryIdEditError');
                    if (error.responseJSON.errors.category_slug[0]) {
                        errMsg.style.display = "block";
                        errMsg.textContent = error.responseJSON.errors.category_id[0];
                    }
                }
                if (error.responseJSON.errors.subcategory_slug) {
                    // Only show if error is present
                    var errMsg = document.getElementById('SubcategorySlugEditError');
                    if (error.responseJSON.errors.subcategory_slug[0]) {
                        errMsg.style.display = "block";
                        errMsg.textContent = error.responseJSON.errors.slug[0];
                    }
                }
            }
            });

        });
    });
</script>

{{-- ---------------------- show edit for Subcategory  -------------------- --}}



<script>
    $(document).ready(function() {
     $('.data-table').on("click", ".editSubcategoryButton", function() {
         var id = $(this).data('id');
         console.log(id);
         $('#EditSubCategory').modal('show');
        $.ajax({
            type: 'GET',
            url: "{{ route('admin.subcategory.edit') }}",
            data: {
                id: id
            },
            success: function(response) {
                console.log(response);
                $('#ideditSubCategory').val(response.id);
                $('#name_edit').val(response.subcategory_name);
                $('#category_id_edit').val(response.category_id);
                $('#slug_edit').val(response.subcategory_name);
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

