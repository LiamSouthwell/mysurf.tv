<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class VideoController extends Controller
{
    //

    public function thumbnail(Request $request){
        $client = new Client();
        $videoInfo = [];
        foreach($request['videos'] as $videoID){
            $res = $client->request('GET', 'https://edge.api.brightcove.com/playback/v1/accounts/6022296345001/videos/'.$videoID, [
                'headers' => [
                    'BCOV-Policy' => 'BCpkADawqM2QNpRhEA926u-QG_ei9CPIY1y941jcI1U71ftdpcMpiOlzQ2rUPrBIyXiYxKaA8UM8yTapGq1wu1KfehOG6x7EzovzDd_v4w1UVfIMJlgIpNZTz8zVchFwepInsFKzbuHWUPKo',
                ]
            ]);
            if($res->getStatusCode() == 200){
                array_push($videoInfo, json_decode($res->getBody()->getContents()));
            }
        }
        return $videoInfo;
    }


    public function watch($videoID){
        return view('test')->with('videoID', $videoID);
    }

    public function search(Request $request){
        $accessToken = $this->accessToken();

        $body = json_encode([
            'key-data' => [
                'account-id' => '2728142626001',
                'apis' => ['search'],
            ],
        ]);
        
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





        /* $client = new Client();
        $res = $client->request('GET', 'https://policy.api.brightcove.com/v1/accounts/2728142626001/policy_keys', [
                'headers' => [
                    'Authorization' => 'Bearer {access_token}',
                ]
            ]);
        --------------WHEN ACCESS TOKEN IS OBTAINABLE THEN CAN REQUEST POLICY KEY ----------------------------
            */
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

/* THIS IS CODE TO REQUEST A SEARCH-ENABLED POLICY KEY
$client = new Client();
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
