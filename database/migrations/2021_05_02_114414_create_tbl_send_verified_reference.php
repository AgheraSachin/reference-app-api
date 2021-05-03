<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSendVerifiedReference extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_verified_reference', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->unsignedBigInteger('from_user_id');
            $table->string('reference_id');
            $table->string('access_code');
            $table->string('access_token');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('from_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('send_verified_reference');
    }
}
