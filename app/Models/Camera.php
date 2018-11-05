<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    protected $fillable = [
        'module_id', 'iccid', 'model_id', 'remotecurrent', 'columns', 'thumbs',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function photos() {
        return $this->hasMany(Photo::class);
    }

    public function actions() {
        return $this->hasMany(Action::class);
    }

    public function log_apis() {
        return $this->hasMany(LogApi::class);
    }

}
