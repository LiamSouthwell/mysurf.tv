<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


//Queueable, implements ShouldQueue
class FetchTrending 
{
    use Dispatchable, InteractsWithQueue,  SerializesModels;

    

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        return "Testing";
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $client = new Client();
        $res = $client->request('GET', 'https://analytics.api.brightcove.com/v1/data?accounts=2728142626001&dimensions=video&sort=-video_view&limit=20', [
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


    private function fetchVideos($videos){
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

}
