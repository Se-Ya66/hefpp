<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = [
        'message',
    ];

    public function send(): BelongsTo
    {
        return $this->belongsToMany('App\Models\User', 'messages', 'receive_id', 'send_id')->withTimestamps();
    }

    // public function sendings(): BelongsToMany
    // {
    //     return $this->belongsToMany('App\Models\User', 'messages', 'send_id', 'receive_id')->withTimestamps();
    // }
}
