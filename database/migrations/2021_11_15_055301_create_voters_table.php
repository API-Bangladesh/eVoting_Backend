<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voters', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('member_id')->nullable()->unique();
            $table->string('category')->nullable();
            $table->string('email_address')->nullable()->unique();
            $table->string('contact_number')->nullable()->unique();
            $table->string('image')->nullable();
            $table->tinyInteger('is_online_voter')->nullable();
            $table->tinyInteger('is_checked_in')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('voters');
    }
}
