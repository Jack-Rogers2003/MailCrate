<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Account;


class AuthController extends Controller
{
    public function showAuthForm()
    {
        return view('auth');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('')->with('success', 'Logged in successfully');
        }

        return back()->withErrors(['login' => 'Invalid credentials'])->withInput();
    }

    public function register(Request $request)
    {
        $Validator = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Account::create([
            'user_id' => $user->id,
            'name' => $request->name
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/auth')->with('success', 'Logged out successfully');
    }
}
