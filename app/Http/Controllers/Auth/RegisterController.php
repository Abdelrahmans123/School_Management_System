<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function registerForm($type)
    {
        return view('auth.register', compact('type'));
    }
}
