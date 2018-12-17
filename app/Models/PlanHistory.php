<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanHistory extends Model
{

    protected $table = 'plan_history';

    protected $fillable = [
        'iccid',
        'user_id',

        'event',
        'points',
        'points_reserve',

        'sub_id', 'sub_plan', 'sub_start', 'sub_end',
        'pay_invoice', 'pay_method', 'pay_no', 'pay_info', 'pay_at',
    ];
}
