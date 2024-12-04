<?php

namespace App\Livewire;
use App\Models\Post;


use Livewire\Component;

class ViewPost extends Component
{
    public $postID;
    public $isAuthenticated;

    public function mount($id) {
        $this->postID = $id;
    }

    public function render()
    {
        return view('livewire.view-post', [
            'post' => Post::find($this->postID)]);
    }
}
