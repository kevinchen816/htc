<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;

class CartItem extends Model
{
    protected $fillable = ['quantity'];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function planProductSku() {
        return $this->belongsTo(PlanProductSku::class);
    }
}
