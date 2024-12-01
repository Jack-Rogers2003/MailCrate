<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Account;

class ProfilePageController extends Controller
{
    public function showProfile($userID)
    {       
        $currentUserID = Account::where('user_id', Auth::id())->first();
        if($currentUserID && $userID == $currentUserID->id) {
            return view('profile');
        } else {
            return redirect('/');
        }
    }
}