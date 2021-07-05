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
Route::post('verify-access-code', [\App\Http\Controllers\SentMyReferenceController::class, 'verifyAccessCode']);
Route::post('send-notification', [\App\Http\Controllers\SentMyReferenceController::class, 'sendNotification']);
Route::post('contact-us', [\App\Http\Controllers\ContactUsController::class, 'create']);
Route::post('iframe-data', [\App\Http\Controllers\AuthController::class, 'decryptCode']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('request-for-unverified-rating', [\App\Http\Controllers\UnverifiedRatingRequestController::class, 'makeRequest']);
    Route::get('publish-unverified-rating/{id}', [\App\Http\Controllers\UnverifiedRatingRequestController::class, 'publish']);
    Route::get('all-unverified-rating/{filter?}', [\App\Http\Controllers\UnverifiedRatingRequestController::class, 'allRatings']);
    Route::get('delete-unverified-rating/{id}', [\App\Http\Controllers\UnverifiedRatingRequestController::class, 'delete']);


    Route::post('request-for-audio-video-reference', [\App\Http\Controllers\AudioVideoReferenceController::class, 'makeRequestForAudioVideoReference']);
    Route::post('post-review', [\App\Http\Controllers\AudioVideoReferenceController::class, 'giveReviewAudioVideo']);
    Route::get('publish-verified-rating/{id}', [\App\Http\Controllers\AudioVideoReferenceController::class, 'publish']);
    Route::get('all-verified-rating/{filter?}', [\App\Http\Controllers\AudioVideoReferenceController::class, 'allRatings']);
    Route::get('delete-verified-rating/{id}', [\App\Http\Controllers\AudioVideoReferenceController::class, 'delete']);

    //User
    Route::get('signout', [\App\Http\Controllers\AuthController::class, 'signout']);
    Route::post('change-password', [\App\Http\Controllers\AuthController::class, 'changePassword']);
    Route::post('report-bug', [\App\Http\Controllers\ReportBugController::class, 'submit']);
    Route::get('delete-account', [\App\Http\Controllers\AuthController::class, 'delete']);
    Route::get('get-my-notification', [\App\Http\Controllers\SentMyReferenceController::class, 'getNotification']);

    //sent-my-reference-video
    Route::get('my-conncections', [\App\Http\Controllers\SentMyReferenceController::class, 'connections']);
    Route::post('send-my-references', [\App\Http\Controllers\SentMyReferenceController::class, 'sendReference']);

    Route::get('my-encrypt-code',[\App\Http\Controllers\AuthController::class, 'encryptCode']);
});
