<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    //a comment belong to one post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    //local Scope
    public function scopeDernier(Builder $query){
        return $query->orderBy(static::UPDATED_AT, 'desc');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
