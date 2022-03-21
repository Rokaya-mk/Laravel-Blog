<?php

namespace App\Models;

use App\Scopes\AdminScope;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['title', 'content', 'slug', 'active','user_id'];

    public function comments()
    {
        return $this->hasMany(Comment::class)->dernier();
    }

    //local scope :post mostComented
    public function scopeMostCommented(Builder $query){
        return $query->withCount('comments')->orderBy('comments_count','desc');
    }
    //local scope get postUsers with comments and tags
    public function scopePostUserCommentsTags(Builder $query){
        return $query->withCount('comments')->with(['user','tags']);
    }
    //delete post with comments
    public static function boot()
    {
        static::addGlobalScope(new AdminScope);
        parent::boot();

        static::addGlobalScope(new LatestScope);
        static::deleting(function (Post $post) {
            $post->comments()->delete();
        });

        static::updating(function (Post $post) {
            Cache::forget("post-show-{$post->id}");
        });

        static::restoring(function (Post $post) {
            $post->comments()->restore();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function tags(){
        return $this->belongsToMany(Tag::class );
    }

    //one post has only one image
    public function image(){
        return $this->hasOne(Image::class);
    }

    
}
