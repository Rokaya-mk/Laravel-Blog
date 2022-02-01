<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['title', 'content', 'slug', 'active'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //delete post with comments
    public static function boot()
    {
        parent::boot();
        static::deleting(function (Post $post) {
            $post->comments()->delete();
        });

        static::restoring(function (Post $post) {
            $post->comments()->restore();
        });
    }
}
