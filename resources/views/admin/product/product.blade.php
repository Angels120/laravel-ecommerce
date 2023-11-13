@extends('admin.layouts.app')
@section('container')
    <div class="col-12">
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Product</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Add, Edit & Remove</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="listjs-table" id="customerList">
                                        <div class="row g-4 mb-3">
                                            <div class="col-sm-auto">
                                                <div>
                                                    <button type="button" class="btn btn-success add-btn"
                                                        data-bs-toggle="modal" id="create-btn"
                                                        data-bs-target="#AddProduct"><i
                                                            class="ri-add-line align-bottom me-1"></i> Add</button>
                                                    <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i
                                                            class="ri-delete-bin-2-line"></i></button>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            <table  id="datatable-crud" class="table nowrap align-middle list-data-table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Product Name</th>
                                                        <th>Product Slug</th>
                                                        <th>Category</th>
                                                        <th>Sub Category</th>
                                                        <th>Discount</th>
                                                        <th>Product Images</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div><!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- container-fluid -->
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade zoomIn" id="deleteCategory" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you Sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger " id="deleteCategoryButton">Yes, Delete
                            It!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end modal -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    @include('admin.product.EditProdcut')
    @include('admin.product.AddProduct')

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#datatable-crud').DataTable({
                processing: true,
                serverSide: true,
                url: "{{ route('admin.brands.index') }}",
                columns: [{
                        data: 'id',
                    },
                    {
                        data: 'name',

                    },
                    {
                        data: 'slug',

                    },
                    {
                        data: 'category',

                    },
                    {
                        data: 'sub_category',

                    },
                    {
                        data: 'discount',

                    },
                    {
                        data: 'images',

                    },

                    {
                        data: 'status',
                    },
                    {
                        data: 'action',
                    }
                ],
                order: [
                    [0, 'asc'] // Sort by the second column (category_name) in ascending order
                ]
            });


        });

        function confirmDelete(button) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const id = $(button).data("id"); // Retrieve data-id from the clicked button
            const deleteUrl = "{{ route('admin.category.delete', ['id' => ':id']) }}";
            const urlWithId = deleteUrl.replace(':id', id);
            $('#deleteCategory').modal('show');
            $('#deleteCategoryButton').on('click', function() {
                console.log('clicked')
                $.ajax({
                    type: 'DELETE',
                    url: urlWithId,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        showToast(response.message);
                        $('#datatable-crud').DataTable().ajax.reload();
                        $('#successAlertContainer').html(successAlert);
                    },
                    error: function(error) {
                        showErrorToast(error);
                    },
                });
                $('#deleteCategory').modal('hide');
            });

        }
    </script>

@endsection
