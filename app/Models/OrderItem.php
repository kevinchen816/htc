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
        // 'rating', 'review', 'reviewed_at'
    ];
    // protected $dates = ['reviewed_at'];
    public $timestamps = false;

    // public function product() {
    public function planProduct() {
        return $this->belongsTo(PlanProduct::class);
    }

    // public function productSku() {
    public function planProductSku() {
        return $this->belongsTo(PlanProductSku::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
