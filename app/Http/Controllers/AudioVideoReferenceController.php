<?php

namespace App\Http\Controllers;

use App\Mail\UnverifiedRatingRequestMail;
use App\Mail\VerifiedRatingRequestMail;
use App\Models\UnverifiedRatingRequest;
use App\Models\VerifiedRatingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AudioVideoReferenceController extends Controller
{
    /**
     * @api {post} /request-for-audio-video-reference 1. Make Request For Give Audio/Video Reference
     * @apiName 1
     * @apiUse APIHeader2
     * @apiGroup Audio Video Reference
     * @apiParam {String} email email
     * @apiSuccess {Boolean} status true
     * @apiSuccess {number} responseCode number
     * @apiSuccess {Object} body object
     * @apiSuccessExample {json} Success-200:
     * HTTP/1.1 200 OK
     * {
     *      "status": true,
     *      "responseCode": 200,
     *      "body": "Request sent successfully"
     *  }
     * @apiUse APIError
     * @apiErrorExample {json} Error-503:
     * Error 503: Validation Errors
     * {
     *   "success": false,
     *   "responseCode": 503,
     *   "body": "Validation Object"
     * },
     *
     * @apiErrorExample {json} Error-500:
     * Error 500: Server Errors
     * {
     *   "success": false,
     *   "responseCode": 500,
     *   "body": "Something went wrong"
     * }
     */
    public function makeRequestForAudioVideoReference(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()], 200);
        }
        if (VerifiedRatingRequest::where(['from_user_id' => Auth::user()->id, 'email' => $request->get('email')])->exists()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => "You have already previouslly requested same user"], 200);
        }

        $token = Str::random(60);
        $params = [
            'from_user_id' => Auth::user()->id,
            'email' => $request->get('email'),
            'url_token' => $token,
        ];

        $result = VerifiedRatingRequest::create($params);
        if ($result) {
            Mail::to($request->get('email'))->send(new VerifiedRatingRequestMail($token, Auth::user()));
            return response()->json(['status' => true, 'responseCode' => 200, 'body' => 'Request sent successfully'], 200);
        } else {
            return response()->json(['status' => false, 'responseCode' => 500, 'body' => 'Something went wrong'], 200);
        }
    }

    /**
     * @api {post} /post-review 2. Complete Review for Audio/Video reference
     * @apiName 2
     * @apiGroup Audio Video Reference
     * @apiParam {String} token string
     * @apiParam {String} review_type string
     * @apiParam {Number} rating number
     * @apiParam {File} review file
     * @apiSuccess {Boolean} status true
     * @apiSuccess {number} responseCode number
     * @apiSuccess {Object} body object
     * @apiSuccessExample {json} Success-200:
     * HTTP/1.1 200 OK
     * {
     *      "status": true,
     *      "responseCode": 200,
     *      "body": "Review Successfully."
     *  }
     * @apiUse APIError
     * @apiErrorExample {json} Error-503:
     * Error 503: Validation Errors
     * {
     *   "success": false,
     *   "responseCode": 503,
     *   "body": "Validation Object"
     * },
     *
     * @apiErrorExample {json} Error-500:
     * Error 500: Server Errors
     * {
     *   "success": false,
     *   "responseCode": 500,
     *   "body": "Something went wrong"
     * }
     */
    public function giveReviewAudioVideo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|exists:verified_rating_requests,url_token',
            'review_type' => 'required',
            'rating' => 'required',
            'review' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()], 200);
        }
        if (VerifiedRatingRequest::where('url_token', $request->get('token'))->whereNotNull('reviwed_on')->exists()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => 'Review on this request already submitted.'], 200);
        }
        $request_sent_data = VerifiedRatingRequest::where('url_token', $request->get('token'))->first();

        if ($request_sent_data->from_user_id == Auth::user()->id) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => 'You can not review your self.'], 200);
        }
        $params = [
            'to_user_id' => Auth::user()->id,
            'rating' => $request->get('rating'),
            'reviwed_on' => now(),
        ];

        if ($request->get('review_type') == 'audio') {
            $filename = time() . '.mp3';
            $content = file_get_contents($request->file('review'));
            Storage::put('Audio/' . $filename, (string)$content, 'public');
            $params['audio'] = $filename;
        } else {
            $filename = time() . '.mp4';
            $content = file_get_contents($request->file('review'));
            Storage::put('Audio/' . $filename, (string)$content, 'public');
            $params['video'] = $filename;
        }

        $result = VerifiedRatingRequest::where('url_token', $request->get('token'))->update($params);

        if ($result) {
            return response()->json(['status' => true, 'responseCode' => 200, 'body' => 'Review Successfully'], 200);
        } else {
            return response()->json(['status' => false, 'responseCode' => 500, 'body' => 'Something went wrong'], 200);
        }

    }
}
