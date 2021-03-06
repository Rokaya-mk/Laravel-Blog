<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
   //add morph to comment
   public function comments(){
    return $this->morphMany(Comment::class,'commentable')->dernier();
}

    //use morhp with image model
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }

    //scope :users most actives
    public function scopeMostActiveUsers(Builder $query){
        return $query->withCount('posts')->orderBy('posts_count','desc');
    }

    //active users in last month
    public function scopeActiveUserLastMonth(Builder $query){
        return $query->withCount(['posts' => function($query){
            $query->whereBetween(static::CREATED_AT,[now()->subMonths(1),now()]);
        }])
        ->having('posts_count','>',4)
        ->orderBy('posts_count','desc');
    }
}
