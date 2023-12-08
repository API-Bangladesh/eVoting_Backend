<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->unique();
            $table->tinyInteger('is_used')->nullable();
            $table->timestamp('scan_blank_ballot')->nullable();
            $table->timestamp('scan_voted_ballot')->nullable();
            $table->foreignId('validated_by')->nullable()->constrained('users', 'id');
            $table->foreignId('verified_by')->nullable()->constrained('users', 'id');
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
        Schema::dropIfExists('qr_codes');
    }
}
