<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanProduct extends Model
{
    protected $fillable = [
        'region', 'currency',
        'title', 'description', 'points', 'image', 'active',
        'rating', 'sold_count', 'price'
    ];

    protected $casts = [
        'on_sale' => 'boolean', // on_sale 是一个布尔类型的字段
    ];

    // public $timestamps = false;

    /* 与商品SKU关联 */
    public function skus() {
        return $this->hasMany(PlanProductSku::class);
    }
}
