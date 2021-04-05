<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('accessToken', [\App\Http\Controllers\AuthController::class, 'accessTokenRetrive']);
Route::post('signup', [\App\Http\Controllers\AuthController::class, 'signup']);
Route::post('signin', [\App\Http\Controllers\AuthController::class, 'signin']);
Route::post('request-for-unverified-rating-review', [\App\Http\Controllers\UnverifiedRatingRequestController::class, 'review']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('request-for-unverified-rating', [\App\Http\Controllers\UnverifiedRatingRequestController::class, 'makeRequest']);
    Route::get('publish-unverified-rating/{id}', [\App\Http\Controllers\UnverifiedRatingRequestController::class, 'publish']);
    Route::get('all-unverified-rating', [\App\Http\Controllers\UnverifiedRatingRequestController::class, 'allRatings']);


    Route::post('request-for-audio-video-refference', [\App\Http\Controllers\AudioVideoReferenceController::class, 'makeRequestForAudioVideoReference']);
});
