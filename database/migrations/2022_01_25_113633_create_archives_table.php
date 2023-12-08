<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('total_voters')->nullable();
            $table->bigInteger('online_voters')->nullable();
            $table->bigInteger('offline_voters')->nullable();
            $table->bigInteger('vote_cast_online')->nullable();
            $table->bigInteger('vote_cast_offline')->nullable();
            $table->bigInteger('total_vote_cast')->nullable();
            $table->integer('total_candidate')->nullable();
            $table->integer('total_position')->nullable();
            $table->json('vote_by_candidate')->nullable();
            //$table->string('elected')->nullable();
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
        Schema::dropIfExists('archives');
    }
}
