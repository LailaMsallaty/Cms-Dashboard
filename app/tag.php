<?php

namespace App;
use App\Post;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    protected $fillable = ['name'];

    public function posts(){

        return $this->belongsToMany(Post::class);
    }
}
