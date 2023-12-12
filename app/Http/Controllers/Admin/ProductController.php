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
    public function index(Request $request)
    {
        $breadcrumb = [

            'breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'current_menu' => 'Prodcuts',
            ],

        ];
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

                    return $row->name ?? '';
                })
                ->editColumn('slug', function ($row) {

                    return $row->slug ?? '';
                })
                ->editColumn('category', function ($row) {

                    return $row->category->category_name ?? '';
                })
                ->editColumn('sub_category', function ($row) {

                    return $row->subcategory->subcategory_name ?? ' ';
                })
                ->editColumn('stock', function ($row) {

                    return $row->stock ?? '';
                })
                ->editColumn('discount', function ($row) {

                    return $row->discount . '%' ?? '';
                })
                ->editColumn('price', function ($row) {

                    return $row->price ?? '';
                })
                ->editColumn('image', function ($row) {
                    $images = $row->image;

                    if (!empty($images) && is_array($images)) {
                        $imageHtml = '';

                        foreach ($images as $index => $image) {
                            $imagePath = public_path('uploads/products/' . $image);

                            if (file_exists($imagePath)) {
                                $imageUrl = asset('uploads/products/' . $image);
                                $imageHtml .= '<img src="' . $imageUrl . '" alt="Image" style="width: 70px; height: 50px;">';

                                if (($index + 1) % 2 == 0 && $index < count($images) - 1) {
                                    $imageHtml .= '<br>';
                                } elseif ($index < count($images) - 1) {

                                    $imageHtml .= '<span style="border-right: 2px solid black; height: 100%; margin-left: 10px;"></span>';
                                }
                            } else {
                                $imageHtml .= 'Image Not Found<br>';
                            }
                        }

                        return $imageHtml;
                    } else {
                        return 'No Images';
                    }
                })


                ->editColumn('status', function ($row) {
                    $status = ($row->status == 0) ? 1 : 0;
                    $buttonColorClass = ($row->status == 0) ? 'btn-danger' : 'btn-success';
                    $buttonText = ($row->status == 0) ? 'Inactive' : 'Active';

                    return '<form action="' . route('admin.product.status.update', ['id' => $row->id]) . '" method="POST">
                                ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-status ' . $buttonColorClass . '">' . $buttonText . '</button>
                            </form>';
                })
                ->editColumn('action', function ($row) {
                    return '<td class="id">
                        <a data-id="' . $row->id . '" class="btn editProductButton btn-info">
                            <i class="ri-edit-2-line"></i>
                        </a>
                        <a data-id="' . $row->id . '" class="btn btn-danger delete">
                            <i class="ri-delete-bin-line"></i>
                        </a>
                    </td>';
                })
                ->rawColumns(['id', 'name', 'category', 'sub_category', 'price', 'discount', 'stock', 'slug', 'status', 'image', 'action'])
                ->make(true);
        }

        return view('admin.product.product', compact('categories', 'subcategories', 'brands','breadcrumb'));
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
            'image' => 'required|array',
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
        $sizes = [];
        $validatedData['image'] = $arrProductImages;
        $validatedData['sizes'] = $sizes;
        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->input('name')),
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
            'sizes' => $sizes,
        ]);
        return response()->json(['message' => 'Product Created successfully']);
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
    public function edit(Request $request)
    {
        $product = Product::findOrFail($request->id);
        return response()->json($product);
    }




    public function unlinkimageedit(Request $request)
    {

        if ($request->has('image') && $request->has('productId')) {

            $product = Product::find($request->productId);

            // Call the removeImage method to remove the image from the database
            $product->removeImage($request->image);

            // Now, unlink the image from storage
            unlink('uploads/products/' . $request->image);

            return response()->json('Image removed successfully');
        }

        return response()->json('Invalid request parameters', 400);
    }


    public function updateStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->status = ($product->status == 0) ? 1 : 0;
        $product->save();
        return response()->json(['message' => 'Product Status updated successfully',200]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request)
    {
        $product = Product::findOrFail($request->id ?? '');

        $request->validate([
            'name' => 'required',
            // 'image' => 'required|array',
            // 'image.*' => 'required',
            'category_id' => 'required',
            'sub_categories_id' => 'required',
            'brands_id' => 'nullable',
            'description' => 'nullable',
            'stock' => 'required',
            'status' => 'required|boolean',
            'featured' => 'required|boolean',
            'price' => 'required',
            'discount' => 'nullable',
            'sizes' => 'nullable',
        ]);

        $arrProductImages = $product->image;
        if ($request->has('image')) {
            $images = $request->input('image');
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
        // $validatedData['image'] = $arrProductImages;
        $validatedData = [
            'name' => $request->name,
            'slug' => Str::slug($request->input('name')),
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
        ];

        $product->update($validatedData);

        return response()->json(['message' => 'Product updated successfully']);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (!empty($product->image) && is_array($product->image)) {
            foreach ($product->image as $image) {
                $filePath = 'uploads/products/' . $image;

                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully', 'data' => $product], 200);
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }
}
