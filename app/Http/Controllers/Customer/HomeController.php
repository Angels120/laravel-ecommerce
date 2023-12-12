<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::where('status', '=', '1')->get();
        $products=Product::where('status','=','1')->get();
        return view('customer.home',compact('categories','products'));
    }
}
