<?php

namespace App\Console\Commands;
use DateTime;
use App\CachedVideo;
use App\Jobs\FetchVideos;
use Illuminate\Console\Command;


class getTrending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:Trending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the platform with trending videos as of the last 30 days from Surfing Australia';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $videoGrabber = new FetchVideos();
        $videos = $videoGrabber->trending();
        foreach($videos['videos'] as $video){
            //update fields of video

            $newvideo = new CachedVideo;
            $newvideo->name = $video->name;
            //check if description is filled out
            if($video->description != null)
                $newvideo->description = $video->description;
            else
                $newvideo->description = " ";
            $newvideo->duration = $video->duration;
            $newvideo->thumbnail = $video->thumbnail;
            $newvideo->video_id = $video->id;
            $newvideo->list = "trending";
            $newvideo->save();
        }
        $this->cleanOldTrending();
        echo "Trending Videos Updated \n";
    }

    private function cleanOldTrending(){
        $date = new DateTime;
        $date->modify('-30 minutes');
        $formatted = $date->format('Y-m-d H:i:s');
        CachedVideo::where(
            [
                ['updated_at', '<=', $formatted], 
                ['list', '=', 'trending']

            ])->delete();
    }
}
