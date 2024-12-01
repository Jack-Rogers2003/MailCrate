<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;



use Livewire\Component;

class ProfilePage extends Component
{
    public $isAuthenticated;

    public $userID;

    public function mount($id)
    {
        $this->userID = $id; 
    }

    public function render()
    {   
        $this->isAuthenticated = Auth::check();
        
        return view('livewire.profile-page', [
            'id' => $this->userID,
            'posts' => Post::where('account_id', $this->userID)->get()]);
    }
}


