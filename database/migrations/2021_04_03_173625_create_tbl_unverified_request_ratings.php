<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblUnverifiedRequestRatings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unverified_request_ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_user_id');
            $table->string('email');
            $table->boolean('published')->default(0);
            $table->string('reviewer_full_name')->nullable();
            $table->string('reviewer_occupations')->nullable();
            $table->string('rating')->nullable();
            $table->text('comment')->nullable();
            $table->date('last_request_on')->nullable();
            $table->string('last_request_count')->default(1)->nullable();
            $table->dateTime('reviwed_on')->nullable();
            $table->string('url_token')->nullable();
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
        Schema::dropIfExists('unverified_request_ratings');
    }
}
