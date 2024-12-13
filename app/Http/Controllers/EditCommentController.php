<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;



class EditCommentController extends Controller
{
    public function showCommentEdit($commentID)
    {     
        $commentToEdit = Comment::where('id', $commentID)->first();

        if($commentToEdit !== null && Auth::check()) {
            if($commentToEdit->account_id === Auth::user()->account_id) {
                return redirect('/');
            } else {
                return view('commentEdit', compact('commentID'));
            }
        } else {
            return redirect('/');
        }

    }
}