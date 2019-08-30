<?php
/**
 * Created by PhpStorm.
 * User: hemant.singh
 * Date: 29/08/19
 * Time: 13:27
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth:api', ['expect' => ['login']]);
    }

    public function register(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->errorBadRequest($validator);
        }

        $password = $request->get('password');
        $attributes = [
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'password' => app('hash')->make($password),
        ];
        $user = User::create($attributes);

        $credentials = $request->only('email', 'password');
        // Validation failed will return 401
        if (!$token = $this->guard()->attempt($credentials,true)) {
            $this->response->errorUnauthorized();
        }

        $result['data'] = [
            'user' => $user,
            'token' => $token,
            'expired_in' => $this->guard()->factory()->getTTL() * 60,
        ];

        return $this->response->array($result)->setStatusCode(201);
    }

    public function login(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorBadRequest($validator);
        }

        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials,true)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorizend'], 401);
    }

    public function me()
    {
        return response()->json($this->guard()->user());
    }

    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
        ]);
    }

    public function guard()
    {
        return Auth::guard();
    }
}
