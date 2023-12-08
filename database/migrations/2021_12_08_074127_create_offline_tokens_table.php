<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfflineTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offline_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voter_id')->nullable()->unique()->constrained('voters');
            $table->foreignId('counter_id')->nullable()->constrained('counters');
            $table->string('card_no')->nullable();
            $table->string('token')->nullable()->unique();
            $table->string('phone')->nullable()->unique();
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
        Schema::dropIfExists('offline_tokens');
    }
}
