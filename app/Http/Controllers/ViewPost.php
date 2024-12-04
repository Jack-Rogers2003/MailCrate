<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewPost extends Controller
{
    public function showPost($postID)
    {       
        return view('postView', compact('postID'));
    }
}
