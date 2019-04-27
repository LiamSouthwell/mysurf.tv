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
         	'name' => 'nudie SurfGroms',
            'playlistid' => '5762486047001',
            'order' => 1,
         ]);

         DB::table('playlists')->insert([
         	'name' => 'The Hold Down TV Series',
            'playlistid' => '5762486045001',
            'order' => 2,
         ]);
    }
}
