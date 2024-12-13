<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Account;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;



use Livewire\Component;

class DashboardLivewire extends Component
{   
    use WithFileUploads;

    public $text = "working";
    public $isAuthenticated;
    public $email;

    public $image;
    public $content;
    public $title;
    public $film;


    public $posts = [];
    public $showCommentReply = false;
    public $showPostComments = false;
    public $editPost = false;
    public $tagsToSelect;
    public $selectedTags = [];
    public $tagButtons;
    public $perPage = 10;

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
        'film' => 'required',
    ];

    public function mount() 
    {
        $this->posts = Post::get();
    }

    public function render()
    {
        $this->isAuthenticated = Auth::check();
        $this->tagButtons = Tag::all('type')->pluck('type')->toArray();
        // Pass the name to the Blade view
        return view('livewire.dashboard');
    }

    public function tagSelected($button) {
        if($this->selectedTags != null && in_array($button, $this->selectedTags)) {
            unset($this->selectedTags[array_search($button, $this->selectedTags)]);
        } else {
            $this->selectedTags[] = $button;
        }
    }

    public function deleteComment($commentID) {
        Comment::find($commentID)->delete();
    }


    public function loadPosts() {
        $this->posts = Post::all();
    }

    public function post() {

        $validatedData = $this->validate();

        $post = Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'film_name' => $this->film,
            'account_id' => Auth::user()->id
        ]);
        
        foreach ($this->selectedTags as $tag) {
            $tagToAdd = Tag::where('type', $tag)->get();
            $post->tags()->attach($tagToAdd);
        }
        $this->posts = Post::all();
    }

    public function sentToProfile($id) {
        return redirect()->route('profile', ['userID' => $id]);
    }

    public function editComment($commentID) {
        return redirect()->route('edit_comment', ['commentID' => $commentID]);
    }

    public function viewPost($postID) {
        return redirect()->route('post_view_full', ['postID' => $postID]);
    }

    public function delete($postID) {
        Post::find($postID)->delete();
        $this->posts = Post::all();
    }

    public function edit($id) {
        return redirect()->route('edit_post', ['postID' => $id]);
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

    
    public function showReplyToComment($commentID)
    {
        $property = "showcommentReply{$commentID}";

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
        $post = Post::find($postID);
        $account = Account::find($post->account_id);
        $this->email = User::find($account->user_id)->email;
        Mail::raw("Someone commented on your post!", function ($message) {
            $message->to($this->email)->subject('Post commented on');
        });
    }

}