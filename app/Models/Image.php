<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;
    protected $fillable=['path'];

    //one image belong to one post
    // public function post(){
    //     return $this->belongsTo(Post::class);
    // }
    //use polymorphisme with post, user model
    public function imageable(){
        return $this->morphTo();
    }
    //get url of image
    public function url(){
        return Storage::url($this->path);
    }
}
