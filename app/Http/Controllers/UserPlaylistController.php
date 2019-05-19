<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserPlaylistVideo;
use App\UserPlaylist;
use Auth;

class UserPlaylistController extends Controller
{
    public function fetch(){
		return UserPlaylist::Where("user_id", "=", Auth::User()->id)->get();
    }

    public function store(Request $request){
    	$playlist = new UserPlaylist();
    	$playlist->name = $request['name'];
    	$playlist->user_id = Auth::User()->id;
    	$playlist->save();
    	return "Added";
    }

    public function playlistvideos($id){
    	return UserPlaylistVideo::Where("playlist_id", "=", $id)->get()->toJson();
    }

    public function addvideotoplaylist(Request $request){
    	$video = new UserPlaylistVideo;
    	$video->id = $request['videoid'];
    	$video->playlist_id = $request['playlistid'];
    	$video->save();
    	return "Saved";
    }
}
