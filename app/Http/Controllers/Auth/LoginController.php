<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $redirectTo = '/admin/dashboard';

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return redirect()->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => trans('auth.failed'),
                ]);
        }

        return $this->authenticated($request, Auth::user())
            ?: redirect(route('admin.dashboard'));
    }

    protected function authenticated($request, $user)
    {

        if ($user->hasRole('Admin') || $user->hasRole('Super Admin')) {
            return redirect('/admin/dashboard');
        } elseif ($user->hasRole('Customer')) {
            return redirect()->route('home.page');
        }

        return redirect($this->redirectTo);
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
