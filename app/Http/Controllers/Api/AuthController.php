<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
    	// grab credentials from the request
        $credentials = $request->only('email', 'password');

        $validation = Validator::make($credentials, [
        	'email' => 'required',
        	'password' => 'required',
        ]);

        if($validation->fails())
        {
        	return response()->json([
        		'user' => $validation->errors(), 
        	], 401);
        }

        if (! $token = JWTAuth::attempt($credentials)) {
           	return response()->json(['error' => 'invalid_credentials'], 401);
        }

        $user = JWTAuth::setToken($token)->toUser();

        return response()->json([
        	'user' => $user,
        	'token' => $token,
        ], 200);
    }

    public function logout()
    {
        $token = JWTAuth::getToken();
        if ($token) {
           JWTAuth::setToken($token)->invalidate();
        }
        
        return response([
           'message' => trans('auth.success.logout_successfull_msg'),
        ]);
    }
}
