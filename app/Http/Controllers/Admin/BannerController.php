<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
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

                    return '<form action="' . route('admin.banner.status.update', ['id' => $row->id]) . '" method="POST">
                                ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-status ' . $buttonColorClass . '">' . $buttonText . '</button>
                            </form>';
                })
                ->editColumn('action', function ($row) {
                    return '<td class="id">
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


    public function store(StoreBannerRequest $request)
    {
        $validatedData = $request->validated();
 
        // Check if image file exists in the request
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Generate a unique filename for the image
            $dbName = 'banner-image-' . time() . '.' . $image->getClientOriginalExtension();

            // Move the uploaded image to the destination folder
            $image->move('uploads/banners/', $dbName);

            // Save the filename in the database
            $banner = new Banner();
            $banner->name = $validatedData['name'];
            $banner->status = $validatedData['status'] ?? 0;
            $banner->image = $dbName;
            $banner->save();

            // Return success response
            return response()->json(['message' => 'Banner created successfully']);
        }
    }

    public function updateStatus($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->status = ($banner->status == 0) ? 1 : 0;
        $banner->save();
        return response()->json(['message' => 'Banner Status updated successfully', 200]);
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->image) {
            unlink('uploads/banners/' . $banner->image);
        }

        $banner->delete();
        return response()->json(['message' => 'Banner deleted successfully']);
    }
}
