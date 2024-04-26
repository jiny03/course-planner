<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AccountController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function loginForm()
    {
        // automatically redirect to profile page if user tried access /login page after the user logged in
        if (Auth::check()) {
            return redirect()->route('account.profile');
        }
        else {
            return view('account/login');
        }
    }

    public function login(Request $request)
    {
        $loginWasSuccessful = Auth::attempt([
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ]);

        if ($loginWasSuccessful) {
            return redirect()
                ->route('account.profile')
                ->with('success', "Succesfully logged in account as '{$request->input('username')}'.");
        }
        else {
            return redirect()->route('login')->with('error', 'Invalid credentials.');
        }
    }
}
