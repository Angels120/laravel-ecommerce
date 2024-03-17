<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use  Illuminate\Support\Str;



class ForgotPasswordController extends Controller
{
    //This is my custom forgot password code.
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function  processForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ], [
            'email.exists' => 'The entered email is invalid.',
        ]);

        $token = Str::random(64);
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        $user = User::where('email', $request->email)->first();
        $mailData = [
            'name' => $user->name,
            'url' => 'http://127.0.0.1:8000/',
            'token' => $token,
            'subject' => 'You have requested to Reset Password',
        ];
        Mail::to($request->email)->send(new ResetPasswordEmail($mailData));
        return redirect()->route('password.request')->with('success', 'We have mailed your password reset link!');
    }
    public function resetPassword($token)
    {
        $tokenExist = DB::table('password_reset_tokens')->where('token', $token)->first();
        if ($tokenExist == null) {
            return redirect()->route('password.request')->with('error', 'Invalid Request!');
        }
        return view('auth.passwords.reset', [
            'token' => $token
        ]);
    }
    public function processResetPassword(Request $request)
    {
        $token = $request->token;
        $tokenObj = DB::table('password_reset_tokens')->where('token', $token)->first();

        if ($tokenObj == null) {
            return redirect()->route('password.request')->with('error', 'Invalid Request!');
        }

        $user = User::where('email', $tokenObj->email)->first();


        $validateData = $request->validate([
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ], [
            'password_confirmation.same' => 'The password confirmation does not match.',
        ]);

        User::where('id', $user->id)->update([
            'password' => Hash::make($request->password)
        ]);
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        return redirect()->route('login')->with('success', 'Password reset successfully.');
    }
}
