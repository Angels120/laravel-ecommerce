<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories=Category::all();
        $index = 1;
        if ($request->ajax()) {
            $subcategories = SubCategory::all();
            return DataTables::of($subcategories)
                ->addIndexColumn()
                ->editColumn('id', function ($row) use (&$index) {
                    $currentIndex = $index;
                    $index++;
                    return $currentIndex;
                })
                ->editColumn('name', function ($row) {

                    return $row->subcategory_name;
                })
                ->editColumn('category_name', function ($row) {

                    return $row->category->category_name;
                })
                ->editColumn('slug', function ($row) {
                    return $row->subcategory_slug;
                })
                ->editColumn('status', function ($row) {
                    $status = ($row->status == 0) ? 1 : 0;
                    $buttonColorClass = ($row->status == 0) ? 'btn-danger' : 'btn-success';
                    $buttonText = ($row->status == 0) ? 'Inactive' : 'Active';

                    return '<form action="' . route('admin.subcategory.status.update', ['id' => $row->id]) . '" method="POST">
                                ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-status ' . $buttonColorClass . '">' . $buttonText . '</button>
                            </form>';
                })
                ->editColumn('action', function ($row) {
                    return '<td class="id">
                        <a data-id="' . $row->id . '" class="btn editSubcategoryButton btn-info">
                            <i class="ri-edit-2-line"></i>
                        </a>
                        <a data-id="' . $row->id . '" class="btn btn-danger delete">
                            <i class="ri-delete-bin-line"></i>
                        </a>
                    </td>';
                })
                ->rawColumns(['id', 'name', 'category_name','slug', 'status',  'action'])
                ->make(true);
        }

        return view('admin.subcategory.subcategory',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subcategories = SubCategory::get();
        return view('admin.subcategory.manage_subcategory',compact('subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCategoryRequest $request)
    {
        $validatedData=($request->validated());
        $subcategory = SubCategory::create($validatedData);
        $subcategory->subcategory_slug = Str::slug($subcategory->subcategory_name);
        $subcategory->save();
        return response()->json(['message'=>'Sub Category Created Sucesfully','subcategory' => $subcategory], 201);
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
        $subcategory=SubCategory::findOrFail($request->id);
        return response()->json($subcategory);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoryRequest $request)
    {
        // dd($request->all());
        $subcategory = SubCategory::findOrFail($request->id ?? '');
        $validateData = $request->validated();
        $subcategory->update($validateData);
        return response()->json(['message' => 'SubCategory details updated successfully', 'data' => $subcategory], 200);
    }

    public function updateStatus($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->status = ($subcategory->status == 0) ? 1 : 0;
        $subcategory->save();
        return response()->json(['message' => 'SubCategory Status updated successfully',200]);
    }


    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();
        return response()->json(['message' => 'Category deleted successfully', 'data' => $subcategory], 200);
    }
}
