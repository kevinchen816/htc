<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'iccid', 'user_id', 'status', 'points', 'points_used'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
