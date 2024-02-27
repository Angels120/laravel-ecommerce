<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Coupon;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Province;
use App\Models\ShippingCharge;
use Carbon\Carbon;
use Database\Seeders\ProvinceSeeder;
use Dotenv\Validator;
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


    public function checkout(Request $request)
    {
        $breadcrumb = [
            'breadcrumbs' => [
                'WebMart' => route('home.page'),
                'Carts' => route('carts.details'),
                'current_menu' => 'Checkout',
            ],
        ];
        $provinces = Province::orderBy('name', 'ASC')->get();
        $cities = City::orderBy('name', 'ASC')->get();
        if (Cart::count() == 0) {
            return redirect()->route('carts.details');
        }
        if (Auth::check() == false) {
            if (!session()->has('url.intended')) {
                session(['url.intended' => url()->current()]);
            }
            return redirect()->route('login');
        }
        $discount = 0;
        $subTotal = Cart::subtotal(2, '.', '');
        //Apply Discount
        if (session()->has('code')) {

            $code = session()->get('code');
            if ($code->type == 'percent') {
                $discount = ($code->discount_amount / 100) * $subTotal;
            } else {
                $discount = $code->discount_amount;
            }
        }
        // Calculate shipping here
        $customerAddress = CustomerAddress::where('user_id', Auth::user()->id)->first();
        $totalQty = 0;
        $totalShippingCharge = 0;
        if ($customerAddress != null) {
            $userCity = $customerAddress->city_id;
            $shippingInfo = ShippingCharge::where('city_id', $userCity)->first();
            if ($shippingInfo != null) {
                foreach (Cart::content() as $item) {
                    $totalQty += $item->qty;
                }
                $totalShippingCharge = $totalQty * $shippingInfo->amount;
                $grandTotal = ($subTotal - $discount) + $totalShippingCharge;
            } else {
                $grandTotal = ($subTotal - $discount);
                $totalShippingCharge = 0;
            }
        }
        $grandTotal = ($subTotal - $discount) + $totalShippingCharge;
        return view('customer.Product.checkout',  compact('breadcrumb', 'customerAddress', 'provinces', 'discount', 'cities', 'totalShippingCharge', 'grandTotal'));
    }
    public function getCity($provinceId)
    {
        $provinces = City::where('province_id', $provinceId)->get();
        return response()->json($provinces);
    }
    public function processCheckoutAddress(Request $request)
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
        // dd($validateData);
        $user = Auth::user();
        CustomerAddress::updateOrCreate(['user_id' => $user->id], $validateData);
        return response()->json(['message' => 'Customer Address collected  successfully']);
    }

    public function processCheckoutPayment(Request $request)
    {
        $user = Auth::user();
        //Step 2 store Order in Order Table
        if ($request->paymentMethod == 'cod') {
            $ShippingCharge = 0;
            $discountCodeId = null;
            $promoCode = null;
            $discount = 0;
            $subTotal = Cart::subtotal(2, '.', '');
            $grandTotal = $subTotal + $ShippingCharge;
            //Apply Discount
            if (session()->has('code')) {
                $code = session()->get('code');
                $discountCodeId = $code->id;
                $promoCode = $code->code;
                if ($code->type == 'percent') {
                    $discount = ($code->discount_amount / 100) * $subTotal;
                } else {
                    $discount = $code->discount_amount;
                }
            }
            $shippingInfo = ShippingCharge::where('city_id', $request->city_id)->first();
            $totalQty = 0;
            foreach (cart::content() as $item) {
                $totalQty += $item->qty;
            }
            if ($shippingInfo != null) {
                $ShippingCharge = $totalQty * $shippingInfo->amount;
                $grandTotal = ($subTotal - $discount) + $ShippingCharge;
            } else {
                $ShippingCharge = 0;
                $grandTotal = ($subTotal - $discount) + $ShippingCharge;
            }

            $order = new Order;
            $order->user_id = $user->id;
            $order->subtotal = $subTotal;
            $order->shipping = $ShippingCharge;
            $order->coupon_code = $promoCode;
            $order->coupon_code_id = $discountCodeId;
            $order->discount = $discount;
            $order->grand_total = $grandTotal;
            $order->payment_status = 'not_paid';
            $order->status = 'pending';

            $order->full_name = $request->full_name;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->province_id = $request->province_id;
            $order->city_id = $request->city_id;
            $order->address = $request->address;
            $order->save();

            // Store order items in order items table
            foreach (Cart::content() as $item) {
                $orderItem = new OrderItem();
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->name = $item->name;
                $orderItem->qty = $item->qty;
                $orderItem->price = $item->price;
                $orderItem->total = $item->price * $item->qty;
                $orderItem->save();
            }
            Cart::destroy();
            session()->forget('code');
            return response()->json(['message' => 'Orders Placed successfully', 'order_id' => $order->id]);
        } else {
            // Handle other payment methods here
        }
    }

    public function getOrderSummary(Request $request)
    {
        $subTotal = Cart::subtotal(2, '.', '');
        $discount = 0;
        $discountString = '';
        //Apply Discount
        if (session()->has('code')) {
            $code = session()->get('code');

            if ($code->type == 'percent') {
                $discount = ($code->discount_amount / 100) * $subTotal;
            } else {
                $discount = $code->discount_amount;
            }
            $discountString = '<div id="discount-response">
                                        <button type="button" class="btn btn-primary btn-label right mt-2"
                                            id="delete-coupon-code">
                                            <i
                                                class="ri-delete-bin-5-line label-icon align-middle fs-16 ms-2 text-danger"></i>
                                            ' . session()->get('code')->code . '
                                        </button>
                                    </div>';
        }


        if ($request->cities_id > 0) {
            $shippingInfo = ShippingCharge::where('city_id', $request->cities_id)->first();
            $totalQty = 0;
            foreach (Cart::content() as $item) {
                $totalQty += $item->qty;
            }
            if ($shippingInfo != null) {
                $ShippingCharge = $totalQty * $shippingInfo->amount;
                $grandTotal = ($subTotal - $discount) + $ShippingCharge;
                return response()->json([
                    'status' => true,
                    'discount' => number_format($discount, 2),
                    'grandTotal' => number_format($grandTotal, 2),
                    'discountString' => $discountString,
                    'shippingCharge' => number_format($ShippingCharge, 2),
                ]);
            } else {
                $ShippingCharge = 0;
                $grandTotal = ($subTotal - $discount) + $ShippingCharge;
                return response()->json([
                    'status' => true,
                    'discount' => number_format($discount, 2),
                    'discountString' => $discountString,
                    'grandTotal' => number_format($grandTotal, 2),
                    'shippingCharge' => number_format($ShippingCharge, 2),
                ]);
            }
        } else {
            return response()->json([
                'status' => true,
                'discount' => number_format($discount, 2),
                'discountString' => $discountString,
                'grandTotal' => number_format($subTotal - $discount, 2),
                'shippingCharge' => number_format(0, 2),
            ]);
        }
    }

    public function applyDiscount(Request $request)
    {
        // dd('clicked');
        $code = Coupon::where('code', $request->code)->first();
        if ($code == null) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid discount Coupon',
            ]);
        }
        //check if coupon start date is valid or not
        $now = Carbon::now();

        if ($code->expires_at != "") {
            $endDate = Carbon::parse($code->expires_at);
            if ($now->gt($endDate)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Coupon Code has already expired',
                ]);
            }
        }


        //Max Uses Check
        if ($code->max_uses > 0) {
            $couponUsed = Order::where('coupon_code_id', $code->id)->count();
            if ($couponUsed >= $code->max_uses) {
                return response()->json([
                    'status' => false,
                    'message' => 'You Already used this coupon',
                ]);
            }
        }

        //Max Uses User Check
        if ($code->max_uses_user > 0) {
            $couponUsedByUser = Order::where(['coupon_code_id' => $code->id, 'user_id' => Auth::user()->id])->count();
            if ($couponUsedByUser >= $code->max_uses_user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Max uses already used this coupon',

                ]);
            }
        }
        $subTotal = Cart::subtotal(2, '.', '');
        //Minimum amount condition check
        if ($code->min_amount > 0) {
            if ($subTotal < $code->min_amount) {
                return response()->json([
                    'status' => false,
                    'message' => 'Your min amount must be Rs. ' . $code->min_amount . '',
                ]);
            }
        }

        session()->put('code', $code);
        return $this->getOrderSummary($request);
    }
    public function removeCoupon(Request $request)
    {
        session()->forget('code');
        return $this->getOrderSummary($request);
    }
}
