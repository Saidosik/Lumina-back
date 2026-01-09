<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id','source_id','title','description'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function source(){
        return $this->belongsTo(Source::class);
    }

    public function creators(){
        return $this->hasOne(User::class, 'creator_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function likeds(){
        return $this->hasMany(Liked::class, 'post_id');
    }
}
