<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobile extends Model
{
    protected $fillable = [
        'device_id', 'push_id', 'name', 'model', 'os', 'ver', 'change'
    ];
}
