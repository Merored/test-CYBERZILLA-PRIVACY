<?php

namespace App\Http\Controllers;
use JWTAuth;
use Auth;
use App\User;


use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        JWTAuth::factory()->setTTL(120);
        if (!$token = JWTAuth::attempt($credentials)) {         
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Вы ввели неверные данные для входа.'
            ], 400);
        }
        return $this->respondWithToken($token);
    }
    public function user(Request $request)
    {
        if (isset(Auth::user()->id)) {
            $user = User::find(Auth::user()->id);
            $user->fullname = $user->fio();
            return $user;
        } else {
            return response([
                'status' => 'error',
                'data' => 'no user data'
            ]);
        }
    }
    public function authorized(Request $request)
    {
        if (isset(Auth::user()->id)) {
            return ['authorized' => true];
        } else {
            return ['authorized' => false];
        }
    }

    public function refresh()
    {   
        $token = JWTAuth::getToken();
        $payload = JWTAuth::decode($token);

        if (($payload->get('exp') - strtotime( date('Y-m-d H:i:s'))) < 1800) {
            $newToken =  JWTAuth::refresh();
            return ['status' => 'success','refresh' => true, 'new_token' => $newToken];
        } 
        return  ['status' => 'success','refresh' => false];
    }
    public function logout()
    {
        JWTAuth::invalidate();
        return response([
                'status' => 'success',
                'msg' => 'Logged out Successfully.'
            ], 200);
    }
    
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => JWTAuth::factory()->getTTL() * 60
        ]);
    }
    public function guard()
    {
        return Auth::guard();
    }
}
