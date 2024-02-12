<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ShippingController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = [

            'breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'current_menu' => 'Shippings',
            ],

        ];
        $index = 1;
        $cities=City::all();
        if ($request->ajax()) {
            $shippings = Shipping::all();
            return DataTables::of($shippings)
                ->addIndexColumn()
                ->editColumn('id', function ($row) use (&$index) {
                    $currentIndex = $index;
                    $index++;
                    return $currentIndex;
                })
                ->editColumn('city_name', function ($row) {
                    return $row->city_id;
                })
                ->editColumn('amount', function ($row) {
                    return $row->amount;
                })

                ->editColumn('action', function ($row) {
                    return '<td class="id">
                        <a data-id="' . $row->id . '" class="btn editCategoryButton btn-info">
                            <i class="ri-edit-2-line"></i>
                        </a>
                        <a data-id="' . $row->id . '" class="btn btn-danger delete">
                            <i class="ri-delete-bin-line"></i>
                        </a>
                    </td>';
                })
                ->rawColumns(['id', 'city_name', 'amount','action'])
                ->make(true);
        }

        return view('admin.Shipping.shipping',compact('breadcrumb','cities'));
    }
    public function create(){
        $cites=City::get();
        return view('admin.shipping.AddShipping');
    }
}
