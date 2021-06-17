<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}
