<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    function handleGithubRedirect(){
        return Socialite::driver('github')->redirect();
    }
    public function handleGithubCallback()
    {
        try {

            $githubUser = Socialite::driver('github')->user();

            $existingUser = User::where('email', $githubUser->email)->first();

            if ($existingUser) {

                $existingUser->update([
                    'oauth_id' => $githubUser->id,
                    'oauth_type' => 'github',
                ]);

                Auth::login($existingUser);

                return redirect()->route('home.page');
            } else {
                $newUser = User::create([
                    'name' => $githubUser->nickname,
                    'username' => $githubUser->nickname,
                    'email' => $githubUser->email,
                    'oauth_id' => $githubUser->id,
                    'oauth_type' => 'github',
                    'password' => Hash::make($githubUser->id),
                ]);

                Auth::login($newUser);

                return redirect()->route('home.page');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
