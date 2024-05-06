<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- JAVASCRIPT -->
 <script src="{{ asset('admin_asset/libs/bootstrap/js/bootstrap.min.js') }}"></script>

 <script src="{{ asset('admin_asset/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
 <script src="{{ asset('admin_asset/js/plugins.js') }}"></script>


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




 <!-- include jQuery library -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>


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
