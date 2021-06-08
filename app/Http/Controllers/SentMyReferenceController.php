<?php

namespace App\Http\Controllers;

use App\Mail\SendVerifiedReferenceMail;
use App\Models\Notification;
use App\Models\SendVerifiedReference;
use App\Models\UnverifiedRatingRequest;
use App\Models\User;
use App\Models\VerifiedRatingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SentMyReferenceController extends Controller
{
    /**
     * @api {get} /my-conncections?page={page_number}&&per_page={per_page} 1. Get Login User's Connections
     * @apiName 1
     * @apiUse APIHeader2
     * @apiGroup Send Verified Reference
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
     * "to_user_id": 2,
     * "rating": "3",
     * "user": {
     * "id": 2,
     * "first_name": "Test2",
     * "last_name": "Test2",
     * "email": "test2@test.com",
     * "profile_pic": null,
     * "created_at": "2021-04-25T14:27:38.000000Z",
     * "updated_at": "2021-04-25T14:27:38.000000Z"
     * }
     * },
     * {
     * "id": 2,
     * "to_user_id": 1,
     * "rating": "3",
     * "user": {
     * "id": 1,
     * "first_name": "Test1",
     * "last_name": "Test1",
     * "email": "test1@test.com",
     * "profile_pic": null,
     * "created_at": "2021-04-25T14:27:38.000000Z",
     * "updated_at": "2021-04-25T14:27:38.000000Z"
     * }
     * }
     * ],
     * "first_page_url": "http://localhost:8000/api/my-conncections?page=1",
     * "from": 1,
     * "last_page": 1,
     * "last_page_url": "http://localhost:8000/api/my-conncections?page=1",
     * "links": [
     * {
     * "url": null,
     * "label": "&laquo; Previous",
     * "active": false
     * },
     * {
     * "url": "http://localhost:8000/api/my-conncections?page=1",
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
     * "path": "http://localhost:8000/api/my-conncections",
     * "per_page": "2",
     * "prev_page_url": null,
     * "to": 2,
     * "total": 2
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
    public function connections(Request $request)
    {
        $connection_from_video_audio = VerifiedRatingRequest::with('user')->where(['from_user_id' => Auth::user()->id, 'published' => 1])->where('reviwed_on', '!=', null)->select('id', 'to_user_id', 'rating')->paginate($request->get('per_page'));
        return response()->json(['status' => true, 'responseCode' => 200, 'body' => $connection_from_video_audio], 200);
    }

    /**
     * @api {post} /send-my-references 2. Send Verified Reference
     * @apiName 2
     * @apiGroup Send Verified Reference
     * @apiUse APIHeader2
     * @apiParam {String} email string
     * @apiParam {Array} reference array
     * @apiParamExample {json} Request-Example:
     * {
     *   email:'xyz12@company.com',
     *   reference[0][id] : 1,
     *   reference[0][email] : 'test1@test.com',
     *    reference[1][id] : 1,
     *   reference[1][email] : 'test2@test.com',
     * }
     * @apiSuccess {Boolean} status true
     * @apiSuccess {number} responseCode number
     * @apiSuccess {Object} body object
     * @apiSuccessExample {json} Success-200:
     * HTTP/1.1 200 OK
     *{
     * "status": true,
     * "responseCode": 200,
     * "body": "Sent reference successfully."
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
    public function sendReference(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'reference.*.id' => 'required',
            'reference.*.email' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()], 200);
        };
        $access_code = substr(str_shuffle("0123456789"), 0, 5);
        $token = Str::random(60);
        foreach ($request->get('reference') as $key => $val) {
            $send_reference = [
                'email' => $request->get('email'),
                'from_user_id' => Auth::user()->id,
                'reference_id' => $val['id'],
                'access_code' => $access_code,
                'access_token' => $token,
            ];
            $result = SendVerifiedReference::create($send_reference);
        }
        if ($result) {
            Mail::to($request->get('email'))->send(new SendVerifiedReferenceMail(Auth::user(), $access_code, $token));
            return response()->json(['status' => true, 'responseCode' => 200, 'body' => 'Sent reference successfully.'], 200);
        } else {
            return response()->json(['status' => false, 'responseCode' => 500, 'body' => 'Something went wrong'], 200);
        }
    }

    /**
     * @api {post} /verify-access-code 2. Access Code Verify
     * @apiName 3
     * @apiGroup Send Verified Reference
     * @apiUse APIHeader2
     * @apiParam {String} access_code string
     * @apiParam {String} access_token string
     * @apiParamExample {json} Request-Example:
     * {
     *   access_code : 35618,
     *   access_token : FYEzlYKQEOR9FIto5f85OiUiUMNmgHT17aVp9Kbc8jgIB0rvLaosplHZVuti,
     * }
     * @apiSuccess {Boolean} status true
     * @apiSuccess {number} responseCode number
     * @apiSuccess {Object} body object
     * @apiSuccessExample {json} Success-200:
     * HTTP/1.1 200 OK
     *{
     * "status": true,
     * "responseCode": 200,
     * "body": [
     * {
     * "id": 1,
     * "from_user_id": 1,
     * "email": "sachinagheara@gmail.com",
     * "to_user_id": 2,
     * "published": 1,
     * "rating": "3",
     * "audio": null,
     * "video": "http://localhost/storage/Video/1619686360.webm",
     * "reviwed_on": "2021-04-29 08:52:40",
     * "url_token": "wyXjl8jghPV7lQgHr1p105skCJIj7b1GTgRpLAViRw7NngeSXBMj2AkYB6OM",
     * "created_at": "2021-04-29T07:39:56.000000Z",
     * "updated_at": "2021-04-29T08:52:40.000000Z",
     * "deleted_at": null
     * }
     * ]
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
    public function verifyAccessCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'access_code' => 'required',
            'access_token' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()], 200);
        };
        if (SendVerifiedReference::where(['access_code' => $request->get('access_code'), 'access_token' => $request->get('access_token')])->exists()) {
            $send_videos = SendVerifiedReference::where(['access_code' => $request->get('access_code'), 'access_token' => $request->get('access_token')])->get();
            $body = [];
            foreach ($send_videos as $key => $val) {
                $video_data = VerifiedRatingRequest::with('user')->where('id', $val['reference_id'])->first()->toArray();
                if ($video_data['audio'] != null) {
                    $video_data['audio'] = $video_data['audio'];
                } else {
                    $video_data['video'] = $video_data['video'];
                }
                $body[] = $video_data;
                if (isset($video_data['user']['profile_pic'])) {
                    $body[$key]['profile_pic'] = $video_data['user']['profile_pic'];
                }
                $body[$key]['email_to'] = $val['email'];
            }

            return response()->json(['status' => true, 'responseCode' => 200, 'body' => $body], 200);
        } else {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => "No Such Access code or token found."], 200);
        }
    }

    /**
     * @api {post} /send-notification 3. Send Notification
     * @apiName 3
     * @apiGroup Send Verified Reference
     * @apiUse APIHeader2
     * @apiParam {string} email string
     * @apiParam {number} from_user_id number
     * @apiParam {array} to_user_id array
     * @apiParamExample {json} Request-Example:
     * {
     *   email:'xyz12@company.com',
     *   from_user_id :1,
     *   to_user_id[0]:2,
     *   to_user_id[1]:3
     * }
     * @apiSuccess {Boolean} status true
     * @apiSuccess {number} responseCode number
     * @apiSuccess {Object} body object
     * @apiSuccessExample {json} Success-200:
     * HTTP/1.1 200 OK
     *{
     *  "status": true,
     * "responseCode": 200,
     * "body": "Notification send successfully"
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
    public function sendNotification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'to_user_id' => 'required',
            'from_user_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()], 200);
        };

        foreach ($request->get('to_user_id') as $key => $val) {
            $user = User::find($request->get('from_user_id'))->get();

            Notification::create(['to_user_id' => $val, 'notification' => '<b>' . $request->get('email') . '</b> has ask you to setup a personal call with your reference <b>' . $user[0]->first_name . ' ' . $user[0]->last_name . "</b>.Don't forgot to organize this call as soon as possible"]);
        }
        return response()->json(['status' => true, 'responseCode' => 200, 'body' => "Notification send successfully"], 200);
    }

    /**
     * @api {get} /get-my-notification 4. Get Notifications
     * @apiName 3
     * @apiGroup Send Verified Reference
     * @apiUse APIHeader2
     * @apiSuccess {Boolean} status true
     * @apiSuccess {number} responseCode number
     * @apiSuccess {Object} body object
     * @apiSuccessExample {json} Success-200:
     * HTTP/1.1 200 OK
     *{
     * "status": true,
     * "responseCode": 200,
     * "body": [
     * {
     * "id": 1,
     * "to_user_id": 2,
     * "notification": "<b>xyz12@company.com</b> has ask you to setup a personal call with your reference <b>Test1 Test1</b>.Don't forgot to organize this call as soon as possible",
     * "is_read": 0,
     * "created_at": "2021-06-07T12:10:21.000000Z",
     * "updated_at": "2021-06-07T12:10:21.000000Z",
     * "deleted_at": null
     * }
     * ]
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
    public function getNotification()
    {
        $result = Notification::where('to_user_id', Auth::user()->id)->get();
        return response()->json(['status' => true, 'responseCode' => 200, 'body' => $result], 200);
    }
}
