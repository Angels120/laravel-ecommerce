<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function AdminIndex(Request $request)
    {
        $index = 1;
        if ($request->ajax()) {
            $users = User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['Admin', 'Super Admin']);
            })->get();
            return DataTables::of($users)
                ->addIndexColumn()
                ->editColumn('id', function ($row) use (&$index) {
                    $currentIndex = $index;
                    $index++;
                    return $currentIndex;
                })
                ->editColumn('name', function ($row) {

                    return $row->name;
                })
                ->editColumn('username', function ($row) {

                    return $row->username;
                })
                ->editColumn('phone_number', function ($row) {

                    return $row->phone_number;
                })
                ->editColumn('verify', function ($row) {
                    $verify = ($row->verify == 0) ? 1 : 0;
                    $buttonColorClass = ($row->verify == 0) ? 'btn-danger' : 'btn-success';
                    $buttonText = ($row->verify == 0) ? 'Inactive' : 'Active';

                    return '<form action="' . route('admin.user.verify.update', ['id' => $row->id]) . '" method="POST">
                                ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-status ' . $buttonColorClass . '">' . $buttonText . '</button>
                            </form>';
                })
                ->editColumn('action', function ($row) {
                    return '<td class="id">
                        <a data-id="' . $row->id . '" class="btn editAdminButton btn-info">
                            <i class="ri-edit-2-line"></i>
                        </a>
                        <a data-id="' . $row->id . '" class="btn btn-danger delete">
                            <i class="ri-delete-bin-line"></i>
                        </a>
                    </td>';
                })
                ->rawColumns(['id', 'name', 'username', 'verify',  'action'])
                ->make(true);
        }

        return view('admin.users.adminuser.admin');
    }


    public function CreateAdminUser(RegisterRequest $request)
{

    $validatedData = $request->validated();

    $user = new User($validatedData);
    $user->save();
    $role = Role::find(2);
    $user->assignRole($role);
    return response()->json(['message' => 'User Created Successfully', 'data' => $user], 201);
}
public function AdminVerify($id)
{
    $user = User::findOrFail($id);
    $user->verify = ($user->verify == 0) ? 1 : 0;
    $user->save();
    return response()->json(['message' => 'User Verification updated successfully', 200]);
}
public function EditAdminUser(Request $request)
{
    $user = User::findOrFail($request->id);
    return response()->json($user);
}

/**
 * Update the specified resource in storage.
 */
public function UpdateAdminUser(UpdateUserRequest $request, User $user)
{
    // dd($request->all());
    $user = User::findOrFail($request->id ?? '');
    $validateData = $request->validated();
    $user->update($validateData);

    return response()->json(['message' => 'User details updated successfully', 'data' => $user], 200);
}
public function DestroyAdminUser($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return response()->json(['message' => 'User deleted successfully', 'data' => $user], 200);
}




public function CustomerIndex(Request $request)
    {
        $breadcrumb = [

            'breadcrumbs' => [
                    'Dashboard' => route('admin.dashboard'),
                    'current_menu' => 'Admin Profile',
            ],

    ];
        $index = 1;
        if ($request->ajax()) {
            $users = User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['Customer']);
            })->get();
            return DataTables::of($users)
                ->addIndexColumn()
                ->editColumn('id', function ($row) use (&$index) {
                    $currentIndex = $index;
                    $index++;
                    return $currentIndex;
                })
                ->editColumn('name', function ($row) {

                    return $row->name;
                })
                ->editColumn('username', function ($row) {

                    return $row->username;
                })
                ->editColumn('phone_number', function ($row) {

                    return $row->phone_number;
                })
                ->editColumn('verify', function ($row) {
                    $verify = ($row->verify == 0) ? 1 : 0;
                    $buttonColorClass = ($row->verify == 0) ? 'btn-danger' : 'btn-success';
                    $buttonText = ($row->verify == 0) ? 'Inactive' : 'Active';

                    return '<form action="' . route('admin.customer.verify.update', ['id' => $row->id]) . '" method="POST">
                                ' . csrf_field() . '
                                <button type="submit" class="btn btn-sm btn-status ' . $buttonColorClass . '">' . $buttonText . '</button>
                            </form>';
                })
                ->editColumn('action', function ($row) {
                    return '<td class="id">
                        <a data-id="' . $row->id . '" class="btn editCustomerButton btn-info">
                            <i class="ri-edit-2-line"></i>
                        </a>
                        <a data-id="' . $row->id . '" class="btn btn-danger delete">
                            <i class="ri-delete-bin-line"></i>
                        </a>
                    </td>';
                })
                ->rawColumns(['id', 'name', 'username', 'verify',  'action'])
                ->make(true);
        }

        return view('admin.users.customeruser.customer',compact('breadcrumb'));
    }
    public function EditCustomerUser(Request $request)
{
    $user = User::findOrFail($request->id);
    return response()->json($user);
}

public function UpdateCustomerUser(UpdateUserRequest $request, User $user)
{
    // dd($request->all());
    $user = User::findOrFail($request->id ?? '');
    $validateData = $request->validated();
    $user->update($validateData);

    return response()->json(['message' => 'User details updated successfully', 'data' => $user], 200);
}

public function DestroyCustomerUser($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return response()->json(['message' => 'User deleted successfully', 'data' => $user], 200);
}

public function CustomerVerify($id)
{
    $user = User::findOrFail($id);
    $user->verify = ($user->verify == 0) ? 1 : 0;
    $user->save();
    return response()->json(['message' => 'User Verification updated successfully', 200]);
}
}
