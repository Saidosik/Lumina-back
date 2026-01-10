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


    public function AllData(){

    }
}