<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'name', 'user_id', 'push_id', 'last_active',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
