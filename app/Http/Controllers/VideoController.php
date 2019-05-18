<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\FetchVideos;
use GuzzleHttp\Client;
use App\CachedVideo;
use App\Playlist;
 
class VideoController extends Controller
{
    //
    public function index(){
        $playlists = Playlist::all();
        return view('welcome')->with('playlists', $playlists);
    }

    public function search(Request $request){
        $videoGrabber = new FetchVideos();
        return $videoGrabber->search($request['terms']);
    }

    public function searchPlaylists(){
        $playlists = Playlist::orderBy('order', 'asc')->get();
        $playlistsforview = [];

        $accessToken = $this->accessToken();

        $client = new Client(); 
        foreach($playlists as $playlist){

        $res = $client->request('GET', 'https://edge.api.brightcove.com/playback/v1/accounts/2728142626001/playlists/'.$playlist->playlistid, [
                'headers' => [
                    'BCOV-Policy' => env('BRIGHTCOVE_POLICY_KEY'),
                ]
            ]);

        if($res->getStatusCode() != 200)
            dd("Something went wrong");
        else
            array_push($playlistsforview, ['title'=> $playlist->name, 'videos'=>json_decode($res->getBody()->getContents())]);
        }

        return $playlistsforview;       
    }

    public function searchPlaylist(Request $request){
        $accessToken = $this->accessToken();

        $client = new Client(); 

        $res = $client->request('GET', 'https://edge.api.brightcove.com/playback/v1/accounts/2728142626001/playlists/'.$request[0], [
                'headers' => [
                    'BCOV-Policy' => env('BRIGHTCOVE_POLICY_KEY'),
                ]
            ]);

        if($res->getStatusCode() != 200)
            dd("Something went wrong");
        else
            return $res->getBody()->getContents();

  
    }

    public function thumbnails($videos){
        $client = new Client();
        $videoInfo = [];
        foreach($videos as $videoID){
            $res = $client->request('GET', 'https://edge.api.brightcove.com/playback/v1/accounts/2728142626001/videos/'.$videoID->video, [
                'headers' => [
                    'BCOV-Policy' => env('BRIGHTCOVE_POLICY_KEY'),
                ]
            ]);
            if($res->getStatusCode() == 200){
                array_push($videoInfo, json_decode($res->getBody()->getContents()));
            }
        }
        return $videoInfo;
    }



    public function getTrending(){
        $videos['videos'] = CachedVideo::latest('created_at')
                    ->where('list', '=', 'trending')
                    ->limit(15)
                    ->get()
                    ->toArray();
        return $videos;
    }

    public function getRecent(Request $request){
        $videoGrabber = new FetchVideos();
        return $videoGrabber->recent();
    }

    public function getRelated(Request $request){
        $videoGrabber = new FetchVideos();
        return $videoGrabber->related($request['id']);
    }

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
