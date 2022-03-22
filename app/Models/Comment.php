<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable= ['content','user_id'];
    //a comment belong to one post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    //add morph comment belong to a post or a user
    public function commentable(){
        return $this->morphTo();
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
     //add morph for tag
     public function tags(){
        return $this->morphToMany(Tag::class,'taggable');
    }
    

    //local Scope
    public function scopeDernier(Builder $query){
        return $query->orderBy(static::UPDATED_AT, 'desc');
    }

    // public static function boot(){
    //     parent::boot();
    //     static::creating(function (Comment $comment) {
    //         Cache::forget("post-show-{$comment->commentable->id}");
    //     });
    // }
}
