<?php

namespace App\Models;

use App\Scopes\AdminScope;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    //delete post with comments
    public static function boot()
    {
        static::addGlobalScope(new AdminScope);
        parent::boot();

        static::addGlobalScope(new LatestScope);
        static::deleting(function (Post $post) {
            $post->comments()->delete();
        });

        static::restoring(function (Post $post) {
            $post->comments()->restore();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
