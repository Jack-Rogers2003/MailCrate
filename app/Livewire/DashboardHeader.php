<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;


use Livewire\Component;

class DashboardHeader extends Component
{
    public $isAuthenticated;
    
    public function render()
    {
        $this->isAuthenticated = Auth::check();
        
        return view('livewire.dashboard-header', [
            'name' => Auth::check() ? Auth::user()->name : '',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/auth')->with('success', 'Logged out successfully');
    }

    public function sentToAuth() {
        return redirect('/auth');
    }
}
