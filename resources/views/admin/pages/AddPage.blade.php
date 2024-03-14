{{-- Add Page --}}
<div class="modal fade" id="AddPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add Page Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="#" method="post" id="Page-create-form">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="control-label mb-1">Page Name</label>
                        <input id="name" name="name" type="text" class="form-control"
                             placeholder="Enter Page Name">
                        <div class="invalid-feedback" id="PageNameError"></div>
                    </div>

                    <div class="mb-3">
                        <div class="col-12">
                            <div>
                                <label for="contentInput" class="form-label">
                                   Content
                                </label>
                                <div id="editor"></div>
                                <input type="hidden" name="content" id="content_input">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="save-Page">Add Page</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- ckeditor for description --}}
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            editor.model.document.on('change:data', () => {
                document.getElementById('content_input').value = editor.getData();
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    $(document).ready(function() {

        $('#save-Page').click(function(e) {
            e.preventDefault();
            var formData = new FormData($('#Page-create-form')[0]);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.page.create') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                $('#AddPage').modal('hide');
                showToast(response.message);
                $('#datatable-crud').DataTable().ajax.reload();

                },
                error: function(error) {
                    document.getElementById('PageNameError').style.display = "none";
                    if (error.responseJSON.errors.name) {
                        var errMsg = document.getElementById('PageNameError');
                        if (error.responseJSON.errors.name[0]) {

                            errMsg.style.display = "block";
                            errMsg.textContent = error.responseJSON.errors.name[0];
                        }
                    }
                }
            });

        });
    });
</script>
