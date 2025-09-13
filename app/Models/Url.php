<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Url extends Model
{
    protected $fillable = [
        'full_url',
        'short_key',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
