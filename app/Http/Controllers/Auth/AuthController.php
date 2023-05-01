<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:40',
            'email'                 => 'required|email|unique:users,email|max:50',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ]);

        $token = Str::random(64);

        $user = User::create($request->only(
            [
                'name',
                'email'
            ]
        ) + [
            'password'                 => Hash::make($request->password),
            'remember_token'           => Str::random(10),
            'email_verification_token' => $token
        ]);

        Mail::send('emails.varifyAccount', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Verify your account");
        });

        return redirect()->route('login.view')->withSuccess('Signed in successfully');
    }

    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password')) && Auth::user()->email_verified_at) {
            return redirect()->route('dashboard')->withSuccess("Logged in successfully");
        }

        return redirect()->route('login.view')->withError('User creaditials are invalid');
    }

    public function dashboard()
    {
        if (Auth::check()) {
            if (Auth::user()->type == 'Admin') {
                return view('admins.dashboard');
            }
            if (Auth::user()->type == 'User') {
                return view('users.dashboard');
            }
        }

        return redirect()->route('login.view')->withError('You are unauthorized please logged in first');
    }

    public function verifyEmail($token)
    {
        $user = User::where('email_verification_token', $token)->first();
        if ($user) {
            if ($user->email_verified_at) {
                return redirect()->route('login.view')->withError('Email already verified');
            } else {
                $user->update([
                    'email_verified_at'        => now(),
                    'email_verification_token' => null
                ]);
                return redirect()->route('login.view')->withSuccess('Email verified successfully');
            }
        }
        return redirect()->route('register.view')->withError('Invalid verification token');
    }

    public function forgotPasswordForm()
    {
        return view('forgot_password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $token = Str::random(64);

        PasswordReset::where('email', $request->email)->delete();

        $password_reset = PasswordReset::create([
            'email' => $request->email,
            'token' => $token
        ]);

        Mail::send('emails.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Reset Password Mail");
        });

        return redirect()->back()->withSuccess("Password reset mail successfully send to your email");
    }

    public function resetPasswordForm($token)
    {
        $password_reset = PasswordReset::where('token', $token)->first();
        if ($password_reset) {
            return view('reset_password', compact('password_reset'));
        }
        return redirect()->back()->withError("Invalid token");
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password'         => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            PasswordReset::where('email', $request->email)->delete();

            return redirect()->route('login.view')->withSuccess('Your password has been changed successfully');
        }

        return redirect()->back()->withInput()->withError("Invalid Token!");
    }
}
