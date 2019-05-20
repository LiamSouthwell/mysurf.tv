<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserPlaylistVideo;
use App\Jobs\FetchVideos;
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
    	$videos = UserPlaylistVideo::Where("playlist_id", "=", $id)->get();
    	$passablevids = [];
    	foreach($videos as $video){
    		array_push($passablevids, $this->getVideo($video->id));
    	}
    	return $passablevids;	
    }

    public function addvideotoplaylist(Request $request){
    	$video = new UserPlaylistVideo;
    	$video->id = $request['videoid'];
    	$video->playlist_id = $request['playlistid'];
    	$video->save();
    	return "Saved";
    }

    public function delete($id){
        return UserPlaylist::where('id', '=', $id)->delete();
    }

    private function getVideo($id){
        $videoGrabber = new FetchVideos();
        return $videoGrabber->video($id);
    }
}
