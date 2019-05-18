<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCachedVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cached_videos', function (Blueprint $table) {
            $table->bigIncrements('identifier');
            $table->string('name');
            $table->string('description');
            $table->integer('duration');
            $table->string('thumbnail');
            $table->string('id');
            $table->string('list');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cached_videos');
    }
}
