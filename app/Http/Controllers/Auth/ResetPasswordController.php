<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;

class ResetPasswordController extends Controller
{

    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->save();
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $response = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        return $response === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __('Your password has been reset!'))
            : back()->withErrors(['email' => __($response)]);
    }
}
