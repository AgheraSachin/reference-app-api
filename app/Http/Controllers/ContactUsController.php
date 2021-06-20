<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsMail;
use App\Models\ContactUs;
use App\Models\ReportBugs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    /**
     * @api {post} /contact-us 1. Contact US
     * @apiName 1
     * @apiGroup Contact US
     * @apiUse APIHeader1
     * @apiParam {string} name string
     * @apiParam {string} email string
     * @apiParam {text} message string
     * @apiParamExample {json} Request-Example:
     * {
     *   name:'John',
     *   email:'John@gmail.com',
     *   message:'Hey i want to reach you',
     * }
     * @apiSuccess {Boolean} status true
     * @apiSuccess {number} responseCode number
     * @apiSuccess {Object} body object
     * @apiSuccessExample {json} Success-200:
     * HTTP/1.1 200 OK
     *{
     * "status": true,
     * "responseCode": 200,
     * "body": "Successfully Sent Message."
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
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()], 200);
        };
        $result = ContactUs::create(['name' => $request->get('name'), 'email' => $request->get('email'), 'message' => $request->get('message')]);
        if ($result) {
            Mail::to(config('constants.sender_mail'))->send(new ContactUsMail($request->get('name'), $request->get('email'), $request->get('message')));
            return response()->json(['status' => true, 'responseCode' => 200, 'body' => 'Successfully Sent Message'], 200);
        } else {
            return response()->json(['status' => false, 'responseCode' => 500, 'body' => 'Something went wrong'], 200);
        }
    }
}
