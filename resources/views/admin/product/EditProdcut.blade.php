{{-- Edit Product --}}
<div class="modal fade" id="EditProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="#" method="post" id="product-edit-form" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="d-flex gap-2">
                        <div class="card" style="width: 65%; height: auto; ">
                            <div class="card-body" style="box-shadow: 0 0 10px rgba(135, 128, 128, 0.2);">
                                <h5>
                                    Product
                                </h5>
                                <div class="row">
                                    <input type="text" name="id" id="ideditProduct" hidden>
                                    <div class="col-lg-12 mt-2">
                                        <label for="name" class="control-label mb-1">Product Name<span
                                                class="ms-1 text-danger">*</span></label>
                                        <input id="Editname" name="name" type="text" class="form-control"
                                            value="{{ old('name') }}" placeholder="Enter Product Name">
                                        <div class="invalid-feedback" id="EditProductNameError"></div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <div>
                                                <label for="descriptionInput" class="form-label">
                                                    Description
                                                </label>
                                                <div id="Editeditor"></div>
                                                <input type="hidden" name="description"
                                                    value="{{ old('description') }}" id="Editeditor_input">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="width: 35%; ">
                            <div class="card ">
                                <div class="card-body" style="box-shadow: 0 0 10px rgba(135, 128, 128, 0.2);">
                                    <h5>
                                        Product Status
                                    </h5>
                                    <div class="col-lg-12">
                                        <label for="status" class="control-label mb-1">Product Status<span
                                                class="ms-1 text-danger">*</span></label>
                                        <select id="Editproductstatus" class="form-select" name="status">
                                            <option value="1" selected>Active</option>
                                            <option value="0">InActive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card " style="width ">
                                <div class="card-body" style="box-shadow: 0 0 10px rgba(135, 128, 128, 0.2);">
                                    <h5>
                                        Product Category
                                    </h5>
                                    <div class="col-lg-12 mt-2">
                                        <label for="category" class="control-label mb-1">Category<span
                                                class="ms-1 text-danger">*</span></label>
                                        <select id="Editcategory_id" class="js-example-basic-singleEdit"
                                            name="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->category_name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback" id="EditProductCategoryError"></div>

                                    </div>

                                    <div class="col-lg-12 mt-2">
                                        <label for="subcategory" class="control-label mb-1">Sub Category<span
                                                class="ms-1 text-danger">*</span></label>
                                        <select id="Editsub_categories_id" class="js-example-basic-singleEdit"
                                            name="sub_categories_id">

                                            @foreach ($subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}">
                                                    {{ $subcategory->subcategory_name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback" id="EditProductSubCategoryError"></div>

                                    </div>

                                    <div class="col-lg-12 mt-2">
                                        <label for="brand" class="control-label mb-1">Brand</label>
                                        <select id="Editbrand_id" class="js-example-basic-singleEdit" name="brands_id">
                                            <option class="" value="">Select Brands</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">
                                                    {{ $brand->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="invalid-feedback" id="EditProductBrandError"></div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body" style="box-shadow: 0 0 10px rgba(135, 128, 128, 0.2);">
                                    <h5>
                                        Product Featured
                                    </h5>
                                    <div class="col-lg-12">
                                        <select id="Editfeatured" class="form-select" name="featured">
                                            <option value="0" selected>No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="width: 100%;">
                        <div class="card-body" style="box-shadow: 0 0 10px rgba(135, 128, 128, 0.2);">
                            <div class="row my-6">
                                <div class="col-lg-12">
                                    <h5>Product Images</h5>
                                    {{-- <input class="form-control" name="image[]" type="file" id="EditProduct_images"> --}}
                                    <input type="file" name="image[]" class="filepond filepond-input-multiple"
                                        multiple data-allow-reorder="true" data-max-file-size="3MB"
                                        data-max-files="5">
                                </div>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <!-- New card for storing images, side by side with the file input -->
                                <div class="card" style="width: 100%;">
                                    <div class="card-body" style="box-shadow: 0 0 10px rgba(135, 128, 128, 0.2);">
                                        <div class="row my-6">
                                            <div id="Editimage" class="col-6">
                                                <div id="ImageContainer"></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invalid-feedback" id="EditProductImagesError"></div>
                        </div>
                    </div>


                    <div class="d-flex gap-2">
                        <div class="card" style="width: 50%;">
                            <div class="card-body" style="box-shadow: 0 0 10px rgba(135, 128, 128, 0.2);">
                                <div class="col-lg-12">
                                    <h5>Product Price</h5>
                                    <h6 class="text-muted">#(Put the actual price of product in compare price field and
                                        discount price in price field)</h6>

                                        <label for="name" class="control-label mb-1">Compare Price<span
                                                class="ms-1 text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="product-discount-addon">Nrs</span>
                                            <input type="text" name="compare_price" class="form-control"
                                                id="Edit-compare-product-price" placeholder="Enter Actual Price">
                                        </div>
                                        <div class="invalid-feedback" id="EditProductComparePriceError"></div>

                                    <div class="d-flex">
                                        <div class="me-3">
                                            <label for="name" class="control-label mb-1">Discount</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="product-discount-addon">%</span>
                                                <input type="text" name="discount" class="form-control"
                                                    id="Editproduct-discount" placeholder="Enter discount">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="name" class="control-label mb-1">Price
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="product-discount-addon">Nrs</span>
                                                <input type="text" name="price" class="form-control"
                                                    id="Editproduct-price" placeholder="Enter Discount  Price">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback" id="EditProductPriceError"></div>
                                </div>
                            </div>
                        </div>


                        <div class="card" style="width: 50%;">
                            <div class="card-body" style="box-shadow: 0 0 10px rgba(135, 128, 128, 0.2);">
                                <div class="col-lg-12">
                                    <h5>
                                        Product Stock
                                    </h5>
                                    <div class="col-lg-12 mt-2">
                                        <label for="name" class="control-label mb-1">In Stock<span
                                                class="ms-1 text-danger">*</span></label>
                                        <input id="EditStock" name="stock" type="text" class="form-control"
                                            value="{{ old('name') }}" placeholder="Stocks">
                                        <div class="invalid-feedback" id="EditProductStockError"></div>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <label for="name" class="control-label mb-1">Available Sizes</label>
                                        <select id="Editsizes" class="js-example-basic-singleEdit form-select"
                                            multiple name="sizes">
                                            <option value="S" selected>Small</option>
                                            <option value="M">Medium</option>
                                            <option value="L">Large</option>
                                            <option value="XL">Extra Large</option>
                                            <option value="XXL">Double Extra Large</option>
                                        </select>
                                        <div class="invalid-feedback" id="EditProductSizesError"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="edit-Product-button">Edit
                                Product</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="deleteProductImages" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="box-shadow: 0 0 10px rgba(18, 16, 16, 0.2);">
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
                        <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Image for this Product?
                            This cannot be undo!</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn w-sm btn-danger " id="deleteProductImagesButton">Yes, Delete
                        It!</button>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Edit Verification for Prodcut --}}
<script>
    $(document).ready(function() {


        $('#edit-Product-button').click(function(e) {
            e.preventDefault();

            // Get the data from the CKEditor
            var editorData = editorInstance ? editorInstance.getData() : '';

            // Create a new FormData object
            var formData = new FormData(document.getElementById('product-edit-form'));

            // Append the CKEditor data to the formData
            formData.append('description', editorData);



            $.ajax({
                type: 'POST',
                url: "{{ route('admin.product.update') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log("finally");
                    showToast(response.message);
                    $('#EditProduct').modal('hide');
                    $('#datatable-crud').DataTable().ajax.reload();
                    $('#successAlertContainer').html(successAlert);
                },
                error: function(error) {

                    console.log(error);
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.name) {
                            var errMsg = document.getElementById('EditProductNameError');
                            if (error.responseJSON.errors.name[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.name[0];
                            }
                        }
                        if (error.responseJSON.errors.category_id) {
                            var errMsg = document.getElementById(
                            'EditProductCategoryError');
                            if (error.responseJSON.errors.category_id[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.category_id[
                                    0];
                            }
                        }
                        if (error.responseJSON.errors.sub_categories_id) {
                            var errMsg = document.getElementById(
                                'EditProductSubCategoryError');
                            if (error.responseJSON.errors.sub_categories_id[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors
                                    .sub_categories_id[0];
                            }
                        }
                        if (error.responseJSON.errors.image) {
                            var errMsg = document.getElementById('EditProductImagesError');
                            if (error.responseJSON.errors.image[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.image[0];
                            }
                        }
                        if (error.responseJSON.errors.compare_price) {
                            var errMsg = document.getElementById('EditProductComparePriceError');
                            if (error.responseJSON.errors.compare_price[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.compare_price[0];
                            }
                        }
                        if (error.responseJSON.errors.price) {
                            var errMsg = document.getElementById('EditProductPriceError');
                            if (error.responseJSON.errors.price[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.price[0];
                            }
                        }
                        if (error.responseJSON.errors.stock) {
                            var errMsg = document.getElementById('EditProductStockError');
                            if (error.responseJSON.errors.stock[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.stock[0];
                            }
                        }
                    }
                }
            });

        });
    });
</script>

{{-- Select2 JS --}}
<script>
    $(document).ready(function() {
        var dropdownParentEl = $('#EditProduct > .modal-dialog > .modal-content');
        $('.js-example-basic-singleEdit').select2({
            dropdownParent: dropdownParentEl
        });
    });
</script>

{{-- ---------------------- show edit for Product  -------------------- --}}
<script>
    $(document).ready(function() {
        $('.data-table').on("click", ".editProductButton", function() {
            var id = $(this).data('id');

            $('#EditProduct').modal('show');
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.product.edit') }}",

                data: {
                    id: id
                },
                success: function(response) {
                    console.log(response)
                    var productDescription = response.description;
                    var imageNames = response.image;
                    var imageContainer = $('#ImageContainer');
                    imageContainer.empty();

                    var imagesRow = $('<div class="d-flex flex-wrap"></div>');
                    imageNames.forEach(function(imageName) {
                        var imageUrl = "{{ asset('uploads/products/') }}/" +
                            imageName;
                        var imageDiv = $(
                            `<div class="image-container position-relative d-inline-block m-2">
             <img src="${imageUrl}" alt="Product Image" style="width: 100px; height: 100px; border: 1px solid #ddd; border-radius: 4px;">
             <button type="button" class="close position-absolute top-0 end-0 mt-2">
            <span aria-hidden="true">&times;</span>
                </button>
                    </div>`
                        );

                        imagesRow.append(imageDiv);
                        imageDiv.find('.close').on('click', function() {
                            $('#deleteProductImages').modal('show');

                            // Event handler for "Yes, Delete It!" button click
                            $('#deleteProductImagesButton').on('click',
                                function() {
                                    $.ajax({
                                        type: 'DELETE',
                                        url: '{{ route('admin.product.image.unlink') }}',
                                        headers: {
                                            'X-CSRF-TOKEN': $(
                                                'meta[name="csrf-token"]'
                                            ).attr(
                                                'content')
                                        },
                                        data: {
                                            productId: id,
                                            image: imageName
                                        }, // Pass the necessary data
                                        success: function(
                                            response) {
                                            // Handle success
                                            imageDiv
                                                .remove();
                                            $('#deleteProductImages')
                                                .modal(
                                                    'hide');
                                        },
                                        error: function(error) {
                                            // Handle error
                                            console.log(
                                                'Error removing image'
                                            );
                                        }
                                    });

                                });
                        });
                    });
                    imageContainer.append(imagesRow);
                    initializeEditor('#Editeditor', productDescription);
                    $('#ideditProduct').val(response.id);
                    $('#Editname').val(response.name);
                    $('#Editcategory_id').val(response.category_id).trigger('change');
                    $('#Editcategory_id option').each(function() {
                        if ($(this).val() == response.category_id) {
                            $(this).prop('selected', true);
                        }
                    });
                    $('#Editsub_categories_id').val(response.sub_categories_id).trigger(
                        'change');
                    $('#Editsub_categories_id option').each(function() {
                        if ($(this).val() == response.sub_categories_id) {
                            $(this).prop('selected', true);
                        }
                    });
                    $('#Editbrand_id').val(response.brands_id).trigger('change');
                    $('#Editbrand_id option').each(function() {
                        if ($(this).val() == response.brands_id) {
                            $(this).prop('selected', true);
                        }
                    });
                    $('#Editproduct-price').val(response.price);
                    $('#Edit-compare-product-price').val(response.compare_price);
                    $('#Editproduct-discount').val(response.discount);
                    $('#EditStock').val(response.stock);
                    $('#Editproductstatus').val(response.status);
                    $('#Editsizes').val(response.sizes);
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

    function initializeEditor(editorElement, productDescription) {
        if (editorInstance) {
            editorInstance.destroy().then(() => {
                createNewEditorInstance(editorElement, productDescription);
            });
        } else {
            createNewEditorInstance(editorElement, productDescription);
        }
    }

    function createNewEditorInstance(editorElement, productDescription) {
        editorInstance = ClassicEditor
            .create(document.querySelector(editorElement), {
                // Configuration options for the editor (if needed)
            })
            .then(editor => {
                // Set the editor data to display the task description
                editor.setData(productDescription ?? '');
                editorInstance = editor;
            })
            .catch(error => {
                console.error(error);
            });
    }
</script>

<script>
    $(document).ready(function() {
        // Function to calculate discounted price and update the "Price" field
        function updatePrice() {
            // Get values from the "Compare Price" and "Discount" fields
            var comparePrice = parseFloat($('#Edit-compare-product-price').val()) || 0;
            var discount = parseFloat($('#Editproduct-discount').val()) || 0;

            // Calculate discounted price
            var discountedPrice = comparePrice - (comparePrice * discount / 100);

            // Update the "Price" field with the calculated discounted price
            $('#Editproduct-price').val(discountedPrice.toFixed(2));
        }

        // Bind the updatePrice function to the input fields' change events
        $('#Edit-compare-product-price, #Editproduct-discount').on('input', updatePrice);
    });
</script>
