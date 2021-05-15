<?php

namespace App\Http\Controllers;

use App\Jobs\uploadAudioVideoFilesJob;
use App\Mail\UnverifiedRatingRequestMail;
use App\Mail\VerifiedRatingRequestMail;
use App\Models\UnverifiedRatingRequest;
use App\Models\User;
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
            Mail::to($request->get('email'))->send(new VerifiedRatingRequestMail($token, Auth::user(), $request->get('email')));
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
        try {
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
                $params['audio'] = $filename;
                Storage::put('Audio/' . $filename, (string)$content, 'public');
                // uploadAudioVideoFilesJob::dispatch($content,$filename, Auth::user(),'audio');

            } else {
                $filename = time() . '.webm';
                $content = file_get_contents($request->file('review'));
                $params['video'] = $filename;
                Storage::put('Video/' . $filename, (string)$content, 'public');
                //uploadAudioVideoFilesJob::dispatch($request->file('review'),$filename, Auth::user(),'video');
            }

            $result = VerifiedRatingRequest::where('url_token', $request->get('token'))->update($params);

            if ($result) {
                return response()->json(['status' => true, 'responseCode' => 200, 'body' => 'Review Successfully'], 200);
            } else {
                return response()->json(['status' => false, 'responseCode' => 500, 'body' => 'Something went wrong'], 200);
            }

        } catch (\Exception $e) {
            echo "<pre>";
            print_r($e);
            exit;
        }
    }

    /**
     * @api {get} /all-verified-rating?page={page_number}&per_page={count} 3. Get All Verified ratings
     * @apiName 3
     * @apiGroup Audio Video Reference
     * @apiSuccess {Boolean} status true
     * @apiSuccess {number} responseCode number
     * @apiSuccess {Object} body object
     * @apiSuccessExample {json} Success-200:
     * HTTP/1.1 200 OK
     *
     * {
     * "status": true,
     * "responseCode": 200,
     * "body": {
     * "current_page": 1,
     * "data": [
     * {
     * "id": 1,
     * "from_user_id": 1,
     * "email": "sachinagheara@gmail.com",
     * "to_user_id": 2,
     * "published": 0,
     * "rating": "3",
     * "audio": null,
     * "video": "1619686360.webm",
     * "reviwed_on": "2021-04-29 08:52:40",
     * "url_token": "wyXjl8jghPV7lQgHr1p105skCJIj7b1GTgRpLAViRw7NngeSXBMj2AkYB6OM",
     * "created_at": "2021-04-29T07:39:56.000000Z",
     * "updated_at": "2021-04-29T08:52:40.000000Z",
     * "deleted_at": null,
     * "img":"https://dsdad/adad/ts.png"
     * }
     * ],
     * "first_page_url": "http://localhost:8000/api/all-verified-rating?page=1",
     * "from": 1,
     * "last_page": 1,
     * "last_page_url": "http://localhost:8000/api/all-verified-rating?page=1",
     * "links": [
     * {
     * "url": null,
     * "label": "&laquo; Previous",
     * "active": false
     * },
     * {
     * "url": "http://localhost:8000/api/all-verified-rating?page=1",
     * "label": "1",
     * "active": true
     * },
     * {
     * "url": null,
     * "label": "Next &raquo;",
     * "active": false
     * }
     * ],
     * "next_page_url": null,
     * "path": "http://localhost:8000/api/all-verified-rating",
     * "per_page": "10",
     * "prev_page_url": null,
     * "to": 1,
     * "total": 1
     * }
     * }
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
    public function allRatings($filter = null, Request $request)
    {
        if ($filter == 'unpublished') {
            $result = VerifiedRatingRequest::where('from_user_id', Auth::user()->id)->where('published', 0)->paginate($request->get('per_page'));
        } else {
            $result = VerifiedRatingRequest::where('from_user_id', Auth::user()->id)->where('published', 1)->paginate($request->get('per_page'));
        }
        foreach ($result->items() as $key => $val) {
            if (isset($val['to_user_id'])) {
                $pic = User::where('id', $val['to_user_id'])->pluck('profile_pic');
                if ($pic[0] != null) {
                    $result->items()[$key]['profile_pic'] = $pic[0];
                } else {
                    $result->items()[$key]['profile_pic'] = null;
                }
            }
        }
        if ($result) {
            return response()->json(['status' => true, 'responseCode' => 200, 'body' => $result], 200);
        } else {
            return response()->json(['status' => false, 'responseCode' => 500, 'body' => 'Something went wrong'], 200);
        }
    }

    /**
     * @api {get} /publish-verified-rating/{id} 4. Publish Given Audio/Video Reference
     * @apiName 4
     * @apiGroup Audio Video Reference
     * @apiSuccess {Boolean} status true
     * @apiSuccess {number} responseCode number
     * @apiSuccess {Object} body object
     * @apiSuccessExample {json} Success-200:
     * HTTP/1.1 200 OK
     * {
     *      "status": true,
     *      "responseCode": 200,
     *      "body": "Review published Successfully"
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
    public function publish($id)
    {
        $data['id'] = $id;
        $validator = Validator::make($data, [
            'id' => 'required|exists:verified_rating_requests,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()], 200);
        };
        $result = VerifiedRatingRequest::where('id', $id)->update(['published' => 1]);
        if ($result) {
            return response()->json(['status' => true, 'responseCode' => 200, 'body' => 'Review published Successfully'], 200);
        } else {
            return response()->json(['status' => false, 'responseCode' => 500, 'body' => 'Something went wrong'], 200);
        }
    }
}
