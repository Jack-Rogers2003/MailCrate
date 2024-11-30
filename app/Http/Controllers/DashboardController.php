<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function showDashboard()
    {        
        // Pass the name to the Blade view
        return view('dashboard');
    }
}