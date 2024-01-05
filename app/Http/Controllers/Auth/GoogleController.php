<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    function handleGoogleRedirect(){
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {

            $googleUser = Socialite::driver('google')->user();

            $existingUser = User::where('email', $googleUser->email)->first();

            if ($existingUser) {
                $existingUser->update([
                    'oauth_id' => $googleUser->id,
                    'oauth_type' => 'google',
                ]);

                // Log in the existing user
                Auth::login($existingUser);

                return redirect()->route('home.page');
            } else {

                $newUser = User::create([
                    'name' => $googleUser->name,
                    'username' => $googleUser->name,
                    'email' => $googleUser->email,
                    'oauth_id' => $googleUser->id,
                    'oauth_type' => 'google',
                    'password' => Hash::make($googleUser->id),
                ]);

                Auth::login($newUser);

                return redirect()->route('home.page');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
