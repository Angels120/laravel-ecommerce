{{-- Add Category --}}
<div class="modal fade" id="AddSubCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add Category Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="#" method="post" id="SubCategory-create-form">

                <div class="modal-body">


                    <div class="mb-3">
                        <label for="category_name" class="control-label mb-1">Sub-Category<span
                                class="ms-1 text-danger">*</span></label>
                        <input id="name" name="subcategory_name" type="text" class="form-control"
                            value="{{ old('subcategory_name') }}" placeholder="Enter Sub Category Name">
                        <div class="invalid-feedback" id="SubcategoryNameError"></div>
                    </div>

                    <div class="mb-3">
                        <label>Category<span class="ms-1 text-danger">*</span></label>
                        <select id="category_id" class="form-select" name="category_id">
                            <option class="" value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->category_name ?? '' }}</option>
                            @endforeach

                        </select>
                        <div class="invalid-feedback" id="CategoryIdError"></div>
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
                            <button type="submit" class="btn btn-success" id="save-SubCategory">Add Sub Category</button>
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
        $('#save-SubCategory').click(function(e) {
            e.preventDefault();
            var data = $('#SubCategory-create-form').serialize();
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.subcategory.create') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function(response) {
                    console.log("finally");
                    showToast(response.message);
                    $('#AddSubCategory').modal('hide');
                    $('#datatable-crud').DataTable().ajax.reload();
                },
                error: function(error) {
                    console.log(error);
                    document.getElementById('SubcategoryNameError').style.display = "none";
                    document.getElementById('CategoryIdError').style.display = "none";
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.subcategory_name) {
                            var errMsg = document.getElementById('SubcategoryNameError');
                            if (error.responseJSON.errors.subcategory_name[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.subcategory_name[0];
                            }
                        }
                        if (error.responseJSON.errors.category_id) {
                            var errMsg = document.getElementById('CategoryIdError');
                            if (error.responseJSON.errors.category_id[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.category_id[0];
                            }
                        }
                    }
                }
            });
        });
    });
</script>

