<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //a comment belong to one post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
