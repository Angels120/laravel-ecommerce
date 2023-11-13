<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Helper;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::get();
        $subcategories = SubCategory::get();
        $brands = Brand::get();
        $index = 1;
        if ($request->ajax()) {
            $products = Product::all();
            return DataTables::of($products)
                ->addIndexColumn()
                ->editColumn('id', function ($row) use (&$index) {
                    $currentIndex = $index;
                    $index++;
                    return $currentIndex;
                })
                ->editColumn('name', function ($row) {

                    return $row->name;
                })
                ->editColumn('slug', function ($row) {

                    return $row->slug;
                })
                ->editColumn('category', function ($row) {

                    return $row->category->name;
                })
                ->editColumn('sub_category', function ($row) {

                    return $row->subcategory->name;
                })
                ->editColumn('discount', function ($row) {

                    return $row->discount;
                })
                ->editColumn('image', function ($row) {
                    $imagePath = public_path('uploads/products/' . $row->image);
                    // Check if the image file exists
                    if (file_exists($imagePath)) {
                        $imageUrl = asset('uploads/products/' . $row->image);
                        return '<img src="' . $imageUrl . '" alt="Image" style="width: 70px; height: 50px;">';
                    } else {
                        return 'Image Not Found';
                    }
                })
                ->editColumn('status', function ($row) {
                    $status = ($row->status == 0) ? 1 : 0;
                    $buttonColorClass = ($row->status == 0) ? 'btn-danger' : 'btn-success';
                    $buttonText = ($row->status == 0) ? 'Inactive' : 'Active';

                    return '<form action="' . '" method="POST">
                                ' . csrf_field() . '
                                <div class="btn btn-sm ' . $buttonColorClass . '">' . $buttonText . '</div>
                            </form>';
                })
                ->editColumn('action', function ($row) {
                    return '<td class="id">
                            <a data-id="' . $row->id . '" class="btn editBrandButton btn-info">
                                <i class="ri-edit-2-line"></i>
                            </a>
                            <a data-id="' . $row->id . '" class="btn btn-danger delete">
                                <i class="ri-delete-bin-line"></i>
                            </a>
                        </td>';
                })
                ->rawColumns(['id', 'name', 'category', 'sub_category', 'discount', 'slug', 'status', 'image', 'action'])
                ->make(true);
        }

        return view('admin.product.product', compact('categories', 'subcategories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $subcategories = SubCategory::get();
        return view('admin.product.manage_product', compact('categories', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image.*' => 'required',
            'category_id' => 'required',
            'sub_categories_id' => 'required',
            'brands_id' => 'nullable',
            'description' => 'nullable',
            'slug' => 'nullable|unique:products,slug',
            'stock' => 'required',
            'status' => 'required|boolean',
            'featured' => 'required|boolean',
            'price' => 'required',
            'discount' => 'nullable',
            'sizes' => 'nullable',
        ]);
        $arrProductImages = [];
        if ($request->has('image')) {
            $images = $request->input('image');
            if (!empty($existingFiles)) {
                $arrProductImages = $existingFiles;
            } else {
                $arrProductImages = [];
            }
            foreach ($images as $image) {
                $dir = 'uploads/products/';
                $imageName = Helper::saveFilePondImage($image, $dir);
                if (is_string($imageName)) {
                    $arrProductImages[] = $imageName;
                } else {
                    return $imageName;
                }
            }
        }
        $validatedData['images'] = $arrProductImages;
        Product::create([
            'name' => $request->name,
            'slug'=> Str::slug($request->input('name')),
            'image' => $arrProductImages,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'sub_categories_id' => $request->sub_categories_id,
            'brands_id' => $request->brands_id,
            'stock' => $request->stock,
            'status' => $request->status,
            'price' => $request->price,
            'featured' => $request->featured,
            'discount' => $request->discount,
            'sizes' => $request->sizes,
        ]);
        return redirect()->route('admin.subcategories.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        return view('admin.product.edit_product', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'model' => 'required|unique:products,model,' . $product->id,
            'short_desc' => 'required',
            'desc' => 'required',
            'keywords' => 'required',
            'slug' => 'required|unique:products,slug,' . $product->id,
            'technical_specification' => 'required',
            'uses' => 'required',
            'warranty' => 'required',
            'status' => 'required|boolean'
        ]);
        $image = $request->image;
        $dbName = $product->$image;
        if ($image) {
            if ($product->image) {
                unlink('uploads/products/' . $product->image);
            }
            $dbName = 'product-image-' . time() . '.' . $image->clientExtension();
            $source = $image->getRealPath();
            $destination = 'uploads/products/' . $dbName;
            copy($source, $destination);
        }
        $category = Category::find($request->category_id);
        $category->products()->update([
            'name' => $request->name,
            'image' => $dbName,
            'brand' => $request->brand,
            'model' => $request->model,
            'short_desc' => $request->short_desc,
            'desc' => $request->desc,
            'keywords' => $request->keywords,
            'slug' => $request->slug,
            'technical_specification' => $request->technical_specification,
            'uses' => $request->uses,
            'warranty' => $request->warranty,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            unlink('uploads/products/' . $product->image);
        }
        $product->delete();
        return redirect(route('admin.products.index'))->with(['success' => 'Product deleted successfully']);
    }
    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }
}
