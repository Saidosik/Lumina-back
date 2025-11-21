<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMembers extends Model
{


            protected $fillable = [
        'chat_id',
        'user_id',
        'role',
        
    ];
}
