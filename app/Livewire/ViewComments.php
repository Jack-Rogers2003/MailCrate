<?php

namespace App\Livewire;

use Livewire\Component;

class ViewComments extends Component
{

    public $postID;
    public $comments;

    public function mount($id) 
    {
        $this->postID = $id;
    }

    public function render()
    {
        $comments = Comment::where('post_id', $this->postID);
        return view('livewire.view-comments', ['comments' => $comments,]);
    }
}
