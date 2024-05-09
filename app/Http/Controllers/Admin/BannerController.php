<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = [
            'breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'current_menu' => 'Banner',
            ],
        ];
        $index = 1;
        if ($request->ajax()) {
            $banners = Banner::all();
            return DataTables::of($banners)
                ->editColumn('id', function ($row) use (&$index) {
                    $currentIndex = $index;
                    $index++;
                    return $currentIndex;
                })
                ->editColumn('name', function ($row) {
                    return $row->name;
                })
                ->editColumn('image', function ($row) {
                    $imagePath = public_path('uploads/banners/' . $row->image);

                    // Check if the image file exists
                    if (file_exists($imagePath)) {
                        $imageUrl = asset('uploads/banners/' . $row->image);
                        return '<img src="' . $imageUrl . '" alt="Image" style="width: 70px; height: 50px;">';
                    } else {
                        return 'Image Not Found';
                    }
                })
                ->editColumn('status', function ($row) {
                    $status = ($row->status == 0) ? 1 : 0;
                    $buttonColorClass = ($row->status == 0) ? 'btn-danger' : 'btn-success';
                    $buttonText = ($row->status == 0) ? 'Inactive' : 'Active';

                    return '<form action="' . route('admin.brand.status.update', ['id' => $row->id]) . '" method="POST">
                                ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-status ' . $buttonColorClass . '">' . $buttonText . '</button>
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
                ->rawColumns(['id', 'name',  'status', 'image', 'action'])
                ->make(true);
        }
        return view('admin.banner.banner', compact('breadcrumb'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255|unique:banners',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024|dimensions:min_width=1600,min_height=740',
        ]);

        $image = $request->file('image');
        if ($request->hasfile('image')) {
            $dbName = 'banner-image-' . time() . 'png';
            $destination = 'uploads/banners/' . $dbName;
            $image->move('uploads/banners/', $dbName);
            $uploadedImageNames[] = $dbName;
            // Save the filename in the database
            $banner = new Banner();
            $banner->name = $request->input('name');
            $banner->status = $request->input('status', 0);
            $banner->image = $dbName;
            $banner->save();
            return response()->json(['message' => 'Banner created successfully']);
        }

        return response()->json(['message' => 'No image uploaded'], 400);
    }
}
