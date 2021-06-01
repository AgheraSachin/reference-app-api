<?php

namespace App\Http\Controllers;

use App\Mail\RegisterPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;


class AuthController extends Controller
{

    /**
     * @apiDefine APIHeader1
     * @apiHeader {String} Api-Version Api Version
     * @apiHeader {String} Accept Content type
     * @apiHeaderExample {json} Header-Example:
     * {
     *      "Api-Version": "v1",
     *      "Accept": "application/json"
     * }
     */

    /**
     * @apiDefine APIHeader2
     * @apiHeader {String} Accept Content type
     * @apiHeader {String} Authorization  Access Bearer token
     * @apiHeaderExample {json} Header-Example:
     * {
     *      "Accept": "application/json",
     *      "Authorization": "Bearer ".{{token}}
     * }
     */

    /**
     * @apiDefine APIError
     * @apiError {Boolean} success false
     * @apiError {String} message Error message
     */

    /**
     * @apiDefine Error401Example
     * @apiErrorExample {json} Error-401:
     * Error 401: Unauthorized
     * {
     *      "success": false,
     *      "message": "Unauthenticated! Login to continue."
     * }
     */

    /**
     * @apiDefine Error422ValidEmailExample
     * @apiErrorExample {json} Error-422:
     * Error 422: Unprocessable Entity
     * {
     *      "success": false,
     *      "message": "The email must be a valid email address."
     * }
     */

    /**
     * @apiDefine Error422UniqueEmailExample
     * @apiErrorExample {json} Error-422:
     * Error 422: Unprocessable Entity
     * {
     *      "success": false,
     *      "message": "The email has already been taken."
     * }
     */

    /**
     * @apiDefine ErrorPassLengthExample
     * @apiErrorExample {json} Error-422:
     * Error 422: Unprocessable Entity
     * {
     *      "success": false,
     *      "message": "The password must be at least 8 characters."
     * }
     */

    /**
     * @apiDefine ErrorPassConfirmExample
     * @apiErrorExample {json} Error-422:
     * Error 422: Unprocessable Entity
     * {
     *      "success": false,
     *      "message": "The password confirmation does not match."
     * }
     */

    /**
     * @apiDefine Error404Example
     * @apiErrorExample {json} Error-404:
     * Error 404: Not Found
     * {
     *      "success": false,
     *      "message": "Resource not found."
     * }
     */

    /**
     * @apiDefine Error405Example
     * @apiErrorExample {json} Error-405:
     * Error 405: Method Not Allowed
     * {
     *      "success": false,
     *      "message": "Method Not Allowed."
     * }
     */

    /**
     * @apiDefine Error500Example
     * @apiErrorExample {json} Error-500:
     * Error 500: Internal Server Error
     * {
     *      "success": false,
     *      "message": "Something went wrong, please try after some time."
     * }
     */


    /**
     * @api {post} /accessToken 1. Get AccessToken
     * @apiName 1
     * @apiGroup Login
     * @apiParam {String} code Authorization code from linkedin
     * @apiParam {string} requested_url URL
     * @apiParam {string} client_id Client ID
     * @apiParam {String} client_secret Client Secret
     * @apiSuccess {Boolean} status true
     * @apiSuccess {Object} body object
     * @apiSuccessExample {json} Success-200:
     * HTTP/1.1 200 OK
     * {
     *   "status": true,
     *   "body":  {
     *        "user":{
     *               "id": 1,
     *              "first_name": "Sachin",
     *              "last_name": "Aghera",
     *              "email": "sachinaghera4@gmail.com",
     *              "profile_pic": "http://localhost/storage/Users/1617456286.jpeg",
     *              "created_at": "2021-03-26T02:35:57.000000Z",
     *              "updated_at": "2021-03-26T02:35:57.000000Z",
     *          },
     *          "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOTgzM2JhMTRjZTBhNTFjNDM3YmJkMTNjOTBkMWViNmQzYTk1MjliOWYyOWJlNzkwMjhjZGQxMDk5M2ZmMjkzMmU0N2RiZjgzYzNmMjA0NTgiLCJpYXQiOjE2MTcyMTI5MzMsIm5iZiI6MTYxNzIxMjkzMywiZXhwIjoxNjQ4NzQ4OTMzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.jYX8b2mj59wURFqfIGXh2Vqtf8y96oCdjDScl2ZiAjGNSrjR_lOGIMo4m4EaBKUCxNjcPvyRU4eTuqznJfsEYeqRtmQRuw3Uifp6fHUIXL6iuDEjiB6t_3f9RM2Sny-QlpV03FUW2F1KRtKKLQSjL9rMemQHefJJ4Bkz0s_rZ1YTpR35kOh9cJ8AenV5pinymKtX6wq1KVrD0aTlEQp33Rlyzk0SS40TqQsKO737VCXQY51Qd-JTJ67jWDmTPtZJKa-V14tGWRQDppx6vMMCY_KZ7eTKWy2KL-zZh_A4JfUoA4O7YalxZK33d2JKtiFLNmAUil5HjalPAcKRFIfD0EqcI8QWdUiJRkBgsliVjzClTLjoUGM2vyF767aXLwn6SDbcesYM-be5jtPsFhAbYzOu7cSdCXtuwbYquNK2QXAUq5CDR7f98TEnvz-yiL3QLgjyaTOj1_KFMhvSxLgl1mMhbJPKaAhxyp1IqCx2QCxIsE7e8BWOBWCc0TGSDsXw2lwGvxMcGF4lg-xKRNiXoH5nwXdQH7Fauxey93EdsRW5ClJcL9YvVgDP-NyXCrVVZv5T8OR1bUFcGm-UTTKo0-i-0bSyld03SrKNJYqpdaltZFbBL9vrFGZwPgt8VcarsWfQE96LhQVOtU7w_hAQsCJP31DUwg9hRi1onyNir6Q"
     *      }
     * }
     * @apiUse APIError
     * @apiErrorExample {json} Error-400:
     * Error 422: Unprocessable Entity
     * {
     *   "success": false,
     *   "body": "Server Error."
     * }
     */
    public function accessTokenRetrive(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'requested_url' => 'required',
            'client_id' => 'required',
            'client_secret' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()], 200);
        }

        $response = Http::asForm()->post('https://www.linkedin.com/oauth/v2/accessToken', [
            'grant_type' => 'authorization_code',
            'code' => $request->get('code'),
            'redirect_uri' => $request->get('requested_url'),
            'client_id' => $request->get('client_id'),
            'client_secret' => $request->get('client_secret'),
        ]);
        if ($response->successful()) {
            $accessToken = $response->json()['access_token'];
            return $this->getUserDetailsfromLinkedIn($accessToken, $request);
        } else {
            return response()->json(['status' => false, 'responseCode' => 404, 'body' => 'Internal Server Error'], 200);
        }
    }

    public function getUserDetailsfromLinkedIn($accessToken, $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken
        ])->get('https://api.linkedin.com/v2/me');
        if ($response->successful()) {
            $userData = $response->json();
            $request->request->add(['first_name' => $userData['localizedFirstName']]);
            $request->request->add(['last_name' => $userData['localizedLastName']]);

            $params = [
                'q' => 'members',
                'oauth2_access_token' => $accessToken,
                'projection' => "(elements*(primary,type,handle~))"
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.linkedin.com/v2/clientAwareMemberHandles?" . rawurldecode(http_build_query($params)));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $emailJsonData = json_decode($output, true);
            if (isset($emailJsonData['elements'][0]['handle~'])) {
                $request->request->add(['email' => $emailJsonData['elements'][0]['handle~']['emailAddress']]);
            }
            return $this->signup($request, $accessToken);
        } else {
            return response()->json(['status' => false, 'error' => 'Internal Server Error'], 200);
        }
    }


    public function signup(Request $request, $accessToken)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()], 200);
        }

        if (User::where('email', $request->get('email'))->exists()) {
            $user = User::where('email', $request->get('email'))->first();
            $data['token'] = $user->createToken('linkedin')->accessToken;
            $data['user'] = $user;
            return response()->json(['status' => true, 'responseCode' => 200, 'body' => $data], 200);
        }

        $password = $this->generateRandomString();
        $profileParams = [
            'oauth2_access_token' => $accessToken,
            'projection' => "(id,firstName,lastName,emailAddress,profilePicture(displayImage~:playableStreams))"
        ];
        $profilePicJsonData = Http::get('https://api.linkedin.com/v2/me', rawurldecode(http_build_query($profileParams)));
        if ($profilePicJsonData->successful()) {
            if (isset($profilePicJsonData->json()['profilePicture'])) {
                $profilepic = $profilePicJsonData->json()['profilePicture']['displayImage~']['elements'][2]['identifiers'][0]['identifier'];
                $content = file_get_contents($profilepic);
                $filename = time() . '.jpeg';
                Storage::put('Users/' . $filename, (string)$content, 'public');
                $request->request->add(['profile_pic' => $filename]);
            } else {
                $request->request->add(['profile_pic' => null]);
            }

        }
        $profile_pic = $request->input('profile_pic');
        $data = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($password),
            'profile_pic' => isset($profile_pic) ? $request->input('profile_pic') : null,
        ];

        $result = User::create($data);

        Mail::to($request->get('email'))->send(new RegisterPasswordMail($request->input('first_name'), $request->input('last_name'), $password));
        if ($result) {
            if (!Auth::attempt(['email' => $request->get('email'), 'password' => $password])) {
                return response()->json(['status' => false, 'responseCode' => 401, 'body' => 'Unauthorized'], 200);
            }
            $user = $request->user();
            $data['token'] = $user->createToken('linkedin')->accessToken;
            $data['user'] = $user;
            return response()->json(['status' => true, 'responseCode' => 200, 'body' => $data], 200);
        }
    }

    function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    /**
     * @api {post} /signin 2. Signin API
     * @apiName 2
     * @apiGroup Login
     * @apiParam {String} email email id
     * @apiParam {string} password password
     * @apiSuccess {Boolean} status true
     * @apiSuccess {number} responseCode responseCode
     * @apiSuccess {Object} body object
     * @apiSuccessExample {json} Success-200:
     * HTTP/1.1 200 OK
     * {
     *   "status": true,
     *   "responseCode":200,
     *     "body":  {
     *        "user":{
     *               "id": 1,
     *              "first_name": "Sachin",
     *              "last_name": "Aghera",
     *              "email": "sachinaghera4@gmail.com",
     *              "profile_pic": "http://localhost/storage/Users/1617456286.jpeg",
     *              "created_at": "2021-03-26T02:35:57.000000Z",
     *              "updated_at": "2021-03-26T02:35:57.000000Z",
     *          },
     *          "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOTgzM2JhMTRjZTBhNTFjNDM3YmJkMTNjOTBkMWViNmQzYTk1MjliOWYyOWJlNzkwMjhjZGQxMDk5M2ZmMjkzMmU0N2RiZjgzYzNmMjA0NTgiLCJpYXQiOjE2MTcyMTI5MzMsIm5iZiI6MTYxNzIxMjkzMywiZXhwIjoxNjQ4NzQ4OTMzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.jYX8b2mj59wURFqfIGXh2Vqtf8y96oCdjDScl2ZiAjGNSrjR_lOGIMo4m4EaBKUCxNjcPvyRU4eTuqznJfsEYeqRtmQRuw3Uifp6fHUIXL6iuDEjiB6t_3f9RM2Sny-QlpV03FUW2F1KRtKKLQSjL9rMemQHefJJ4Bkz0s_rZ1YTpR35kOh9cJ8AenV5pinymKtX6wq1KVrD0aTlEQp33Rlyzk0SS40TqQsKO737VCXQY51Qd-JTJ67jWDmTPtZJKa-V14tGWRQDppx6vMMCY_KZ7eTKWy2KL-zZh_A4JfUoA4O7YalxZK33d2JKtiFLNmAUil5HjalPAcKRFIfD0EqcI8QWdUiJRkBgsliVjzClTLjoUGM2vyF767aXLwn6SDbcesYM-be5jtPsFhAbYzOu7cSdCXtuwbYquNK2QXAUq5CDR7f98TEnvz-yiL3QLgjyaTOj1_KFMhvSxLgl1mMhbJPKaAhxyp1IqCx2QCxIsE7e8BWOBWCc0TGSDsXw2lwGvxMcGF4lg-xKRNiXoH5nwXdQH7Fauxey93EdsRW5ClJcL9YvVgDP-NyXCrVVZv5T8OR1bUFcGm-UTTKo0-i-0bSyld03SrKNJYqpdaltZFbBL9vrFGZwPgt8VcarsWfQE96LhQVOtU7w_hAQsCJP31DUwg9hRi1onyNir6Q"
     *      }
     * }
     * @apiUse APIError
     * @apiErrorExample {json} Error-500:
     * Error 500: Unprocessable Entity
     * {
     *   "status": false,
     *   "responseCode":500,
     *   "body": "Server Error."
     * },
     * @apiErrorExample {json} Error-401:
     * Error 401: Unauthorized Entity
     * {
     *   "status": false,
     *   "responseCode":401,
     *   "body": "Unauthorized."
     * },
     * @apiErrorExample {json} Error-503:
     * Error 503: Validation Error
     * {
     *   "status": false,
     *   "responseCode":503,
     *   "body": "error object"
     * },
     *
     */

    public function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()]);
        }
        if (!User::where('email', $request->get('email'))->exists()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => 'No User found.']);
        }
        if (!Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            return response()->json(['status' => false, 'responseCode' => 401, 'body' => 'Unauthorized'], 200);
        }
        $user = $request->user();
        $data['token'] = $user->createToken('linkedin')->accessToken;
        $data['user'] = $user;
        return response()->json(['status' => true, 'responseCode' => 200, 'body' => $data], 200);
    }

    /**
     * @api {get} /signout 3. Signout User
     * @apiName 3
     * @apiUse APIHeader2
     * @apiGroup Login
     * @apiSuccess {Boolean} status true
     * @apiSuccess {number} responseCode number
     * @apiSuccess {Object} body object
     * @apiSuccessExample {json} Success-200:
     * HTTP/1.1 200 OK
     * {
     *      "status": true,
     *      "responseCode": 200,
     *      "body": "logout successfully"
     *  }
     */
    public function signout()
    {
        $user = Auth::user()->token();
        $user->revoke();
        return response()->json(['status' => true, 'responseCode' => 200, 'body' => "logout successfully"], 200);
    }

    /**
     * @api {post} /change-password 4. Change the user's password
     * @apiName 4
     * @apiUse APIHeader2
     * @apiGroup Login
     * @apiParamExample {json} Request-Example:
     * {
     *   password:'xyz',
     *   password_confirmation : "xyz",
     * }
     * @apiSuccess {Boolean} status true
     * @apiSuccess {number} responseCode number
     * @apiSuccess {Object} body object
     * @apiSuccessExample {json} Success-200:
     * HTTP/1.1 200 OK
     * {
     *      "status": true,
     *      "responseCode": 200,
     *      "body": "Password Changed successfully"
     *  }
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|confirmed'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()]);
        }

        $user_id = Auth::user()->id;

        $resullt = User::where('id', $user_id)->update(['password' => bcrypt($request->get('password'))]);

        if ($resullt) {
            return response()->json(['status' => true, 'responseCode' => 200, 'body' => "Password Changed successfully"], 200);
        } else {
            return response()->json(['status' => false, 'responseCode' => 500, 'body' => "something went wrong"], 500);
        }
    }

    /**
     * @api {get} /delete-account 5. Delete User Account
     * @apiName 5
     * @apiUse APIHeader2
     * @apiGroup Login
     * @apiSuccess {Boolean} status true
     * @apiSuccess {number} responseCode number
     * @apiSuccessExample {json} Success-200:
     * HTTP/1.1 200 OK
     * {
     *      "status": true,
     *      "responseCode": 200,
     *      "body": "Delete Account Successfully"
     *  }
     */
    public function delete(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->delete();
        return response()->json(['status' => true, 'responseCode' => 200, 'body' => "Delete Account Successfully"], 200);
    }
}
