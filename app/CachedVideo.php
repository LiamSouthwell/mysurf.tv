<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CachedVideo extends Model
{
	protected $fillable = [
        'title', 'description', 'duration', 'thumbnail', 'video_id'
    ];
}
