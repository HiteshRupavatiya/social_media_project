<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function logout()
    {
        session()->flush();
        Auth::logout();
        return redirect()->route('login.view')->withSuccess('You logged out successfully');
    }
}
