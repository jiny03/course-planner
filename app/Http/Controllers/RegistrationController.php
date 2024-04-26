<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('registration/index');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|min:3|max:20|unique:users,username',
            'password' => 'required|string|min:3'
        ]);


        $user = new User($validatedData);
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        return redirect()
            ->route('account.login')
            ->with('success', "Succesfully registered account as '{$validatedData['username']}'.");
    }
}
