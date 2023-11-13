<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes=Size::all();
        return view('admin.size.size',compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.size.manage_size');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'size'=>'required',
            'status'=>'required|boolean',
        ]);
        size::create($request->all());
        return redirect()->route('admin.sizes.index')->with('success', 'Size created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size)
    {
         return view('admin.size.edit_size',compact('size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size)
    {
        $request->validate([
            'size'=>'required',
            'status'=>'required|boolean',
        ]);
        $size->update($request->all());
        return redirect()->route('admin.sizes.index')->with('success', 'size updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
        $size->delete();
        return redirect(route('admin.sizes.index'))->with('success', 'Size deleted successfully.');
    }
}
