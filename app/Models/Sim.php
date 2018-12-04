<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sim extends Model
{
    protected $fillable = [
        'iccid', 'region', 'style', 'status', 'note'
    ];
}
