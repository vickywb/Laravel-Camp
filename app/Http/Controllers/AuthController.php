<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.user.login');
    }

    public function userLogin(Request $request)
    {
        // $user = User::where('email', $request->email);
        Auth::loginUsingId(2);
        // dd($user);

        // if (!$user) {
        //     return 'Email atau Password anda Salah!';
        // }

        return view('user.dashboard');
    }
}
