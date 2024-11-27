<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate form input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // If successful, redirect to the intended page or dashboard
            return redirect()->intended('/');
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'Invalid credentials. Please try again.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}