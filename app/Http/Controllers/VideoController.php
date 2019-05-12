<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Playlist;
 
class VideoController extends Controller
{
    //
    public function index(){
        $playlists = Playlist::all();
        return view('welcome')->with('playlists', $playlists);
    }

    public function thumbnail(Request $request){
        $client = new Client();
        $thumbs = $this.requestthumbnails($request['videos']);
        return $thumbs;
    }

    public function search(Request $request){
        $client = new Client();
        $res = $client->request('GET', 'https://edge.api.brightcove.com/playback/v1/accounts/2728142626001/videos?q='.$request['terms'], [
                'headers' => [
                    'BCOV-Policy' => env('BRIGHTCOVE_POLICY_KEY'),
                ]
            ]);
        if($res->getStatusCode() != 200)
            return $res->getStatusCode();
        else
            return $res->getBody()->getContents();
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
            array_push($playlistsforview, ['displayname'=> $playlist->name, 'playlist'=>json_decode($res->getBody()->getContents())]);
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

    function accessToken(){
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
        $client = new Client();
            $res = $client->request('GET', 'https://analytics.api.brightcove.com/v1/data?accounts=2728142626001&dimensions=video&sort=-video_view&limit=20', [
                'headers' => [
                    'Authorization' => 'Bearer '.$this->accessToken(),
                ]
            ]);
            if($res->getStatusCode() == 200){
                $videos = $res->getBody()->getContents();
                $videos = json_decode($videos);
                $thumbnails = $this->thumbnails($videos->items);
                return ['videos'=>$thumbnails];
            }
    }

    public function getRelated(Request $request){
        $client = new Client();
            $res = $client->request('GET', 'https://edge.api.brightcove.com/playback/v1/accounts/2728142626001/videos/'.$request['id'].'/related', [
                'headers' => [
                    'BCOV-Policy' => env('BRIGHTCOVE_POLICY_KEY'),
                ]
            ]);
            if($res->getStatusCode() == 200){
                return $res->getBody()->getContents();
            }
    }




/* THIS IS CODE TO REQUEST A SEARCH-ENABLED POLICY KEY
        $client = new Client();
        $accessToken = $this->accessToken();
        $body = json_encode([
            'key-data' => [
                'account-id' => '2728142626001',
                'apis' => ['search'],
            ],
        ]);
        $res = $client->request('POST', 'https://policy.api.brightcove.com/v1/accounts/2728142626001/policy_keys', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                ],
                'body' => $body,
            ]);
        dd(json_decode($res->getBody()->getContents()));
*/

}
