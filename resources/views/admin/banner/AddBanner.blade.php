<!--  Add Banner -->
<div class="modal fade" id="AddBanner" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add Banner Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="#" method="post" id="Banner-create-form" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Banner_name" class="control-label mb-1">Banner Name</label>
                        <input id="name" name="name" type="text" class="form-control"
                            value="{{ old('name') }}" placeholder="Enter Banner Name">
                        <div class="invalid-feedback" id="BannerNameError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="Image" class="form-label">Banner Image</label>
                        <input name="image" type="file" id="BannerImage" class="form-control">
                        <div class="invalid-feedback" id="BannerImageError"></div>
                        <span class="text-success">Image size recomended is height: 740 px width: 1600 px</span>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Banner Status</label>
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
                            <button type="submit" class="btn btn-success" id="save-banner">Add Banner</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $('#save-banner').click(function(e) {
            e.preventDefault();
            var formData = new FormData($('#Banner-create-form')[0]);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.banner.create') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                $('#AddBanner').modal('hide');
                showToast(response.message);
                $('#datatable-crud').DataTable().ajax.reload();

                },
                error: function(error) {
                    console.log(error);
                    document.getElementById('BannerNameError').style.display = "none";
                    document.getElementById('BannerImageError').style.display = "none";
                    if (error.responseJSON.errors.name) {
                        var errMsg = document.getElementById('BannerNameError');
                        if (error.responseJSON.errors.name[0]) {

                            errMsg.style.display = "block";
                            errMsg.textContent = error.responseJSON.errors.name[0];
                        }
                    }
                    if (error.responseJSON.errors.image) {
                        // Only show if error is present
                        var errMsg = document.getElementById('BannerImageError');
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
