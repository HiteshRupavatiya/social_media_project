<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class TwoFactorAuthenticationController extends Controller
{
    public function index()
    {
        return view('two_step_verification');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        $findCode = User::where('id', auth()->user()->id)
            ->where('code', $request->code)
            ->where('updated_at', '>=', now()->subMinutes(2))
            ->first();

        if (!is_null($findCode)) {
            Session::put('two_factor_code_user', auth()->user()->id);
            return redirect()->route('dashboard')->withSuccess('Two step verification completed');
        }

        return redirect()->back()->withError('Invalid two step verification code');
    }

    public function resend()
    {
        auth()->user()->generateCode();

        return back()->withSuccess('We sent you code on your email.');
    }
}
