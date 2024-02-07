<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{


    public function cart()
    {
        $breadcrumb = [
            'breadcrumbs' => [
                'WebMart' => route('home.page'),
                'current_menu' => 'Shopping Cart',
            ],
        ];
        $cartContent = Cart::content();

        $data['cartContent'] = $cartContent;
        return view('customer.Product.carts', $data, compact('breadcrumb'));
    }
    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);
        $price = $product->price !== null ? $product->price : $product->compare_price;
        if ($product == null) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ]);
        }

        if (Cart::count() > 0) {
            // Product already exists in the cart
            // To check whether the product already exists in the cart, if not, add it to cart conditions
            $cartContent = Cart::content();
            $productAlreadyExist = false;

            foreach ($cartContent as $item) {
                if ($item->id == $product->id) {
                    $productAlreadyExist = true;
                }
            }

            if ($productAlreadyExist == false) {
                Cart::add($product->id, $product->name, 1, $price, [
                    'image' => (!empty($product->image[0])) ? $product->image[0] : '',
                    'stock' => $product->stock,
                ]);

                $status = true;
                $message = $product->name . ' added to cart';
            } else {
                $status = false;
                $message = $product->name . ' already added to cart';
            }
        } else {
            // Cart is empty
            Cart::add($product->id, $product->name, 1, $price, [
                'image' => (!empty($product->image[0])) ? $product->image[0] : '',
            ]);
            $status = true;
            $message = $product->name . ' added to cart';
        }

        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }



    public function updateCart(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->qty;
        $itemInfo = Cart::get($rowId);
        $product = Product::find($itemInfo->id);
        if ($qty <= $product->stock) {
            Cart::update($rowId, $qty);
            $status = true;
            $message = 'Cart Updated Succesfully';
        } else {
            $status = false;
            $message = 'Request quantity (' . $qty . ')not available in stock';
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], 200);
    }
    public function delteItem(Request $request)
    {

        $itemInfo = Cart::get($request->rowId);
        if ($itemInfo == null) {
            return response()->json([
                'status' => false,
                'message' => 'Item Not Found',
            ], 200);
        }
        Cart::remove($request->rowId);
        return response()->json([
            'status' => true,
            'message' => 'Item Delted From Cart succesfully',
        ], 200);
    }


    public function checkout(Request $request){
        $breadcrumb = [
            'breadcrumbs' => [
                'WebMart' => route('home.page'),
                'current_menu' => 'Checkout',
            ],
        ];
        if(Cart::count()==0){
            return redirect()->route('carts.details');
        }
        if(Auth::check()==false){
            if(!session()->has('url.intended')){
            session(['url.intended'=>url()->current()]);
            }
            return redirect()->route('login');
        }
        return view('customer.Product.checkout',  compact('breadcrumb'));
    }
}
