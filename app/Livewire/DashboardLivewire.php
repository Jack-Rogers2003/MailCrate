<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use Livewire\WithFileUploads;



use Livewire\Component;

class DashboardLivewire extends Component
{   
    use WithFileUploads;
    public $text = "working";
    public $isAuthenticated;
    public $image;
    public $posts = [];
    public $showCommentReply = false;
    public $showPostComments = false;
    public $editPost = false;



    public function render()
    {
        $this->isAuthenticated = Auth::check();
        // Pass the name to the Blade view
        $this->posts = Post::get();
        return view('livewire.dashboard', [
            'name' => Auth::check() ? Auth::user()->name : '',
            'posts' => Post::get()
        ]);
    }

    public function post($title, $film, $content) {

        if(!is_null($this->image)) {
            $imageContent = file_get_contents($this->image->getRealPath());
            $mimeType = $this->image->getMimeType();
            $imageName = $this->image->getClientOriginalName();
        } else {
            $imageContent = null;
            $mimeType = null;
            $imageName = null;
        }


        Post::create([
            'title' => $title,
            'content' => $content,
            'film_name' => $film,
            'image_name' => $imageName,
            'mime_type' => $mimeType,
            'image_data' => $imageContent,
            'account_id' => Auth::user()->id
        ]);
    }

    public function sentToProfile($id) {
        return redirect()->route('profile', ['userID' => $id]);
    }

    public function delete($postID) {
        Post::find($postID)->delete();
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

    public function toggleEdit()
    {
        $this->editPost = !$this->editPost;
    }

    public function togglePostComments($postID)
    {
        $property = "showCommentInput__{$postID}";

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
}