<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $product = Product::find($request->id);

        if($product == null){
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ]);
        }

        if(Cart::count() > 0){
            // Product already exists in the cart
            // To check whether the product already exists in the cart, if not, add it to cart conditions
            $cartContent = Cart::content();
            $productAlreadyExist = false;

            foreach($cartContent as $item){
                if($item->id == $product->id){
                    $productAlreadyExist = true;
                }
            }

            if($productAlreadyExist == false){
                Cart::add($product->id, $product->name, 1, $product->price, [
                    (!empty($product->image[0])) ? $product->image[0] : ''
                ]);

                $status = true;
                $message = $product->name . ' added to cart';

            } else {
                $status = false;
                $message = $product->name . ' already added to cart';
            }
        } else {
            // Cart is empty
            Cart::add($product->id, $product->name, 1, $product->price, [
                (!empty($product->image[0])) ? $product->image[0] : ''
            ]);

            $status = true;
            $message = $product->name . ' added to cart';
        }

        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }


    public function cart(){
        $cartContent = Cart::content();
        // dd( $cartContent);
        $data['cartContent']=$cartContent;
        return view('customer.Product.carts',$data);
    }
}
