<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\FetchVideos;
use GuzzleHttp\Client;
use App\CachedVideo;
use App\Playlist;
use Auth;
 
class VideoController extends Controller
{
    //return main component
    public function index(){
        $playlists = Playlist::all();
        return view('welcome')->with('playlists', $playlists);
    }
    //search with terms from axios call
    public function search(Request $request){
        $videoGrabber = new FetchVideos();
        return $videoGrabber->search($request['terms']);
    }
    //fetch recent videos
    public function getRecent(Request $request){
        $videoGrabber = new FetchVideos();
        return $videoGrabber->recent();
    }
    //fetch related videos
    public function getRelated(Request $request){
        $videoGrabber = new FetchVideos();
        return $videoGrabber->related($request['id']);
    }
    //get trending videos
    public function getTrending(){
        $videos['videos'] = CachedVideo::latest('created_at')
                    ->where('list', '=', 'trending')
                    ->limit(15)
                    ->get()
                    ->toArray();

        return $videos;
    }
    //return currently logged in user
    public function getUser(){
        if(Auth::Check())
            return Auth::User();
        else
            return ["none"];
    }
    //get a specific video
    public function getVideo($id){
        $videoGrabber = new FetchVideos();
        return $videoGrabber->video($id);
    }  
    //return an array of videos segregated into playlists
    public function searchPlaylists(){
        //get the saved playlists by the admin
        $playlists = Playlist::orderBy('order', 'asc')->get();
        $playlistsforview = [];

        $accessToken = $this->accessToken();

        $client = new Client(); 
        //for each playlist grab an array of video info from brightcove
        foreach($playlists as $playlist){

        $res = $client->request('GET', 'https://edge.api.brightcove.com/playback/v1/accounts/2728142626001/playlists/'.$playlist->playlistid, [
                'headers' => [
                    'BCOV-Policy' => env('BRIGHTCOVE_POLICY_KEY'),
                ]
            ]);

        if($res->getStatusCode() != 200)
            return "Something went wrong";
        else
            //if the call was successful add the playlists to an array of playlists with the title of the playlist
            array_push($playlistsforview, ['title'=> $playlist->name, 'videos'=>json_decode($res->getBody()->getContents())]);
        }
        //return the playlists that we fetched
        return $playlistsforview;       
    }
    //get a brightcove API accesstoken
    private function accessToken(){
        $client = new Client();
        $res = $client->request('POST', 'https://oauth.brightcove.com/v4/access_token?grant_type=client_credentials', [
                'headers' => [
                    'Authorization' => 'Basic '.base64_encode(env('BRIGHTCOVE_CLIENT_ID').':'.env('BRIGHTCOVE_CLIENT_SECRET')),
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ]
            ]);
        if($res->getStatusCode() != 200)
            return $res->getStatusCode();
        else
            return json_decode($res->getBody()->getContents())->access_token;
    }



}
