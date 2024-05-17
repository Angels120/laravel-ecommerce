@extends('customer.layouts.app')
@section('container')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="text-center py-5">
                <div class="mb-4">
                    <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop"
                        colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon>
                </div>
                <h5>Thank you ! Your Order is Completed !</h5>
                <p class="text-muted">You will receive an order confirmation email with
                    details of your order.</p>

                <h3 class="fw-semibold">Order ID: {{$order->id}}<span id="orderID"
                        class="text-decoration-underline"></span>
                </h3>
            </div>
        </div>
    </div>
</div>

@endsection
