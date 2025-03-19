<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Flugg\Responder\Http\Responses\SuccessResponseBuilder;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('API_Token')->accessToken;

        return responder()->success([
            'token' => $token,
            'expires_at' => now()->addDays(7),
            'user' => $user
        ])->respond();
    }


    /**
     * Get the authenticated User.
     *
     * @return \Flugg\Responder\Responder
     */
    public function logout(): SuccessResponseBuilder
    {
        /** @var User $user */
        $user = auth()->user();
        $user->tokens()->delete();

        return responder()->success([
            'message' => 'Successfully logged out'
        ]);
    }
}
