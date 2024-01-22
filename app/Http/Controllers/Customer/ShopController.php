<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    Public function index(Request $request,$categorySlug=null,$subCategorySlug=null){
        $categorySelected='';
        $subCategorySelected='';
        $brandsArray=[];


        $categories=Category::orderBy('category_name','ASC')->with('subcategories')->where('status',1)->get();
        $brands=Brand::orderBy('name','ASC')->where('status',1)->get();
        $products=Product::where('status',1)->get();
        //Apply Filters
        if(!empty($categorySlug)){
            $category=Category::where('category_slug',$categorySlug)->first();
            $products=Product::where('category_id',$category->id)->get();
        }
        if(!empty($subCategorySlug)){
            $subcategory=SubCategory::where('subcategory_slug',$subCategorySlug)->first();
            $products=Product::where('sub_categories_id',$subcategory->id)->get();
        }
        if(!empty($request->get('brand'))){
            $brandsArray=explode(',',$request->get('brand'));
            $products=$products->whereIn('brands_id',$brandsArray);
        }
        if(($request->get('price_max')!=''&& $request->get('price_min')!='')){
            $products=$products->whereBetween('price',[intval($request->get('price_min')),intval($request->get('price_max'))]);
        }
        $data['priceMin']=intval($request->get('price_min'));
        $data['priceMax']=intval($request->get('price_max'));
        return view('customer.Product.shop',$data,compact('products','categories','brands','brandsArray'));
    }
}
