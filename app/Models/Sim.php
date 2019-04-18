<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sim extends Model
{
    protected $fillable = [
        'iccid', 'imsi', 'phone_num', 'region', 'style', 'status', 'note'
    ];
}