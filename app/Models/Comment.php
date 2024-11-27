<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function commenter()
    {
        return $this->belongsTo(Account::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'commentable_id');
    }
}
