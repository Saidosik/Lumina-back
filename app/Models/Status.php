<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'message_id',
        'status',
        'scheduled_at',
    ];
}
