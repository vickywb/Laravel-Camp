<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function renderLogin()
    {
        return view('auth.admin.login');
    }

    public function login(Request $request)
    {
        $user = $this->userRepository->findByColumn($request->email, 'email');

        if (!$user) {
            return redirect()->back()->withErrors([
                'errors' => 'Username and Password did not match.'
            ]);
        }

        if ($user->role != 1) {
            return redirect()->back()->withErrors([
                'errors' => 'Sorry, This is Admin Area.'
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors([
                'message' => 'Username and Password did not match.'
            ]);
        }

        Auth::login($user, true);

        return redirect()->route('admin.dashboard');
    }
}
