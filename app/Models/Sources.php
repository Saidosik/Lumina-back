<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sources extends Model
{
    protected $fillable = [
        'user_id', 'name', 'path', 'size', 'type', 'duration'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->hasMany(Post::class, 'post_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class, 'source_id');
    }
}
