<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class PostEdit extends Controller
{
    public function showPostToEdit($postID)
    {     
        $postToEdit = Post::where('id', $postID)->first();

        if($postToEdit !== null && Auth::check()) {
            if($postToEdit->account_id === Auth::user()->account_id) {
                return redirect('/');
            } else {
                return view('postEdit', compact('postID'));
            }
        } else {
            return redirect('/');
        }

    }
}
