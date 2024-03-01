<!-- JAVASCRIPT -->
 <script src="{{ asset('admin_asset/libs/bootstrap/js/bootstrap.min.js') }}"></script>
 <script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
</script>
 <script src="{{ asset('admin_asset/libs/simplebar/simplebar.min.js') }}"></script>
 <script src="{{ asset('admin_asset/libs/node-waves/waves.min.js') }}"></script>
 <script src="{{ asset('admin_asset/libs/feather-icons/feather.min.js') }}"></script>
 <script src="{{ asset('admin_asset/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
 <script src="{{ asset('admin_asset/js/plugins.js') }}"></script>

 {{-- ck editor --}}
 <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>


 {{-- <script src="{{ asset('admin_asset/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script> --}}
 <!-- apexcharts -->
 <script src="{{ asset('admin_asset/libs/apexcharts/apexcharts.min.js') }}"></script>

 <!-- Vector map-->
 <script src="{{ asset('admin_asset/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
 <script src="{{ asset('admin_asset/libs/jsvectormap/maps/world-merc.js') }}"></script>

 <!--Swiper slider js-->
 <script src="{{ asset('admin_asset/libs/swiper/swiper-bundle.min.js') }}"></script>


<!-- swiper.init js -->
<script src="{{ asset('admin_asset/js/pages/swiper.init.js') }}"></script>
 <!-- Dashboard init -->
 <script src="{{ asset('admin_asset/js/pages/dashboard-ecommerce.init.js') }}"></script>
 <script src="{{ asset('admin_asset/js/pages/ecommerce-product-details.init.js') }}"></script>

 <script src="{{ asset('admin_asset/js/pages/ecommerce-product-checkout.init.js') }}"></script>



 <!-- init js -->
 <script src="{{ asset('admin_asset/js/pages/form-editor.init.js') }}"></script>
 <!-- App js -->
 <script src="{{ asset('admin_asset/js/app.js') }}"></script>



 <!-- filepond js -->

 <script src="{{ asset('admin_asset/libs/filepond/filepond.min.js') }}"></script>
 <script src="{{ asset('admin_asset/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}">
 </script>
 <script
     src="{{ asset('admin_asset/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
 </script>
 <script
     src="{{ asset('admin_asset/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
 </script>
 <script src="{{ asset('admin_asset/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>
 <script src="{{ asset('admin_asset/js/pages/form-file-upload.init.js') }}"></script>
 <!-- include jQuery library -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
 <script src="{{ asset('admin_asset/js/pages/datatables.init.js') }}"></script>




 <!--datatable js-->
 <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

 <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>



 <!-- Select2 -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
 <!-- range Slider js -->
 <script src="{{ asset('admin_asset/js/ion.rangeSlider.min.js') }}"></script>

 <script>
    function addToCart(id) {
        $.ajax({
            url: '{{ route("carts.add") }}',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { id: id },
            dataType: 'json',
            success: function (response) {
                if(response.status==true){
                    localStorage.setItem("successMessage", response.message);
                    window.location.href="{{ route('carts.details') }}"
                }else{
                    alert('Your Product already added');
                    $('#cartErrorModal').modal('show');

                }
            },

        });
    }
    function addToWishlist(id) {
        $.ajax({
            url: '{{ route("wishlists.add") }}',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { id: id },
            dataType: 'json',
            success: function (response) {
                if(response.status==true){
                    showToast(response.message);
                }else{
                    window.location.href="{{ route('login') }}"
                }
            },

        });
    }
 </script>
