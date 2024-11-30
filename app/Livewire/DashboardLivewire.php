<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;


use Livewire\Component;

class DashboardLivewire extends Component
{   
    public $text = "working";

    public function render()
    {
        
        // Pass the name to the Blade view
        return view('livewire.dashboard', [
            'name' => Auth::check() ? Auth::user()->name : '',
        ]);
    }

    public function addText($toAdd) {
        $this->text = $toAdd;
    }
}