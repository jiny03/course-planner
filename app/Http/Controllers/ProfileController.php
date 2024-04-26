<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('account/profile', [
            'user' => Auth::user(),
        ]);
    }
}
