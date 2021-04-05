<?php

namespace App\Http\Controllers;

use App\Mail\UnverifiedRatingRequestMail;
use App\Mail\VerifiedRatingRequestMail;
use App\Models\UnverifiedRatingRequest;
use App\Models\VerifiedRatingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AudioVideoReferenceController extends Controller
{
    public function makeRequestForAudioVideoReference(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => $validator->errors()], 503);
        }
        if (VerifiedRatingRequest::where(['from_user_id' => Auth::user()->id, 'email' => $request->get('email')])->exists()) {
            return response()->json(['status' => false, 'responseCode' => 503, 'body' => "You have already previouslly requested same user"], 503);
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
}
