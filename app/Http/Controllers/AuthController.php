<?php

namespace App\Http\Controllers;

use App\Mail\RegisterPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;


class AuthController extends Controller
{

    public function accessTokenRetrive(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'requested_url' => 'required',
            'client_id' => 'required',
            'client_secret' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => $validator->errors()]);
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
            return response()->json(['status' => false, 'error' => 'Internal Server Error'], 503);
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
            return $this->signup($request);
        } else {
            return response()->json(['status' => false, 'error' => 'Internal Server Error'], 503);
        }
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => $validator->errors()]);
        }

        if (User::where('email', $request->get('email'))->exists()) {
            $user = User::where('email', $request->get('email'))->first();
            $user['token'] = $user->createToken('linkedin')->accessToken;
            return response()->json(['status' => true, 'data' => $user], 200);
        }

        $password = $this->generateRandomString();
        $data = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($password)
        ];

        $result = User::create($data);

        Mail::to($request->get('email'))->send(new RegisterPasswordMail($password));
        if ($result) {
            if (!Auth::attempt(['email' => $request->get('email'), 'password' => $password])) {
                return response()->json(['status' => false, 'message' => 'Unauthorized'], 401);
            }
            $user = $request->user();
            $user['token'] = $user->createToken('linkedin')->accessToken;
            return response()->json(['status' => true, 'data' => $user], 200);
        }
    }

    function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }
}
