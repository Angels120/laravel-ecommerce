{{-- Add Brand --}}
<div class="modal fade" id="AddBrand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add Brand Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="#" method="post" id="Brand-create-form" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="brand_name" class="control-label mb-1">Brand Name</label>
                        <input id="name" name="name" type="text" class="form-control"
                            value="{{ old('name') }}" placeholder="Enter Brand Name">
                        <div class="invalid-feedback" id="BrandNameError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="Image" class="form-label">Brand Image</label>
                        <input name="image" type="file" id="BrandImage" class="form-control">
                        <div class="invalid-feedback" id="BrandImageError"></div>

                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Brand Status</label>
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
                            <button type="submit" class="btn btn-success" id="save-Brand">Add Brand</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $('#save-Brand').click(function(e) {
            e.preventDefault();
            var formData = new FormData($('#Brand-create-form')[0]);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.brand.create') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                $('#AddBrand').modal('hide');
                showToast(response.message);
                $('#datatable-crud').DataTable().ajax.reload();

                },
                error: function(error) {
                    console.log(error);
                    document.getElementById('BrandNameError').style.display = "none";
                    document.getElementById('BrandImageError').style.display = "none";
                    if (error.responseJSON.errors.name) {
                        var errMsg = document.getElementById('BrandNameError');
                        if (error.responseJSON.errors.name[0]) {

                            errMsg.style.display = "block";
                            errMsg.textContent = error.responseJSON.errors.name[0];
                        }
                    }
                    if (error.responseJSON.errors.image) {
                        // Only show if error is present
                        var errMsg = document.getElementById('BrandImageError');
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
