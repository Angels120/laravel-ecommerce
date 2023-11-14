<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */



     public function index(Request $request)
     {
        $index = 1;
        if ($request->ajax()) {
            $categories = Category::all();
            return DataTables::of($categories)
                ->addIndexColumn()
                ->editColumn('id', function ($row) use (&$index) {
                    $currentIndex = $index;
                    $index++;
                    return $currentIndex;
                })
                ->editColumn('category_name', function ($row) {

                    return $row->category_name;
                })
                ->editColumn('category_slug', function ($row) {

                    return $row->category_slug;
                })
                ->editColumn('status', function ($row) {
                    $status = ($row->status == 0) ? 1 : 0;
                    $buttonColorClass = ($row->status == 0) ? 'btn-warning' : 'btn-success';
                    $buttonText = ($row->status == 0) ? 'Inactive' : 'Active';

                    return '<form action="' . '" method="POST">
                            ' . csrf_field() . '
                            <div class="btn btn-sm ' . $buttonColorClass . '">' . $buttonText . '</div>
                        </form>';
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
                ->rawColumns(['id', 'category_name', 'category_slug', 'status',  'action'])
                ->make(true);
        }

        return view('admin.category.category');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validatedData = $request->validated();

        $category = Category::create($validatedData);
        $category->category_slug = Str::slug($category->category_name);
        $category->save();
        return response()->json(['message' => 'Category Created Successfully', 'data' => $category], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $category=Category::findOrFail($request->id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
    $category = Category::findOrFail($request->id ?? '');
    $validateData = $request->validated();
    $category->update($validateData);
    // Custom response message
    return response()->json(['message' => 'Category details updated successfully', 'data' => $category], 200);

    }
    public function status(Request $request,$status,$id)
    {
       $model=Category::find($id);
       $model->status=$status;
       $model->save();
       return redirect('admin/categories')->with(['success'=>'status updated successfully']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully', 'data' => $category], 200);
    }
}
