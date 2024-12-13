<?php

namespace App\Livewire;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


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

    public function sentToProfile($id) {
        return redirect()->route('profile', ['userID' => $id]);
    }

    public function toggleCommentReply($postID)
    {
        $property = "showReplyInput_{$postID}";

        // If the property already exists, toggle it
        if (property_exists($this, $property)) {
            $this->$property = !$this->$property;
        } else {
            // Initialize the property for the first time
            $this->$property = true;
        }
    }

    public function addComment($content, $postID) {
        Comment::create([
            'content' => $content,
            'account_id' => Auth::user()->id,
            'post_id' => $postID
        ]);
        $property = "showReplyInput_{$postID}";
        $this->$property = false;
    }

    public function addCommentToComment($content, $commentID) {
        Comment::create([
            'content' => $content,
            'account_id' => Auth::user()->id,
            'parent_comment_id' => $commentID
        ]);
    }

    public function deleteComment($commentID) {
        Comment::find($commentID)->delete();
    }

    public function editComment($commentID) {
        return redirect()->route('edit_comment', ['commentID' => $commentID]);
    }

    public function showReplyToComment($commentID)
    {
        $property = "showReplyToComment{$commentID}";

        // If the property already exists, toggle it
        if (property_exists($this, $property)) {
            $this->$property = !$this->$property;
        } else {
            // Initialize the property for the first time
            $this->$property = true;
        }
    }
}
