<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('category_id')->nullable();
            $table->tinyInteger('receiver_type_id')->nullable();
            $table->string('subject')->nullable();
            $table->longText('body')->nullable();
            $table->string('sms', 160)->nullable();
            $table->integer('counter')->nullable();
            $table->json('sent_logs')->nullable();

            $table->date('schedule_date')->nullable();
            $table->time('schedule_time')->nullable();

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
        Schema::dropIfExists('email_templates');
    }
}
