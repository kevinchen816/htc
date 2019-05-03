<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EZCode extends Model
{
    protected $fillable = [
        'ezcode', 'module_id', 'region', 'style', 'status'
    ];

}