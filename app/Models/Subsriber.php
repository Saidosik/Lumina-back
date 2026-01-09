<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subsriber extends Model
{
    protected $fillable = [
        'user_id','creator_id'
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function creator(){
        return $this->belongsTo(User::class, 'creator_id');
    }
}
