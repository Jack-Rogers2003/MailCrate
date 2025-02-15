<?php


namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Tag;
use Livewire\WithFileUploads;
use Livewire\Component;

class PostComponenet extends Component
{

    use WithFileUploads;
    public $text = "working";
    public $isAuthenticated;
    public $image;
    public $posts;
    public $showCommentReply = false;
    public $showPostComments = false;
    public $tagsToSelect;
    public $selectedTags = [];
    public $tagButtons;


    public function mount() 
    {
        $this->posts = Post::get();
    }

    public function render()
    {
        $this->isAuthenticated = Auth::check();
        $this->tagButtons = Tag::all('type')->pluck('type')->toArray();
        // Pass the name to the Blade view
        return view('livewire.post-componenet');
    }

    public function loadPosts() {
        $this->posts = Post::all();
    }

    public function tagSelected($button) {
        if($this->selectedTags != null && in_array($button, $this->selectedTags)) {
            unset($this->selectedTags[array_search($button, $this->selectedTags)]);
        } else {
            $this->selectedTags[] = $button;
        }
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


        $post = Post::create([
            'title' => $title,
            'content' => $content,
            'film_name' => $film,
            'image_name' => $imageName,
            'mime_type' => $mimeType,
            'image_data' => $imageContent,
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
        }
}
