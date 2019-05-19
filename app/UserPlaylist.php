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
        return $this->hasMany('App\UserPlaylistVideo');
    }

        public function user()
    {
        return $this->belongsTo('App\User');
    }
}
