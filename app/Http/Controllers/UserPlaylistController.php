<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserPlaylistVideo;
use App\UserPlaylist;
use Auth;

class UserPlaylistController extends Controller
{
    public function fetch(){
    	return UserPlaylist::Where("user_id", "=", Auth::User()->id)->get()->toJson();
    }

    public function store(Request $request){
    	$playlist = new UserPlaylist();
    	$playlist->name = $request['name'];
    	$playlist->user_id = Auth::User()->id;
    	$playlist->save();
    	return "Added";
    }
}
