<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;

class EditComment extends Component
{
    public $commentID;

    public $content;

    protected $rules = [
        'content' => 'required',
    ];

    public function mount($id)
    {
        $this->commentID = $id;
    }

    public function render()
    {
        return view('livewire.edit-comment', [
            'comment' => Comment::find($this->commentID)]);
    }

    public function applyEdit($content) {
        $this->content = $content;
        $validatedData = $this->validate();
        Comment::where('id', $this->commentID)->update([
            'content' => $content,
        ]);
        return redirect('/');

    }
}
