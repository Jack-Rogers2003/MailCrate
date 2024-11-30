<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;


use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        
        // Pass the name to the Blade view
        return view('livewire.dashboard', [
            'name' => Auth::check() ? Auth::user()->name : ''
        ]);
    }

    public function getName() {
        $name = Auth::check() ? Auth::user()->name : '';
    }
}