<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;


use Livewire\Component;

class ProfilePage extends Component
{


    public $userID;

    public function mount($id)
    {
        $this->userID = $id;  // Access the ID from the URL
    }

    public function render()
    {   
        
        return view('livewire.profile-page', [
            'id' => $this->userID]);
    }
}


