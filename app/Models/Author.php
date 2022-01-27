<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    //define one to one relation with profile model
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
