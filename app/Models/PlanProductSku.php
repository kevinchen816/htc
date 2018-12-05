<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\PlanProduct;

class PlanProductSku extends Model
{
    protected $fillable = [
        'title', 'description', 'active',
        'rating', 'sold_count', 'price',
        // 'stock'
    ];

    public function product() {
        return $this->belongsTo(PlanProduct::class);
    }
}
