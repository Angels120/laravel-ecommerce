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

    $product = Product::where('slug', $slug)
        ->withCount(['product_ratings' => function ($query) {
            $query->where('status', 1);
        }])
        ->with(['product_ratings' => function ($query) {
            $query->where('status', 1);
        }])
        ->withSum(['product_ratings' => function ($query) {
            $query->where('status', 1);
        }], 'rating')
        ->first();

    $avgRating = '0.00';
    $avgRatingPer = 0;
    if ($product->product_ratings_count > 0) {
        $avgRating = number_format(($product->product_ratings_sum_rating / $product->product_ratings_count), 2);
        $avgRatingPer = ($avgRating * 100) / 5;
    }
    // dd($product);
    return view('customer.Product.details', compact('product', 'avgRatingPer', 'avgRating'));
}

    public function storeReview(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'product_id' => ['required'],
            'username' => ['required', 'min:5', 'max:20'],
            'email' => ['required', 'email'],
            'rating' => ['required', 'numeric', 'between:0,10'],
            'comment' => ['required'],
        ]);

        $count = ProductRating::where('email', $request->email)
                               ->where('product_id', $request->product_id)
                               ->where('product_id', $request->product_id)
                               ->count();
        if ($count > 0) {
            return response()->json([
                'status' => false,
                'message' => 'You have already rated this product.'
            ]);
        }
        $rating = ProductRating::create($validatedData);

        return response()->json([
            'status' => true,
            'message' => 'Product Rating added successfully',
            'rating' => $rating,
        ], 201);
    }

}
