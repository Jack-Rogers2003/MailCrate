<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;


use Livewire\Component;

class ProfilePage extends Component
{
    public function render()
    {
        return view('livewire.profile-page', [
            'id' => Auth::check() ? Auth::user()->id : '']);
    }
}
