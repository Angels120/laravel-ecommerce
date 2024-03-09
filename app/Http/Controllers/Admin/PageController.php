<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class PageController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = [
            'breadcrumbs' => [
                'Dashboard' => route('admin.dashboard'),
                'current_menu' => 'Pages',
            ],
        ];
        $index = 1;
        if ($request->ajax()) {
            $brands = Page::all();
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
                ->editColumn('action', function ($row) {
                    return '<td class="id">
                        <a data-id="' . $row->id . '" class="btn editPageButton btn-info">
                            <i class="ri-edit-2-line"></i>
                        </a>
                        <a data-id="' . $row->id . '" class="btn btn-danger delete">
                            <i class="ri-delete-bin-line"></i>
                        </a>
                    </td>';
                })


                ->rawColumns(['id', 'name', 'slug',  'action'])
                ->make(true);
        }

        return view('admin.pages.page', compact('breadcrumb'));
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'slug' => 'nullable',
            'content' => 'nullable',
        ]);
        $page = new Page($validateData);
        $page->slug = Str::slug($page->name);
        $page->save();
        return response()->json(['message' => 'Page Created successfully'],201);
    }
    public function edit(Request $request)
    {
        $page = Page::findOrFail($request->id);
        return response()->json($page);
    }
    public function update(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'slug' => 'nullable',
            'content' => 'nullable',
        ]);
        $page = Page::findOrFail($request->id ?? '');
        $page->update($validateData);
        $page->slug = Str::slug($page->name);
        $page->save();
        return response()->json(['message' => 'Page details updated successfully', 'data' => $page], 200);
    }
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
        return response()->json(['message' => 'Page deleted successfully', 'data' => $page], 200);
    }
}
