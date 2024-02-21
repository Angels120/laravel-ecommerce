<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(){
        $breadcrumb = [
            'breadcrumbs' => [
                'WebMart' => route('home.page'),
                'current_menu' => 'Profile',
            ],
        ];
        return view('auth.profile.profile',compact('breadcrumb'));
    }
}
