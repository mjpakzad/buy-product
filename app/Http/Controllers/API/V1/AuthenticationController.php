<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    /**
     * Login a user.
     * @throws \Throwable
     */
    public function login(LoginRequest $request)
    {
        throw_unless(auth()->attempt($request->validated()), AuthenticationException::class);
        $token = auth()->user()->createToken('users')->plainTextToken;
        return response()->success(['token' => $token,]);
    }

    /**
     * Logout an authenticated user.
     */
    public function logout(Request $request)
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->success(['message' => 'You have been logged out successfully!'], 200);
    }
}
