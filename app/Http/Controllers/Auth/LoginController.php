<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {

        if (Session::has('url.intended')) {
            $intendedUrl = Session::get('url.intended');

            Session::forget('url.intended');

            return redirect($intendedUrl);
        }
        if ($user->hasAnyRole(['Admin', 'Super Admin'])) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->intended($this->redirectPath());
    }
}
