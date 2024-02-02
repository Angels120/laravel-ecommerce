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
    public function index(Request $request, $categorySlug = null, $subCategorySlug = null)
    {
        $breadcrumb = [
            'breadcrumbs' => [
                'WebMart' => route('home.page'),
                $categorySlug   => route('lists', $categorySlug),
                $subCategorySlug   => route('lists', $subCategorySlug),
            ],
        ];

        $categorySelected = '';
        $subCategorySelected = '';
        $brandsArray = [];

        $categories = Category::orderBy('category_name', 'ASC')->with('subcategories')->where('status', 1)->get();
        $brands = Brand::orderBy('name', 'ASC')->where('status', 1)->get();

        $productsQuery = Product::where('status', 1);

        // Apply Filters
        if (!empty($categorySlug)) {
            $category = Category::where('category_slug', $categorySlug)->first();
            $productsQuery->where('category_id', $category->id);
        }

        if (!empty($subCategorySlug)) {
            $subcategory = SubCategory::where('subcategory_slug', $subCategorySlug)->first();
            $productsQuery->where('sub_categories_id', $subcategory->id);
        }

        if (!empty($request->get('brand'))) {
            $brandsArray = explode(',', $request->get('brand'));
            $productsQuery->whereIn('brands_id', $brandsArray);
        }

        if (($request->get('price_max') != '' && $request->get('price_min') != '')) {
            if ($request->get('price_max') == 1000) {
                $productsQuery->whereBetween('price', [intval($request->get('price_min')), 1000000]);
            } else {
                $productsQuery->whereBetween('price', [intval($request->get('price_min')), intval($request->get('price_max'))]);
            }
        }

        // Sort the results
        if ($request->has('sort') && $request->get('sort') != '') {
            if ($request->get('sort') == 'latest') {
                $productsQuery->orderByDesc('id');
            } elseif ($request->get('sort') == 'price_high') {
                $productsQuery->orderByDesc('price');
            } elseif ($request->get('sort') == 'price_low') {
                $productsQuery->orderBy('price');
            }
        } else {
            $productsQuery->orderByDesc('id');
        }

        // Get paginated results
        $products = $productsQuery->paginate(6);

        $data['priceMin'] = intval($request->get('price_min'));
        $data['priceMax'] = intval($request->get('price_max'));
        $data['sort'] = $request->get('sort');

        return view('customer.Product.shop', $data, compact('products', 'categories', 'brands', 'brandsArray', 'breadcrumb'));
    }



    Public function BrandFilter(Request $request,$brandSlug=null){
        $breadcrumb = [
            'breadcrumbs' => [
                'WebMart' => route('home.page'),
                'current_menu' => 'Brands',
            ],
        ];
        $brandsArray=[];

        $brands=Brand::orderBy('name','ASC')->where('status',1)->get();
        $products=Product::where('status',1)->get();
        //Apply Filters
        if(!empty($brandSlug)){
            $brands=Brand::where('slug',$brandSlug)->first();

            $products=Product::where('brands_id',$brands->id)->get();
        }
        return view('customer.Product.brands-filter',compact('products','brands','breadcrumb'));
    }
}
