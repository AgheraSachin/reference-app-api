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


    Route::post('request-for-audio-video-reference', [\App\Http\Controllers\AudioVideoReferenceController::class, 'makeRequestForAudioVideoReference']);
    Route::post('post-review', [\App\Http\Controllers\AudioVideoReferenceController::class, 'giveReviewAudioVideo']);
    Route::get('publish-verified-rating/{id}', [\App\Http\Controllers\AudioVideoReferenceController::class, 'publish']);
    Route::get('all-verified-rating', [\App\Http\Controllers\AudioVideoReferenceController::class, 'allRatings']);

    //User
    Route::get('signout', [\App\Http\Controllers\AuthController::class, 'signout']);
    Route::post('change-password', [\App\Http\Controllers\AuthController::class, 'changePassword']);
    Route::post('report-bug', [\App\Http\Controllers\ReportBugController::class, 'submit']);

    //sent-my-reference-video
    Route::get('my-conncections', [\App\Http\Controllers\SentMyReferenceController::class, 'connections']);
    Route::post('send-my-references', [\App\Http\Controllers\SentMyReferenceController::class, 'sendReference']);
    Route::post('verify-access-code', [\App\Http\Controllers\SentMyReferenceController::class, 'verifyAccessCode']);
});
