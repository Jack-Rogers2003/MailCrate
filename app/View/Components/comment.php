<?php


namespace App\View\Components;

use Illuminate\View\Component;

class Comment extends Component
{
    public $comment;

    // Pass the comment data through the constructor
    public function __construct($child)
    {
        $this->comment = $comment;
    }

    public function render()
    {
        return view('components.comment');
    }

    public function sentToProfile($id) {
        return redirect()->route('profile', ['userID' => $id]);
    }
}