<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function loginForm($type)
    {
        return view('auth.login', compact('type'));
    }
}
