{{-- Add Product --}}
<div class="modal fade" id="AddProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add Product Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="#" method="post" id="product-create-form" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="d-flex gap-2">
                        <div class="card" style="width: 65%; height: auto; ">
                            <div class="card-body" style="box-shadow: 0 0 10px rgba(135, 128, 128, 0.2);">
                                <h5>
                                    Product
                                </h5>
                                <div class="row">
                                    <div class="col-lg-12 mt-2">
                                        <label for="name" class="control-label mb-1">Product Name<span
                                                class="ms-1 text-danger">*</span></label>
                                        <input id="name" name="name" type="text" class="form-control"
                                            value="{{ old('name') }}" placeholder="Enter Product Name">
                                        <div class="invalid-feedback" id="ProductNameError"></div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <div>
                                                <label for="descriptionInput" class="form-label">
                                                    Description
                                                </label>
                                                <div  id="editor"></div>
                                                <input type="hidden" name="description"
                                                value="{{ old('description') }}" id="editor_input">
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
                                        <select id="productstatus" class="form-select" name="status">
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
                                        <select id="category_id" class="js-example-basic-singleEdit1" name="category_id">
                                            <option class="" value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->category_name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback" id="ProductCategoryError"></div>

                                    </div>
                                    <div id="subcategory-select" class="d-none">
                                        <div class="col-lg-12 mt-2">
                                            <label for="subcategory" class="control-label mb-1">Sub Category<span
                                                    class="ms-1 text-danger">*</span></label>
                                            <select id="sub_categories_id" class="js-example-basic-singleEdit1"
                                                name="sub_categories_id">
                                                <option class="" value="">Select Sub-Category</option>
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}">
                                                        {{ $subcategory->subcategory_name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback" id="ProductSubCategoryError"></div>

                                        </div>
                                    </div>
                                    <div id="brand-select" class="d-none">
                                        <div class="col-lg-12 mt-2">
                                            <label for="brand" class="control-label mb-1">Brand</label>
                                            <select id="brand_id" class="js-example-basic-singleEdit1" name="brands_id">
                                                <option class="" value="">Select Brands</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">
                                                        {{ $brand->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="invalid-feedback" id="ProductBrandError"></div>

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body" style="box-shadow: 0 0 10px rgba(135, 128, 128, 0.2);">
                                    <h5>
                                        Product Featured
                                    </h5>
                                    <div class="col-lg-12">
                                        <select id="featured" class="form-select" name="featured">
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
                                        <h5>
                                            Product Images
                                        </h5>
                                        <input type="file" class="filepond filepond-input-multiple w-100" multiple name="image[]" data-allow-reorder="true"  data-max-file-size="3MB" data-max-files="5">
                                </div>
                            </div>
                            <div class="invalid-feedback" id="ProductImagesError"></div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <div class="card" style="width: 50%;">
                            <div class="card-body" style="box-shadow: 0 0 10px rgba(135, 128, 128, 0.2);">
                                <div class="col-lg-12">
                                    <h5>
                                        Product Price
                                    </h5>
                                    <div class="col-lg-12 mt-2">
                                        <label for="name" class="control-label mb-1">Price<span
                                                class="ms-1 text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="product-discount-addon">Nrs</span>
                                            <input type="text" name="price" class="form-control"
                                                id="product-price" placeholder="Enter Price">
                                        </div>
                                        <div class="invalid-feedback" id="ProductPriceError"></div>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <label for="name" class="control-label mb-1">Discount</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="product-discount-addon">%</span>
                                            <input type="text" name="discount" class="form-control"
                                                id="product-discount" placeholder="Enter discount">
                                        </div>
                                    </div>
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
                                        <input id="stock" name="stock" type="text" class="form-control"
                                            value="{{ old('name') }}" placeholder="Stocks">
                                        <div class="invalid-feedback" id="ProductStockError"></div>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <label for="name" class="control-label mb-1">Available Sizes</label>
                                        <select id="sizes" class="form-select" name="sizes">
                                            <option value="S" selected>Small</option>
                                            <option value="M">Medium</option>
                                            <option value="L">Large</option>
                                            <option value="XL">Extra Large</option>
                                            <option value="XXL">Double Extra Large</option>
                                        </select>
                                        <div class="invalid-feedback" id="ProductSizesError"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="save-Product">Add Product</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('.js-example-basic-singleEdit1').select2({
            dropdownParent: $('#AddProduct')
        });
    });
</script>

{{-- ckeditor for description --}}
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            editor.model.document.on('change:data', () => {
                document.getElementById('editor_input').value = editor.getData();
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    $(document).ready(function() {
        $('#category_id').change(function() {
            if ($(this).val()) {
                $('#subcategory-select').removeClass('d-none');
                $('#brand-select').removeClass('d-none');
            } else {
                $('#subcategory-select').addClass('d-none');
                $('#brand-select').addClass('d-none');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#category_id').change(function() {
            var categoryId = $(this).val();
            if (categoryId) {
                console.log(categoryId)
                var url = "{{ route('admin.subcategories.get', ['id' => ':id']) }}";
                var urlWithId = url.replace(':id', categoryId);
                $.ajax({
                    type: "GET",
                    url: urlWithId,
                    success: function(res) {
                        if (res) {
                            $("#sub_categories_id").empty();
                            $("#sub_categories_id").append(
                                '<option value="">Select Sub-Category</option>');
                            $.each(res, function(key, value) {
                                $("#sub_categories_id").append('<option value="' +
                                    value.id + '">' + value.subcategory_name +
                                    '</option>');
                            });
                        } else {
                            $("#sub_categories_id").empty();
                        }
                    }
                });
            } else {
                $("#sub_categories_id").empty();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#save-Product').click(function(e) {
            e.preventDefault();

            var data = $('#product-create-form').serializeArray();


            $.ajax({
                type: 'POST',
                url: "{{ route('admin.product.create') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function(response) {
                    console.log("finally");
                    showToast(response.message);
                    $('#AddProduct').modal('hide');
                    $('#datatable-crud').DataTable().ajax.reload();
                    $('#successAlertContainer').html(successAlert);
                },
                error: function(error) {
                    console.log(error);
                    document.getElementById('ProductNameError').style.display = "none";
                    document.getElementById('ProductCategoryError').style.display = "none";
                    document.getElementById('ProductSubCategoryError').style.display ="none";
                    document.getElementById('ProductBrandError').style.display = "none";
                    document.getElementById('ProductImagesError').style.display = "none";
                    document.getElementById('ProductPriceError').style.display = "none";
                    document.getElementById('ProductStockError').style.display = "none";
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.name) {
                            var errMsg = document.getElementById('ProductNameError');
                            if (error.responseJSON.errors.name[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.name[0];
                            }
                        }
                        if (error.responseJSON.errors.category_id) {
                            var errMsg = document.getElementById('ProductCategoryError');
                            if (error.responseJSON.errors.category_id[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.category_id[
                                    0];
                            }
                        }
                        if (error.responseJSON.errors.sub_categories_id) {
                            var errMsg = document.getElementById('ProductSubCategoryError');
                            if (error.responseJSON.errors.sub_categories_id[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors
                                    .sub_categories_id[0];
                            }
                        }
                        if (error.responseJSON.errors.brands_id) {
                            var errMsg = document.getElementById('ProductBrandError');
                            if (error.responseJSON.errors.brands_id[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.brands_id[0];
                            }
                        }
                        if (error.responseJSON.errors.image) {
                            var errMsg = document.getElementById('ProductImagesError');
                            if (error.responseJSON.errors.image[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.image[0];
                            }
                        }
                        if (error.responseJSON.errors.price) {
                            var errMsg = document.getElementById('ProductPriceError');
                            if (error.responseJSON.errors.price[0]) {
                                errMsg.style.display = "block";
                                errMsg.textContent = error.responseJSON.errors.price[0];
                            }
                        }
                        if (error.responseJSON.errors.stock) {
                            var errMsg = document.getElementById('ProductStockError');
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
