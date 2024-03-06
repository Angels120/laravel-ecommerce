<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', '=', '1')->get();
        $products = Product::where('status', '=', '1')->get();
        $latestProducts = Product::latest()->take(4)->get();
        $brands = Brand::where('status', '=', '1')->get();
        return view('customer.home', compact('categories', 'products', 'latestProducts', 'brands'));
    }
    public function addToWishlist(Request $request)
    {
        if (Auth::check() == false) {
            session(['url.intended' => url()->previous()]);
            return response()->json([
                'status' => false
            ]);
        }
        Wishlist::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->id
            ],
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->id,
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'Product added in your wishlist',
        ]);
    }
}
