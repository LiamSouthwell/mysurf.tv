<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPlaylistVideo extends Model
{
	protected $fillable = [
        'id', 'playlist_id'
    ];
        public function playlist()
    {
        return $this->belongsTo('App\UserPlaylist');
    }
}
