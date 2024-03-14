{{-- Edit Pages --}}
<div class="modal fade" id="EditPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add Page Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="#" method="post" id="Page-update-form">
                <div class="modal-body">
                    <input type="text" name="id" id="ideditPage" hidden>
                    <div class="mb-3">
                        <label for="name" class="control-label mb-1">Page Name</label>
                        <input id="page_name_edit" name="name" type="text" class="form-control"
                            placeholder="Enter Page Name">
                        <div class="invalid-feedback" id="EditPageNameError"></div>
                    </div>
                    <div class="mb-3">
                        <div>
                            <label for="descriptionInput" class="form-label">
                                Page Content
                            </label>
                            <div id="Editeditor"></div>
                            <input type="hidden" name="content" id="Editeditor_input">
                        </div>
                    </div>



                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="update-Page">Update Page</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




{{-- ---------------------- Validation edit for Page  -------------------- --}}

<script>
    $(document).ready(function() {
        $('#update-Page').click(function(e) {
            e.preventDefault();
            var editorData = editorInstance ? editorInstance.getData() : '';

            var formData = new FormData($('#Page-update-form')[0]);
            formData.append('content', editorData);

            var id = $('#ideditPage').val();
            formData.append('id', id);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.page.update') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#EditPage').modal('hide');
                    showToast(response.message);
                    $('#datatable-crud').DataTable().ajax.reload();
                },
                error: function(error) {
                    document.getElementById('EditPageNameError').style.display = "none";
                    if (error.responseJSON.errors.name) {
                        // Only show if error is present
                        var errMsg = document.getElementById('EditPageNameError');
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





{{-- ---------------------- show edit for Page  -------------------- --}}
<script>
    $(document).ready(function() {
        $('.data-table').on("click", ".editPageButton", function() {
            var id = $(this).data('id');
            console.log(id);
            $('#EditPage').modal('show');
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.page.edit') }}",
                data: {
                    id: id
                },
                success: function(response) {

                    $('#ideditPage').val(response.id);
                    $('#page_name_edit').val(response.name);
                    var PageDescription = response.content;
                    initializeEditor('#Editeditor', PageDescription);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

{{-- For CkEditor DAta Retrive --}}
<script>
    var editorInstance = null;
    function initializeEditor(editorElement, PageDescription) {
        if (editorInstance) {
            editorInstance.destroy().then(() => {
                createNewEditorInstance(editorElement, PageDescription);
            });
        } else {
            createNewEditorInstance(editorElement, PageDescription);
        }
    }

    function createNewEditorInstance(editorElement, PageDescription) {
        editorInstance = ClassicEditor
            .create(document.querySelector(editorElement), {
                // Configuration options for the editor (if needed)
            })
            .then(editor => {
                // Set the editor data to display the task description
                editor.setData(PageDescription ?? '');
                editorInstance = editor;
            })
            .catch(error => {
                console.error(error);
            });
    }
</script>
