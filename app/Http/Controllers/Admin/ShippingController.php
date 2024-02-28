<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShippingRequest;
use App\Http\Requests\UpdateShippingRequest;
use App\Models\City;
use App\Models\ShippingCharge;
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
            $shippings = ShippingCharge::all();
            return DataTables::of($shippings)
                ->addIndexColumn()
                ->editColumn('id', function ($row) use (&$index) {
                    $currentIndex = $index;
                    $index++;
                    return $currentIndex;
                })
                ->editColumn('city_name', function ($row) {
                    return $row->city->name;
                })
                ->editColumn('amount', function ($row) {
                    return 'Rs. ' .$row->amount;
                })

                ->editColumn('action', function ($row) {
                    return '<td class="id">
                        <a data-id="' . $row->id . '" class="btn editShippingButton btn-info">
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
    public function store(StoreShippingRequest $request){
        $validatedData=($request->validated());
        $shipping = ShippingCharge::create($validatedData);
        $shipping->save();
        return response()->json(['message'=>'Shipping Created Sucesfully','shipping' => $shipping], 201);

    }
    public function edit(Request $request)
    {
        $shipping=ShippingCharge::findOrFail($request->id);
    return response()->json($shipping);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShippingRequest $request)
    {
        $shipping = ShippingCharge::findOrFail($request->id ?? '');
        $validateData = $request->validated();
        $shipping->update($validateData);
        return response()->json(['message' => 'shipping details updated successfully', 'data' => $shipping], 200);
    }
    public function destroy($id)
    {
        $shipping = ShippingCharge::findOrFail($id);
        $shipping->delete();
        return response()->json(['message' => 'Shipping deleted successfully', 'data' => $shipping], 200);
    }
}
