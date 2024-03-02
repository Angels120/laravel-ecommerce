@extends('auth.account.sidebar')
@section('all-content')
    <div class="col-md-10 ms-3">
        <div class="card">
            <div class="card-header">
                <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
            </div>
            <div class="card-body p-4">
                @if ($wishlists->isNotEmpty())
                    @foreach ($wishlists as $wishlist)
                        <div class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom">
                            <div class="d-block d-sm-flex align-items-start text-center text-sm-start"><a
                                    class="d-block flex-shrink-0 mx-auto me-sm-4" href="#" style="width: 10rem;"> <img class="img-fluid d-block"
                                    src="{{ asset('uploads/products/' . ($wishlist->product->image[0] ?? '')) }}"
                                    alt=""></a>
                                <div class="pt-2">
                                    <h3 class="product-title fs-base mb-2"><a href="{{ route('product.detail', $wishlist->product->slug) }}">{{$wishlist->product->name}}</a>
                                    </h3>
                                    <div class="fs-lg text-accent pt-2">Rs. {{ number_format($wishlist->product->price,2) }}</div>
                                </div>
                            </div>
                            <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                <button onclick="removeProduct({{ $wishlist->product_id }});" class="btn btn-outline-danger btn-sm" type="button"><i
                                        class="fas fa-trash-alt me-2"></i>Remove</button>
                            </div>
                        </div>
                    @endforeach
                @else
                <div>
                    <h2>Your WishList is Empty!!</h2>

                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>

function removeProduct(id) {
    $.ajax({
        url: '{{ route("user.wishlist.remove") }}',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { id: id },
        dataType: 'json',
        success: function (response) {
            if(response.status==true){
                localStorage.setItem("successMessage", response.message);
                window.location.href="{{ route('user.wishlist') }}"
            }
        },

    });
}
$(document).ready(function() {
            var errorMessage = localStorage.getItem('errorMessage');
            var successMessage = localStorage.getItem('successMessage');
            if (errorMessage) {
                showErrorToast(errorMessage);
                localStorage.removeItem('errorMessage');
            }
            if (successMessage) {
                showToast(successMessage);
                localStorage.removeItem('successMessage');
            }
        });
</script>
@endsection
