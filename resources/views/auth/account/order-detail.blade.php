@extends('auth.account.sidebar')
@section('all-content')

    <div class="col-md-12 ms-3">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2 class="h5 mb-0 pt-2 pb-2">Order: {{ $order->id }}</h2>
                    </div>

                    <div class="card-body pb-0">
                        <!-- Info -->
                        <div class="card card-sm">
                            <div class="card-body bg-light mb-3">
                                <div class="row">
                                    <div class="col-6 col-lg-3">
                                        <!-- Heading -->
                                        <h6 class=" text-muted">Order No:</h6>
                                        <!-- Text -->
                                        <p class="mb-lg-0 fs-sm fw-bold">
                                        {{ $order->id }}
                                        </p>
                                    </div>
                                    <div class="col-6 col-lg-3">
                                        <!-- Heading -->
                                        <h6 class=" text-muted">Shipped date:</h6>
                                        <!-- Text -->
                                        <p class="mb-lg-0 fs-sm fw-bold">
                                            <time datetime="2019-10-01">
                                                01 Oct, 2019
                                            </time>
                                        </p>
                                    </div>
                                    <div class="col-6 col-lg-3">
                                        <!-- Heading -->
                                        <h6 class=" text-muted">Status:</h6>
                                        <!-- Text -->
                                        <p class="mb-0 fs-sm fw-bold">
                                            @if( $order->status=='pending')
                                            <span class="badge bg-danger">Pending</span>
                                            @elseif( $order->status=='shipped' )
                                            <span class="badge bg-info">Shipped</span>
                                            @else
                                            <span class="badge bg-success">Status</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-6 col-lg-3">
                                        <!-- Heading -->
                                        <h6 class=" text-muted">Order Amount:</h6>
                                        <!-- Text -->
                                        <p class="mb-0 fs-sm fw-bold">
                                         Rs {{ number_format($order->grand_total,2) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer p-3">

                        <!-- Heading -->
                        <h6 class="mb-7 h5 mt-4">Order Items ({{ $orderItems->count() }})</h6>

                        <!-- Divider -->
                        <hr class="my-3">

                        <!-- List group -->
                        <ul>
                            @foreach ($orderItems as $item)

                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-4 col-md-3 col-xl-2">
                                        <!-- Image -->
                                        <a href="product.html"><img src="{{ asset('uploads/products/' . ($item->product->image[0] ?? '')) }}"
                                            alt="..." class="img-fluid"></a>
                                    </div>
                                    <div class="col">
                                        <!-- Title -->
                                        <p class="mb-4 fs-md fw-bold">
                                            <a class="text-body" href="product.html">{{ $item->name }} x {{ $item->qty }}</a> <br>
                                            <span class="text-muted">Rs {{ number_format($item->total,2) }}</span>
                                        </p>
                                    </div>
                                </div>
                            </li>

                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="card card-lg mb-5 mt-3">
                    <div class="card-body">
                        <!-- Heading -->
                        <h6 class="mt-0 mb-3 h5">Order Total</h6>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td class="text-end">Rs. {{ number_format($order->subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Discount{{ (!empty($order->coupon_code) ? ' ('.$order->coupon_code.')' : '') }}</td>
                                    <td class="text-end">Rs. {{ number_format($order->discount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td class="text-end">Rs. {{ number_format($order->shipping, 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Total</td>
                                    <td class="text-end fw-bold">Rs. {{ number_format($order->grand_total, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
