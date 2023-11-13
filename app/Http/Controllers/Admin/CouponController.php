<?php

namespace App\Http\Controllers\Admin;
use App\Models\Coupon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function index()
    {
        $coupons= Coupon::all();
        return view('admin.coupon.coupon',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupon.manage_coupon');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'code'=>'required|unique:coupons,code'.$request->post('id'),
            'value'=>'required',
        ]);
        Coupon::create($request->all());
        return redirect(route('coupons.index'))->with('success', 'Coupon created successfully.');

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
    public function edit(Coupon $coupon)
    {
        return view('admin.coupon.edit_coupon', ['coupon' => $coupon]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'title'=>'required',
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            'value'=>'required',
        ]);
        $coupon->update($request->all());
        return redirect(route('admin.coupons.index'))->with('success', 'Coupon updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect(route('admin.coupons.index'))->with('success', 'Coupon deleted successfully.');
    }
}
