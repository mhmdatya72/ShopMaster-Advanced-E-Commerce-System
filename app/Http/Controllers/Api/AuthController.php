<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends BaseController
{
    /**
     * Create a new AuthController instance.
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (!$token = JWTAuth::attempt($request->validated())) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'success' => true,
            'message' => 'User successfully registered',
            'data' => new AuthResource((object) [
                'user' => $user,
                'access_token' => $token,
            ])
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     */
    public function logout(): JsonResponse
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'success' => true,
            'message' => 'User successfully signed out'
        ]);
    }

    /**
     * Refresh a token.
     */
    public function refresh(): JsonResponse
    {
        return $this->createNewToken(JWTAuth::refresh());
    }

    /**
     * Get the authenticated User.
     */
    public function userProfile(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new UserResource(Auth::user())
        ]);
    }

    /**
     * Get the token array structure.
     */
    protected function createNewToken($token): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => new AuthResource((object) [
                'user' => Auth::user(),
                'access_token' => $token,
            ])
        ]);
    }
}
