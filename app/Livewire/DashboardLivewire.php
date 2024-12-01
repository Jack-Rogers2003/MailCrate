<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;


use Livewire\Component;

class DashboardLivewire extends Component
{   
    public $text = "working";
    public $isAuthenticated;

    public function render()
    {
        $this->isAuthenticated = Auth::check();
        // Pass the name to the Blade view
        return view('livewire.dashboard', [
            'name' => Auth::check() ? Auth::user()->name : '',
            'posts' => Post::get()
        ]);
    }

    public function post($title, $film, $content) {
        Post::create([
            'title' => $title,
            'content' => $content,
            'film_name' => $film,
            'account_id' => Auth::user()->id
        ]);
    }

    public function sentToProfile($id) {
        return redirect()->route('profile', ['userID' => $id]);
    }

    public function delete($postID) {
        Post::find($postID)->delete();
    }
}