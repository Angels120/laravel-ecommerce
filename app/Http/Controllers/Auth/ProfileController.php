<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
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
        return view('auth.account.profile',compact('breadcrumb'));
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
}
