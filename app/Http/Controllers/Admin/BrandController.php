<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class BrandController extends Controller
{


    public function index(Request $request)
    {
        $index = 1;
        if ($request->ajax()) {
            $brands = Brand::all();
            return DataTables::of($brands)
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
                ->editColumn('image', function ($row) {
                    $imagePath = public_path('uploads/brands/' . $row->image);

                    // Check if the image file exists
                    if (file_exists($imagePath)) {
                        $imageUrl = asset('uploads/brands/' . $row->image);
                        return '<img src="' . $imageUrl . '" alt="Image" style="width: 70px; height: 50px;">';
                    } else {
                        return 'Image Not Found';
                    }
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
                        <a data-id="' . $row->id . '" class="btn editBrandButton btn-info">
                            <i class="ri-edit-2-line"></i>
                        </a>
                        <a data-id="' . $row->id . '" class="btn btn-danger delete">
                            <i class="ri-delete-bin-line"></i>
                        </a>
                    </td>';
                })


                ->rawColumns(['id', 'name', 'slug', 'status', 'image', 'action'])
                ->make(true);
        }

        return view('admin.brand.brand');
    }


     public function store(Request $request)
     {

         $request->validate([
             'name' => 'required|string|max:255|unique:brands',
             'status' => 'required',
             'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
         $image = $request->file('image');
         if ($request->hasfile('image')) {
            $dbName = 'brand-image-' . time() . 'png';
            $destination = 'uploads/brands/' . $dbName;
            $image->move('uploads/brands/', $dbName);
            $uploadedImageNames[] = $dbName;
             // Save the filename in the database
             $brand = new Brand();
             $brand->name = $request->input('name');
             $brand->slug = Str::slug($request->input('name'));
             $brand->status = $request->input('status', 0);
             $brand->image = $dbName;
             $brand->save();
             return response()->json(['message' => 'Brand created successfully']);
         }

         return response()->json(['message' => 'No image uploaded'], 400);
     }

    public function show(string $id)
    {
        //
    }


    public function edit(Request $request)
    {
        $brand = Brand::findOrFail($request->id);
        return response()->json($brand);
    }



    public function update(Request $request,Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $request->id,
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $brand = Brand::findOrFail($request->id ?? '');
        $brand->name = $request->input('name');
        $brand->slug = Str::slug($request->input('name'));
        $brand->status = $request->input('status', 0);
        if ($request->hasFile('image')) {
            if (file_exists(public_path('uploads/brands/' . $brand->image))) {
                unlink(public_path('uploads/brands/' . $brand->image));
            }
            $image = $request->file('image');
            $dbName = 'brand-image-' . time() . '.' . $image->getClientOriginalExtension();
            $destination = 'uploads/brands/' . $dbName;
            $image->move('uploads/brands/', $dbName);
            $brand->image = $dbName;
        }
        $brand->save();
        return response()->json(['message' => 'Brand updated successfully']);
    }


    public function destroy($id)
    { $brand = Brand::findOrFail($id);

        if ($brand->image) {
            unlink('uploads/brands/' . $brand->image);
        }

        $brand->delete();
        return response()->json(['message' => 'Brand deleted successfully']);
    }
}
