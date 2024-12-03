<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;


class PostEdit extends Component
{

    public $postID;
    public $selectedTags = [];
    public $tagButtons;

    public function mount($id)
    {
        $this->postID = $id;
        $this->tagButtons = Tag::all('type')->pluck('type')->toArray();
        $tags = \App\Models\Post::find($this->postID)->tags;
        foreach($tags as $tag) {
            $this->selectedTags[] = $tag->type;
        }
    }

    public function tagSelected($tagName) {
        if($this->selectedTags != null && in_array($tagName, $this->selectedTags)) {
            unset($this->selectedTags[array_search($tagName, $this->selectedTags)]);
        } else {
            $this->selectedTags[] = $tagName;
        }
    }


    public function render()
    {
        return view('livewire.post-edit', [
            'post' => Post::find($this->postID)]);
    }

    public function applyEdit($title, $film, $content) {
        Post::where('id', $this->postID)->update([
            'content' => $content,
            'title' => $title,
            'film_name' => $film
        ]);

        Post::find($this->postID)->tags()->detach();

        foreach ($this->selectedTags as $tag) {
            $tagToAdd = Tag::where('type', $tag)->get();
            Post::find($this->postID)->tags()->attach($tagToAdd);
        }
        return redirect('/');

    }
}
