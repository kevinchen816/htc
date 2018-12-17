<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\PlanProduct;
use App\Models\PlanProductSku;
use App\Models\Order;

class OrderItem extends Model
{
    protected $fillable = [
        'quantity', 'price',
        'iccid', 'sub_plan', 'points', 'month',
        // 'rating', 'review', 'reviewed_at'
    ];
    // protected $dates = ['reviewed_at'];
    public $timestamps = false;

    /* function name must be planProduct -> plan_product_id */
    // public function product() { // NG
    public function planProduct() {
        return $this->belongsTo(PlanProduct::class);
    }

    /* function name must be planProductSku -> plan_product_sku_id */
    // public function productSku() { // NG
    public function planProductSku() {
        return $this->belongsTo(PlanProductSku::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
