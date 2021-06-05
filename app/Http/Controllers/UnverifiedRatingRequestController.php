<?php

namespace App\Http\Controllers;

use App\Mail\UnverifiedRatingRequestMail;
use App\Models\UnverifiedRatingRequest;
use App\Models\User;
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
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()], 200);
        }
        if (UnverifiedRatingRequest::where(['from_user_id' => Auth::user()->id, 'email' => $request->get('email')])->exists()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => "You have already previouslly requested same user"], 200);
        }

        $lastData = UnverifiedRatingRequest::where('from_user_id', Auth::user()->id)->first();
        $lastRequestCount = 1;
        if (isset($lastData->last_request_on) && Carbon::parse($lastData->last_request_on)->isCurrentDay()) {
            if ($lastData->last_request_count < config('constants.daily_unverified_email_request')) {
                $lastRequestCount += $lastData->last_request_count;
            } else {
                return response()->json(['status' => false, 'responseCode' => 503, 'body' => "You have reached daily max limit to sent request."], 200);

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
            Mail::to($request->get('email'))->send(new UnverifiedRatingRequestMail($token, Auth::user(), $request->get('email')));
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
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()], 200);
        }
        if (UnverifiedRatingRequest::where('url_token', $request->get('url_token'))->whereNotNull('reviwed_on')->exists()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => 'Review on this request already submitted.'], 200);
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
            return response()->json(['status' => false, 'responseCode' => 500, 'body' => 'Something went wrong'], 200);
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
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()], 200);
        };
        $result = UnverifiedRatingRequest::where('id', $id)->update(['published' => 1]);
        if ($result) {
            return response()->json(['status' => true, 'responseCode' => 200, 'body' => 'Review published Successfully'], 200);
        } else {
            return response()->json(['status' => false, 'responseCode' => 500, 'body' => 'Something went wrong'], 200);
        }
    }

    /**
     * @api {get} /all-unverified-rating?page={page_number}&per_page={count} 4. Get All Given Rating
     * @apiName 4
     * @apiGroup Unverified Rating
     * @apiSuccess {Boolean} status true
     * @apiSuccess {number} responseCode number
     * @apiSuccess {Object} body object
     * @apiSuccessExample {json} Success-200:
     * HTTP/1.1 200 OK
     *  {
     * "status": true,
     * "responseCode": 200,
     * "body": {
     * "current_page": 1,
     * "data": [
     * {
     * "id": 7,
     * "from_user_id": 1,
     * "email": "tt@tt.com1",
     * "published": 0,
     * "reviewer_full_name": null,
     * "reviewer_occupations": null,
     * "rating": null,
     * "comment": null,
     * "last_request_on": "2021-04-25",
     * "last_request_count": "1",
     * "reviwed_on": null,
     * "url_token": "LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL",
     * "created_at": "2021-04-25T14:46:51.000000Z",
     * "updated_at": "2021-04-25T14:46:51.000000Z",
     * "deleted_at": null
     * },
     * {
     * "id": 8,
     * "from_user_id": 1,
     * "email": "tt@tt.com1",
     * "published": 0,
     * "reviewer_full_name": null,
     * "reviewer_occupations": null,
     * "rating": null,
     * "comment": null,
     * "last_request_on": "2021-04-25",
     * "last_request_count": "1",
     * "reviwed_on": null,
     * "url_token": "LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL",
     * "created_at": "2021-04-25T14:46:51.000000Z",
     * "updated_at": "2021-04-25T14:46:51.000000Z",
     * "deleted_at": null
     * },
     * {
     * "id": 9,
     * "from_user_id": 1,
     * "email": "tt@tt.com1",
     * "published": 0,
     * "reviewer_full_name": null,
     * "reviewer_occupations": null,
     * "rating": null,
     * "comment": null,
     * "last_request_on": "2021-04-25",
     * "last_request_count": "1",
     * "reviwed_on": null,
     * "url_token": "LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL",
     * "created_at": "2021-04-25T14:46:51.000000Z",
     * "updated_at": "2021-04-25T14:46:51.000000Z",
     * "deleted_at": null
     * },
     * {
     * "id": 10,
     * "from_user_id": 1,
     * "email": "tt@tt.com1",
     * "published": 0,
     * "reviewer_full_name": null,
     * "reviewer_occupations": null,
     * "rating": null,
     * "comment": null,
     * "last_request_on": "2021-04-25",
     * "last_request_count": "1",
     * "reviwed_on": null,
     * "url_token": "LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL",
     * "created_at": "2021-04-25T14:46:51.000000Z",
     * "updated_at": "2021-04-25T14:46:51.000000Z",
     * "deleted_at": null
     * },
     * {
     * "id": 11,
     * "from_user_id": 1,
     * "email": "tt@tt.com1",
     * "published": 0,
     * "reviewer_full_name": null,
     * "reviewer_occupations": null,
     * "rating": null,
     * "comment": null,
     * "last_request_on": "2021-04-25",
     * "last_request_count": "1",
     * "reviwed_on": null,
     * "url_token": "LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL",
     * "created_at": "2021-04-25T14:46:51.000000Z",
     * "updated_at": "2021-04-25T14:46:51.000000Z",
     * "deleted_at": null
     * },
     * {
     * "id": 12,
     * "from_user_id": 1,
     * "email": "tt@tt.com1",
     * "published": 0,
     * "reviewer_full_name": null,
     * "reviewer_occupations": null,
     * "rating": null,
     * "comment": null,
     * "last_request_on": "2021-04-25",
     * "last_request_count": "1",
     * "reviwed_on": null,
     * "url_token": "LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL",
     * "created_at": "2021-04-25T14:46:51.000000Z",
     * "updated_at": "2021-04-25T14:46:51.000000Z",
     * "deleted_at": null
     * },
     * {
     * "id": 13,
     * "from_user_id": 1,
     * "email": "tt@tt.com1",
     * "published": 0,
     * "reviewer_full_name": null,
     * "reviewer_occupations": null,
     * "rating": null,
     * "comment": null,
     * "last_request_on": "2021-04-25",
     * "last_request_count": "1",
     * "reviwed_on": null,
     * "url_token": "LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL",
     * "created_at": "2021-04-25T14:46:51.000000Z",
     * "updated_at": "2021-04-25T14:46:51.000000Z",
     * "deleted_at": null
     * },
     * {
     * "id": 14,
     * "from_user_id": 1,
     * "email": "tt@tt.com1",
     * "published": 0,
     * "reviewer_full_name": null,
     * "reviewer_occupations": null,
     * "rating": null,
     * "comment": null,
     * "last_request_on": "2021-04-25",
     * "last_request_count": "1",
     * "reviwed_on": null,
     * "url_token": "LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL",
     * "created_at": "2021-04-25T14:46:51.000000Z",
     * "updated_at": "2021-04-25T14:46:51.000000Z",
     * "deleted_at": null
     * },
     * {
     * "id": 15,
     * "from_user_id": 1,
     * "email": "tt@tt.com1",
     * "published": 0,
     * "reviewer_full_name": null,
     * "reviewer_occupations": null,
     * "rating": null,
     * "comment": null,
     * "last_request_on": "2021-04-25",
     * "last_request_count": "1",
     * "reviwed_on": null,
     * "url_token": "LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL",
     * "created_at": "2021-04-25T14:46:51.000000Z",
     * "updated_at": "2021-04-25T14:46:51.000000Z",
     * "deleted_at": null
     * },
     * {
     * "id": 16,
     * "from_user_id": 1,
     * "email": "tt@tt.com1",
     * "published": 0,
     * "reviewer_full_name": null,
     * "reviewer_occupations": null,
     * "rating": null,
     * "comment": null,
     * "last_request_on": "2021-04-25",
     * "last_request_count": "1",
     * "reviwed_on": null,
     * "url_token": "LwqmdRDtishpjcyMvwaxXE72Onj02L3JX0crtVesS4DEA1QO1Gvm1zCMrUSL",
     * "created_at": "2021-04-25T14:46:51.000000Z",
     * "updated_at": "2021-04-25T14:46:51.000000Z",
     * "deleted_at": null
     * }
     * ],
     * "first_page_url": "http://localhost:8000/api/all-unverified-rating?page=1",
     * "from": 1,
     * "last_page": 2,
     * "last_page_url": "http://localhost:8000/api/all-unverified-rating?page=2",
     * "links": [
     * {
     * "url": null,
     * "label": "&laquo; Previous",
     * "active": false
     * },
     * {
     * "url": "http://localhost:8000/api/all-unverified-rating?page=1",
     * "label": "1",
     * "active": true
     * },
     * {
     * "url": "http://localhost:8000/api/all-unverified-rating?page=2",
     * "label": "2",
     * "active": false
     * },
     * {
     * "url": "http://localhost:8000/api/all-unverified-rating?page=2",
     * "label": "Next &raquo;",
     * "active": false
     * }
     * ],
     * "next_page_url": "http://localhost:8000/api/all-unverified-rating?page=2",
     * "path": "http://localhost:8000/api/all-unverified-rating",
     * "per_page": "10",
     * "prev_page_url": null,
     * "to": 10,
     * "total": 16,
     * "average": 4.75
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
//        if ($filter == 'unpublished') {
//            $result = UnverifiedRatingRequest::where('from_user_id', Auth::user()->id)->where('published', 0)->paginate($request->get('per_page'));
//        } else {
//            $result = UnverifiedRatingRequest::where('from_user_id', Auth::user()->id)->where('published', 1)->paginate($request->get('per_page'));
//        }
        $result = UnverifiedRatingRequest::where('from_user_id', Auth::user()->id)->paginate($request->get('per_page'));
        $average = UnverifiedRatingRequest::where('from_user_id', Auth::user()->id)->avg('rating');
        $custom = collect(['average' => $average]);
        $data = $custom->merge($result);

        if ($result) {
            return response()->json(['status' => true, 'responseCode' => 200, 'body' => $data], 200);
        } else {
            return response()->json(['status' => false, 'responseCode' => 500, 'body' => 'Something went wrong'], 200);
        }
    }

    /**
     * @api {get} /delete-unverified-rating/{id} 5. Delete reference
     * @apiName 5
     * @apiUse APIHeader2
     * @apiGroup Unverified Rating
     * @apiSuccess {Boolean} status true
     * @apiSuccess {number} responseCode number
     * @apiSuccessExample {json} Success-200:
     * HTTP/1.1 200 OK
     * {
     *      "status": true,
     *      "responseCode": 200,
     *      "body": "Delete Successfully"
     *  }
     */
    public function delete($id)
    {
        $data = UnverifiedRatingRequest::find($id);
        $data->delete();
        return response()->json(['status' => true, 'responseCode' => 200, 'body' => "Delete Successfully"], 200);
    }
}
