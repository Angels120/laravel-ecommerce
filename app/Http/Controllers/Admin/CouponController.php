<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{

    public function index(Request $request)
    {
        $breadcrumb = [

            'breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'current_menu' => 'Coupons',
            ],

        ];
        $index = 1;
        if ($request->ajax()) {
            $coupons = Coupon::all();
            return DataTables::of($coupons)
                ->addIndexColumn()
                ->editColumn('id', function ($row) use (&$index) {
                    $currentIndex = $index;
                    $index++;
                    return $currentIndex;
                })
                ->editColumn('coupon_code', function ($row) {
                    return $row->code;
                })
                ->editColumn('name', function ($row) {
                    return $row->name;
                })
                ->editColumn('discount_amount', function ($row) {
                    return $row->discount_amount;
                })
                ->editColumn('status', function ($row) {
                    $status = ($row->status == 0) ? 1 : 0;
                    $buttonColorClass = ($row->status == 0) ? 'btn-danger' : 'btn-success';
                    $buttonText = ($row->status == 0) ? 'Inactive' : 'Active';
                    return '<form action="' . route('admin.coupon.status.update', ['id' => $row->id]) . '" method="POST">
                                ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-status ' . $buttonColorClass . '">' . $buttonText . '</button>
                            </form>';
                })
                ->editColumn('action', function ($row) {
                    return '<td class="id">
                        <a data-id="' . $row->id . '" class="btn editCouponButton btn-info">
                            <i class="ri-edit-2-line"></i>
                        </a>
                        <a data-id="' . $row->id . '" class="btn btn-danger delete">
                            <i class="ri-delete-bin-line"></i>
                        </a>
                    </td>';
                })
                ->rawColumns(['id', 'coupon_code', 'name', 'discount_amount', 'status', 'action'])
                ->make(true);
        }

        return view('admin.coupon.coupon', compact('breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouponRequest $request)
    {
        $validatedData = $request->validated();
        //check whether the start at for coupon is null if null it will set ti current time and date
        if (!isset($validatedData['starts_at'])) {
            $validatedData['starts_at'] = Carbon::now();
        }
        $coupon = Coupon::create($validatedData);
        $coupon->save();

        return response()->json(['message' => 'Coupon Created Successfully', 'data' => $coupon], 201);
    }
    public function updateStatus($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->status = ($coupon->status == 0) ? 1 : 0;
        $coupon->save();
        return response()->json(['message' => 'Coupon Status updated successfully', 200]);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $coupon = Coupon::findOrFail($request->id);
        return response()->json($coupon);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {

        $coupon = Coupon::findOrFail($request->id ?? '');
        $validateData = $request->validated();
        $coupon->update($validateData);
        return response()->json(['message' => 'Coupon details updated successfully', 'data' => $coupon], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return response()->json(['message' => 'Coupon deleted successfully', 'data' => $coupon], 200);
    }
}
