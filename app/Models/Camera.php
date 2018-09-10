<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    protected $fillable = [
        'module_id', 'iccid', 'model_id',
    ];

    public function photos() {
        return $this->hasMany(Photo::class);
    }
}
