@extends('auth.account.sidebar')
@section('all-content')
    <div class="col-md-10 ms-3">
        <div class="card">
            <div class="card-header">
                <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
            </div>

            <div class="card-body pb-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Orders #</th>
                                <th>Date Purchased</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->isNotEmpty())
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            <a href="order-detail.php">{{ $order->id }}</a>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</td>
                                        <td>
                                            <span class="badge bg-success">{{ $order->status }}</span>
                                        </td>
                                        <td>Rs. {{number_format($order->grand_total,2)}}</td>
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="3" class="text-center fs-1  font-weight-bold">Orders Not Found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    @endsection
