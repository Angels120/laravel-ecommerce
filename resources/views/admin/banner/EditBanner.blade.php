{{-- Edit Banners --}}
<div class="modal fade" id="EditBanner" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add Banner Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="#" method="post" id="Banner-update-form" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="text" name="id" id="ideditBanner" hidden>
                    <div class="mb-3">
                        <label for="category_name" class="control-label mb-1">Banner Name</label>
                        <input id="Banner_name_edit" name="name" type="text" class="form-control"
                            value="{{ old('name') }}" placeholder="Enter Banner Name">
                        <div class="invalid-feedback" id="EditBannerNameError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="Banner_image_edit" class="form-label">Update Banner Image</label>
                        <input class="form-control" name="image" type="file" id="Banner_image_edit">
                        <div class="invalid-feedback" id="EditBannerImageError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Banner Status</label>
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
                            <button type="submit" class="btn btn-success" id="update-Banner">Update Banner</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




{{-- ---------------------- Validation edit for Banner  -------------------- --}}

<script>
    $(document).ready(function() {
    $('#update-Banner').click(function(e) {
        console.log("You just clicked add");
        e.preventDefault();
        var formData = new FormData($('#Banner-update-form')[0]);
        var id = $('#ideditBanner').val();
        console.log(id);
        formData.append('id', id);
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.banner.update') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log("Finally");
                $('#EditBanner').modal('hide');
                showToast(response.message);
                $('#datatable-crud').DataTable().ajax.reload();
            },
            error: function(error) {
                console.log(error);
                document.getElementById('EditBannerNameError').style.display = "none";
                document.getElementById('EditBannerImageError').style.display = "none";
                if (error.responseJSON.errors.name) {
                        // Only show if error is present
                        var errMsg = document.getElementById('EditBannerNameError');
                        if (error.responseJSON.errors.name[0]) {

                            errMsg.style.display = "block";
                            errMsg.textContent = error.responseJSON.errors.name[0];
                        }
                    }
                    if (error.responseJSON.errors.image) {
                        // Only show if error is present
                        var errMsg = document.getElementById('EditBannerImageError');
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





{{-- ---------------------- show edit for Banner  -------------------- --}}
<script>
   $(document).ready(function() {
    $('.data-table').on("click", ".editBannerButton", function() {
        var id = $(this).data('id');
        console.log(id);
        $('#EditBanner').modal('show');
        $.ajax({
            type: 'GET',
            url: "{{ route('admin.banner.edit') }}",
            data: {
                id: id
            },
            success: function(response) {
                ;
                $('#ideditBanner').val(response.id);
                $('#Banner_name_edit').val(response.name);
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
