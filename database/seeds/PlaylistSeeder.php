<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('playlists')->insert([
         	'name' => 'Test',
            'playlistid' => 'thisisaplaylistid',
            'order' => 1,
         ]);

         DB::table('playlists')->insert([
         	'name' => 'Test2',
            'playlistid' => 'thisisaplaylistid2',
            'order' => 2,
         ]);
    }
}
