<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function showDashboard()
    {
        $name = Auth::check() ? Auth::user()->name : '';  // Default to 'Guest' if no user is authenticated
        
        // Pass the name to the Blade view
        return view('livewire/dashboard', ['name' => $name]);
    }
}