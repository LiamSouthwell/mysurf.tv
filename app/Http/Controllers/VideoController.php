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

        // 200
        //echo $res->getHeader('content-type');
        // 'application/json; charset=utf8'


    }



//    public function search(){
//    	$client = new Client();
//    	$json = [
//		    'key-data' => [
//		        'account-id' => '6022296345001',
//		        'apis' => ['search'],
//		    ],
//		];


//   	$res = $client->request('GET', 'https://policy.api.brightcove.com/v1/accounts/6022296345001/policy_keys', [
    		//ADD AUTHENTICATION IN HEADER @ https://support.brightcove.com/overview-policy-api#Search_videos HEADER SECTION    		
//    		'headers' => [
//                'Authorization' => 'Bearer {access_token}',
//            ],
//            'json' => $json,
//        ]);

    	//$res = $client->request('GET', 'https://edge.api.brightcove.com/playback/v1/accounts/6022296345001/videos', [
        //    'headers' => [
        //        'BCOV-Policy' => 'BCpkADawqM2QNpRhEA926u-QG_ei9CPIY1y941jcI1U71ftdpcMpiOlzQ2rUPrBIyXiYxKaA8UM8yTapGq1wu1KfehOG6x7EzovzDd_v4w1UVfIMJlgIpNZTz8zVchFwepInsFKzbuHWUPKo',
        //    ],
        //]);
    	//echo $res->getStatusCode();
        // 200
        //echo $res->getHeader('content-type');
        // 'application/json; charset=utf8'
        //echo $res->getBody();
    //}
}
