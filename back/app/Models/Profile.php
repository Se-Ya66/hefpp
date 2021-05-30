<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    protected $fillable = [
        'prefecture',
        'type',
        'file_path',
        'url',
        'introduction',
        'address',
        'tel',
    ];

    public function user(): HasOne
    {
        return $this->hasOne('App\Models\User');
    }
}
