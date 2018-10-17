<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'camera_id', 'filename', 'upload_resolution', 'source','datetime','filepath', 'action'
    ];

    //protected $hidden = [
    //    'password', 'remember_token',
    //];

    public function camera() {
        return $this->belongsTo(Camera::class);
    }
}
