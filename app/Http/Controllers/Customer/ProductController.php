<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    Public function productDetail($slug){

        $product=Product::where('slug',$slug)->first();
        // dd($product);
        return view('customer.Product.details',compact('product'));
    }
}
