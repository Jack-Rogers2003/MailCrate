<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


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

    public function parentComment()
    {
        return $this->belongsTo(Comment::class);
    }

    // A comment can have many child comments
    public function childComments()
    {
        return $this->hasMany(Comment::class);
    }

    protected $fillable = [
        'content',
        'post_id',
        'parent_comment_id',
        'account_id',
    ];
}
