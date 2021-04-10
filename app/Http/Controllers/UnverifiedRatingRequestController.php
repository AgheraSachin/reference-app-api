<?php

namespace App\Http\Controllers;

use App\Mail\UnverifiedRatingRequestMail;
use App\Models\UnverifiedRatingRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UnverifiedRatingRequestController extends Controller
{
    /**
     * @api {post} /request-for-unverified-rating 1. Make Request For Give Rating
     * @apiName 1
     * @apiUse APIHeader2
     * @apiGroup Unverified Rating
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
    public function makeRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()], 503);
        }
        if (UnverifiedRatingRequest::where(['from_user_id' => Auth::user()->id, 'email' => $request->get('email')])->exists()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => "You have already previouslly requested same user"], 503);
        }

        $lastData = UnverifiedRatingRequest::where('from_user_id', Auth::user()->id)->first();
        $lastRequestCount = 1;
        if (isset($lastData->last_request_on) && Carbon::parse($lastData->last_request_on)->isCurrentDay()) {
            if ($lastData->last_request_count < config('constants.daily_unverified_email_request')) {
                $lastRequestCount += $lastData->last_request_count;
            } else {
                return response()->json(['status' => false, 'responseCode' => 503, 'body' => "You have reached daily max limit to sent request."], 503);

            }
        }
        $token = Str::random(60);
        $params = [
            'from_user_id' => Auth::user()->id,
            'email' => $request->get('email'),
            'last_request_on' => now(),
            'last_request_count' => $lastRequestCount,
            'url_token' => $token,
        ];

        $result = UnverifiedRatingRequest::create($params);

        if ($result) {
            Mail::to($request->get('email'))->send(new UnverifiedRatingRequestMail($token, Auth::user()));
            return response()->json(['status' => true, 'responseCode' => 200, 'body' => 'Request sent successfully'], 200);
        } else {
            return response()->json(['status' => false, 'responseCode' => 500, 'body' => 'Something went wrong'], 200);
        }
    }

    /**
     * @api {post} /request-for-unverified-rating-review 2. Complete Review for rating
     * @apiName 2
     * @apiGroup Unverified Rating
     * @apiParam {String} url_token string
     * @apiParam {String} full_name string
     * @apiParam {String} occupation string
     * @apiParam {Number} rating number
     * @apiParam {String} comment string
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
    public function review(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url_token' => 'required|exists:unverified_request_ratings,url_token',
            'full_name' => 'required',
            'occupation' => 'required',
            'rating' => 'required',
            'comment' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()], 503);
        }
        if (UnverifiedRatingRequest::where('url_token', $request->get('url_token'))->whereNotNull('reviwed_on')->exists()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => 'Review on this request already submitted.'], 503);
        }
        $params = [
            'reviewer_full_name' => $request->get('full_name'),
            'reviewer_occupations' => $request->get('occupation'),
            'rating' => $request->get('rating'),
            'comment' => $request->get('comment'),
            'reviwed_on' => now(),
        ];

        $result = UnverifiedRatingRequest::where('url_token', $request->get('url_token'))->update($params);

        if ($result) {
            return response()->json(['status' => true, 'responseCode' => 200, 'body' => 'Review Successfully'], 200);
        } else {
            return response()->json(['status' => false, 'responseCode' => 500, 'body' => 'Something went wrong'], 500);
        }
    }

    /**
     * @api {get} /publish-unverified-rating/{id} 3. Publish Given Rating
     * @apiName 3
     * @apiGroup Unverified Rating
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
            'id' => 'required|exists:unverified_request_ratings,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()], 503);
        };
        $result = UnverifiedRatingRequest::where('id', $id)->update(['published' => 1]);
        if ($result) {
            return response()->json(['status' => true, 'responseCode' => 200, 'body' => 'Review published Successfully'], 200);
        } else {
            return response()->json(['status' => false, 'responseCode' => 500, 'body' => 'Something went wrong'], 500);
        }
    }

    /**
     * @api {get} /all-unverified-rating 4. Get All Given Rating
     * @apiName 4
     * @apiGroup Unverified Rating
     * @apiSuccess {Boolean} status true
     * @apiSuccess {number} responseCode number
     * @apiSuccess {Object} body object
     * @apiSuccessExample {json} Success-200:
     * HTTP/1.1 200 OK
     * {
     *      "status": true,
     *      "responseCode": 200,
     *      "body": [
     *                   {
     *                       "id": 3,
     *                       "from_user_id": 1,
     *                       "email": "test@test1.com",
     *                       "published": 1,
     *                       "reviewer_full_name": "Mural tel",
     *                       "reviewer_occupations": "Software Engineer",
     *                       "rating": "5",
     *                       "comment": "He is such a great perrson",
     *                       "last_request_on": "2021-04-04",
     *                       "last_request_count": "1",
     *                       "reviwed_on": "2021-04-04 06:46:30",
     *                       "url_token": "PcXCHFp9EM60KarvJ2AfAlDxKgNFDihQUIUTWpixMcpoUQQYeOPhsnHbVX6f",
     *                       "created_at": "2021-04-04T05:46:27.000000Z",
     *                       "updated_at": "2021-04-04T12:02:33.000000Z",
     *                       "deleted_at": null
     *                  }
     *           ]
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
    public function allRatings(Request $request)
    {
        $result = UnverifiedRatingRequest::where('from_user_id', Auth::user()->id)->get();
        if ($result) {
            return response()->json(['status' => true, 'responseCode' => 200, 'body' => $result], 200);
        } else {
            return response()->json(['status' => false, 'responseCode' => 500, 'body' => 'Something went wrong'], 500);
        }
    }
}
