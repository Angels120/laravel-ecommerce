<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
                ->rawColumns(['id', 'customer_name', 'email','phone_number','amount','action'])
                ->make(true);
        }

        return view('admin.order.orders',compact('breadcrumb'));
    }
    public function edit(Request $request)
    {
        $order=Order::findOrFail($request->id);
        return response()->json($order);
    }

}
