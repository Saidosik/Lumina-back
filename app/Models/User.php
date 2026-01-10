<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Атрибуты, которые можно массово заполнять.
     */
    protected $fillable = [
        'userName',
        'login',
        'email',
        'password',
        'login',
    ];

    /**
     * Атрибуты, которые должны быть скрыты при сериализации.
     */
    protected $hidden = [
        'password',
        'login',
        'remember_token',
    ];

    /**
     * Преобразования типов.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function reposts(){
        return $this->hasMany(Repost::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likeds(){
        return $this->hasMany(Liked::class);
    }

    public function sources(){
        return $this->hasMany(Source::class);
    }

    public function subs(){
        return $this->hasMany(Subscriber::class, 'user_id');
    }

    public function creators(){
        return $this->hasMany(Subscriber::class, 'creator_id');
    }
}