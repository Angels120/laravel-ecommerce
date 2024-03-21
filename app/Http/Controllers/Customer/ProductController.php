<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productDetail($slug)
    {

        $product = Product::where('slug', $slug)->first();
        // dd($product);
        return view('customer.Product.details', compact('product'));
    }
    public function storeReview(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => ['required'],
            'username' => ['required', 'min:5', 'max:20'],
            'email' => ['required', 'email'],
            'rating' => ['required' ,'min:10'],
            'comment' => 'required',
        ]);

        // Assuming you have a model named ProductRating
        ProductRating::create(
            $validatedData
        );

        return response()->json(['message' => 'Product Rating added successfully'], 201);
    }
}
