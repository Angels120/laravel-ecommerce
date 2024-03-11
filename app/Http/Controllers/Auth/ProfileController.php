<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Province;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        $breadcrumb = [
            'breadcrumbs' => [
                'WebMart' => route('home.page'),
                'current_menu' => 'My Profile',
            ],
        ];
        $user = User::where('id', Auth::user()->id)->first();
        $provinces = Province::orderBy('name', 'ASC')->get();
        $cities = City::orderBy('name', 'ASC')->get();
        $customerAddress = CustomerAddress::where('user_id', $user->id)->first();

        return view('auth.account.profile', compact('breadcrumb', 'user', 'provinces', 'cities', 'customerAddress'));
    }


    public function updateProfile(Request $request)
    {
        $userId = Auth::user()->id;
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $userId . ',id',
            'phone_number' => 'required',
        ]);

        // Using the 'where' method to find the user by ID and update their profile
        User::where('id', $userId)->update($validateData);

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully',
        ]);
    }

    public function BillingAddress(Request $request)
    {
        //Step 1 store User Address in Address table
        $validateData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable',
            'province_id' => 'required',
            'city_id' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' => 'required',
        ]);
        $user = Auth::user();
        CustomerAddress::updateOrCreate(['user_id' => $user->id], $validateData);
        return response()->json(['message' => 'Billing Address collected  successfully']);
    }

    public function order()
    {
        $breadcrumb = [
            'breadcrumbs' => [
                'WebMart' => route('home.page'),
                'current_menu' => 'My Order',
            ],
        ];
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();

        return view('auth.account.order', compact('breadcrumb', 'orders'));
    }

    public function orderDetail($id)
    {
        $breadcrumb = [
            'breadcrumbs' => [
                'WebMart' => route('home.page'),
                'My Order' => route('user.order'),
                'current_menu' => 'Order-Detail',
            ],
        ];
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->where('id', $id)->first();
        $orderItems = OrderItem::where('order_id', $id)->get();
        return view('auth.account.order-detail', compact('breadcrumb', 'order', 'orderItems'));
    }

    public function wishlist()
    {
        $breadcrumb = [
            'breadcrumbs' => [
                'WebMart' => route('home.page'),
                'current_menu' => 'My Wishlist',
            ],
        ];
        $user = Auth::user();
        $wishlists = Wishlist::where('user_id', $user->id)->with('product')->get();

        return view('auth.account.wishlist', compact('breadcrumb', 'wishlists'));
    }
    public function removeProductFromWishlist(Request $request)
    {
        $wishlists = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $request->id)->first();
        if ($wishlists == null) {
            return response()->json([
                'status' => true,
                'message' => 'product removed already'
            ]);
        } else {
            $wishlists = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $request->id)->delete();
            return response()->json([
                'status' => true,
                'message' => 'product removed successfully'
            ]);
        }
    }
    public function changePassword(Request $request)
    {
        $breadcrumb = [
            'breadcrumbs' => [
                'WebMart' => route('home.page'),
                'current_menu' => 'Change Password',
            ],
        ];
        return view('auth.account.change-password', compact('breadcrumb'));
    }
    public function processChangePassword(Request $request)
    {

        Validator::extend('match_password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, Auth::user()->password);
        });

        Validator::extend('different_password', function ($attribute, $value, $parameters, $validator) {
            return !Hash::check($value, Auth::user()->password);
        });

        // dd($request->new_password);

        $validatedData = $request->validate([
            'old_password' => ['required', 'match_password'],
            'new_password' => ['required', 'min:8', 'different_password'],
            'confirm_password' => 'required|same:new_password',
        ], [
            'old_password.match_password' => 'The old password is incorrect.',
            'new_password.different_password' => 'The new password must be different from the old password.',
        ]);

        $user = Auth::user();

        User::where('id',$user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Password changed successfully.'
        ], 200);
    }
}
