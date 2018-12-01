<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanProductSku extends Model
{
    protected $fillable = [
        'title', 'description', 'on_sale',
        'rating', 'sold_count', 'price',
        // 'stock'
    ];

    public function product() {
        return $this->belongsTo(PlanProduct::class);
    }
}
