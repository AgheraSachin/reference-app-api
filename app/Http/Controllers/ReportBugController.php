<?php

namespace App\Http\Controllers;

use App\Models\ReportBugs;
use App\Models\UnverifiedRatingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReportBugController extends Controller
{
    /**
     * @api {post} /report-bug 1. Report Bug
     * @apiName 1
     * @apiGroup Report Bug
     * @apiUse APIHeader2
     * @apiParam {string} description string
     * @apiParamExample {json} Request-Example:
     * {
     *   description:'I am not able to connect',
     * }
     * @apiSuccess {Boolean} status true
     * @apiSuccess {number} responseCode number
     * @apiSuccess {Object} body object
     * @apiSuccessExample {json} Success-200:
     * HTTP/1.1 200 OK
     *{
     * "status": true,
     * "responseCode": 200,
     * "body": "Report Bug Successfully."
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
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()], 200);
        };
        $result = ReportBugs::create(['description' => $request->get('description'), 'user_id' => Auth::user()->id]);
        if ($result) {
            return response()->json(['status' => true, 'responseCode' => 200, 'body' => 'Report Bug Successfully'], 200);
        } else {
            return response()->json(['status' => false, 'responseCode' => 500, 'body' => 'Something went wrong'], 200);
        }
    }
}
