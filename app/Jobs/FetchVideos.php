<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
//Queueable, implements ShouldQueue
class FetchVideos 
{
    use Dispatchable, InteractsWithQueue,  SerializesModels;

    

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        return "";
    }

    /**
     * Grab a specific video given an ID
     */
    public function video($id){
        $client = new Client();
        $res = $client->request(
            'GET', 
            'https://edge.api.brightcove.com/playback/v1/accounts/2728142626001/videos/'.$id, 
            [
                'headers' => [
                    'BCOV-Policy' => env('BRIGHTCOVE_POLICY_KEY'),
            ]
        ]);
        if($res->getStatusCode() == 200){
            return json_decode($res->getBody()->getContents());
        }
    }

    /**
     * Grab an array of related videoinfo given a video ID
     */
    public function related($id){
        $client = new Client();
        $res = $client->request(
            'GET', 
            'https://edge.api.brightcove.com/playback/v1/accounts/2728142626001/videos/'.$id.'/related', 
            [
                'headers' => [
                    'BCOV-Policy' => env('BRIGHTCOVE_POLICY_KEY'),
            ]
        ]);
        if($res->getStatusCode() == 200){
            return $res->getBody()->getContents();
        }
    }

    /**
     * Grab an array of 20 videos recently uploaded to brightcove
     */

    public function recent(){
        $client = new Client();
        $res = $client->request(
            'GET', 
            'https://edge.api.brightcove.com/playback/v1/accounts/2728142626001/videos?sort=-created_at', 
            [
                'headers' => [
                    'BCOV-Policy' => env('BRIGHTCOVE_POLICY_KEY'),
                ]
            ]);
        if($res->getStatusCode() != 200)
            return $res->getStatusCode();
        else
            return $res->getBody()->getContents();
    }

    /**
     * Grab an array of 20 videos given a number of URI encoded terms
     */

    public function search($terms){
        $client = new Client();
        $res = $client->request(
            'GET', 
            'https://edge.api.brightcove.com/playback/v1/accounts/2728142626001/videos?q='.$terms, 
            [
                'headers' => [
                    'BCOV-Policy' => env('BRIGHTCOVE_POLICY_KEY'),
                ]
            ]);
        if($res->getStatusCode() != 200)
            return $res->getStatusCode();
        else
            return $res->getBody()->getContents();
    }

    /**
     * Grab an array of 20 videos that have the most views in the past 30 days
     */

    public function trending()
    {

        $client = new Client();
        $res = $client->request(
            'GET', 
            'https://analytics.api.brightcove.com/v1/data?accounts=2728142626001&dimensions=video&sort=-video_view&limit=20', 
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$this->accessToken(),
            ]
        ]);

        if($res->getStatusCode() == 200){
            $videos = $res->getBody()->getContents();
            $videos = json_decode($videos);
            $videoinfo = $this->fetchVideos($videos->items);
            return ['videos'=>$videoinfo];
        }

        return "Failure";
    }



    private function accessToken(){
        $client = new Client();
        $res = $client->request(
            'POST', 
            'https://oauth.brightcove.com/v4/access_token?grant_type=client_credentials',
            [
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

    /**
     * Create an array of videoinfo given an array of video ID's
     */
    private function fetchVideos($videos){
        $client = new Client();
        $videoInfo = [];
        foreach($videos as $videoID){
            $res = $client->request(
                'GET', 
                'https://edge.api.brightcove.com/playback/v1/accounts/2728142626001/videos/'.$videoID->video, 
                [
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
}
