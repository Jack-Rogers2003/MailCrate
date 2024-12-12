<?php

namespace App\Livewire;

use Livewire\Component;

class CommentComponent extends Component
{

    public $comment;

    public function mount($child) {
        $this->comment = $child;
    }
    public function render()
    {
        return view('livewire.comment-component');
    }

    public function sentToProfile($id) {
        return redirect()->route('profile', ['userID' => $id]);
    }
}
