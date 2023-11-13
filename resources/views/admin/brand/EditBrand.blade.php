{{-- Edit Brands --}}
<div class="modal fade" id="EditBrand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add Brand Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="#" method="post" id="Brand-update-form" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="text" name="id" id="ideditBrand" hidden>
                    <div class="mb-3">
                        <label for="category_name" class="control-label mb-1">Brand Name</label>
                        <input id="brand_name_edit" name="name" type="text" class="form-control"
                            value="{{ old('name') }}" placeholder="Enter Brand Name">
                        <div class="invalid-feedback" id="EditBrandNameError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="brand_image_edit" class="form-label">Update Brand Image</label>
                        <input class="form-control" name="image" type="file" id="brand_image_edit">
                        <div class="invalid-feedback" id="EditBrandImageError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Brand Status</label>
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
                            <button type="submit" class="btn btn-success" id="update-Brand">Update Brand</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




{{-- ---------------------- Validation edit for Brand  -------------------- --}}

<script>
    $(document).ready(function() {
    $('#update-Brand').click(function(e) {
        console.log("You just clicked add");
        e.preventDefault();
        var formData = new FormData($('#Brand-update-form')[0]);
        var id = $('#ideditBrand').val();
        console.log(id);
        formData.append('id', id);
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.brand.update') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log("Finally");
                $('#EditBrand').modal('hide');
                showToast(response.message);
                $('#datatable-crud').DataTable().ajax.reload();
            },
            error: function(error) {
                console.log(error);
                document.getElementById('EditBrandNameError').style.display = "none";
                document.getElementById('EditBrandImageError').style.display = "none";
                if (error.responseJSON.errors.name) {
                        // Only show if error is present
                        var errMsg = document.getElementById('EditBrandNameError');
                        if (error.responseJSON.errors.name[0]) {

                            errMsg.style.display = "block";
                            errMsg.textContent = error.responseJSON.errors.name[0];
                        }
                    }
                    if (error.responseJSON.errors.image) {
                        // Only show if error is present
                        var errMsg = document.getElementById('EditBrandImageError');
                        if (error.responseJSON.errors.image[0]) {
                            errMsg.style.display = "block";
                            errMsg.textContent = error.responseJSON.errors.image
                        }

                    }
            }
        });
    });
});

</script>





{{-- ---------------------- show edit for Brand  -------------------- --}}
<script>
   $(document).ready(function() {
    $('.data-table').on("click", ".editBrandButton", function() {
        var id = $(this).data('id');
        console.log(id);
        $('#EditBrand').modal('show');
        $.ajax({
            type: 'GET',
            url: "{{ route('admin.brand.edit') }}",
            data: {
                id: id
            },
            success: function(response) {
                ;
                $('#ideditBrand').val(response.id);
                $('#brand_name_edit').val(response.name);
                if (response.status === 1) {
                    $('#Available_edit').prop('checked', true);
                } else if (response.status === 0) {
                    $('#Unavailable_edit').prop('checked', true);
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});

</script>
