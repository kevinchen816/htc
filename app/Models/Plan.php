<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'iccid', 'user_id', 'region', 'style', 'status', 'points', 'points_used'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    // public function planProductSku() {
    //     return $this->belongsTo(PlanProductSku::class);
    // }
}
