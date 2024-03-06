<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile(){
        $breadcrumb = [
            'breadcrumbs' => [
                'WebMart' => route('home.page'),
                'current_menu' => 'My Profile',
            ],
        ];
        $user=User::where('id',Auth::user()->id)->first();
        return view('auth.account.profile',compact('breadcrumb','user'));
    }
    public function updateProfile(Request $request){
        // dd('heere');

    }

    public function order(){
        $breadcrumb = [
            'breadcrumbs' => [
                'WebMart' => route('home.page'),
                'current_menu' => 'My Order',
            ],
        ];
        $user=Auth::user();
        $orders=Order::where('user_id',$user->id)->orderBy('created_at','DESC')->get();

        return view('auth.account.order',compact('breadcrumb','orders'));
    }

    public function orderDetail($id){
        $breadcrumb = [
            'breadcrumbs' => [
                'WebMart' => route('home.page'),
                'My Order' => route('user.order'),
                'current_menu' => 'Order-Detail',
            ],
        ];
        $user=Auth::user();
        $order=Order::where('user_id',$user->id)->where('id',$id)->first();
        $orderItems=OrderItem::where('order_id',$id)->get();
        return view('auth.account.order-detail',compact('breadcrumb','order','orderItems'));

    }

    public function wishlist(){
        $breadcrumb = [
            'breadcrumbs' => [
                'WebMart' => route('home.page'),
                'current_menu' => 'My Wishlist',
            ],
        ];
        $user=Auth::user();
        $wishlists=Wishlist::where('user_id',$user->id)->with('product')->get();

        return view('auth.account.wishlist',compact('breadcrumb','wishlists'));
    }
    public function removeProductFromWishlist(Request $request){
        $wishlists=Wishlist::where('user_id',Auth::user()->id)->where('product_id',$request->id)->first();
        if($wishlists==null){
            return response()->json([
                'status'=>true,
                'message'=>'product removed already'
            ]);
        }else{
            $wishlists=Wishlist::where('user_id',Auth::user()->id)->where('product_id',$request->id)->delete();
            return response()->json([
                'status'=>true,
                'message'=>'product removed successfully'
            ]);
        }
    }
}
