<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerifiedRatingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verified_rating_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_user_id');
            $table->string('email');
            $table->unsignedBigInteger('to_user_id')->nullable();
            $table->boolean('published')->default(0);
            $table->string('rating')->nullable();
            $table->string('audio')->nullable();
            $table->string('video')->nullable();
            $table->dateTime('reviwed_on')->nullable();
            $table->string('url_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('from_user_id')->references('id')->on('users');
            $table->foreign('to_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verified_rating_requests');
    }
}
