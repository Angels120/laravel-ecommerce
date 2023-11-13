{{-- Add Category --}}
<div class="modal fade" id="AddCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add Category Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="#" method="post"  id="Category-create-form">

                <div class="modal-body">


                    <div class="mb-3">
                        <label for="category_name" class="control-label mb-1">Category</label>
                        <input id="category_name" name="category_name" type="text" class="form-control"
                            value="{{ old('category_name') }}" placeholder="Enter Category Name">
                        <div class="invalid-feedback" id="CategoryNameError">Please enter a customer name.</div>
                    </div>

                    <div class="mb-3">
                        <label for="email-field" class="form-label">Category Slug</label>
                        <input type="text" id="category_slug" name="category_slug" class="form-control"
                            placeholder="category Slug" />
                        <div class="invalid-feedback" id="CategorySlugError">Please Category Slug</div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Category Status</label>
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
                        <button  type="submit" class="btn btn-success" id="save-Category" >Add Category</button>
                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function AddCategorymodel() {
        console.log("clicked");
        $('#AddCategory').modal('show');
    }
 </script>
{{-- Add Verification for Categroy --}}
<script>
    $(document).ready(function() {
        $('#save-Category').click(function(e) {
            console.log("u just clicekd add");
            e.preventDefault();
            var data = $('#Category-create-form').serialize();
            $.ajax({
            type: 'POST',
            url: "{{ route('admin.category.create') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
                success: function(response) {
                    showToast(response.message);
                    $('#AddCategory').modal('hide');
                    $('#datatable-crud').DataTable().ajax.reload();
            },
                error: function(error) {
                    console.log(error);
                document.getElementById('CategoryNameError').style.display = "none";
                document.getElementById('CategorySlugError').style.display = "none";
                if (error.responseJSON.errors.category_name) {
                    // Only show if error is present
                    var errMsg = document.getElementById('CategoryNameError');
                    if (error.responseJSON.errors.category_name[0]) {

                        errMsg.style.display = "block";
                        errMsg.textContent = error.responseJSON.errors.category_name[0];
                    }
                }
                if (error.responseJSON.errors.category_slug) {
                    // Only show if error is present
                    var errMsg = document.getElementById('CategorySlugError');
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

