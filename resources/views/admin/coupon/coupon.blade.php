@extends('admin.layouts.app')
@section('page_head', 'Coupon Details')
@section('container')

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
                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#AddCoupon"><i
                                            class="ri-add-line align-bottom me-1"></i> Add</button>
                                    <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i
                                            class="ri-delete-bin-2-line"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="display table list-data-table data-table" style="width:100%" id="datatable-crud">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Coupon Code</th>
                                        <th>Coupon Name</th>
                                        <th>Discount Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                </tbody>
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

    <!-- Modal -->
    <div class="modal fade zoomIn" id="deleteCoupon" tabindex="-1" aria-hidden="true">
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
                        <button type="button" class="btn w-sm btn-danger " id="deleteCouponButton">Yes, Delete
                            It!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end modal -->
    @include('admin.Coupon.AddCoupon')
    @include('admin.Coupon.EditCoupon')


    <script>
        $(document).ready(function() {
            $('#datatable-crud').DataTable({
                "processing": true,
                "serverSide": true,
                ajax: {
                    "url": "{{ route('admin.coupon.index') }}",
                    "data": function(d) {
                        d._token = "{{ csrf_token() }}";
                    }
                },
                columns: [{
                        data: 'id',
                    },
                    {
                        data: 'coupon_code',

                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'discount_amount',
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

        var urlWithId = "";
        $(document).ready(function() {
            $('.data-table').on("click", ".delete", function() {
                var couponId = $(this).data('id');
                const deleteUrl = "{{ route('admin.coupon.delete', ['id' => ':id']) }}";
                urlWithId = deleteUrl.replace(':id', couponId);
                $('#deleteCouponButton').data('couponId-id', couponId);
                $('#deleteCoupon').modal('show');
            });
            $('#deleteCouponButton').click(function() {
                var couponId = $(this).data('couponId-id');
                $.ajax({
                    type: 'DELETE',
                    url: urlWithId,
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        showToast(response.message);
                        $('#deleteCoupon').modal('hide');
                        $('#datatable-crud').DataTable().ajax.reload();
                    },
                    error: function(error) {
                        console.error('Delete error:', error);
                    }
                });
            });
        });
    </script>
    {{-- For Status Update Script --}}
    <script>
        $(document).on('click', '.btn-status', function(e) {
            e.preventDefault();

            var form = $(this).closest('form');
            var url = form.attr('action');

            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(),
                success: function(response) {
                    showToast(response.message);
                    // You can add additional logic here if needed
                    // For example, updating the button color and text based on the new status

                    // Reload the DataTable after successful status update
                    $('#datatable-crud').DataTable().ajax.reload();
                },
                error: function(error) {
                    console.error('Error updating status:', error);
                }
            });
        });
    </script>
@endsection
