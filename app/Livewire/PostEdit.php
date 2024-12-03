<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class PostEdit extends Component
{

    public $postID;

    public function mount($id)
    {
        $this->postID = $id; 
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
        return redirect('/');
    }
}
