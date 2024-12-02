<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;



use Livewire\Component;

class ProfilePage extends Component
{
    public $isAuthenticated;

    public $userID;
    public $showPosts = true;

    public function mount($id)
    {
        $this->userID = $id; 
    }

    public function switchPostsComments() {
        $this->showPosts = !$this->showPosts;
    }

    public function render()
    {   
        $this->isAuthenticated = Auth::check();
        
        return view('livewire.profile-page', [
            'id' => $this->userID,
            'posts' => Post::where('account_id', $this->userID)->get(),
            'comments' => Comment::where('account_id', $this->userID)->get()]);
    }

    public function postsButton() {
        $this->showPosts = true;
    }

    public function commentsButton() {
        $this->showPosts = false;
    }
}


