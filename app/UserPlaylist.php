<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPlaylist extends Model
{
	protected $fillable = [
        'name'
    ];
        public function video()
    {
        return $this->belongsTo('App\UserPlaylistVideo');
    }
}
