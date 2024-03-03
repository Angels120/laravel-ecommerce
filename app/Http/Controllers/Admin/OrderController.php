<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = [

            'breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'current_menu' => 'Orders',
            ],

        ];
        $index = 1;
        if ($request->ajax()) {
            $orders = Order::all();
            return DataTables::of($orders)
                ->addIndexColumn()
                ->editColumn('id', function ($row) use (&$index) {
                    $currentIndex = $index;
                    $index++;
                    return $currentIndex;
                })
                ->editColumn('customer_name', function ($row) {
                    return $row->full_name;
                })
                ->editColumn('email', function ($row) {
                    return $row->email;
                })
                ->editColumn('phone_number', function ($row) {
                    return  $row->phone;
                })
                ->editColumn('amount', function ($row) {
                    return 'Rs. ' . number_format($row->grand_total, 2);
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 'pending') {
                        return new HtmlString('<span class="badge bg-danger">Pending</span>');
                    } elseif ($row->status == 'shipped') {
                        return new HtmlString('<span class="badge bg-info">Shipped</span>');
                    } else {
                        return new HtmlString('<span class="badge bg-success">' . $row->status . '</span>');
                    }
                })

                ->editColumn('action', function ($row) {
                    return '<td class="id">
                        <a data-id="' . $row->id . '" class="btn editOrderButton btn-info">
                            <i class="ri-eye-line"></i>
                        </a>
                        <a data-id="' . $row->id . '" class="btn btn-danger delete">
                            <i class="ri-delete-bin-line"></i>
                        </a>
                    </td>';
                })
                ->rawColumns(['id', 'customer_name', 'email', 'phone_number', 'amount', 'action'])
                ->make(true);
        }

        return view('admin.order.orders', compact('breadcrumb'));
    }
    public function edit(Request $request)
    {
        $order = Order::with('province', 'city')->findOrFail($request->id);
        $orderItems = OrderItem::with('product')->where('order_id', $request->id)->get();
        $responseData = [
            'order' => $order,
            'orderItems' => $orderItems
        ];
        return response()->json($responseData);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:pending,delivered,shipped',
            'shipped_date' => 'nullable|date_format:Y-m-d\TH:i',
        ]);

        $order = Order::findOrFail($request->id);
        $order->update($validatedData);

        return response()->json(['message' => 'Order details updated successfully', 'data' => $order], 200);
    }
    public function destroy($id){
        $order=Order::findOrFail($id);
        $order->delete();
        return response()->json(['message' => 'Order delete successfully'], 200);
    }

    public function sendInvoiceEmail(Request $request){
        Helper::orderEmail($request->id,$request->userType);
        return response()->json(['message' => 'Order email Send successfully'], 200);
    }
}
